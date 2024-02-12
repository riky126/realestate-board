<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/** Internal Imports */
use App\Models\Proprietor;
use App\Http\Requests\ProprietorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Request the Proprietor List page.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function show(Request $request) {
        
        $user = Auth::user();

        $corporation_id = $user->customer->corporation->id;
        $budget = $user->customer->corporation->budget;

        $proprietors = [];
        
        if( $request->has('accounting-period') ) {
            $date = $request->query('accounting-period');
            $proprietors = Proprietor::where('corporation_id',  $corporation_id)
                            ->whereYear('created_at', '=', Carbon::parse($date)->format('Y'))->get();

        }else {
            $proprietors = $user->customer->corporation->proprietors;
        }
        
        $monthly_mentenace_budget = $budget->total_maintenance / 12;
        $data = [
            'title' => 'Proprietors',
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
            $existingProprietor = Proprietor::where([
                'email'          => $request->email,
                'corporation_id' => $user->customer->corporation->id]
                )->first();

            if ($existingProprietor != null) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'createError' => "Proprietor exist with that email: {$request->email}",
                    ]);
            }

            $existingProprietor = Proprietor::where([
                'lot_number'     => $request->lot_number,
                'corporation_id' => $user->customer->corporation->id
                ])->first();

            if ($existingProprietor != null) {
                return back()
                    ->withInput()
                    ->withErrors([
                    'createError' => "Proprietor exist with same lot#: {$request->lot_number}",
                ]);
            }
        
            $proprietor = new Proprietor();
            $proprietor->first_name = $request->first_name;
            $proprietor->last_name = $request->last_name;
            $proprietor->email = $request->email;
            $proprietor->unit_entitlement = $request->unit_ent;
            $proprietor->lot_number = $request->lot_number;
            $proprietor->postal_address = $request->address;
            $proprietor->date_created = now();
            $proprietor->maintenance_fee = $this->calculateMonthlyFee($request->unit_ent, null);
            $proprietor->corporation_id = $user->customer->corporation->id;
            $proprietor->save();

            $request->flush();
            return back()
                   ->with('success', 'Successfully! created Proprietor');

        }catch(\Exception $e) {
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
            $existingProprietor = Proprietor::where('lot_number', $request->lot_number)
                                            ->orWhere('email', $request->email)->first();
            
            if ($proprietor == null) {
                $request->request->add(['proprietor' => $proprietor->first()->id]);
                return back()
                    ->withInput()
                    ->withErrors([
                        'existingUser' => 'Unable to update proprietor',
                    ]);
            }

            if ($existingProprietor != null && (
                $proprietor->first()->id != $existingProprietor->id ||
                $proprietor->first()->email != $existingProprietor->email
            )) {
                $request->request->add(['proprietor' => $proprietor->first()->id]);
                return back()
                    ->withInput()
                    ->withErrors([
                        'updateError'  => 'Proprietor exist with lot#: '. $request->lot_number,
                    ]);
            }

            $payload['first_name'] = $request->first_name;
            $payload['last_name'] = $request->last_name;
            $payload['email'] = $request->email;
            $payload['unit_entitlement'] = $request->unit_ent;
            $payload['lot_number'] = $request->lot_number;
            $payload['postal_address'] = $request->address;
            $payload['updated_at'] = now();
            $proprietor->update($payload);

            $this->calculateMonthlyFee($request->unit_ent, $proprietor);
            
            $request->flush();
            return back();
        }catch(\Exception $e) {
            return back()
                ->withInput()
                ->withErrors([
                'updateError' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Update new Proprietor.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function delete(Request $request, MessageBag $error) {
        try {
            $proprietor = Proprietor::whereId($request->proprietor_id);
            $proprietor->delete();
            $this->calculateMonthlyFee($request->unit_ent, $proprietor);

            $request->flush();
            return back();
        }catch(\Exception $e) {
            return back()->withErrors([
                'deleteError' => $e->getMessage(),
            ]);
        }
    }


    protected function calculateFee($total_maintenance, $unit_ent, $total_entitlement) {
        return ($total_maintenance * $unit_ent / $total_entitlement) / 12;
    }

    protected function calculateMonthlyFee ($unit_ent, $update_proprietor) {
        
        $user = Auth::user();

        $budget = $user->customer->corporation->budget;
        $proprietors = $user->customer->corporation->proprietors;

        $total_entitlement =  $update_proprietor == null ? $proprietors->sum('unit_entitlement') + $unit_ent :
                              $proprietors->sum('unit_entitlement');

        $total_maintenance = $budget->total_maintenance; //env('TOTAL_MAINTENANCE');
        $monthly_fee = $this->calculateFee($total_maintenance, $unit_ent, $total_entitlement);

        foreach($proprietors as $proprietor) {
            $proprietor->maintenance_fee = $this->calculateFee($total_maintenance,
                                                $proprietor->unit_entitlement, $total_entitlement);

            $proprietor->save();
        }

        return $monthly_fee;
    }
}
