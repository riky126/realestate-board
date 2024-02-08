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
        $monthly_mentenace_budget = env('TOTAL_MAINTENANCE') / 12;

        $data = [
            'title' => 'Dashboard',
            'proprietors' => $proprietors,
            'monthly_mentenace_budget' => $monthly_mentenace_budget
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

        try {
            $proprietor = new Proprietor();
            $proprietor->first_name = $request->first_name;
            $proprietor->last_name = $request->last_name;
            $proprietor->email = $request->email;
            $proprietor->unit_entitlement = $request->unit_ent;
            $proprietor->lot_number = $request->lot_number;
            $proprietor->postal_address = $request->address;
            $proprietor->date_created = now();
            $proprietor->maintenance_fee = $this->calculateMonthlyFee($request->unit_ent);
            $proprietor->corporation_id = $user->customer->corporation->id;
            $proprietor->save();
            
            $request->flush();
            return back();

        }catch(Exception $e) {
            return back()->withErrors([
                'createError' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update new Proprietor.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function update(ProprietorRequest $request, MessageBag $error) {
     
        try {
            $proprietor = Proprietor::whereId($request->proprietor);

            if ($proprietor == null) {
                return back()->withErrors([
                    'existingUser' => 'Unable to update proprietor',
                ]);
            }

            $payload['first_name'] = $request->first_name;
            $payload['last_name'] = $request->last_name;
            $payload['email'] = $request->email;
            $payload['unit_entitlement'] = $request->unit_ent;
            $payload['lot_number'] = $request->lot_number;
            $payload['postal_address'] = $request->address;
            $payload['updated_at'] = now();
            $payload['maintenance_fee'] = $this->calculateMonthlyFee($request->unit_ent);
    
            $proprietor->update($payload);
            
            $request->flush();
            return back();
        }catch(Exception $e) {
            return back()->withErrors([
                'updateError' => $e->getMessage(),
            ]);
        }
    }


    protected function calculateFee($total_maintenance, $unit_ent, $total_entitlement) {
        return ($total_maintenance * $unit_ent / $total_entitlement) / 12;
    }

    protected function calculateMonthlyFee ($unit_ent) {
        
        $user = Auth::user();
        $proprietors = $user->customer->corporation->proprietors;
       
        $total_entitlement = $proprietors->sum('unit_entitlement') + $unit_ent;
        $total_maintenance = env('TOTAL_MAINTENANCE');

        $monthly_fee = $this->calculateFee($total_maintenance, $unit_ent, $total_entitlement);
    
        foreach($proprietors as $proprietor) {
            $proprietor->maintenance_fee = $this->calculateFee($total_maintenance,
                                                $proprietor->unit_entitlement, $total_entitlement);
            $proprietor->save();
        }

        return $monthly_fee;
    }
}
