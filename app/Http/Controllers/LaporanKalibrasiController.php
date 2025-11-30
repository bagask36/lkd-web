<?php

namespace App\Http\Controllers;

use App\Models\LaporanKalibrasi;
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
            'nilai_setting' => 'required|numeric', // Validasi nilai setting
            'nilai_pengukuran' => 'required|array|min:2',
            'nilai_pengukuran.*' => 'required|numeric',
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
        $nilaiSetting = $request->input('nilai_setting');
        $nilaiPengukuran = $request->input('nilai_pengukuran');

        // Inisialisasi variabel untuk perhitungan
        $rataRata = 0;
        $standarDeviasi = 0;
        $uAValue = 0;
        $nilaiKoreksi = 0;

        if (count($nilaiPengukuran) > 1) {
            $n = count($nilaiPengukuran);
            $rataRata = array_sum($nilaiPengukuran) / $n;
            
            $jumlahKuadratSelisih = 0;
            foreach ($nilaiPengukuran as $nilai) {
                $jumlahKuadratSelisih += pow($nilai - $rataRata, 2);
            }

            $standarDeviasi = sqrt($jumlahKuadratSelisih / ($n - 1));
            $uAValue = $standarDeviasi / sqrt($n);
        }
        
        // Hitung nilai koreksi berdasarkan Rata-rata dan Nilai Setting
        $nilaiKoreksi = $rataRata - $nilaiSetting;

        // 3. Simpan data laporan ke database
        LaporanKalibrasi::create([
            'kalibrasi_id' => $request->kalibrasi_id,
            'nama_alat' => $request->nama_alat,
            'merk' => $request->merk,
            'no_seri' => $request->no_seri,
            'tgl_kalibrasi' => $request->tgl_kalibrasi,
            'tgl_next_kalibrasi' => $request->tgl_next_kalibrasi,
            'hasil' => $request->hasil,
            'teknisi' => $request->teknisi,
            'file_path' => $filePath,
            'nilai_setting' => $nilaiSetting,
            'nilai_pengukuran' => json_encode($nilaiPengukuran), // Simpan array sebagai JSON
            'u_a_value' => $uAValue,
            'rata_rata' => $rataRata,
            'standar_deviasi' => $standarDeviasi,
            'nilai_koreksi' => $nilaiKoreksi,
        ]);

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
        $laporan->update($request->all());
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
