<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/sidebar', 'header'); ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content'); ?>
<?php endwhile; ?>
