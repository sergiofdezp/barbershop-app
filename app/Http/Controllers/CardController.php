<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
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
    public function update_num_services($user_id)
    {
        $card = Card::where('user_id', '=', $user_id)->where('available', '=', 0)->first();

        return $card->update([
            'num_services' => $card->num_services + 1,
            'available' => $card->available,
            'used' => $card->used,
        ]);
    }

    public function cancel_order_update_num_services($user_id)
    {
        $card = Card::where('user_id', '=', $user_id)->where('available', '=', 0)->first();

        return $card->update([
            'num_services' => $card->num_services - 1,
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
}
