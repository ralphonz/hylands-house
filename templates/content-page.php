<div class="entry-content">
  <?php the_content(); ?>
</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'hylands-house'), 'after' => '</p></nav>']); ?>
<?php 
if (has_nav_menu('button_navigation') && !is_page_template('template-contact.php')) :
  wp_nav_menu([
    'theme_location' => 'button_navigation', 
    'menu_class' => 'nav nav-pills', 
  ]);
endif;
?>
