<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Instalasi;
use App\Models\Kalibrasi;
use App\Models\Maintenance;
use App\Models\LaporanKalibrasi;
use App\Models\LaporanMaintenance;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Summary counts
        $stats = [
            'users' => User::count(),
            'instalasi' => Instalasi::count(),
            'kalibrasi' => Kalibrasi::count(),
            'maintenance' => Maintenance::count(),
            'laporanKalibrasi' => LaporanKalibrasi::count(),
            'laporanMaintenance' => LaporanMaintenance::count(),
        ];

        // Recent records
        $recentKalibrasi = Kalibrasi::latest()->take(5)->get();
        $recentMaintenance = Maintenance::latest()->take(5)->get();

        // Chart data (monthly counts for current year)
        $months = collect(range(1, 12))->map(function ($m) {
            return Carbon::create(null, $m, 1)->format('M');
        });

        $kalibrasiMonthly = collect(range(1, 12))->map(function ($m) {
            return Kalibrasi::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $m)
                ->count();
        });

        $maintenanceMonthly = collect(range(1, 12))->map(function ($m) {
            return Maintenance::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $m)
                ->count();
        });

        return view('dashboard.index', [
            'stats' => $stats,
            'recentKalibrasi' => $recentKalibrasi,
            'recentMaintenance' => $recentMaintenance,
            'months' => $months,
            'kalibrasiMonthly' => $kalibrasiMonthly,
            'maintenanceMonthly' => $maintenanceMonthly,
        ]);
    }
}
