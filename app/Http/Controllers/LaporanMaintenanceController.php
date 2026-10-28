<?php
// app/Http/Controllers/LaporanMaintenanceController.php

namespace App\Http\Controllers;

use App\Models\LaporanMaintenance;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanMaintenanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporan = LaporanMaintenance::query();
            return DataTables::of($laporan)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="'.route('laporan-maintenance.show', $row->id).'" class="btn btn-info btn-sm">View</a> ';
                    $btn .= '<a href="'.route('laporan-maintenance.edit', $row->id).'" class="btn btn-warning btn-sm">Edit</a> ';
                    $btn .= '<form action="'.route('laporan-maintenance.destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                             </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('laporan-maintenance.index');
    }

    public function create()
    {
        return view('laporan-maintenance.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'merk' => 'required',
            'no_seri' => 'required',
            'tgl_maintenance' => 'required|date',
            'tindakan' => 'required',
            'hasil' => 'required',
            'teknisi' => 'required'
        ]);

        LaporanMaintenance::create($request->all());
        return redirect()->route('laporan-maintenance.index')->with('success', 'Laporan maintenance berhasil ditambahkan.');
    }

    public function show(LaporanMaintenance $laporanMaintenance)
    {
        return view('laporan-maintenance.show', compact('laporanMaintenance'));
    }

    public function edit(LaporanMaintenance $laporanMaintenance)
    {
        return view('laporan-maintenance.edit', compact('laporanMaintenance'));
    }

    public function update(Request $request, LaporanMaintenance $laporanMaintenance)
    {
        $request->validate([
            'nama_alat' => 'required',
            'merk' => 'required',
            'no_seri' => 'required',
            'tgl_maintenance' => 'required|date',
            'tindakan' => 'required',
            'hasil' => 'required',
            'teknisi' => 'required'
        ]);

        $laporanMaintenance->update($request->all());
        return redirect()->route('laporan-maintenance.index')->with('success', 'Laporan maintenance berhasil diperbarui.');
    }

    public function destroy(LaporanMaintenance $laporanMaintenance)
    {
        $laporanMaintenance->delete();
        return redirect()->route('laporan-maintenance.index')->with('success', 'Laporan maintenance berhasil dihapus.');
    }
}