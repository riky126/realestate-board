<?php
namespace App\Http\Controllers\Admin;

/** External Imports */
use Illuminate\Support\Facades\Auth;

/** Internal Imports */
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
     * Request the Customer page.
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
