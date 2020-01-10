<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title_en', 'title_ar', 'content_en', 'content_ar', 'image', 'user_id'];
    protected $with = ['user'];
    protected $append = ['url'];

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'first_name', 'last_name');
    }

    public static function search($request)
    {
        return  static::where(lang('title'), 'like', '%' . $request->search . '%')->latest()->paginate(10);
    }

    public function uploadImage($imageName = 'image')
    {
        if(request()->has($imageName)){
            request()->validate(['image' => 'image']);

            \Storage::delete($this->image);

            $uploadedImage = request()->$imageName->store('blogs/');
            
            \Image::make('storage/'.$uploadedImage)->resize(870, 412)->save();

            $this->update(['image' => $uploadedImage]);
        }
    }

    public function getUrlAttribute()
    {
        return url('blog/'.$this->id . '-' . \Str::slug($this->{lang('title')}));
    }
}
