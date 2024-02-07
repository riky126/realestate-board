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
        
        $data = Customer::find(1)->corporation->account->subscription->plan;
        
        // $data = Customer::find(1)->corporation->proprietors()
        //          ->where('id', 1)
        //          ->first()->contributions;

        // print_r($data);

        $data = [
            'title' => 'Dashboard'
        ];
        return view('pages.dashboard', $data);
    }
}
