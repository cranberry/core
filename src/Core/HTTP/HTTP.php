<?php

/*
 * This file is part of Cranberry\Core
 */
namespace Cranberry\Core\HTTP;

class HTTP
{
	/**
	 * @param	mixed	$request	Core\HTTP\Request object or URL string
	 * @return	Cranberry\HTTP\Response
	 */
	static public function get( $request )
	{
		return self::request( $request );
	}

	/**
	 * @param	Cranberry\Core\HTTP\Request or string	$request
	 * @return	Cranberry\Core\HTTP\Response
	 */
	static protected function request( $request, $method="GET" )
	{
		if( is_string( $request ) )
		{
			$request = new Request( $request );
		}

		$curl = curl_init();

		curl_setopt( $curl, CURLOPT_URL, $request->getURL() );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_HTTPHEADER, $request->getHeaders() );
		curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, $method );

		if( $method == 'POST' )
		{
			$postData = $request->getPostData();
			if( !is_null( $postData ) )
			{
				curl_setopt( $curl, CURLOPT_POSTFIELDS, $postData );
			}
		}

		$body = curl_exec( $curl );
		$info = curl_getinfo( $curl );
		$error = [
			'code' => curl_errno( $curl ),
			'message' => curl_error( $curl )
		];

		curl_close( $curl );

		return new Response( $body, $info, $error );
	}

	/**
	 * @param	mixed	$request	Core\HTTP\Request object or URL string
	 * @return	Cranberry\HTTP\Response
	 */
	static public function post( $request )
	{
		return self::request( $request, 'POST' );
	}

	/**
	 * @param	mixed	$request	Core\HTTP\Request object or URL string
	 * @return	Cranberry\HTTP\Response
	 */
	static public function put( $request )
	{
		return self::request( $request, 'PUT' );
	}
}
