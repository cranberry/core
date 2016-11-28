<?php

/*
 * This file is part of Cranberry\Core
 */
namespace Cranberry\Core;

class JSON
{
	/**
	 * Perform standard JSON decode, throwing an exception on error
	 *
	 * @param	string	$string
	 * @param	boolean	$assoc
	 * @param	int		$depth
	 * @param	int		$options
	 * @return	array
	 */
	static public function decode( $string, $assoc=false, $depth=512, $options=0 )
	{
		$result = json_decode( $string, $assoc, $depth, $options );

		$errorCode = json_last_error();
		$errorMessage = json_last_error_msg();

		if( $errorCode != 0 )
		{
			throw new \UnexpectedValueException( $errorMessage, $errorCode );
		}

		return $result;
	}

	/**
	 * Perform standard JSON encode, throwing an exception on error
	 *
	 * @param	mixed	$value
	 * @param	int		$options
	 * @param	int		$depth
	 * @return	string
	 */
	static public function encode( $value, $options=0, $depth=512 )
	{
		$result = json_encode( $value, $options, $depth );

		$errorCode = json_last_error();
		$errorMessage = json_last_error_msg();

		if( $errorCode != 0 )
		{
			throw new \UnexpectedValueException( $errorMessage, $errorCode );
		}

		return $result;
	}
}
