<?php
 /*
****************************************************************
* Theme Customization
****************************************************************/

/**
 * Custom theme features
 */
function theme_setup() {

	// Update default image sizes
	update_option( 'thumbnail_size_w', 100 );
	update_option( 'thumbnail_size_h', 100 );
	update_option( 'thumbnail_crop', 0 );
	
	update_option( 'medium_size_w', 370 );
	update_option( 'medium_size_h', 9999 );
	update_option( 'medium_crop', 0 );
	
	update_option( 'large_size_w', 940 );
	update_option( 'large_size_h', 999 );
	update_option( 'large_crop', 0 );
	
	// Custom image sizes
	add_image_size( 'grid_small', 240, 161, TRUE );
	add_image_size( 'grid_large', 480, 324, TRUE );
	add_image_size( 'team_thumb', 240, 350, TRUE );
	add_image_size( 'product_feature', 460, 0, TRUE );
	add_image_size( 'product_thumb', 225, 150, TRUE );
	add_image_size( 'product_thumb_large', 600, 400, TRUE );
	add_image_size( 'product_gallery_thumb', 75, 75, TRUE );

	// Support post-thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// Add support
	add_post_type_support( 'page', 'excerpt' );
	add_post_type_support( 'page', 'post-thumbnails' );
	
}
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Remove Taxonomy Menus
 */
function remove_estimator_meta() {
	remove_meta_box( 'tagsdiv-estimator', 'project', 'side' );
}
add_action( 'admin_menu' , 'remove_estimator_meta' );

function remove_architect_meta() {
	remove_meta_box( 'tagsdiv-architect', 'project', 'side' );
}
add_action( 'admin_menu' , 'remove_architect_meta' );

function remove_client_meta() {
	remove_meta_box( 'tagsdiv-client', 'project', 'side' );
}
add_action( 'admin_menu' , 'remove_client_meta' );

function remove_service_meta() {
	//remove_meta_box( 'servicediv', 'project', 'side' );
}
add_action( 'admin_menu' , 'remove_service_meta' );

function remove_industry_meta() {
	//remove_meta_box( 'industrydiv', 'project', 'side' );
}
add_action( 'admin_menu' , 'remove_industry_meta' );

/**
 * Custom Base Templates
 */
add_filter('roots_wrap_base', 'roots_wrap_base_cpts'); // Add our function to the roots_wrap_base filter

function roots_wrap_base_cpts($templates) {
	$cpt = get_post_type(); // Get the current post type
	if ($cpt) {
	   array_unshift($templates, 'base-' . $cpt . '.php'); // Shift the template to the front of the array
	}
	return $templates; // Return our modified array with base-$cpt.php at the front of the queue
}


/*
****************************************************************
* Wordpress Helper Functions
****************************************************************/

/**
 * Get the root directory of a URL
 * @return string
 */
function get_url_root_dir() {
	$paths = explode('/',substr($_SERVER['REQUEST_URI'],1));
	$rootDir = array_shift($paths); // split into two lines to prevent warning
	return $rootDir;
}


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .post-type-project .meta-box-sortables #acf_19 {
      width:48%;
      float:left;
    } 
    .post-type-project .meta-box-sortables #acf_29 {
      width:48%;
      float:right;
    }   
    .post-type-project .meta-box-sortables #acf_93 .label{
    	display:none;
    }
    </style>';
}

/**
 * 
 * @param Array $list
 * @param int $p
 * @return multitype:multitype:
 * @link http://www.php.net/manual/en/function.array-chunk.php#75022
 */
function partition(Array $list, $p) {
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for($px = 0; $px < $p; $px ++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


/*
****************************************************************
* URL Rewrites
****************************************************************/

/* Custom re-write rules for projects*/
function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

add_action( 'wp_ajax_product_filter', 'myajax_product_filter' );
add_action( 'wp_ajax_nopriv_product_filter', 'myajax_product_filter' );


/*
****************************************************************
* Ajax functions
****************************************************************/

function myajax_product_filter() {
	// check nonce
	$nonce = $_REQUEST['nextNonce']; 
	$filter_query = $_REQUEST['filterQuery']; 

	if ( ! wp_verify_nonce( $nonce, 'myajax-next-nonce' ) )
		die ( 'Busted!');
 
	// response output
	parse_str($filter_query, $filter_array);

	//print_r($filter_array);

	// Init a variable to store the values of the original WP Query
	$temp_query = $wp_query;

	// query args
	$args = array (
		'post_type'             => 'product',
		'post_status'           => 'publish',
		'posts_per_page'        => '-1',
		'order'                 => 'ASC',
		'orderby'               => 'name',
		/*'meta_query'            => array(
			'relation' => 'AND',
			array(
				'key'       	=> 'sleeps',
				'value'			=> $filter_array['sleeps'],
				'compare' 		=> '='
			),
			array(
				'key'       	=> 'assembly',
				'value'			=> $filter_array['assembly'],
				'compare' 		=> '='
			)
		)*/
	);	

	if ($filter_array['producttype'] !== 'all') {
    	$args['product-type'] = $filter_array['producttype'];
	}
	if ($filter_array['construction'] !== 'all') {
    	$args['construction-type'] = $filter_array['construction'];
	}
	if ($filter_array['sleeps'] !== 'all' && $filter_array['assembly'] !== 'all'){
    	$args['meta_query']['relation'] = 'AND';
    }
	if ($filter_array['sleeps'] !== 'all'){
    	$args['meta_query'][] = array(
				'key'       	=> 'sleeps',
				'value'			=> $filter_array['sleeps'],
				'compare' 		=> '='
			);
    }
	if ($filter_array['assembly'] !== 'all'){
    	$args['meta_query'][] = array(
				'key'       	=> 'assembly',
				'value'			=> $filter_array['assembly'],
				'compare' 		=> '='
			);
    }
    if ($filter_array['prices'] !== 'all'){
    	if ($filter_array['prices'] == '10k-below'){
	    	$args['meta_query'][] = array(
				'key'       	=> '_price',
				'value'			=> '10000',
				'compare' 		=> '<'
			);    
		}elseif($filter_array['prices'] == '50k-below'){
	    	$args['meta_query'][] = array(
				'key'       	=> '_price',
				'value'			=> '50000',
				'compare' 		=> '<'
			);    			
		}elseif($filter_array['prices'] == '50k-above'){
	    	$args['meta_query'][] = array(
				'key'       	=> '_price',
				'value'			=> '50000',
				'compare' 		=> '>='
			);    			
		}   
	} 

	// The Query
	$wp_query = new WP_Query( $args );
	$total_products = $wp_query->found_posts;
    
	// The Loop
	if ( $wp_query->have_posts() ) {
	        $i = 0;
		while ( $wp_query->have_posts() ) {
			$wp_query->the_post();?>
			
			<?php if ($i == 0 || $i % 4 == 0) {echo "<div class='product-row'>";} ?>

			<div class="product">
				<a class="product-link" href="<?php the_permalink();?>">
					<article>
						<div class="product-thumb"><?php the_post_thumbnail('product_thumb'); ?></div>
						<div class="product-title"><h3><?php the_title();?></h3></div>  
						<ul class="attributes">
							<li class="size">
								<span class="title">Size:</span>
								<span><?php the_field('size');?></span>
							</li>
							<li class="sleeps">
								<span class="title">Sleeps:</span>
								<span><?php the_field('sleeps');?></span>
							</li>
							<li class="assembly">
								<span class="title">Assembly:</span>
								<span><?php the_field('assembly');?></span>
							</li>		
							<li class="assembly">
								<span class="title">Price:</span>
								<?php $meta = get_post_meta( get_the_ID(), '_price' ); ?>
									<span><?php print_r($meta);?></span>
									</li>														
						</ul>
					</article>
				</a>
			</div>

			<?php
			$i++;
			if ($i % 4 == 0){echo "</div>";}
			if ($i == $total_products){echo "</div>";
			}
		}
	} else {
		echo "<h2>No Products Found</h2>";

		// Restore the $wp_query back to its original state
		$wp_query = $temp_query;		
	}

 
	// IMPORTANT: don't forget to "exit"
	exit;
	
}

/*
****************************************************************
* Product CPT Menus
****************************************************************/

add_action('admin_head', 'my_custom_styles');

function my_custom_styles() {
  echo '<style>
    .acf-gallery .thumbnail img{
	  max-width:98px;
	  height:auto;
	}
	.acf-gallery .thumbnails {
		min-height:150px;
	}
  </style>';
}

function remove_taxonomies_metaboxes() {
    remove_meta_box( 'tagsdiv-construction-type', 'product', 'side' );
    remove_meta_box( 'tagsdiv-product-type', 'product', 'side' );
    remove_meta_box( 'product_catdiv', 'product', 'side' );
    remove_meta_box( 'tagsdiv-product_tag', 'product', 'side' );
    remove_meta_box('woocommerce-product-images','product', 'side');
    remove_meta_box( 'commentsdiv', 'product', 'normal' );
    remove_meta_box('postexcerpt','product','normal');
}
add_action( 'add_meta_boxes_product' , 'remove_taxonomies_metaboxes', 11 );


/** woocommerce: change position of add-to-cart on single product **/
remove_action( 'woocommerce_single_product_summary', 
           'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 
           'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 
           'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 
           'woocommerce_template_single_meta', 40 ); 

function c2hh_remove_menus() {

	remove_submenu_page( 'themes.php', 'theme-editor.php' );

}
add_action( 'admin_menu', 'c2hh_remove_menus', 999 );


/*
****************************************************************
* Query Vars
****************************************************************/

function add_query_vars_filter( $vars ){
  $vars[] = "product_type";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function c2hh_enqueue_script() {
	

	if ( is_cart() ){
		if ( get_option( 'woocommerce_enable_chosen' ) == 'yes' ) {
			wp_enqueue_script( 'wc-chosen', get_bloginfo( 'url' ). '/wp-content/plugins/woocommerce/assets/js/chosen/chosen.jquery.min.js', false );
			wp_enqueue_style( 'woocommerce_chosen_styles', get_bloginfo( 'url' ). '/wp-content/plugins/woocommerce/assets/css/chosen.css', false );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'c2hh_enqueue_script' );



