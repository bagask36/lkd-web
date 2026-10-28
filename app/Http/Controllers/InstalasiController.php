<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instalasi;
use Yajra\DataTables\Facades\DataTables;
class InstalasiController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $instalasis = Instalasi::query();
            return DataTables::of($instalasis)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="'.route('instalasi.show', $row->id).'" class="btn btn-info btn-sm">View</a> ';
                    $btn .= '<a href="'.route('instalasi.edit', $row->id).'" class="btn btn-warning btn-sm">Edit</a> ';
                    $btn .= '<form action="'.route('instalasi.destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                             </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('instalasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('instalasi.create');
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

        instalasi::create($request->all());

        return redirect()->route('instalasi.index')->with('success', 'Data instalasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instalasi $instalasi)
    {
        return view('instalasi.show', compact('instalasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instalasi $instalasi)
    {
        return view('instalasi.edit', compact('instalasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instalasi $instalasi)
    {
        $request->validate([
            'nama_alat' => 'required',
            'merk_alat' => 'required',
            'tipe_alat' => 'required',
            'tanggal_kalibrasi' => 'required|date',
        ]);

        $instalasi->update($request->all());

        return redirect()->route('instalasi.index')->with('success', 'Data instalasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instalasi $instalasi)
    {
        $instalasi->delete();

        return redirect()->route('instalasi.index')->with('success', 'Data instalasi berhasil dihapus!');
    }
}
