<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Fawry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public $fawry;

    public function __construct()
    {
       $this->fawry = new Fawry(); 
    }

    public function index()
    {
        return (new Fawry)->listCustomerTokens(auth()->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = $this->fawry->createCardToken(
            $request->cardNumber,
            $request->expireYear,
            $request->expireMonth,
            $request->cvv,
            auth()->user()
        );

        if($res->statusCode == 200)
            return response()->json(['status' => true, 'message' => __('user.auth.cardCreated')]);
            
        else if($res->statusCode == 17003)
            return response()->json(['status' => true, 'message' => __('user.auth.cardExists')]);

        return response()->json(['status' => false, 'message' => __('user.auth.cardInvalid')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $res = $this->fawry->deleteCardToken(auth()->user(), $request->cardToken);

        if($res->statusCode == 200)
            return response()->json(['status' => true, 'message' => __('user.auth.cardDeleted')]);
        
        return response()->json(['status' => false]);
    }
}
