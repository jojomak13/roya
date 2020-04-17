<?php

namespace App\Http\Controllers;

use App\Helpers\Fawry;
use Illuminate\Http\Request;

class CardController extends Controller
{

    public $fawry;

    public function __construct()
    {
       $this->fawry = new Fawry(); 
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
            session()->flash('success', __('user.auth.cardCreated'));
            
        else if($res->statusCode == 17003)
            session()->flash('warning', __('user.auth.cardExists'));
            
        else
            session()->flash('warning', __('user.auth.cardInvalid'));
            
        return redirect()->route('profile.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $res = $this->fawry->deleteCardToken(auth()->user(), $request->cardToken);

        if($res->statusCode == 200){
            session()->flash('info', __('user.auth.cardDeleted'));

            return response()->json(['status' => true]);
        }
        
        return response()->json(['status' => false]);
    }
}
