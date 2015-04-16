<?php

use Minion\Core\Gear;
use Minion\Core\Arr;

if ( ! function_exists('navigation'))
{
	/**
	 * 
	 *
	 * @param  String  $folder
	 * @return array
	 */
	function navigation($folder = null )
	{	
		$gear = new Gear;
		$menus = $gear->navigation();

		if(!is_null($folder))
		{
			$array = array_where($menus, function($key, $value) use ($folder) {
				if($key === $folder) return $value;
			});
		}else{
			$array = $menus;
		}
		return $array;
	}
}

if ( ! function_exists('array_where'))
{
	/**
	 * Filter the array using the given callback.
	 *
	 * @param  array  $array
	 * @param  callable  $callback
	 * @return array
	 */
	function array_where($array, callable $callback)
	{
		return Arr::where($array, $callback);
	}
}