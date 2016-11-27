<?php
/**
 * The main plugin file for "Called unto Holiness"
 *
 * Define core functions and basic CSS for the "Called unto Holiness" plugin.
 *
 * @link https://github.com/reubenlillie.com/called-unto-holiness/
 *
 * @package Called_Unto_Holiness
 * @subpackage Main
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin Name: "Called unto Holiness"
 * Plugin URI: http://github.com/reubenlillie/called-unto-holiness
 * Description: This is not just a plugin, it symbolizes the hope and enthusiasm which the earliest Nazarenes have passed down for generations through each verse of Lelia N. Morris' anthem "Holiness unto the Lord" (1904). When activated you will see a randomly selected lyric from "Holiness unto the Lord" in the upper right of your admin screen on every page.
 * Author: Reuben L. Lillie
 * Version: 1.0.0
 * Author URI: https://reubenlillie.com/about
 * Textdomain: holiness
 */

/*
 * This plugin is inspired by and adapted from the Hello, Dolly! plugin
 * developed by Matt Mullenweg.
 *
 * @link http://wordpress.org/plugins/hello-dolly/
 * @link http://ma.tt/
 */


/**
 * List the lyrics, split the lyrics into lines, and randomize them on output.
 *
 * Store the lyrics in a variable 
 * and use the PHP functions `explode` and `mt_rand` 
 * to select a single line at random.
 *
 * @since 1.0.0
 *
 * @param  string $lyrics Translatable "Holiness unto the Lord" lyrics.
 * @return string A randomly selected line from lyrics.
 */
function holiness_get_lyric() {
	/**
	 * Place lyrics to "Holiness unto the Lord" in a translatable string
	 *
	 * @since 1.0.0
	 * 
	 * @var string $lyrics
	 */
	$lyrics = __( 
			'"Called unto holiness," church of our God,
			Purchase of Jesus, redeemed by his blood;
			Called from the world and its idols to flee,
			Called from the bondage of sin to be free.
			"Called unto holiness," children of light,
			Walking with Jesus in garments of white;
			Raiment unsullied, nor tarnished with sin;
			God\'s Holy Spirit abiding within.
			"Called unto holiness," praise his dear name!
			This blessed secret to faith now made plain,
			Not our own righteousness, but Christ within,
			Living and reigning and saving from sin.
			"Called unto holiness," Bride of the Lamb,
			Waiting the Bridegroom\'s returning again;
			Lift up your heads, for the day draweth near
			When in his beauty the King shall appear.
			"Holiness unto the Lord" is our watchword and song.
			"Holiness unto the Lord" as we’re marching along.
			Sing it, shout it, loud and long,
			"Holiness unto the Lord," now and forever.'
			, 'holiness' //textdomain
		);

	/**
	 * Split lyrics into smaller strings by line.
	 *
	 * @since 1.0.0
	 *
	 * @see explode()
	 * @link http://php.net/manual/en/function.explode.php
	 */
	$lyrics = explode( "\n", $lyrics );

	/**
	 * Select a line at random.
	 *
	 * @since 1.0.0
	 *
	 * @see mt_rand()
	 * http://php.net/manual/en/function.mt-rand.php
	 */
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

/**
 * Select a line to return as a formatted string (escape on output).
 *
 * @since 1.0.0
 *
 * @see holiness_get_lyric()
 *
 * @see sprintf()
 * @link http://php.net/manual/en/function.sprintf.php
 */
function called_unto_holiness() {
	/**
	 * Put the selected lyirc in a variable to return as an escaped string.
	 *
	 * @since 1.0.0
	 *
	 * @see holiness_get_lyric()
	 * 
	 * @var string $selected
	 */
	$selected = holiness_get_lyric();
	echo '<p id="holiness">' . esc_attr( $selected ) . '</p>';
}

/**
 * Run when the admin_notices action is called.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/reference/hooks/admin_notices/
 */
add_action( 'admin_notices', 'called_unto_holiness' );

/**
 * Determine the text direction and define basic CSS.
 *
 * @since 1.0.0
 *
 * @see holiness_get_lyric()
 *
 * @see sprintf()
 * @link http://php.net/manual/en/function.sprintf.php
 */
function holiness_css() {
	// Ensure that the positioning is also good for right-to-left
	$text_direction = is_rtl() ? 'left' : 'right';
	$text = esc_attr( $text_direction );

	echo "
	<style type='text/css'>
	#holiness {
		float: $text;
		padding-$text: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

/**
 * Add CSS to the HTML head tag on admin pages.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/reference/hooks/admin_head/
 */
add_action( 'admin_head', 'holiness_css' );

