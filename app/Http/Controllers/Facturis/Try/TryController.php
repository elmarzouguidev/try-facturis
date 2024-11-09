<?php

namespace App\Http\Controllers\Facturis\Try;

use App\Http\Controllers\Controller;
use App\Http\Requests\Facturis\Try\TryFormRequest;
use App\Models\Facturis\Client;
use App\Models\Facturis\Plan;
use App\Models\Tools\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class TryController extends Controller
{



    public function index()
    {

        $plans = Plan::select(['id', 'uuid', 'name', 'price'])->get();

        $countries = Country::select(['id', 'name'])->get();

        return view('try.index',compact('plans','countries'));
    }

    public function store(TryFormRequest $request)
    {

        try {
            DB::beginTransaction();
            $plan = Plan::whereUuid($request->pack)->first();
            $demande = new Client();
            $demande->full_name = $request->full_name;
            $demande->email = $request->email;
            $demande->telephone = $request->telephone;
            $demande->city = $request->city;
            $demande->address = $request->address;
            $demande->business_name = $request->business_name;
            $demande->ice = $request->ice;
            $demande->website = $request->website;
            $demande->country()->associate($request->country);
            $demande->plan()->associate($plan);
            $demande->save();

            DB::commit();

            return redirect(route('try.get'))->with('success', 'Votre demande a été envoyé avec succès');
        } catch (ValidationException $e) {

            DB::rollback();

            return redirect(route('try.get'))->with('error', 'Merci de nous renvoyer votre demande ');
        }
    }
}
