<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:create_offers'])->only(['create', 'store']);
        $this->middleware(['permission:read_offers'])->only('index');
        $this->middleware(['permission:update_offers'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_offers'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = request()->has('search')? Offer::search(request()) : Offer::latest()->paginate(10); 

        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $offers = Offer::create($request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required|image',
        ]))->uploadImage();


        session()->flash('success', __('dashboard.offers.create_success'));
        return redirect()->route('admin.offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        $products = $offer->products;
        return view('admin.offers.show', compact('offer', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        return view('admin.offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $offer->update($request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
        ]));
            
        $offer->uploadImage();

        session()->flash('success', __('dashboard.offers.edit_success'));
        return redirect()->route('admin.offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        \Storage::delete($offer->image);
        $offer->delete();
        
        session()->flash('success', __('dashboard.offers.delete_success'));
        return redirect()->route('admin.offers.index');
    }
}
