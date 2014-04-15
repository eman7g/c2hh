<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
  /**
   * woocommerce_before_single_product hook
   *
   * @hooked wc_print_notices - 10
   */
   do_action( 'woocommerce_before_single_product' );

   if ( post_password_required() ) {
    echo get_the_password_form();
    return;
   }
?>

<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
  <div class="row">
    <div class="col-md-8">
      <?php $images = get_field('product_images'); $i = 0; ?>

      <?php if( $images ): ?>
        <div class="product-slider-wrap clearfix">
          <ul class="bxslider product-slider">
              <li><?php the_post_thumbnail('product_feature'); ?></li>
            <?php foreach( $images as $image ): ?>
              <li><img src="<?php echo $image['sizes']['product_feature']; ?>" alt="<?php echo $image['alt']; ?>" /></li>
            <?php endforeach ?>
          </ul>

          <div id="product-pager">
            <a data-slide-index="<?php echo $i;?>" href=""><?php the_post_thumbnail('product_gallery_thumb'); ?></a>
            <?php $i++;?>
            <?php foreach( $images as $image ): ?>
              <a data-slide-index="<?php echo $i;?>" href=""> <img src="<?php echo $image['sizes']['product_gallery_thumb']; ?>" alt="<?php echo $image['alt']; ?>" /></a>
            <?php $i++; endforeach ?>
          </div>
        </div>

      <?php endif ?>

      <div class="product-attributes">
        <h4>Product Attributes</h4>
        <ul>
          <?php $terms = get_the_terms( $post->ID, 'attribute' );?>
          <?php
            foreach ( $terms as $term ) : ?>
              <li class="<?php echo $term->slug;?>"><?php echo $term->name;?></li>
            <?php endforeach;
          ?>
        </ul>
      </div>


    </div>
    <div class="col-md-8">
      <div class="product-main">
        <header>
          <h1 class="entry-title"><?php the_title(); ?></h1>
          <h2 class="price">
            <?php 
              woocommerce_get_template( 'loop/price.php' );
            ?>
          </h2>
        </header>    

        <h4 class="product-type">Dwelling Unit</h4>

        <div class="product-description">
          <?php the_content('description');?>
        </div>

        <div class="row">
          <div class="col-md-6">
            <?php 
              woocommerce_get_template( 'loop/add-to-cart.php' );
            ?>
            <?php
              /**
               * woocommerce_single_product_summary hook
               *
               * @hooked woocommerce_template_single_add_to_cart - 30
               * @hooked woocommerce_template_single_sharing - 50
               */
              do_action( 'woocommerce_single_product_summary' );
            ?>
          </div>
            
          <div class="col-md-10">
            <ul class="social-links">
              <li><a class="links contact" href="#">Contact A Representative</a></li>
              <li>
                  <!-- AddToAny BEGIN -->
                  <div class="a2a_kit a2a_default_style">
                  <a class="a2a_dd" href="http://www.addtoany.com/share_save">Share</a>
                  </div>
                  <script type="text/javascript">
                    a2a_config = {
                      onclick: 1
                    };
                  </script>
                  <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
                  <!-- AddToAny END -->
              </li>

            </ul>
          </div>
        </div>

      </div>

      <div class="product-details">
        <h2>Product Details</h2>

        <div class="panel-group" id="product-accordion">
          <?php if (get_field('specifications')) : ?>
            <div class="panel panel-default">
              <div class="panel-heading" data-toggle="collapse" data-parent="#product-accordion" href="#specifications">
                <h4 class="panel-title">
                    <a>Specifications:</a>
                </h4>
              </div>
              <div id="specifications" class="panel-collapse collapse in">
                <div class="panel-body">
                  <?php the_field('specifications');?>
                </div>
              </div>
            </div>
          <?php endif ?>
          <?php if (get_field('facilities_features')) : ?>
            <div class="panel panel-default">
              <div class="panel-heading collapsed" data-toggle="collapse" data-parent="#product-accordion" href="#facilities">
                <h4 class="panel-title">
                    <a>Facilities &amp; Features:</a>
                </h4>
              </div>
              <div id="facilities" class="panel-collapse collapse">
                <div class="panel-body">
                  <?php the_field('facilities_features');?>
                </div>
              </div>
            </div>
          <?php endif ?>
          <?php if (get_field('plumbing_electrical_mechanical')) : ?>
            <div class="panel panel-default">
              <div class="panel-heading collapsed" data-toggle="collapse" data-parent="#product-accordion" href="#plumbing">
                <h4 class="panel-title">
                    <a>Plumbing, Electrical &amp; Mechanical:</a>
                </h4>
              </div>
              <div id="plumbing" class="panel-collapse collapse">
                <div class="panel-body">
                  <?php the_field('plumbing_electrical_mechanical');?>
                </div>
              </div>
            </div>
          <?php endif ?>
          <?php if (get_field('assembly_shipping')) : ?>
            <div class="panel panel-default">
              <div class="panel-heading collapsed" data-toggle="collapse" data-parent="#product-accordion" href="#assembly">
                <h4 class="panel-title">
                    <a>Assembly &amp; Shipping:</a>
                </h4>
              </div>
              <div id="assembly" class="panel-collapse collapse">
                <div class="panel-body">
                  <?php the_field('assembly_shipping');?>
                </div>
              </div>
            </div>
          <?php endif ?>
          <?php if (get_field('construction_materials_green_impact')) : ?>
            <div class="panel panel-default">
              <div class="panel-heading collapsed" data-toggle="collapse" data-parent="#product-accordion" href="#construction">
                <h4 class="panel-title">
                    <a>Construction Materials &amp; Green Impact:</a>
                </h4>
              </div>
              <div id="construction" class="panel-collapse collapse">
                <div class="panel-body">
                  <?php the_field('construction_materials_green_impact');?>
                </div>
              </div>  
            <?php endif ?>                      
          </div>
        </div>

      </div>

    </div>
  </div>

</article><!-- #product-<?php the_ID(); ?> -->
<?php endwhile; ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>

