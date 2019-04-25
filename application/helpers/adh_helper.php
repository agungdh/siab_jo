<?php

use Jenssegers\Blade\Blade;

if (!function_exists('blade')) {
    function blade($view, $data = [])
    {
    	$data['adh'] = new agungdh\Pustaka();
        $path = APPPATH.'blades';
        $blade = new Blade($path, APPPATH.'cache/blade');

    	echo $blade->make($view, $data);
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
        $factory = new JeffOchoa\ValidatorFactory();
        return $factory;
    }
 }
