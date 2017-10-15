<?php
/**
 * Template Name: Contact Page
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php if (has_post_thumbnail()) { get_template_part('templates/content', 'hero'); } ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <div class="contact-widget">
    <?php dynamic_sidebar('contact-widget'); ?>
  </div>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
