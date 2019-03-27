<?php

namespace App\Http\Controllers;

use App\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AvisController extends Controller
{
    public function delete(Request $request) {

        $verification = Validator::make($request->all(), [
            'id' => 'numeric|exists:avis',
        ]);

        if ($verification->fails())
            return response()->json([
                'verification' => 'fail',
            ]);

        Avis::where([['id_user', $request->user()->id], ['id', $request->get('id')]])->delete();

        return response()->json([
            'delete' => 'success'
        ]);
    }

    public function create(Request $request) {

        $verification = Validator::make($request->all(), [
            'description' => 'string',
            'id' => 'numeric|exists:restaurants',
        ]);

        if ($verification->fails())
            return response()->json([
                'verification' => 'fail',
            ]);

        $avis = new Avis();
        $avis->description = $request->get('description');
        $avis->id_restaurants = $request->get('id');
        $avis->id_user = $request->user()->id;
        $avis->save();

        return response()->json([
            'create' => 'success'
        ]);
    }
}
