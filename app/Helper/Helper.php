<?php

/**
 *  All View share data/ title name
 */
if (!function_exists('pageTitle')) {
    function pageTitle ($title = ''){
        return view()->share(['title'=>$title]);
    }
}
/**
 *  date formate
 */
if (!function_exists('date_formats')) {
    function date_formats ($format, $date){
        return date($format, strtotime($date));
    }
}


