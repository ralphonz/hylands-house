<?php
/**
 * Template Name: No widgets
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php if (has_post_thumbnail()) { get_template_part('templates/content', 'hero'); } ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
