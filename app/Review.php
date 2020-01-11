<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Review extends Pivot
{
    protected $appends = ['user_review'];

    public function getUserReviewAttribute()
    {
        $res = [];
        for($i = 1; $i <= $this->stars; $i++)
            $res[] = '<i class="fa fa-star active"></i>';
    
        for ($i = 5 - $this->stars; $i > 0; $i--)
            $res[] = '<i class="fa fa-star-o"></i>';

            
        return ($res);
    }

    public static function productRates($id)
    {
        $res = [
            "5" => 0,
            "4" => 0,
            "3" => 0,
            "2" => 0,
            "1" => 0
        ];

        $productRates = \DB::table('product_user')
        ->where('product_id', $id)
        ->selectRaw('count(*) as rated_count, stars')
        ->groupBy('stars')
        ->orderBy('stars', 'desc')
        ->get()
        ->pluck('rated_count', 'stars')
        ->toArray();

        foreach($res as $key => $value){
            if(array_key_exists($key, $productRates))
                $res[$key] = $productRates[$key]; 
        }

        return $res;
    }
}
