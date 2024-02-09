<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/** Internal Imports */
use App\Models\Corporation;

class ProfileController extends Controller {
    
    /**
     * Request the login page.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function show() {

        $user = Auth::user();
        $corporation = $user->customer ? $user->customer->corporation : null;

        $data = [
            'title'         => 'Profile',
            'user'          => $user,
            'corporation'   => $corporation
        ];
        return view('pages.profile', $data);
    }

}