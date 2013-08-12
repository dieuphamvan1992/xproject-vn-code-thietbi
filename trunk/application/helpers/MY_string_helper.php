<?php
/**
 * Hàm dùng để loại bỏ các ký tự trắng thừa ở trong xâu
 * @param string input
 * @return string ouput
 */
 function changeString($str){
    $str = (string) $str;
    return preg_replace('/\s+/', ' ', trim($str));
 }