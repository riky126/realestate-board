<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/** Internal Imports */
use App\Models\User;
use App\Models\Account;
use App\Models\Porprietor;
use App\Models\Contribution;
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
     * Request the login page.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function show() {
        
        $user = Auth::user();
        $corporation = $user->customer->corporation;

        $contributions = Contribution::orderBy('created_at', 'desc')
                    ->with('proprietor')
                    ->where('corporation_id', '=', $corporation->id)
                    ->take(10)
                    ->get();

        $mentenance_budget = env('TOTAL_MAINTENANCE');
        $data = [
            'title' => 'Dashboard',
            'contributions' => $contributions,
            'total_mentenance_budget' => $mentenance_budget,
            'monthly_mentenace_budget' => $mentenance_budget  / 12
        ];
        return view('pages.dashboard', $data);
    }
}
