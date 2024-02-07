<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/** Internal Imports */
use App\Models\User;
use App\Models\Proprietor;
use App\Http\Requests\ProprietorRequest;

class ProprietorController extends Controller {

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
        $proprietors = $user->customer->corporation->proprietors;
        
        $data = [
            'title' => 'Dashboard',
            'proprietors' => $proprietors
        ];
        return view('pages.proprietors', $data);
    }

    /**
     * Create new Proprietor.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function create(ProprietorRequest $request, MessageBag $error) {

        $user = Auth::user();
        
        $proprietor = new Proprietor();
        $proprietor->first_name = $request->first_name;
        $proprietor->last_name = $request->last_name;
        $proprietor->email = $request->email;
        $proprietor->unit_entitlement = $request->ent_unit;
        $proprietor->lot_number = $request->lot_number;
        $proprietor->postal_address = $request->address;
        $proprietor->maintenance_fee = 1234.99;
        $proprietor->corporation_id = $user->customer->corporation->id;
        $proprietor->save();
        
        return back()->withErrors([
            'password' => 'Wrong username or password',
        ]);
    }
}
