<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 8]><div class="alert alert-warning"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>

<?php if (is_page('home')) : ?>
  <div class="grid-container">
    <div class="home-grid">
      <div class="home-grid-inner clearfix">
        <div class="block-column">
          <div class="block small green"></div>
          <div class="block small image">
            <?php 
              $attachment_ids = get_field('grid_small_images');
              echo wp_get_attachment_image( $attachment_ids[0]['image'], 'grid_small' );
            ?>          
          </div>
        </div>
        <div class="block-column-large block-column">
          <div class="block large image">
            <?php 
              $attachment_id = get_field('grid_large_image');
              echo wp_get_attachment_image( $attachment_id, 'grid_large' );
            ?>
          </div>
        </div>
        <div class="block-column">
          <div class="block small image">
            <?php 
              echo wp_get_attachment_image( $attachment_ids[1]['image'], 'grid_small' );
            ?>   
          </div>
          <a class="block small green" href="#">
            <h4>Compare Shelters</h4>
          </a>
        </div>
        <div class="block-column">
          <a class="block small blue" href="#">
              <h4>Our Story</h4>
          </a>
          <div class="block small image">
            <?php 
              echo wp_get_attachment_image( $attachment_ids[2]['image'], 'grid_small' );
            ?>   
          </div>
        </div>
        <div class="block-column">
          <div class="block small image">
            <?php 
              echo wp_get_attachment_image( $attachment_ids[3]['image'], 'grid_small' );
            ?>   
          </div>
          <div class="block small blue"></div>
        </div>
      </div>
    </div>
  </div>
<?php endif ?>

  <div class="wrap container" role="document">
    <div class="content row">
      <?php if (roots_display_sidebar()) : ?>
        <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
          <?php include roots_sidebar_path(); ?>
        </aside><!-- /.sidebar -->
      <?php endif; ?>      
      <div class="main <?php echo roots_main_class(); ?>" role="main">
        <?php include roots_template_path(); ?>
      </div><!-- /.main -->

    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>

</body>
</html>
