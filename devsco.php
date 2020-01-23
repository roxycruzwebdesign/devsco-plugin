<?php
/**
 * Plugin Name: Display Elementor Via Shortcode Output
 * Plugin URI:  https://github.com/roxycruzwebdesign/devsco-plugin
 * Description: Lets you display Elementor templates via shortcode in text widget. 
 * Version:     1.0.0
 * Author:      Roxy Cruz
 * Author URI:  https://roxycruzwebdesign.com
 * Text Domain: rcwd_devsco
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Make sure shortcodes are allowed in widgets
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Use shortcode INSERT_ELEMENTOR  eg: [INSERT_ELEMENTOR id=xxx]
 * Parameter "xxx" is id of any post created using Elementor.
 * 
 * @param  array $atts - the attributes passed into the shortcode
 * @return string - the shortcode output
 */
function rcwd_devsco_insert_elementor( $atts) {
	
  if ( !class_exists('Elementor\Plugin') ) {
    return '';
  }
  if ( !isset($atts['id']) || empty($atts['id']) ) {
    return '';
  }
  $post_id = $atts['id'];
  $response = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($post_id);
  return $response;
}
add_shortcode('INSERT_ELEMENTOR','rcwd_devsco_insert_elementor');