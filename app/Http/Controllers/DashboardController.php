<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Support\Facades\Auth;

/** Internal Imports */
use App\Models\Contribution;
use App\Models\Subscription;
use App\Models\Customer;

class DashboardController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Return the Dashboard for admin or customer.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function show() {
        $user = Auth::user();

        if ($user->is_admin) {
            return $this->admin();
        }else {
            return $this->customer();
        }
    }

    protected function admin() {
        $subscriptions = Subscription::with('account', 'plan', 'customer')->get();

        $stats = [
            'subscriptions_count' => $subscriptions->count(),
            'customer_count'      => Customer::all()->count()
        ];

        $data = [
            'subscriptions' => $subscriptions,
            'stats'         => $stats
        ];
        return view('pages.dashboard.dashboard-admin', $data);
    }

    protected function customer() {
        $user = Auth::user();
        $corporation = $user->customer->corporation;
        $contributions_count = $user->customer->corporation->contributions->count();
        $proprietors = $corporation->proprietors;

        $contributions = Contribution::orderBy('created_at', 'desc')
                    ->with('proprietor')
                    ->where('corporation_id', '=', $corporation->id)
                    ->take(5)
                    ->get();

        $mentenance_budget = env('TOTAL_MAINTENANCE');
        $stats = [
            'total_contributions' => $contributions->sum('amount'),
            'proprietors_count'   => $proprietors->count(),
            'contributions_count' => $contributions_count,
            'total_units'   => $proprietors->sum('unit_entitlement')
        ];

        $data = [
            'title' => 'Dashboard',
            'contributions' => $contributions,
            'total_mentenance_budget' => $mentenance_budget,
            'monthly_mentenace_budget' => $mentenance_budget  / 12,
            'stats' => $stats
        ];

        return view('pages.dashboard.dashboard-customer', $data);
    }


}
