<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    
    protected $fillable = ['title_en', 'title_ar', 'link', 'image'];

    public function uploadImage($imageName = 'image')
    {
        if(request()->has($imageName)){
            request()->validate(['image' => 'image']);

            \Storage::delete($this->image);

            $uploadedImage = request()->$imageName->store('slideshow/');
            
            \Image::make('storage/'.$uploadedImage)->resize(870, 412)->save();

            $this->update(['image' => $uploadedImage]);
        }
    }

    public static function search($request)
    {
        return  static::where(lang('title'), 'like', '%' . $request->search . '%')->latest()->paginate(10);
    }
}
