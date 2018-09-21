<?php
/*
 * Plugin Name: Preserve Editor Scroll Position
 * Version: 0.2
 * Description: This plugin will recover the old scroll position in your Editor after saving. Either HTML or visuel editor.
 * Author: Dominik Schilling
 * Author URI: http://wphelper.de/
 * Plugin URI: http://wpgrafie.de/wp-plugins/preserve-editor-scroll-position/
 *
 * License: GPLv2 or later
 *
 * 	Copyright (C) 2011-2012 Dominik Schilling
 *
 * 	modify it under the terms of the GNU General Public License
 * 	as published by the Free Software Foundation; either version 2
 * 	of the License, or (at your option) any later version.
 *
 * 	This program is distributed in the hope that it will be useful,
 * 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 	GNU General Public License for more details.
 *
 * 	You should have received a copy of the GNU General Public License
 * 	along with this program; if not, write to the Free Software
 * 	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/*
 * Don't call this file directly.
 */
if ( ! class_exists( 'WP' ) ) {
	die();
}

/**
 * The class will help you to recover the old scoll position in your Editor.
 * Either HTML or visuel editor.
 *
 */
final class Preserve_Editor_Scroll_Position {
	/**
	 * Init.
	 *
	 * @since 0.1.0
	 */
	public static function init() {
		add_filter( 'redirect_post_location', array( __CLASS__, 'add_query_arg' ) );
		add_action( 'edit_form_advanced', array( __CLASS__, 'add_input_field' ) );
		add_action( 'edit_page_form', array( __CLASS__, 'add_input_field' ) );
		add_filter( 'tiny_mce_before_init', array( __CLASS__, 'extend_tiny_mce' ) );
		add_action( 'after_wp_tiny_mce', array( __CLASS__, 'print_js' ) );
	}

	/**
	 * Adds a hidden input field for scrolltop value.
	 *
	 * @since 0.1.0
	 */
	public static function add_input_field() {
		$position = ! empty( $_GET['scrollto'] ) ? $_GET['scrollto'] : 0;

		printf( '<input type="hidden" id="scrollto" name="scrollto" value="%d"/>', esc_attr( $position ) );
	}


	/**
	 * Extend TinyMCE config with a setup function.
	 * See http://www.tinymce.com/wiki.php/API3:event.tinymce.Editor.onInit
	 *
	 * @since 0.1.0
	 *
	 * @param array $init
	 * @return array
	 */
	public static function extend_tiny_mce( $init ) {
		if ( wp_default_editor() == 'tinymce' )
			$init['setup'] = 'rich_scroll';

		return $init;
	}


	/**
	 * Returns redirect url with query arg for scroll position.
	 *
	 * @since 0.1.0
	 *
	 * @param string $location
	 * @return string
	 */
	public static function add_query_arg( $location ) {
		if( ! empty( $_POST['scrollto'] ) )
			$location = add_query_arg( 'scrollto', (int) $_POST['scrollto'], $location );

		return $location;
	}

	/**
	 * Prints Javascript data.
	 * On form submit the scrollTop value will be saved into the hidden input field.
	 * Includes callback function for TinyMCE scrolling.
	 *
	 * @since 0.1.0
	 */
	public static function print_js( $mce_settings ) {
		?>
<script>
( function( $ ) {
	$( '#post' ).submit( function() {
		// TinyMCE or HTML Editor?
		scrollto =
			$('#content' ).is(':hidden') ?
			$('#content_ifr').contents().find( 'body' ).scrollTop() :
			$('#content' ).scrollTop();

		// Save scrollto value
		$( '#scrollto' ).val( scrollto );
	} );

	// Only HTML editor: scroll to scrollto value
	$( '#content' ).scrollTop( $( '#scrollto' ).val() );
} )( jQuery );
<?php if ( wp_default_editor() == 'tinymce' && ! empty( $mce_settings ) ) : ?>
/*
 * Callback function for TinyMCE setup event
 * See http://www.tinymce.com/wiki.php/API3:event.tinymce.Editor.onInit
 */
function rich_scroll( ed ) {
	ed.onInit.add( function() {
		jQuery( '#content_ifr' ).contents().find( 'body' ).scrollTop( jQuery( '#scrollto' ).val() );
	} );
};
<?php endif; ?>
</script>
		<?php
	}
}

// Please load. Thanks.
add_action( 'admin_init', array( 'Preserve_Editor_Scroll_Position', 'init' ) );
