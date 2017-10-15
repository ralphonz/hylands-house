<footer class="content-info pagefade">
  <nav class="navbar navbar-toggleable-md navbar-dark">
    <a class="navbar-brand brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?> <span class="tagline"><?php bloginfo( 'description' ); ?></span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bottom-nav" aria-controls="bottom-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      <span class="sr-only"><?= __('Toggle navigation', 'hylands-house'); ?></span>
    </button>     
    <?php
    if (has_nav_menu('primary_navigation')) :
      wp_nav_menu([
        'theme_location' => 'primary_navigation', 
        'menu_class' => 'navbar-nav mr-auto', 
        'container_class' => 'navbar-collapse',
        'container_id' => 'bottom-nav'
      ]);
    endif;
    ?>
  </nav>
  <p class="copyright">&copy; <?php _e('Copyright', 'hylands-house');?> <a href="<?= get_site_url(); ?>"><?= bloginfo('name'); ?></a> <?php echo date("Y"); ?>. <?php _e('Designed and hosted with renewable energy @ ', 'hylands-house'); ?><a href="https://blueleafstudio.net" title="Blueleaf Studio Web Developemt">Blueleaf Studio</a></p>
</footer>
