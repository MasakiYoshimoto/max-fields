<?php

/* 
RSS74 - Version 0.3
First release: Dec 21, 2006 / Last update: Dec 21, 2006
--------------------------------------------------------------------
RSS74 is a PHP class with that you can create RSS files.
It provides a simple interface to do that. Just look at the
examples.

The latest version of RSS74 can be obtained from:
http://www.jonasjohn.de/lab/rss74.htm
--------------------------------------------------------------------
Copyright (c) 2006 Jonas John, All rights reserved.
See license.txt for more details.
*/

class rss74 {

    // RSS feed title:
    var $title = "Untitled";
    
    // RSS description:
    var $desc = "";
    
    // RSS base url
    // -> Example: http://www.jonasjohn.de/
    var $base_url = "";
    
    // XSL file for the resulting RSS feed:
    var $xsl_file = 'rss.xsl';
    
    // RSS 2.0 Specification (URL):
    var $doc_url = 'http://blogs.law.harvard.edu/tech/rss';
    
    // Copyright text:
    // -> Example: Copyright 2006, Jonas John
    var $copyright = ''; 
    
    // RSS language setting: 
    // Example: en-us, de-de, fr-fr
    var $language = 'en-us';
    
    // Managing editor and webmaster:
    // (should contain a E-Mail adress)
    var $managing_editor = '';
    var $webmaster = '';
    
    // Feedburner URL
    // Example: http://feeds.feedburner.com/codedump-rss
    // (If a FB URL is set, all requests except the Feedburner and Google
    // requests will be redricted to the feedburner URL)
    var $feedburner_url = '';
    
    // RSS generator:
    var $generator = 'rss74/v0.3';
    
    // Limit RSS entries to:
    // (Example: 20, 30, 40, 50, etc.)
    var $limit_entries = 20;

    // RSS items:
    var $items = array();

	// BrowserAgent
	var $browseragent = '';

	// BrowserVer
	var $browserver = '';

    // constructor:
    function rss74(){

		//browser&verの取得
		if ( ereg ( 'MSIE ([0-9].[0-9]{1,2})' , $_SERVER [ 'HTTP_USER_AGENT' ] , $log_version ) ) {
			//IEの場合
			$this->browserver = $log_version [ 1 ]*1;
			$this->browseragent = 'IE';
		}
		else {
			//それ以外の場合
			$this->browserver = 0;
			$this->browseragent = 'OTHER';
		}

    }   
    
    function add_entry($entry){    
    
        // create date key:
        $date = isset($entry['date']) ? $entry['date'] : time();   

        // add unique string:
        $date .= '_' . md5($entry['title']);
        
        $this->items[$date] = $entry;
    }
    
    function _get_val(&$array, $key){
        return isset($array[$key]) ? $array[$key] : '';
    }
    
    function _exists_val(&$array, $key){
        return isset($array[$key]);
    }
    
    function get_rss_headers($rss_webpath){
        return '<link rel="alternate" type="application/rss+xml" title="RSS" href="'.$rss_webpath.'" />';
    }
    
    function print_rss(){
        global $_SERVER;
    
//        krsort($this->items);
        $this->items = array_slice($this->items, 0, $this->limit_entries);
        
        $first_item = array_keys($this->items);
        $first_item = $first_item[0];
        
        $last_change = $this->items[$first_item]['date'];
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_change).' GMT');
        
        header('Content-Type: text/xml; charset=utf-8');

        if (!empty($this->feedburner_url)){
            if (!preg_match("/feedburner/i", $_SERVER['HTTP_USER_AGENT']) and !preg_match("/google/i", $_SERVER['HTTP_USER_AGENT'])) {
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: ' . $this->feedburner_url);
                print '<a href="'.$this->feedburner_url.'">Redirecting...</a>';
                return true;
            }
        }

        print '<?xml version="1.0" encoding="utf-8"?>' . "\n";
        
        if ($this->xsl_file != '')
            print '<?xml-stylesheet href="rss.xsl" type="text/xsl" media="screen"?>' . "\n";
        if ( $this->browseragent != 'IE' || ( $this->browseragent == 'IE' && $this->browserver < 7 ) )
        print '<!DOCTYPE rss [<!ENTITY % HTMLlat1 PUBLIC "-//W3C//ENTITIES Latin 1 for XHTML//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml-lat1.ent">]>' . "\n";
        
        print "<!--\nHello!\nThis web page is a RSS file that is meant to be read\nby a RSS reader application.\n\nLook at http://en.wikipedia.org/wiki/RSS to learn more\nabout RSS.\n-->";
        
        print '<rss version="2.0" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
        print '<channel>' . "\n";
        
        print "\t".'<title>'.htmlentities($this->title , ENT_COMPAT , 'UTF-8').'</title>' . "\n";
        
        if (!empty($this->desc))
            print "\t".'<description>'.htmlentities($this->desc , ENT_COMPAT , 'UTF-8').'</description>' . "\n";
        
        if (!empty($this->base_url))
            print "\t".'<link>'.htmlentities($this->base_url , ENT_COMPAT , 'UTF-8').'</link>' . "\n";
        
        print "\t".'<lastBuildDate>'.date('r', time()).'</lastBuildDate>' . "\n";
        print "\t".'<pubDate>'.date('r', time()).'</pubDate>' . "\n";
        
        if (!empty($this->generator))
            print "\t".'<generator>'.$this->generator.'</generator>' . "\n";
        
        if (!empty($this->copyright))
            print "\t".'<copyright>'.$this->copyright.'</copyright>' . "\n";
            
        if (!empty($this->doc_url))
            print "\t".'<docs>'.$this->doc_url.'</docs>' . "\n";
        
        if (!empty($this->language))
            print "\t<language>".$this->language."</language>\n";
            
        if (!empty($this->managing_editor))
            print "\t<managingEditor>".$this->managing_editor."</managingEditor>\n";

        if (!empty($this->webmaster))
            print "\t<webMaster>".$this->webmaster."</webMaster>\n";


        while(list($num, $item) = each($this->items)){
      
            print "\t<item>\n";
            print "\t\t<title>".htmlentities($this->_get_val($item, 'title') , ENT_COMPAT , 'UTF-8')."</title>\n";
            
            if ($this->_exists_val($item, 'url')){
                print "\t\t<link>".$this->_get_val($item, 'url')."</link>\n";
                print "\t\t<guid isPermaLink=\"true\">".$this->_get_val($item, 'url')."</guid>\n";
            }
            
            if ($this->_exists_val($item, 'desc'))
                print "\t\t<description><![CDATA[".$this->_get_val($item, 'desc')."]]></description>\n";
            
            if ($this->_exists_val($item, 'date')){
                print "\t\t<pubDate>".date('r', intval($this->_get_val($item, 'date')))."</pubDate>\n";
            }
        
            $cats = array();
            while(list($cn, $citem) = each($cats)){
                print "\t\t<category>$citem</category>\n";
            }
                
            print "\t</item>\n";
             
        }

        print "\t</channel>\n";
        print "</rss>";
        
        return true;
        
    }
}

?>