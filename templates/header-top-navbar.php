<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
        </div>
      </div>

      <div class="col-md-10">

        <nav class="collapse navbar-collapse" role="navigation">           
          <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
            endif;
          ?>
        </nav>
      </div>
      <div class="col-md-3">
        <?php get_search_form(); ?>
      </div>
    </div>
  </div>
</header>
