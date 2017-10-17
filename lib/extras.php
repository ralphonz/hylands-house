<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a class="read-more btn" href="' . get_permalink() . '">' . __('Read More', 'hylands-house') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/* Change Excerpt length */
function custom_excerpt_length( $length ) {
  return 35;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\\custom_excerpt_length', 999 );

/**
 * Add boostrap classes to nav items
 * @since 1.0.0
 * @link https://stackoverflow.com/questions/37823371/adding-class-to-li-elements-in-wp-nav-menu
 */
function menu_item_class ( $classes ){
  $classes[] = 'nav-item';
  return $classes;
}
add_filter('nav_menu_css_class', __NAMESPACE__ . '\\menu_item_class' );