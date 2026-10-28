<?php

namespace App\Http\Controllers;

use App\Models\LaporanKalibrasi;
use App\Models\LaporanKalibrasiSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class LaporanKalibrasiController extends Controller
{
    /**
     * Tampilkan halaman pencarian khusus tanpa data awal.
     */
    public function searchOnly()
    {
        return view('laporan.search_only');
    }

    /**
     * Memproses pencarian dan menampilkan hasil di halaman khusus.
     */
    public function searchResults(Request $request)
    {
        $laporan = LaporanKalibrasi::query();

        if ($request->has('search')) {
            $search = $request->search;
            $laporan->where('nama_alat', 'like', '%' . $search . '%')
                    ->orWhere('merk', 'like', '%' . $search . '%')
                    ->orWhere('teknisi', 'like', '%' . $search . '%');
        }

        $laporan = $laporan->get();

        return view('laporan.search_only', compact('laporan'));
    }
    
    /**
     * Tampilkan daftar laporan lengkap.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporan = LaporanKalibrasi::query();
            return DataTables::of($laporan)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="'.route('laporan.show', $row->id).'" class="btn btn-info btn-sm">View</a> ';
                    $btn .= '<a href="'.route('laporan.edit', $row->id).'" class="btn btn-warning btn-sm">Edit</a> ';
                    if ($row->file_path) {
                        $btn .= '<a href="'.route('laporan.download', $row->id).'" class="btn btn-success btn-sm">Download</a> ';
                    }
                    $btn .= '<form action="'.route('laporan.destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                             </form>';
                    return $btn;
                })
                ->addColumn('file_download', function($row) {
                    if ($row->file_path) {
                        return '<a href="'.route('laporan.download', $row->id).'" class="btn btn-sm btn-outline-primary">Download File</a>';
                    }
                    return 'No File';
                })
                ->rawColumns(['action', 'file_download'])
                ->make(true);
        }
        return view('laporan.index');
    }

    /**
     * Tampilkan formulir untuk membuat laporan baru.
     */
    public function create()
    {
        return view('laporan.create');
    }
    
    /**
     * Tampilkan detail laporan.
     */
    public function show(LaporanKalibrasi $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    /**
     * Simpan laporan baru ke database, termasuk file yang diunggah.
     */
    public function store(Request $request)
    {
        // 1. Validasi semua data
        $request->validate([
            'kalibrasi_id' => 'nullable|exists:kalibrasi,id|unique:laporan_kalibrasis,kalibrasi_id',
            'nama_alat' => 'required',
            'merk' => 'required',
            'no_seri' => 'required',
            'tgl_kalibrasi' => 'required|date',
            'tgl_next_kalibrasi' => 'required|date',
            'hasil' => 'required',
            'teknisi' => 'required',
            'nilai_sets' => 'nullable|array|max:5',
            'nilai_sets.*.setting' => 'required|numeric',
            'nilai_sets.*.pengukuran' => 'required|array|min:2',
            'nilai_sets.*.pengukuran.*' => 'required|numeric',
            'file_kalibrasi' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // 2. Unggah file jika ada
        $filePath = null;
        if ($request->hasFile('file_kalibrasi')) {
            $file = $request->file('file_kalibrasi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kalibrasi'), $fileName);
            $filePath = 'uploads/kalibrasi/' . $fileName;
        }

        // Ambil nilai-nilai dari input
        $nilaiSets = $request->input('nilai_sets');

        // Inisialisasi variabel untuk perhitungan
        $primarySet = null;
        if (is_array($nilaiSets) && count($nilaiSets) > 0) {
            $primarySet = $nilaiSets[0];
        }

        // 3. Simpan data laporan ke database
        $laporan = LaporanKalibrasi::create([
            'kalibrasi_id' => $request->kalibrasi_id,
            'nama_alat' => $request->nama_alat,
            'merk' => $request->merk,
            'no_seri' => $request->no_seri,
            'tgl_kalibrasi' => $request->tgl_kalibrasi,
            'tgl_next_kalibrasi' => $request->tgl_next_kalibrasi,
            'hasil' => $request->hasil,
            'teknisi' => $request->teknisi,
            'file_path' => $filePath,
            'nilai_setting' => $primarySet ? $primarySet['setting'] : null,
            'nilai_pengukuran' => $primarySet ? json_encode($primarySet['pengukuran']) : null,
            'u_a_value' => null,
            'rata_rata' => null,
            'standar_deviasi' => null,
            'nilai_koreksi' => null,
        ]);

        if (is_array($nilaiSets)) {
            foreach ($nilaiSets as $set) {
                $setting = $set['setting'];
                $pengukuran = $set['pengukuran'];
                $n = count($pengukuran);
                $rata = $n ? array_sum($pengukuran) / $n : 0;
                $sumSq = 0;
                foreach ($pengukuran as $v) { $sumSq += pow($v - $rata, 2); }
                $sd = $n > 1 ? sqrt($sumSq / ($n - 1)) : 0;
                $ua = $n > 0 ? $sd / sqrt($n) : 0;
                $koreksi = $rata - $setting;
                LaporanKalibrasiSet::create([
                    'laporan_kalibrasi_id' => $laporan->id,
                    'nilai_setting' => $setting,
                    'nilai_pengukuran' => json_encode($pengukuran),
                    'rata_rata' => $rata,
                    'standar_deviasi' => $sd,
                    'u_a_value' => $ua,
                    'nilai_koreksi' => $koreksi,
                ]);
            }
        }

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan');
    }

    /**
     * Menangani proses unduh file laporan.
     */
    public function download(LaporanKalibrasi $laporan)
    {
        // Periksa apakah ada file yang terkait dengan laporan
        if ($laporan->file_path && file_exists(public_path($laporan->file_path))) {
            return response()->download(public_path($laporan->file_path));
        }
        
        // Jika file tidak ditemukan, arahkan kembali dengan pesan error
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    /**
     * Tampilkan formulir untuk mengedit laporan.
     */
    public function edit(LaporanKalibrasi $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

    /**
     * Perbarui laporan di database.
     */
    public function update(Request $request, LaporanKalibrasi $laporan)
    {
        $request->validate([
            'nama_alat' => 'required',
            'merk' => 'required',
            'no_seri' => 'required',
            'tgl_kalibrasi' => 'required|date',
            'tgl_next_kalibrasi' => 'required|date',
            'hasil' => 'required',
            'teknisi' => 'required',
            'nilai_sets' => 'nullable|array|max:5',
            'nilai_sets.*.setting' => 'required|numeric',
            'nilai_sets.*.pengukuran' => 'required|array|min:2',
            'nilai_sets.*.pengukuran.*' => 'required|numeric',
            'file_kalibrasi' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $filePath = $laporan->file_path;
        if ($request->hasFile('file_kalibrasi')) {
            $file = $request->file('file_kalibrasi');
            $filename = 'laporan_'.time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/laporan'), $filename);
            $filePath = 'uploads/laporan/'.$filename;
        }

        $nilaiSets = $request->input('nilai_sets');
        $primarySet = (is_array($nilaiSets) && count($nilaiSets) > 0) ? $nilaiSets[0] : null;

        $laporan->update([
            'nama_alat' => $request->nama_alat,
            'merk' => $request->merk,
            'no_seri' => $request->no_seri,
            'tgl_kalibrasi' => $request->tgl_kalibrasi,
            'tgl_next_kalibrasi' => $request->tgl_next_kalibrasi,
            'hasil' => $request->hasil,
            'teknisi' => $request->teknisi,
            'file_path' => $filePath,
            'nilai_setting' => $primarySet ? $primarySet['setting'] : null,
            'nilai_pengukuran' => $primarySet ? json_encode($primarySet['pengukuran']) : null,
        ]);

        // Replace existing sets with new ones
        $laporan->sets()->delete();
        if (is_array($nilaiSets)) {
            foreach ($nilaiSets as $set) {
                $setting = $set['setting'];
                $pengukuran = $set['pengukuran'];
                $n = count($pengukuran);
                $rata = $n ? array_sum($pengukuran) / $n : 0;
                $sumSq = 0;
                foreach ($pengukuran as $v) { $sumSq += pow($v - $rata, 2); }
                $sd = $n > 1 ? sqrt($sumSq / ($n - 1)) : 0;
                $ua = $n > 0 ? $sd / sqrt($n) : 0;
                $koreksi = $rata - $setting;
                $laporan->sets()->create([
                    'nilai_setting' => $setting,
                    'nilai_pengukuran' => json_encode($pengukuran),
                    'rata_rata' => $rata,
                    'standar_deviasi' => $sd,
                    'u_a_value' => $ua,
                    'nilai_koreksi' => $koreksi,
                ]);
            }
        }

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui');
    }

    /**
     * Hapus laporan dari database.
     */
    public function destroy(LaporanKalibrasi $laporan)
    {
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus');
    }
}
