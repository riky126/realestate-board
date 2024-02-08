<?php
namespace App\Http\Controllers\Admin;

/** External Imports */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/** Internal Imports */
use App\Models\User;
use App\Models\Customer;
use App\Http\Controllers\Controller;

class CustomerController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }
    
    /**
     * Request the Subscription page.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function show() {
        
        $user = Auth::user();
        $customers = Customer::with('corporation', 'user')->get();

        $data = [
            'title' => 'Dashboard',
            'customers' => $customers
        ];
        return view('pages.admin.customers', $data);
    }
}
