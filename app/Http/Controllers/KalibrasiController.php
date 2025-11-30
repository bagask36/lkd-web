<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalibrasi;
use Yajra\DataTables\Facades\DataTables;

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
}
