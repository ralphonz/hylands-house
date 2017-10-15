<?php 

namespace Roots\Sage\Admin;

use Roots\Sage\Assets;

/**
 * Enqueue admin stylessheet
 * @since 1.0
 */
function admin_style() {
  wp_enqueue_style('sage/admin', Assets\asset_path('styles/admin.css'), false, null);
}
add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\admin_style');

/**
 * Change the admin footer text
 * @since 1.0
 * @return string
 */
function footer_admin_text () { 
  echo 'Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Designed by <a href="http://blueleafstudio.net" target="_blank" title="Blueleaf Studio Web Design and Development">Blueleaf Studio Web Design and Development</a> | Hosted with 100% renewable energy at <a href="http://www.wpbeginner.com" target="_blank" title="Blueleaf Studio Eco Web Hosting">Blueleaf Web Hosting</a></p>';
}
add_filter('admin_footer_text', __NAMESPACE__ . '\\footer_admin_text');

/**
 * Remove the wordpress version number for the admin footer for evryone except admins
 * @since 1.0
 */
function footer_shh() {
  if ( ! current_user_can('manage_options') ) { // 'update_core' may be more appropriate
    remove_filter( 'update_footer', 'core_update_footer' ); 
  }
}
add_action( 'admin_menu', __NAMESPACE__ . '\\footer_shh' );

/**
 * Change the login styles
 * @since 1.0
 */
function login_stylesheet() {
  wp_enqueue_style( 'sage/login', Assets\asset_path('styles/login.css'), false, null);
}
add_action( 'login_enqueue_scripts', __NAMESPACE__ . '\\login_stylesheet' );


/**
 * Change the "Posts" labels
 * @since 1.0
 */
function change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Newsletters';
    $submenu['edit.php'][5][0] = 'Newsletter';
    $submenu['edit.php'][10][0] = 'Add Newsletter';
    $submenu['edit.php'][16][0] = 'Newsletter Tags';
}
function change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Newsletters';
    $labels->singular_name = 'Newsletter';
    $labels->add_new = 'Add Newsletter';
    $labels->add_new_item = 'Add Newsletter';
    $labels->edit_item = 'Edit Newsletter';
    $labels->new_item = 'Newsletter';
    $labels->view_item = 'View Newsletter';
    $labels->search_items = 'Search Newsletters';
    $labels->not_found = 'No Newsletters found';
    $labels->not_found_in_trash = 'No Newsletters found in the Bin';
    $labels->all_items = 'All Newsletters';
    $labels->menu_name = 'Newsletters';
    $labels->name_admin_bar = 'Newsletters';
}
add_action( 'admin_menu', __NAMESPACE__ . '\\change_post_label' );
add_action( 'init', __NAMESPACE__ . '\\change_post_object' );

/**
 * Move featured image to the top of the posts edit screen
 * @since 1.0
 */
function move_meta_box(){
    remove_meta_box( 'postimagediv', ['post', 'page'], 'side' );
    remove_meta_box( 'categorydiv', ['post'], 'side' );
    remove_meta_box( 'categorydiv', ['post'], 'side' );
    add_meta_box('postimagediv', __('Featured Image', 'hylands-house'), 'post_thumbnail_meta_box', ['post', 'page'], 'side', 'high');
}
add_action('do_meta_boxes', __NAMESPACE__ . '\\move_meta_box');

/**
 * Remove Categories and Tags from posts admin menu
 * @since 1.0
 */
function adjust_the_wp_menu() {
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}
add_action( 'admin_menu', __NAMESPACE__ . '\\adjust_the_wp_menu', 999 );

/**
 * Remove dashboard widgets
 * @since 1.0
 */
function remove_dashboard_widgets() {
    global $wp_meta_boxes;
 
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
 
}
 
add_action('wp_dashboard_setup', __NAMESPACE__ . '\\remove_dashboard_widgets' );