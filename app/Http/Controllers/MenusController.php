<?php

namespace App\Http\Controllers;

use App\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MenusController extends Controller
{
    public function delete(Request $request)
    {

        $verification = Validator::make($request->all(), [
            'id_restaurants' => 'numeric|exists:menus',
            'id' => 'numeric|exists:menus'
        ]);

        if ($verification->fails())
            return response()->json([
                'verification' => 'fail',
            ]);

        Menus::where([['id_user', $request->user()->id], ['id_restaurants', $request->get('id_restaurants')], ['id', $request->get('id')]])->delete();

        return response()->json([
            'delete' => 'success'
        ]);
    }

    public function create(Request $request) {
        $verification = Validator::make($request->all(), [
            'nom' => 'string|unique:menus',
            'description' => 'string',
            'prix' => 'numeric',
            'id' => 'numeric|exists:restaurants',
        ]);

        if ($verification->fails())
            return response()->json([
                'verification' => 'fail',
                ]);

        $menu = new Menus();
        $menu->nom = $request->get('nom');
        $menu->description = $request->get('description');
        $menu->prix = $request->get('prix');
        $menu->id_restaurants = $request->get('id');
        $menu->id_user = $request->user()->id;
        $menu->save();

        return response()->json([
            'create' => 'success'
        ]);
    }

    public function update(Request $request) {

        $verification = Validator::make($request->all(), [
            'nom' => 'string|unique:menus',
            'description' => 'string',
            'prix' => 'numeric',
            'id_restaurants' => 'numeric|exists:menus',
            'id' => 'numeric|exists:menus'
        ]);

        if ($verification->fails())
            return response()->json([
                'verification' => 'fail',
            ]);

        $input = array_filter($request->all());

        Menus::where([['id_user', $request->user()->id], ['id_restaurants', $request->get('id_restaurants')], ['id', $request->get('id')]])->update($input);

        return response()->json([
            'update' => 'success'
        ]);
    }
}
