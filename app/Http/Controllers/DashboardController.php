<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/** Internal Imports */
use App\Models\User;

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
        
        $user = User::find(1)->proprietor;
        
        $data = [
            'title' => 'Dashboard',
            'user' => $user,
        ];
        return view('pages.dashboard', $data);
    }
}
