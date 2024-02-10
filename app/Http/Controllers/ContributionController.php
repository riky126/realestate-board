<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

/** Internal Imports */
use App\Models\Contribution;
use App\Models\Proprietor;

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
     * Request the Contribution List page.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function show() {
        
        $user = Auth::user();
        $corporation = $user->customer->corporation;

        $proprietors = $user->customer->corporation->proprietors;
        $contributions = Contribution::orderBy('created_at', 'desc')
                    ->with('proprietor')
                    ->where('corporation_id', '=', $corporation->id)
                    ->get();

        $data = [
            'title' => 'Contributions',
            'contributions' => $contributions,
            'proprietors' => $proprietors
        ];
        return view('pages.contributions', $data);
    }

    /**
     * Add Contribution for Proprietor.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request, MessageBag $error) {
        
        validator($request->all(), [
            'proprietor' => ['required'],
            'amount' => ['required', 'numeric', 'min:1']
        ])->validate();

        $proprietor = Proprietor::find($request->proprietor);
        $corporation = $proprietor->corporation;

        $contribution = new Contribution();
        $contribution->amount = $request->amount;
        $contribution->proprietor_id = $proprietor->id;
        $contribution->corporation_id = $corporation->id;
        $contribution->save();

        return back();
    }
}
