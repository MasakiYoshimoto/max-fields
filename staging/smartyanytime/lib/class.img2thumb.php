<?php

/**
*	class Image2Thumbnail
*   Thumbnail creation with PHP4 and GDLib 2.0.1 !
*
*
*   @author     Andreas Martens <heyn@plautdietsch.de>
*   @author     Patrick Teague <webdude@veslach.com>
*	@version	1.0a
*   @date       modified 03/13/2003
*   @modifications - added support for reading gif images - makes jpg thumbnails
*        changed several groups of 'if' statements to single 'switch' statements
*        commented out original code so modification could be identified.
*/

class Img2Thumb	{
// New modification

/**
*   Constructor - requires following vars:
*	
*	@param string $filename			image path
*	
*	These are additional vars:
*	
*	@param int $newxsize			new maximum image width
*	@param int $newysize			new maximum image height
*	@param string $fileout			output image path
*	
*/
	function Img2Thumb($filename, $newxsize=60, $newysize=60, $fileout='')
	{
		global $_POST, $_GET, $_COOKIE;
		
		if (isset($_COOKIE))
			$httpvars = $_COOKIE;
		else if (isset($_POST))
			$httpvars =  $_POST;
   		else if (isset($_GET))
   			$httpvars =  $_GET;
		
//	New modification - checks color int to be sure within range
		
		$this -> NewImgCreate($filename,$newxsize,$newysize,$fileout);
	}
	
/**
*  
*	private function - do not call
*
*/
	function NewImgCreate($filename,$newxsize,$newysize,$fileout)
	{
		$type = $this->GetImgType($filename);
		
		switch($type)
		{
			case "gif":
				// unfortunately this function does not work on windows
				// via the precompiled php installation :(
				// it should work on all other systems however.
				if( function_exists("imagecreatefromgif") )
				{
					$orig_img = imagecreatefromgif($filename);
					break;
				}
				else
				{
					print( "sorry, this server doesn't support <b>imagecreatefromgif()</b>" );
					exit;
					break;
				}
			case "jpg":
				$orig_img = imagecreatefromjpeg($filename);
				break;
			case "png":
				$orig_img = imagecreatefrompng($filename);
				break;
		}
		
		$new_img =$this->NewImgResize($orig_img,$newxsize,$newysize,$filename);
		
		if (!empty($fileout))
		{
			 $this-> NewImgSave($new_img,$fileout,$type);
		}
		else
		{
			 $this->NewImgShow($new_img,$type);
		}
		
		ImageDestroy($new_img);
		ImageDestroy($orig_img);
	}
	
	/**
*  
*	private function - do not call
*	includes function ImageCreateTrueColor and ImageCopyResampled which are available only under GD 2.0.1 or higher !
*/
	function NewImgResize($orig_img,$newxsize,$newysize,$filename)
	{
		//getimagesize returns array
		// [0] = width in pixels
		// [1] = height in pixels
		// [2] = type
		// [3] = img tag "width=xx height=xx" values
		
		$orig_size = getimagesize($filename);

		$maxX = $newxsize;
		$maxY = $newysize;
		
		if ($orig_size[0]<$orig_size[1])
		{
			$newxsize = $newysize * ($orig_size[0]/$orig_size[1]);
			$adjustX = ($maxX - $newxsize)/2;
			$adjustY = 0;
		}
		else
		{
			$newysize = $newxsize / ($orig_size[0]/$orig_size[1]);
			$adjustX = 0;
			$adjustY = ($maxY - $newysize)/2;
		}
		
		/* Original code removed to allow for maxSize thumbnails
		$im_out = ImageCreateTrueColor($newxsize,$newysize);
		ImageCopyResampled($im_out, $orig_img, 0, 0, 0, 0,
			$newxsize, $newysize,$orig_size[0], $orig_size[1]);
		*/
		
//	New modification - creates new image at maxSize

			$im_out = ImageCreateTrueColor($newxsize,$newysize);
			ImageCopyResampled($im_out, $orig_img, 0, 0, 0, 0,
				$newxsize, $newysize,$orig_size[0], $orig_size[1]);

		return $im_out;
	}
	
	/**
*  
*	private function - do not call
*
*/
	function NewImgSave($new_img,$fileout,$type)
	{
		/* Original code removed in favor of 'switch' statement
		if ($type=="png")
		{
			if (substr($fileout,strlen($fileout)-4,4)!=".png")
				$fileout .= ".png";
			 return imagepng($new_img,$fileout);
		}
		if ($type=="jpg")
		{
			if (substr($fileout,strlen($fileout)-4,4)!=".jpg")
				$fileout .= ".jpg";
			 return imagejpeg($new_img,$fileout);
		}
		*/
		switch($type)
		{
			case "gif":
				if( function_exists("imagegif") )
				{
					if (substr($fileout,strlen($fileout)-4,4)!=".gif")
						$fileout .= ".gif";
					return imagegif($new_img,$fileout);
					break;
				}
				else
					$this->NewImgSave( $new_img, $fileout, "jpg" );
			case "jpg":
				if (substr($fileout,strlen($fileout)-4,4)!=".jpg")
					$fileout .= ".jpg";
				return imagejpeg($new_img,$fileout);
				break;
			case "png":
				if (substr($fileout,strlen($fileout)-4,4)!=".png")
					$fileout .= ".png";
				return imagepng($new_img,$fileout);
				break;
		}
	}
	
	/**
*  
*	private function - do not call
*
*/
	function NewImgShow($new_img,$type)
	{
		/* Original code removed in favor of 'switch' statement
		if ($type=="png")
		{
			header ("Content-type: image/png");
			 return imagepng($new_img);
		}
		if ($type=="jpg")
		{
			header ("Content-type: image/jpeg");
			 return imagejpeg($new_img);
		}
		*/
		switch($type)
		{
			case "gif":
				if( function_exists("imagegif") )
				{
					header ("Content-type: image/gif");
					return imagegif($new_img);
					break;
				}
				else
					$this->NewImgShow( $new_img, "jpg" );
			case "jpg":
				header ("Content-type: image/jpeg");
				return imagejpeg($new_img);
				break;
			case "png":
				header ("Content-type: image/png");
				return imagepng($new_img);
				break;
		}
	}
	
	/**
*  
*	private function - do not call
*
*   1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF,
*   5 = PSD, 6 = BMP,
*   7 = TIFF(intel byte order),
*   8 = TIFF(motorola byte order),
*   9 = JPC, 10 = JP2, 11 = JPX,
*   12 = JB2, 13 = SWC, 14 = IFF
*/
	function GetImgType($filename)
	{
		$size = getimagesize($filename);
		/* Original code removed in favor of 'switch' statement
		if($size[2]==2)
			return "jpg";
		elseif($size[2]==3)
			return "png";
		*/
		switch($size[2])
		{
			case 1:
				return "gif";
				break;
			case 2:
				return "jpg";
				break;
			case 3:
				return "png";
				break;
		}
	}
	
}

?>