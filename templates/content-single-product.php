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
    <div class="col-md-8 col-sm-16">

      <?php $images = get_field('product_images'); $i = 0; ?>
      <?php 
      $feature_image = get_the_post_thumbnail($post->ID,'product_feature'); 
      $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full', true);
      ?>

      <?php if( $images ): ?>
        <div class="product-slider-wrap clearfix">
          <ul class="bxslider product-slider">
              <li><a href="<?php echo $thumb_url[0];?>" class="fancybox" data-fancybox-group="product-gallery"><span class="magnify"></span><?php the_post_thumbnail('product_feature'); ?></a></li>
            <?php foreach( $images as $image ): ?>
              <li><a href="<?php echo $image['url']; ?>" class="fancybox" data-fancybox-group="product-gallery"><span class="magnify"></span><img src="<?php echo $image['sizes']['product_feature']; ?>" alt="<?php echo $image['alt']; ?>" /></a></li>
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
      <?php elseif (has_post_thumbnail()) : ?>
        <div class="product-slider-wrap clearfix">
          <ul class="bxslider product-slider">
            <li><?php the_post_thumbnail('product_feature'); ?></li>
          </ul>
        </div>
      <?php endif ?>

      <?php $terms = get_the_terms( $post->ID, 'attribute' );?>

      <?php if (!empty($terms)) : ?>
        <div class="product-attributes visible-lg visible-md">
          <h4>Product Attributes</h4>
          <ul>
            <?php
              foreach ( $terms as $term ) : ?>
                <li class="<?php echo $term->slug;?>"><span class="icon"><img src="<?php the_field('icon', 'attribute_'.$term->term_id); ?>" /></span><?php echo $term->name;?></li>
              <?php endforeach;
            ?>
          </ul>
        </div>
      <?php endif ?>

    </div>  

    <div class="col-md-8 visible-lg visible-md">
      <div class="product-main">
        <header>
          <h1 class="entry-title"><?php the_title(); ?></h1>            
          <?php 
            woocommerce_get_template( 'single-product/price.php' );
          ?>
        </header>    



        <?php
          $terms = get_the_terms( $post->ID, 'product-type' );
          //print_r($terms);
        ?>

        <h4 class="product-type">
          <?php
            $prefix = '';
            foreach ( $terms as $term ) {
              //echo $term->name;
              $typeList[] = $term->name;
            }
            $commaList = implode(', ', $typeList);
            echo $commaList;
          ?>
        </h4>

        <div class="product-description">
          <?php the_content('description');?>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <?php 
              //woocommerce_get_template( 'loop/add-to-cart.php' );
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
            
          <div class="col-sm-10">
            <ul class="social-links">
              <li><a class="links contact" href="mailto:<?php the_field('representative_email');?>">Contact A Representative</a></li>
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

      <div class="product-details visible-lg visible-md">
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
            </div>
          <?php endif ?>                      
        </div>

      </div>

    </div>
  </div>

  <div class="row hidden-lg hidden-md">
    <div class="col-sm-16">
      
      <div class="product-main">

        <div class="row">
          <div class="col-sm-8">
            <header>
              <h1 class="entry-title"><?php the_title(); ?></h1>
              <h2 class="price">
                <?php 
                  woocommerce_get_template( 'loop/price.php' );
                ?>
              </h2>
            </header> 
          </div>
          <div class="col-sm-8">

            <div class="product-add">
                <?php 
                  //woocommerce_get_template( 'loop/add-to-cart.php' );
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
                
            <ul class="social-links">
              <li><a class="links contact" href="mailto:<?php the_field('representative_email');?>">Contact A Representative</a></li>
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
        <?php
          $terms = get_the_terms( $post->ID, 'product-type' );
          //print_r($terms);
        ?>

        <h4 class="product-type">
          <?php
            $prefix = '';
            $commaList = '';
            foreach ( $terms as $term ) {
              //echo $term->name;
              $typeList[] = $term->name;
            }
            $commaList = implode(', ', $typeList);
            echo $commaList;
          ?>
        </h4>

        <div class="product-description">
          <?php the_content('description');?>
        </div>

        <?php $attribute_terms = get_the_terms( $post->ID, 'attribute' );?>
        <?php if (!empty($attribute_terms)) : ?>
          <div class="product-attributes ">

              <h4>Product Attributes</h4>
              <ul>
                <?php
                  // vars
                  $queried_object = get_queried_object(); 
                  $taxonomy = $queried_object->taxonomy;
                  $term_id = $queried_object->term_id;  
                ?>
                <?php
                  foreach ( $attribute_terms as $term ) : ?>
                    <li class="<?php echo $term->slug;?>"><span class="icon"><img src="<?php the_field('icon', 'attribute_'.$term->term_id); ?>" /></span><?php echo $term->name;?></li>
                  <?php endforeach;
                ?>
              </ul>
          </div>
        <?php endif ?>

      </div>

      <div class="product-details hidden-lg hidden-md">
        <h2>Product Details</h2>

        <div class="panel-group" id="product-accordion-mobilie">
          <?php if (get_field('specifications')) : ?>
            <div class="panel panel-default">
              <div class="panel-heading" data-toggle="collapse" data-parent="#product-accordion-mobilie" href="#specifications-mobile">
                <h4 class="panel-title">
                    <a>Specifications:</a>
                </h4>
              </div>
              <div id="specifications-mobile" class="panel-collapse collapse in">
                <div class="panel-body">
                  <?php the_field('specifications');?>
                </div>
              </div>
            </div>
          <?php endif ?>
          <?php if (get_field('facilities_features')) : ?>
            <div class="panel panel-default">
              <div class="panel-heading collapsed" data-toggle="collapse" data-parent="#product-accordion-mobilie" href="#facilities-mobile">
                <h4 class="panel-title">
                    <a>Facilities &amp; Features:</a>
                </h4>
              </div>
              <div id="facilities-mobile" class="panel-collapse collapse">
                <div class="panel-body">
                  <?php the_field('facilities_features');?>
                </div>
              </div>
            </div>
          <?php endif ?>
          <?php if (get_field('plumbing_electrical_mechanical')) : ?>
            <div class="panel panel-default">
              <div class="panel-heading collapsed" data-toggle="collapse" data-parent="#product-accordion-mobilie" href="#plumbing-mobile">
                <h4 class="panel-title">
                    <a>Plumbing, Electrical &amp; Mechanical:</a>
                </h4>
              </div>
              <div id="plumbing-mobile" class="panel-collapse collapse">
                <div class="panel-body">
                  <?php the_field('plumbing_electrical_mechanical');?>
                </div>
              </div>
            </div>
          <?php endif ?>
          <?php if (get_field('assembly_shipping')) : ?>
            <div class="panel panel-default">
              <div class="panel-heading collapsed" data-toggle="collapse" data-parent="#product-accordion-mobilie" href="#assembly-mobile">
                <h4 class="panel-title">
                    <a>Assembly &amp; Shipping:</a>
                </h4>
              </div>
              <div id="assembly-mobile" class="panel-collapse collapse">
                <div class="panel-body">
                  <?php the_field('assembly_shipping');?>
                </div>
              </div>
            </div>
          <?php endif ?>
          <?php if (get_field('construction_materials_green_impact')) : ?>
            <div class="panel panel-default">
              <div class="panel-heading collapsed" data-toggle="collapse" data-parent="#product-accordion-mobilie" href="#construction-mobile">
                <h4 class="panel-title">
                    <a>Construction Materials &amp; Green Impact:</a>
                </h4>
              </div>
              <div id="construction-mobile" class="panel-collapse collapse">
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

