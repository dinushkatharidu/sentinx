<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Evidence;
use App\Models\Target;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_targets' => Target::count(),
            'active_cases' => Target::where('status', 'active')->count(),
            'closed_cases' => Target::where('status', 'closed')->count(),
            'total_evidence' => Evidence::count(),
        ];

        $recent_activities = Activity::with('target')->latest()->take(5)->get();
        return view('dashboard', compact('stats', 'recent_activities'));
    }
}
