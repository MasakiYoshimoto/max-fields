<?php
//----------------------------------------------------------------------
// dacRssParse.php
//
// ◇RSS解析クラス [v1.0.3.40110]
//
// Copyright (C) 2003,2004 The Dark Angel
//----------------------------------------------------------------------

class CDaRssParse
{
	//------------------------------------------
	// Constants
	//------------------------------------------
	
	var $MODE_READY		= 0;
	var $MODE_CHANNEL	= 1;
	var $MODE_IMAGE		= 2;
	var $MODE_TEXTINPUT	= 3;
	var $MODE_ITEM		= 4;
	
	var $FETCH_FILE		= 0;
	var $FETCH_CURL		= 1;
	var $FETCH_CMD		= 2;
	
	var $CMDFORMAT		= "/usr/local/bin/wget -q -O - '%s'";
	
	var $VERSION		= '1.0.3';
	
	//------------------------------------------
	// Variables
	//------------------------------------------
	
	var $debug;
	var $encoding;
	var $fetchtype;
	
	var $data;
	
	var $channel;
	var $image;
	var $textinput;
	var $items;
	
	var $mode;
	var $name;
	var $item;
	
	var $parser;
	
	//------------------------------------------
	// Constructor, Destructor
	//------------------------------------------
	
	function CDaRssParse()
	{
		$this->__construct();
	}
	
	function __construct()
	{
		/* デフォルト値設定 */
		$this->debug		= FALSE;
		$this->encoding		= 'UTF-8';
		$this->fetchtype	= $this->FETCH_FILE;
		
		$this->_initVariables();
		
		$this->parser = xml_parser_create();
		xml_parser_set_option( $this->parser, XML_OPTION_CASE_FOLDING, FALSE );
		xml_set_object( $this->parser, $this );
		xml_set_element_handler( $this->parser, '_startElementHandler', '_endElementHandler' );
		xml_set_character_data_handler( $this->parser, '_characterDataHandler' );
	}
	
	function __destruct()
	{
		xml_parser_free( $this->parser );
	}
	
	//------------------------------------------
	// Private Functions
	//------------------------------------------
	
	function _initVariables()
	{
		$this->data = '';
		
		$this->channel = array();
		$this->image = array();
		$this->textinput = array();
		$this->items = array();
		
		$this->mode = $this->MODE_READY;
		$this->name = '';
		$this->item = array();
	}
	
	function _startElementHandler( $parser, $name, $attrs )
	{
		switch( $name )
		{
		case 'channel':
			$this->mode = $this->MODE_CHANNEL;
			$this->name = '';
			break;
		
		case 'image':
			$this->mode = $this->MODE_IMAGE;
			$this->name = '';
			break;
		
		case 'textinput':
			$this->mode = $this->MODE_TEXTINPUT;
			$this->name = '';
			break;
		
		case 'item':
			$this->mode = $this->MODE_ITEM;
			$this->name = '';
			$this->item = array();
			break;
		
		default:
			if( $this->mode != $this->MODE_READY )
			{
				$this->name = $name;
			}
		}
	}
	
	function _endElementHandler( $parser, $name )
	{
		switch( $name )
		{
		case 'item':
			$this->items[] = $this->item;
		
		case 'channel':
		case 'image':
		case 'textinput':
			$this->mode = $this->MODE_READY;
			break;
		}
		
		$this->name = '';
	}
	
	function _characterDataHandler( $parser, $data )
	{
		if( empty( $this->name ) )
		{
			return;
		}
		
		$data = @mb_convert_encoding( $data, $this->encoding, 'auto' );
		
		switch( $this->mode )
		{
		case $this->MODE_CHANNEL:
			isset( $this->channel[$this->name] )
				? $this->channel[$this->name] .= $data
				: $this->channel[$this->name] = $data;
			break;
		
		case $this->MODE_IMAGE:
			isset( $this->image[$this->name] )
				? $this->image[$this->name] .= $data
				: $this->image[$this->name] = $data;
			break;
		
		case $this->MODE_TEXTINPUT:
			isset( $this->textinput[$this->name] )
				? $this->textinput[$this->name] .= $data
				: $this->textinput[$this->name] = $data;
			break;
		
		case $this->MODE_ITEM:
			isset( $this->item[$this->name] )
				? $this->item[$this->name] .= $data
				: $this->item[$this->name] = $data;
			break;
		}
	}
	
	function _fetchRSS( &$url )
	{
		switch( $this->fetchtype )
		{
		case $this->FETCH_FILE:
			return $this->_fetchRSS_FILE( $this->data, $url );
		case $this->FETCH_CURL:
			return $this->_fetchRSS_CURL( $this->data, $url );
		case $this->FETCH_CMD:
			return $this->_fetchRSS_CMD( $this->data, $url );
		}
		
		return FALSE;
	}
	
	function _fetchRSS_FILE( &$buff, &$url )
	{
		if( function_exists( 'file_get_contents' ) )
		{
			$buff = @file_get_contents( $url );
		}
		else
		{
			$fp = @fopen( $url, 'r' );
			
			if( $fp === FALSE )
			{
				if( $this->debug )
				{
					echo "<div>Could not open URL [$url]</div>";
				}
				return FALSE;
			}
			
			while( !feof( $fp ) )
			{
				$buff .= fread( $fp, 1024 );
			}
			
			fclose( $fp );
		}
		
		return TRUE;
	}
	
	function _fetchRSS_CURL( &$buff, &$url )
	{
		ob_start();
		
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		$r = curl_exec( $ch );
		curl_close( $ch );
		
		$buff = ob_get_clean();
		
		return $r;
	}
	
	function _fetchRSS_CMD( &$buff, &$url )
	{
		$cmd = sprintf( $this->CMDFORMAT, $url );
		$buff = shell_exec( $cmd );
		
		return TRUE;
	}
	
	//------------------------------------------
	// Public Functions
	//------------------------------------------
	
	function getVersion() { return $this->VERSION; }
	
	function setDebug( $flag ) { $this->debug = $flag ? TRUE : FALSE; }
	function getDebug() { return $this->debug; }
	
	function setEncoding( $enc ) { $this->encoding = $enc; }
	function getEncoding() { return $this->encoding; }
	
	function setFetchType( $type ) { $this->fetchtype = $type; }
	function getFetchType() { return $this->fetchtype; }
	
	function getChannel() { return $this->channel; }
	function getImage() { return $this->image; }
	function getTextinput() { return $this->textinput; }
	function getItems() { return $this->items; }
	
	function parse( $url )
	{
		$this->_initVariables();
		
		if( !$this->_fetchRSS( $url ) )
		{
			return FALSE;
		}
		
		if( !xml_parse( $this->parser, $this->data, TRUE ) )
		{
			if( $this->debug )
			{
				printf( '<div>XML Parse Error: %s at line %d</div>',
					xml_error_string( xml_get_error_code( $this->parser ) ),
					xml_get_current_line_number( $this->parser ) );
			}
			return FALSE;
		}
		
		return TRUE;
	}
}

?>
