<?php

/*
 * This file is part of Cranberry\Core
 */
namespace Cranberry\Core;

class Utils
{
	/**
	 * Return a random element from the given array
	 *
	 * @param	array	$array
	 * @param	int		$num
	 * @return	mixed
	 */
	public static function getRandomElement( array $array, $num=1 )
	{
		if( count( $array ) == 0 || !is_int( $num ) || $num < 1 )
		{
			return;
		}

		/* Don't fail if $num is too high, just reset it */
		if( $num > count( $array ) )
		{
			$num = count( $array );
		}

		$keys = array_rand( $array, $num );

		if( $num == 1 )
		{
			return $array[$keys];
		}

		$elements = [];
		foreach( $keys as $key )
		{
			$elements[] = $array[$key];
		}

		return $elements;
	}

	/**
	 * @param	array	$array
	 * @return	array
	 */
	static public function reindexArray( array &$array )
	{
		$originalArray = $array;
		$array = [];

		foreach( $originalArray as $item )
		{
			$array[] = $item;
		}
	}
}
