<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('convertDate'))
{
	function convertDate($date)
	{
		$newDate = date("d-m-Y", strtotime($date));
		return $newDate;
	}
}

if ( ! function_exists('convertDate2'))
{
	function convertDate2($date)
	{
		$newDate = date("Y-m-d", strtotime($date) );
		return $newDate;
	}
}



