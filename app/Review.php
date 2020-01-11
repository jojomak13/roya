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
}
