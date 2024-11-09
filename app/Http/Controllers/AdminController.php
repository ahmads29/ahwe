<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receipt;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Get daily total receipts and revenue
    public function getDailySummary()
    {
        $today = Carbon::today();

        // Count total receipts for today
        $totalReceipts = Receipt::whereDate('created_at', $today)->count();

        // Calculate total revenue for today
        $totalRevenue = Receipt::whereDate('created_at', $today)->sum('total_price');

        return response()->json([
            'total_receipts' => $totalReceipts,
            'total_revenue' => $totalRevenue
        ]);
    }
}
