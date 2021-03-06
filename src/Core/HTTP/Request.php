<?php

/*
 * This file is part of Cranberry\Core
 */
namespace Cranberry\Core\HTTP;

class Request
{
	/**
	 * @var array
	 */
	protected $headers=[];

	/**
	 * @var	array
	 */
	protected $options=[];

	/**
	 * @var array
	 */
	protected $parameters=[];

	/**
	 * @var	string
	 */
	protected $postData;

	/**
	 * @var string
	 */
	protected $url='';

	/**
	 * @param	string	$url
	 */
	public function __construct( $url )
	{
		$this->url = $url;
	}

	/**
	 * Add a single query string parameter
	 *
	 * @param	string	$key
	 * @param	string	$value
	 * @return	self	$this	For chaining
	 */
	public function addParameter( $key, $value )
	{
		$this->parameters[ $key ] = $value;
		return $this;
	}

	/**
	 * Add query string parameter
	 *
	 * @param	array	$parameters
	 * @return	self	$this	For chaining
	 */
	public function addParameters( array $parameters )
	{
		$this->parameters = array_merge( $this->parameters, $parameters );
		return $this;
	}

	/**
	 * Add HTTP header
	 *
	 * @param	string	$key
	 * @param	string	$value
	 * @return	self	$this	For chaining
	 */
	public function addHeader( $key, $value )
	{
		$this->headers[ $key ] = $value;
		return $this;
	}

	/**
	 * @return	array
	 */
	public function getHeaders()
	{
		$headerStrings = [];

		foreach( $this->headers as $key => $value )
		{
			$headerStrings[] = "{$key}: {$value}";
		}

		return $headerStrings;
	}

	/**
	 * @return	array
	 */
	public function getOptions()
	{
		return $this->options;
	}

	/**
	 * @return	array
	 */
	public function getParameters()
	{
		return $this->parameters;
	}

	/**
	 * @param
	 * @return	void
	 */
	public function getPostData()
	{
		return $this->postData;
	}

	/**
	 * @return	string
	 */
	public function getURL()
	{
		$url = $this->url;

		$queryString = http_build_query( $this->parameters );
		if( strlen( $queryString ) > 0 )
		{
			$url .= "?{$queryString}";
		}

		return $url;
	}

	/**
	 * Manually set cURL option values to use during the HTTP request
	 *
	 * @param	int		$option
	 * @param	mixed	$value
	 */
	public function registerOption( $option, $value )
	{
		$this->options[$option] = $value;
	}

	/**
	 * @param	string	$data
	 */
	public function setPostData( $postData )
	{
		$this->postData = $postData;
	}
}
