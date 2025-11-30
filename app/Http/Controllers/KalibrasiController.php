<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalibrasi;
use App\Models\LaporanKalibrasi;
use Yajra\DataTables\Facades\DataTables;
use setasign\Fpdi\Fpdi;

class KalibrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kalibrasis = Kalibrasi::query();
            if ($request->filled('nama_alat')) {
                $kalibrasis->where('nama_alat', 'like', '%'.$request->get('nama_alat').'%');
            }
            if ($request->filled('merk_alat')) {
                $kalibrasis->where('merk_alat', 'like', '%'.$request->get('merk_alat').'%');
            }
            if ($request->filled('tipe_alat')) {
                $kalibrasis->where('tipe_alat', 'like', '%'.$request->get('tipe_alat').'%');
            }
            if ($request->filled('start_date')) {
                $kalibrasis->whereDate('tanggal_kalibrasi', '>=', $request->get('start_date'));
            }
            if ($request->filled('end_date')) {
                $kalibrasis->whereDate('tanggal_kalibrasi', '<=', $request->get('end_date'));
            }
            return DataTables::of($kalibrasis)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="'.route('kalibrasi.show', $row->id).'" class="btn btn-info btn-sm">View</a> ';
                    $btn .= '<a href="'.route('kalibrasi.edit', $row->id).'" class="btn btn-warning btn-sm">Edit</a> ';
                    $btn .= '<form action="'.route('kalibrasi.destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                             </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('kalibrasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kalibrasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'merk_alat' => 'required',
            'tipe_alat' => 'required',
            'tanggal_kalibrasi' => 'required|date',
            'merek' => 'nullable|string',
            'model_tipe' => 'nullable|string',
            'no_seri' => 'nullable|string',
            'no_order' => 'nullable|string',
            'nama_pemilik' => 'nullable|string',
            'alamat_pemilik' => 'nullable|string',
            'nama_ruang' => 'nullable|string',
            'lokasi_kalibrasi' => 'nullable|string',
            'hasil' => 'nullable|string',
            'metode_kerja' => 'nullable|string',
        ]);

        Kalibrasi::create($request->all());

        return redirect()->route('kalibrasi.index')->with('success', 'Data kalibrasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kalibrasi $kalibrasi)
    {
        return view('kalibrasi.show', compact('kalibrasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kalibrasi $kalibrasi)
    {
        return view('kalibrasi.edit', compact('kalibrasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kalibrasi $kalibrasi)
    {
        $request->validate([
            'nama_alat' => 'required',
            'merk_alat' => 'required',
            'tipe_alat' => 'required',
            'tanggal_kalibrasi' => 'required|date',
            'merek' => 'nullable|string',
            'model_tipe' => 'nullable|string',
            'no_seri' => 'nullable|string',
            'no_order' => 'nullable|string',
            'nama_pemilik' => 'nullable|string',
            'alamat_pemilik' => 'nullable|string',
            'nama_ruang' => 'nullable|string',
            'lokasi_kalibrasi' => 'nullable|string',
            'hasil' => 'nullable|string',
            'metode_kerja' => 'nullable|string',
        ]);

        $kalibrasi->update($request->all());

        return redirect()->route('kalibrasi.index')->with('success', 'Data kalibrasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kalibrasi $kalibrasi)
    {
        $kalibrasi->delete();

        return redirect()->route('kalibrasi.index')->with('success', 'Data kalibrasi berhasil dihapus!');
    }

    public function export(Request $request)
    {
        $query = Kalibrasi::query();
        if ($request->filled('nama_alat')) {
            $query->where('nama_alat', 'like', '%'.$request->get('nama_alat').'%');
        }
        if ($request->filled('merk_alat')) {
            $query->where('merk_alat', 'like', '%'.$request->get('merk_alat').'%');
        }
        if ($request->filled('tipe_alat')) {
            $query->where('tipe_alat', 'like', '%'.$request->get('tipe_alat').'%');
        }
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_kalibrasi', '>=', $request->get('start_date'));
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_kalibrasi', '<=', $request->get('end_date'));
        }

        $filename = 'kalibrasi.csv';
        return response()->streamDownload(function() use ($query) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['No', 'Nama Alat', 'Merk Alat', 'Tipe Alat', 'Tanggal Kalibrasi']);
            $no = 0;
            foreach ($query->orderBy('tanggal_kalibrasi', 'desc')->cursor() as $row) {
                $tanggal = $row->tanggal_kalibrasi ? $row->tanggal_kalibrasi->format('d-m-Y') : '';
                fputcsv($handle, [++$no, $row->nama_alat, $row->merk_alat, $row->tipe_alat, $tanggal]);
            }
            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function search(Request $request)
    {
        $q = $request->get('q');
        $results = Kalibrasi::query()
            ->when($q, function ($query) use ($q) {
                $query->where('nama_alat', 'like', '%'.$q.'%')
                      ->orWhere('merk_alat', 'like', '%'.$q.'%')
                      ->orWhere('no_seri', 'like', '%'.$q.'%');
            })
            ->select('id', 'nama_alat', 'merk_alat', 'no_seri', 'nama_pemilik')
            ->orderBy('nama_alat')
            ->limit(20)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->nama_alat.' - '.($item->nama_pemilik ?? '-'),
                    'nama_alat' => $item->nama_alat,
                    'merk_alat' => $item->merk_alat,
                    'no_seri' => $item->no_seri,
                ];
            });

        return response()->json($results);
    }

    public function sertifikat(Kalibrasi $kalibrasi)
    {
        $templatePath = public_path('assets/back/sertifikat.pdf');
        if (!file_exists($templatePath)) {
            abort(404, 'Template sertifikat tidak ditemukan');
        }

        $pdf = new Fpdi();
        $pdf->AddPage('P', 'A4');
        $pdf->setSourceFile($templatePath);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0, 210);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);

        $dateStr = $kalibrasi->tanggal_kalibrasi ? $kalibrasi->tanggal_kalibrasi->format('d F Y') : '-';
        $issuedStr = \Carbon\Carbon::now()->format('d F Y');

        $fields = [
            ['label' => 'Nama Pemilik', 'en' => 'Owner Name', 'value' => $kalibrasi->nama_pemilik],
            ['label' => 'Nama Alat', 'en' => 'Instrument Name', 'value' => $kalibrasi->nama_alat],
            ['label' => 'Merk Alat', 'en' => 'Brand', 'value' => $kalibrasi->merk_alat],
            ['label' => 'Tipe Alat', 'en' => 'Model/Type', 'value' => $kalibrasi->tipe_alat],
            ['label' => 'No. Seri', 'en' => 'Serial Number', 'value' => $kalibrasi->no_seri],
            ['label' => 'No. Order', 'en' => 'Order Number', 'value' => $kalibrasi->no_order],
            ['label' => 'Tanggal Kalibrasi', 'en' => 'Calibration Date', 'value' => $dateStr],
            ['label' => 'Lokasi Kalibrasi', 'en' => 'Calibration Location', 'value' => $kalibrasi->lokasi_kalibrasi],
            ['label' => 'Nama Ruang', 'en' => 'Room Name', 'value' => $kalibrasi->nama_ruang],
            ['label' => 'Metode Kerja', 'en' => 'Method', 'value' => $kalibrasi->metode_kerja],
        ];

        $xLabelLeft = 20; $xValueLeft = 70; $xLabelRight = 110; $xValueRight = 150;
        $yStart = 118; $line = 11;
        $yLeft = $yStart; $yRight = $yStart;

        $leftFields = array_slice($fields, 0, 5);
        $rightFields = array_slice($fields, 5);

        foreach ($leftFields as $f) {
            $value = $f['value'] ?: '-';
            $pdf->SetXY($xLabelLeft, $yLeft);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Write(5, $f['label']);
            $pdf->SetXY($xLabelLeft, $yLeft + 5);
            $pdf->SetTextColor(120, 120, 120);
            $pdf->SetFont('Arial', 'I', 8);
            $pdf->Write(5, ($f['en'] ?? ''));
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($xValueLeft, $yLeft);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Write(5, ': '.$value);
            $yLeft += $line;
        }

        foreach ($rightFields as $f) {
            $value = $f['value'] ?: '-';
            $pdf->SetXY($xLabelRight, $yRight);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Write(5, $f['label']);
            $pdf->SetXY($xLabelRight, $yRight + 5);
            $pdf->SetTextColor(120, 120, 120);
            $pdf->SetFont('Arial', 'I', 8);
            $pdf->Write(5, ($f['en'] ?? ''));
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($xValueRight, $yRight);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Write(5, ': '.$value);
            $yRight += $line;
        }

        $y = max($yLeft, $yRight) + 8;

        // Alamat dan Hasil ditulis multiline
        $pdf->SetXY($xLabelLeft, $y);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Write(5, 'Alamat Pemilik');
        $pdf->SetXY($xLabelLeft, $y + 5);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Write(5, 'Owner Address');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($xValueLeft, $y);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(120, 6, ': '.($kalibrasi->alamat_pemilik ?: '-'));
        $y += 20;

        $pdf->SetXY($xLabelLeft, $y);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Write(5, 'Hasil Kalibrasi');
        $pdf->SetXY($xLabelLeft, $y + 5);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Write(5, 'Calibration Result');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($xValueLeft, $y);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(120, 6, ': '.($kalibrasi->hasil ?: '-'));

        $y += 16;

        $xRightLabel = $xLabelRight; $xRightValue = $xValueRight; $yRightBlock = $y;
        $pdf->SetXY($xRightLabel, $yRightBlock);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Write(5, 'Diterbitkan Tanggal');
        $pdf->SetXY($xRightLabel, $yRightBlock + 5);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Write(5, 'Issued Date');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($xRightValue, $yRightBlock);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Write(5, ': '.$issuedStr);

        $pdf->SetXY($xRightLabel, $yRightBlock + 18);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Write(5, 'Tanda Tangan');
        $pdf->SetXY($xRightLabel, $yRightBlock + 24);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Write(5, 'Signature');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Rect($xRightLabel, $yRightBlock + 30, 60, 25);
        $pdf->SetXY($xRightLabel + 2, $yRightBlock + 32);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Write(5, 'Dari '.(config('app.name') ?: ''));
        $pdf->SetXY($xRightLabel + 2, $yRightBlock + 38);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Write(5, 'From '.(config('app.name') ?: ''));
        $pdf->SetTextColor(0, 0, 0);

        $signaturePath = public_path('assets/back/tandatangan.png');
        if (file_exists($signaturePath)) {
            $pdf->Image($signaturePath, $xRightLabel + 5, $yRightBlock + 31, 50);
        }

        // Halaman 2: Laporan Hasil Kalibrasi (tabel 3 kolom)
        $pdf->AddPage('P', 'A4');
        $tpl2 = null;
        try {
            $tpl2 = $pdf->importPage(2);
        } catch (\Throwable $e) {
            $tpl2 = null;
        }
        if ($tpl2) {
            $pdf->useTemplate($tpl2, 0, 0, 210);
        }

        $laporan = LaporanKalibrasi::with('sets')
            ->where('kalibrasi_id', $kalibrasi->id)
            ->first();

        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(5, 30);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(210, 8, 'LAPORAN HASIL KALIBRASI', 0, 1, 'C');

        $x = 20; $y = 50; $w1 = 60; $w2 = 60; $w3 = 60; $h = 10;
        $pdf->SetLineWidth(0.3);
        $pdf->SetDrawColor(120,120,120);
        $pdf->SetFillColor(240,240,240);
        // Header cells
        $pdf->SetXY($x, $y);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell($w1, $h, '', 1, 0, 'C', true);
        $pdf->Cell($w2, $h, '', 1, 0, 'C', true);
        $pdf->Cell($w3, $h, '', 1, 1, 'C', true);
        // Header titles and subtitle (italic, muted)
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY($x, $y + 2);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell($w1, 4, 'Nilai Setting', 0, 0, 'C');
        $pdf->Cell($w2, 4, 'Rata-rata', 0, 0, 'C');
        $pdf->Cell($w3, 4, 'Nilai Koreksi', 0, 1, 'C');
        $pdf->SetTextColor(120,120,120);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->SetXY($x, $y + 6);
        $pdf->Cell($w1, 4, 'Nominal Values', 0, 0, 'C');
        $pdf->Cell($w2, 4, 'Actual Standard', 0, 0, 'C');
        $pdf->Cell($w3, 4, 'Correction', 0, 1, 'C');
        $pdf->SetTextColor(0,0,0);

        if ($laporan && $laporan->sets && count($laporan->sets)) {
            foreach ($laporan->sets as $s) {
                $y += $h;
                $pdf->SetXY($x, $y);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell($w1, $h, number_format($s->nilai_setting, 2), 1, 0, 'C');
                $pdf->Cell($w2, $h, $s->rata_rata !== null ? number_format($s->rata_rata, 2) : '-', 1, 0, 'C');
                $pdf->Cell($w3, $h, $s->nilai_koreksi !== null ? number_format($s->nilai_koreksi, 2) : '-', 1, 1, 'C');
            }
        } else {
            $y += $h;
            $pdf->SetXY($x, $y);
            $pdf->Cell($w1 + $w2 + $w3, $h, 'Belum ada data laporan kalibrasi untuk alat ini', 1, 1, 'C');
        }

        // Footer on page 2: Issued date and signature again
        $issuedStr2 = \Carbon\Carbon::now()->format('d F Y');
        $yFooter = min($y + 20, 230);
        $xRightLabel2 = 130; $xRightValue2 = 165;
        $pdf->SetXY($xRightLabel2, $yFooter);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Write(5, 'Diterbitkan Tanggal');
        $pdf->SetXY($xRightLabel2, $yFooter + 5);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Write(5, 'Issued Date');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($xRightValue2, $yFooter);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Write(5, ': '.$issuedStr2);

        $pdf->SetXY($xRightLabel2, $yFooter + 18);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Write(5, 'Tanda Tangan');
        $pdf->SetXY($xRightLabel2, $yFooter + 24);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Write(5, 'Signature');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Rect($xRightLabel2, $yFooter + 30, 60, 25);
        $pdf->SetXY($xRightLabel2 + 2, $yFooter + 32);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Write(5, 'Dari '.(config('app.name') ?: ''));
        $pdf->SetXY($xRightLabel2 + 2, $yFooter + 38);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Write(5, 'From '.(config('app.name') ?: ''));
        $pdf->SetTextColor(0, 0, 0);

        $signaturePath2 = public_path('assets/back/tandatangan.png');
        if (file_exists($signaturePath2)) {
            $pdf->Image($signaturePath2, $xRightLabel2 + 5, $yFooter + 31, 50);
        }

        return response($pdf->Output('S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Sertifikat Kalibrasi - '.$kalibrasi->nama_alat.'.pdf"');
    }
}
