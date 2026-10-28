<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use Yajra\DataTables\Facades\DataTables;
class MaintenanceController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $maintenances = Maintenance::query();
            return DataTables::of($maintenances)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="'.route('maintenance.show', $row->id).'" class="btn btn-info btn-sm">View</a> ';
                    $btn .= '<a href="'.route('maintenance.edit', $row->id).'" class="btn btn-warning btn-sm">Edit</a> ';
                    $btn .= '<form action="'.route('maintenance.destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                             </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('maintenance.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('maintenance.create');
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

        Maintenance::create($request->all());

        return redirect()->route('maintenance.index')->with('success', 'Data maintenance berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view('maintenance.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        return view('maintenance.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'nama_alat' => 'required',
            'merk_alat' => 'required',
            'tipe_alat' => 'required',
            'tanggal_kalibrasi' => 'required|date',
        ]);

        $maintenance->update($request->all());

        return redirect()->route('maintenance.index')->with('success', 'Data maintenance berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('maintenance.index')->with('success', 'Data maintenance berhasil dihapus!');
    }
}
