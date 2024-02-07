<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/** Internal Imports */
use App\Models\Plan;
use App\Models\Account;
use App\Models\Customer;
use App\Models\Corporation;
use App\Models\Subscription;
use App\Models\User;

use App\Common\Enums\UserType;
use App\Http\Requests\CreateAccountRequest;


class AccountController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() { }
    
    /**
     * Request the Create Account page.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function show() {
        
        $plans = Plan::all();
        
        $data = [
            'title' => 'Create Account',
            'plans' => $plans,
        ];
        return view('pages.create-account', $data);
    }

    /**
     * Create new User and Account.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function create(CreateAccountRequest $request, MessageBag $error) {
       
        $existingUser = $this->getUserByUserEmail($request->email);

        if ($existingUser != null) {
            return back()->withErrors([
                'existingUser' => 'User exist with that email: ' . $request->email,
            ]);
        }
        
        // [2] Create User
        $user = User::create([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'is_admin' => false,
            'type'     => UserType::Customer,
            'password' => Hash::make($request->password),
        ]);


        // [2] Create Customer
        $customer_number = (time()+ rand(1,1000));

        $customer = new Customer();
        $customer->number = $customer_number;
        $user->customer()->save($customer);
        $user->save();

        // [3] Create Subscription
        $plan = $this->getPlanById($request->plan);

        $subscription = new Subscription();
        $subscription->is_active = true;
        $subscription->renewal_date = now();
        $subscription->start_date = now();
        $subscription->plan_id = $plan->id;
        $subscription->customer_id = $customer->id;
        $subscription->save();

        // [4] Create Account
        $account_number = (time()+ rand(1,1000));

        $account = new Account();
        $account->number = $account_number;
        $account->is_active = true;
        $account->owner_id = $customer->id;
        $account->subscription_id = $subscription->id;
        $account->save();

        // [4] Create Account
        $account_number = (time()+ rand(1,1000));

        $corporation = new Corporation();
        $corporation->name = $request->name;
        $corporation->number = $request->strata_number;
        $corporation->account_holder_id = $customer->id;
        $corporation->account_id = $account->id;
        $corporation->save();

        $request->flash(); //to put the posted data to session

        return redirect()->intended('/account-success');
    }

    /**
     * Fetch user
     * (You can extract this to repository method).
     *
     * @param  $email
     * @return mixed
     */
    public function getUserByUserEmail($email) {
        return User::where('email', $email) -> first();
    }

    /**
     * Fetch user
     * (You can extract this to repository method).
     *
     * @param  $email
     * @return mixed
     */
    public function getPlanById($id) {
        return Plan::find($id);
    }
}