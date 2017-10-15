<header class="banner">
  <div class="container-fluid">
    <nav class="navbar navbar-toggleable-md navbar-dark">
      <a class="navbar-brand brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?> <span class="tagline"><?php bloginfo( 'description' ); ?></span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#top-nav" aria-controls="top-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        <span class="sr-only"><?= __('Toggle navigation', 'hylands-house'); ?></span>
      </button>     
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu([
          'theme_location' => 'primary_navigation', 
          'menu_class' => 'navbar-nav mr-auto', 
          'container_class' => 'navbar-collapse',
          'container_id' => 'top-nav'
        ]);
      endif;
      ?>
    </nav>
  </div>
</header>
