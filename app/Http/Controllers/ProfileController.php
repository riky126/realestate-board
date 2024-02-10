<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Support\Facades\Auth;

/** Internal Imports */

class ProfileController extends Controller {
    
    /**
     * Request the Profile page.
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