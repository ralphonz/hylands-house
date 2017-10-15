<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-content">
    <?php if (has_post_thumbnail()) : ?>
      <div class="alignleft featured-image"> 
        <?php the_post_thumbnail('medium'); ?>
      </div>
    <?php endif; ?>
    <?php the_content(); ?>
  </div>
</article>
