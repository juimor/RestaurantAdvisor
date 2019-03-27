<?php

namespace App\Http\Controllers;

use App\Restaurants;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantsController extends Controller
{
    public function delete(Request $request) {

        $verification = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:restaurants',
        ]);

        if ($verification->fails())
            return response()->json([
                'verification' => 'fail',
            ]);

        Restaurants::where([['id_user', $request->user()->id], ['id', $request->get('id')]])->delete();
        return response()->json([
            'delete' => 'success'
        ]);
    }

    public function create(Request $request) {

        $verification = Validator::make($request->all(), [
            'nom' => 'required|string|unique:restaurants',
            'note' => 'string',
            'telephone' => 'string',
            'description' => 'string',
            'localisation' => 'required|string|unique:restaurants',
            'siteweb' => 'string',
            'horaire_semaine' => 'string',
            'horaire_weekend' => 'string'
        ]);

        if ($verification->fails())
            return response()->json([
                'verification' => 'fail',
            ]);

        $restaurant = new Restaurants();
        $restaurant->nom = $request->get('nom');
        $restaurant->description = $request->get('description');
        $restaurant->note = $request->get('note');
        $restaurant->localisation = $request->get('localisation');
        $restaurant->telephone = $request->get('telephone');
        $restaurant->siteweb = $request->get('siteweb');
        $restaurant->horaire_semaine = $request->get('horaire_semaine');
        $restaurant->horaire_weekend = $request->get('horaire_weekend');
        $restaurant->id_user = $request->user()->id;
        $restaurant->save();

        return response()->json([
            'create' => 'success'
        ]);
    }

    public function update(Request $request) {

        $verification = Validator::make($request->all(), [
            'nom' => 'nullable|string|unique:restaurants',
            'note' => 'nullable|numeric',
            'telephone' => 'nullable|string',
            'description' => 'nullable|string',
            'localisation' => 'nullable|string|unique:restaurants',
            'siteweb' => 'nullable|string',
            'horaire_semaine' => 'nullable|string',
            'horaire_weekend' => 'nullable|string',
            'id' => 'numeric|exists:restaurants',
        ]);

        if ($verification->fails())
            return response()->json([
                'verification' => 'fail',
            ]);
        $input = array_filter($request->all());

        Restaurants::where([['id_user', $request->user()->id], ['id', $request->get('id')]])->update($input);

        return response()->json([
            'update' => 'success'
        ]);
    }
}
