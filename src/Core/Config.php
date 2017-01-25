<?php

/*
 * This file is part of Cranberry\Core
 */
namespace Cranberry\Core;

use Cranberry\Core\File;
use Cranberry\Core\JSON;

class Config
{
	/**
	 * @var	array
	 */
	protected $data = [];

	/**
	 * @var	Cranberry\Core\File\File
	 */
	protected $source;

	/**
	 * @param	Cranberry\Core\File\File		$source
	 * @return	void
	 */
	public function __construct( File\File $source )
	{
		if( $source->exists() )
		{
			$json = $source->getContents();
			$this->data = JSON::decode( $json, true );
		}
		else
		{
			$source->create();
		}

		$this->source = $source;
	}

	/**
	 * @param	string	$domain
	 * @return	array
	 */
	public function getDomain( $domain )
	{
		if( isset( $this->data[$domain] ) )
		{
			return $this->data[$domain];
		}
	}

	/**
	 * @param	string	$domain
	 * @param	string	$key
	 * @return	mixed
	 */
	public function getValue( $domain, $key )
	{
		if( isset( $this->data[$domain][$key] ) )
		{
			return $this->data[$domain][$key];
		}
	}

	/**
	 * @return	array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param	string	$key
	 * @param	string	$value
	 * @return	void
	 */
	public function setValue( $domain, $key, $value )
	{
		$this->data[$domain][$key] = $value;
	}

	/**
	 * @return	void
	 */
	public function write()
	{
		$encodedData = JSON::encode( $this->data, JSON_PRETTY_PRINT );
		$this->source->putContents( $encodedData . PHP_EOL );
	}
}
