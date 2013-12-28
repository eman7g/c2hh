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
	
	update_option( 'large_size_w', 960 );
	update_option( 'large_size_h', 999 );
	update_option( 'large_crop', 0 );
	
	// Custom image sizes
	add_image_size( 'grid_small', 240, 161, TRUE );
	add_image_size( 'grid_large', 480, 324, TRUE );
	//add_image_size( 'thumbnail_instructor', 145, 145, TRUE );

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
