<?php

use Jenssegers\Blade\Blade;
use JeffOchoa\ValidatorFactory;
use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\User;
use application\classes\Helper;

if (!function_exists('blade')) {
    function blade($view, $data = [])
    {
    	$data['adh'] = new agungdh\Pustaka();
        $path = APPPATH.'blades';
        $blade = new Blade($path, APPPATH.'cache/blade');

    	echo $blade->make($view, $data);
    }
 }

if (!function_exists('bladeHtml')) {
    function bladeHtml($view, $data = [])
    {
        $data['adh'] = new agungdh\Pustaka();
        $path = APPPATH.'blades';
        $blade = new Blade($path, APPPATH.'cache/blade');

        return $blade->make($view, $data);
    }
 }

if (!function_exists('ci')) {
    function ci()
    {
    	$ci =& get_instance();
    	return $ci;
    }
 }

if (!function_exists('validator')) {
    function validator()
    {
        $factory = new ValidatorFactory();
        return $factory;
    }
 }

if (!function_exists('getUserData')) {
    function getUserData()
    {
        return User::with('pegawai')->find(ci()->session->userID);
    }
 }

if (!function_exists('helper')) {
    function helper()
    {
        return new Helper;
    }
 }

 if (!function_exists('DB')) {
    function DB()
    {
        return new DB;
    }
 }