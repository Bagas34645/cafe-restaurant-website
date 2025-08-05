<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index()
    {
        $total = Visitor::count();
        $today = Visitor::whereDate('created_at', Carbon::today())->count();
        $week = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $month = Visitor::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();

        $visitors = Visitor::latest()->paginate(20);

        return view('admin.visitors.index', compact('total', 'today', 'week', 'month', 'visitors'));
    }
}
