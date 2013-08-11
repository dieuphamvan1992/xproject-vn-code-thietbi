<?php
/**
 * @param width pixel
 * @param height pixel
 * @param array option(x = 300, y = 225)
 * @return array(width, height)
 */
function changeImage($width, $height, $option = array(0 => 300, 1 => 225)){
    $temp = array();
    $x = $option[0];
    $y = $option[1];
    
    if (($width/$x) >= ($height/$y)){
        $temp['width'] = $x;
        $temp['height'] = ($height/$width) * $x;
    }else{
        $temp['width'] = ($width/$height) * $y;
        $temp['height'] = $y;
    }
    return $temp;
}