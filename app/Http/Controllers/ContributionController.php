<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/** Internal Imports */
use App\Models\User;
use App\Models\Contribution;

class ContributionController extends Controller {

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
        $contributions = $user->customer->corporation->contributions;

        $data = [
            'title' => 'Contributions',
            'contributions' => $contributions
        ];
        return view('pages.contributions', $data);
    }
}
