<?php

/*
 * This file is part of Cranberry\Core
 */
namespace Cranberry\Core;

class String
{
	/**
	 * Alias for mb_strlen
	 *
	 * @param	string	$string
	 * @param	string	$encoding
	 * @return	string
	 */
	static public function strlen( $string, $encoding=null )
	{
		$encoding = is_null( $encoding ) ? mb_internal_encoding() : $encoding;
		return mb_strlen( $string, $encoding );
	}

	/**
	 * Alias for mb_strtolower
	 *
	 * @param	string	$string
	 * @param	string	$encoding
	 * @return	string
	 */
	static public function strtolower( $string, $encoding=null )
	{
		$encoding = is_null( $encoding ) ? mb_internal_encoding() : $encoding;
		return mb_strtolower( $string, $encoding );
	}

	/**
	 * Alias for mb_strtoupper
	 *
	 * @param	string	$string
	 * @param	string	$encoding
	 * @return	string
	 */
	static public function strtoupper( $string, $encoding=null )
	{
		$encoding = is_null( $encoding ) ? mb_internal_encoding() : $encoding;
		return mb_strtoupper( $string, $encoding );
	}

	/**
	 * Multibyte-safe ucfirst
	 * Make a string's first character uppercase
	 *
	 * @param	string	$string
	 * @return	string
	 */
	static public function ucfirst( $string )
	{
		$firstCharacter = mb_substr( $string, 0, 1 );
		$firstCharacter = mb_strtoupper( $firstCharacter );
		$otherCharacters = mb_substr( $string, 1 );

		$string = $firstCharacter . $otherCharacters;
		return $string;
	}

	/**
	 * Multibyte-safe ucwords
	 * Uppercase the first character of each word in a string
	 *
	 * @param	string	$string
	 * @param	string	$delimiters
	 * @return	string
	 */
	static public function ucwords( $string, $delimiters=" \t\r\n\f\v" )
	{
		for( $d = 0; $d < strlen( $delimiters ); $d++ )
		{
			$delimiterChar = $delimiters[$d];
			$words = explode( $delimiterChar, $string );

			foreach( $words as &$word )
			{
				$firstCharacter = mb_substr( $word, 0, 1 );
				$firstCharacter = mb_strtoupper( $firstCharacter );
				$otherCharacters = mb_substr( $word, 1 );

				$word = $firstCharacter . $otherCharacters;
			}

			$string = implode( $delimiterChar, $words );
		}

		return $string;
	}
}
