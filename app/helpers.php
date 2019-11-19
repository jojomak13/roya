<?php

function lang($value){
    return $value . '_' . LaravelLocalization::getCurrentLocale();    
}