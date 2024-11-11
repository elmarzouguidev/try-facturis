<?php

namespace App\Http\Controllers\Facturis\Try;

use App\Http\Controllers\Controller;
use App\Http\Requests\Facturis\Try\TryFormRequest;
use App\Models\Facturis\Client;
use App\Models\Facturis\Plan;
use App\Models\Tools\Country;
use App\Models\User;
use App\Notifications\Facturis\Try\NewTryRequestedNotification;
use App\Services\CheckConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class TryController extends Controller
{


    public function index()
    {

        $plans = Plan::select(['id', 'uuid', 'name', 'price'])->get();

        $countries = Country::select(['id', 'name'])->get();

        return view('try.index', compact('plans', 'countries'));
    }

    public function store(TryFormRequest $request)
    {

        try {
            DB::beginTransaction();
            $plan = Plan::whereUuid($request->pack)->first();
            $client = new Client();
            $client->full_name = $request->full_name;
            $client->email = $request->email;
            $client->telephone = $request->telephone;
            $client->city = $request->city;
            $client->address = $request->address;
            $client->business_name = $request->business_name;
            $client->ice = $request->ice;
            $client->website = $request->website;
            $client->country()->associate($request->country);
            $client->plan()->associate($plan);
            $client->save();

            DB::commit();

            if (CheckConnection::isConnected()) {

                $delay = now()->addMinutes(2);

                $admins = User::role('SuperAdmin')->get();

                $admins->each(function (User $admin) use ($client, $delay) {

                    $admin->notify((new NewTryRequestedNotification($client))->delay($delay));
                });
                //Notification::send($admins, new NewTryRequestedNotification($client));
            }

            return redirect(route('try.get'))->with('success', 'Votre demande a été envoyé avec succès');
        } catch (ValidationException $e) {

            Log::channel('try')->info("Error when try to save Data : " . json_encode([

                'url' => $request->url(),
                'payload' => $e,

            ], JSON_PRETTY_PRINT));

            DB::rollback();

            return redirect(route('try.get'))->with('error', 'Merci de nous renvoyer votre demande ');
        }
    }
}
