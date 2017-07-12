<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-navbar-header">
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

      <div class="col-md-10 col-navbar">

        <nav class="navbar-collapse collapse" role="navigation">           
          <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
            endif;
          ?>
          <div class="search-mobile visible-xs">
            <?php get_search_form(); ?>
          </div>
        </nav>
      </div>
      <div class="col-md-3 hidden-sm hidden-xs">
        <?php get_search_form(); ?>
      </div>
    </div>
    <div class="row">
      <div class="search-tablet visible-sm">
        <?php get_search_form(); ?>
      </div>
    </div>

    <!--<div class="cart-link">
      <?php global $woocommerce; ?>

      <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><span>( <?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> )</span> View Cart</a>
    </div>-->

  </div>

</header>
