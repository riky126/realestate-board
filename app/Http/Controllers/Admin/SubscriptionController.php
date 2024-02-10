<?php
namespace App\Http\Controllers\Admin;

/** External Imports */
use Illuminate\Support\Facades\Auth;

/** Internal Imports */
use App\Models\Subscription;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller {

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
        $subscriptions = Subscription::with('account', 'plan', 'customer')->get();

        $data = [
            'title' => 'Dashboard',
            'subscriptions' => $subscriptions
        ];
        return view('pages.admin.subscriptions', $data);
    }
}
