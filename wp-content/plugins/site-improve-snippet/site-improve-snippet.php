<?php
/*
Plugin Name: Site Improve Snippet
Description: Enqueue Stanford's Siteimprove javascript snippet
Version:     1.0
Author:      JB Christy
Author URI:  https://www.stanford.edu/site/
License:     Educational Community License 2.0
License URI: http://directory.fsf.org/wiki/License:ECL2.0
*/

namespace Stanford\Siteimprove;

function enqueue_snippet() {
  wp_enqueue_script( 'site-improve-snippet', plugins_url( '', __FILE__ ) . '/snippet.js', [], '1.0' );
}
add_action( 'wp_enqueue_scripts', 'Stanford\Siteimprove\enqueue_snippet');