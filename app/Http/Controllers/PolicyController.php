<?php

namespace App\Http\Controllers;

use App\Imports\PoliciesImport;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PolicyController extends Controller
{

    // view for the list of uploaded policies
    public function index(Request $request)
    {
        $query = Policy::query();

        if ($request->filled('filter_date')) {
            $query->whereDate('transaction_date', $request->filter_date);
        }

        $policies = $query->groupBy('customer_name', 'transaction_date')
            ->select([
                'customer_name',
                DB::raw('SUM(policy_premium) as total_policy_premium'),
                DB::raw('SUM(policy_premium * policy_commission / 100) as total_commission_received'),
                'transaction_date'
            ])
            ->orderBy('total_commission_received', 'desc')
            ->paginate(50);

        return view('policies.index', compact('policies'));
    }

    // view for uploading excel
    public function importView()
    {
        return view('policies.upload');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        Excel::import(new PoliciesImport, $request->file('file'));

        return back()->with('success', 'Policies imported successfully!');
    }
}
