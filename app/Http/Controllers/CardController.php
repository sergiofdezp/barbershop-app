<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($user_id)
    {
        $card = array(
            "user_id" => $user_id,
            "num_services" => 0,
            "available" => 0,
            "used" => 0,
        );

        Card::create($card);
    }

    public function store_for_new_user()
    {
        $user_id = User::latest('id')->first()->id + 1;
        $card = array(
            "user_id" => $user_id,
            "num_services" => 0,
            "available" => 0,
            "used" => 0,
        );

        Card::create($card);
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        //
    }

    public function update_num_services($user_id)
    {
        $card = Card::where('user_id', '=', $user_id)->where('available', '=', 0)->first();

        return $card->update([
            'num_services' => $card->num_services + 1,
            'available' => $card->available,
            'used' => $card->used,
        ]);
    }

    public function update_available_card($user_id)
    {
        $card = Card::where('user_id', '=', $user_id)->where('available', '=', 0)->first();

        return $card->update([
            'num_services' => $card->num_services,
            'available' => 1,
            'used' => $card->used,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        //
    }
}
