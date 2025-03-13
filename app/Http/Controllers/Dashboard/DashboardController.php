<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View|Factory|Application
    {
        $user = Auth::user();
        return view('dashboard.index');
    }
}
