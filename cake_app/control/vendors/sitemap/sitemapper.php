<?php
/**
 *  Sitemapper
 *  @see       http://0-oo.net/sbox/php-tool-box/sitemapper
 *  @version   0.1.0
 *  @copyright 2010 dgbadmin@gmail.com
 *  @license   http://0-oo.net/pryn/MIT_license.txt (The MIT license)
 */
class SiteMapper {
	public static function map(array $urls, $type = 'normal') {

		$lastmod = date('Y-m-d');

		$x = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
 
		if ($type == 'mobile') {
			$x .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
			$x .= ' xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0">';
		} else {
			$x .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		}
		$x .= "\n";
		foreach ($urls as $url) {
			if($url['del']&&$url['del']==1) continue;
			$x .= "   <url>\n";
			$x .= '      <loc>' . htmlspecialchars($url['link']) . "</loc>\n";
			$x .= "      <lastmod>" . $lastmod . "</lastmod>\n";
			$x .= "      <changefreq>" . $url['changefreq'] . "</changefreq>\n";
			$x .= "      <priority>" . $url['priority'] ."</priority>\n";
			if ($type == 'mobile') {
				$x .= "      <mobile:mobile/>\n";
			}
			$x .= "   </url>\n";
		}
 
		$x .= "</urlset>\n";
 
		return $x;
	}
}
?>