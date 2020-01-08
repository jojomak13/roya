<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SlideShow;

class SlideShowController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_slideshow'])->only(['create', 'store']);
        $this->middleware(['permission:read_slideshow'])->only('index');
        $this->middleware(['permission:update_slideshow'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_slideshow'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slideshows = request()->has('search')? SlideShow::search(request()) : SlideShow::paginate(10); 

        return view('admin.slideshow.index', compact('slideshows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slideshow.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slideShow = SlideShow::create($request->validate([
            'title_en' => 'required',
            'title_ar' => 'required',
            'link' => 'nullable|url',
            'image' => 'required|image',
        ]))->uploadImage();


        session()->flash('success', __('dashboard.slideshow.create_success'));
        return redirect()->route('admin.slideshow.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SlideShow  $slideShow
     * @return \Illuminate\Http\Response
     */
    public function show(SlideShow $slideShow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SlideShow  $slideShow
     * @return \Illuminate\Http\Response
     */
    public function edit(SlideShow $slideshow)
    {
        return view('admin.slideshow.edit', compact('slideshow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SlideShow  $slideShow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlideShow $slideshow)
    {
        $slideshow->update($request->validate([
            'title_en' => 'required',
            'title_ar' => 'required',
            'link' => 'nullable|url'
        ]));
            
        $slideshow->uploadImage();

        session()->flash('success', __('dashboard.slideshow.edit_success'));
        return redirect()->route('admin.slideshow.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SlideShow  $slideShow
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlideShow $slideshow)
    {
        \Storage::delete($slideshow->image);
        $slideshow->delete();
        
        session()->flash('success', __('dashboard.slideshow.delete_success'));
        return redirect()->route('admin.slideshow.index');
    }
}
