<?php 

// Init a variable to store the values of the original WP Query
$temp_query = $wp_query;

global $post;
$post_slug=$post->post_name;

if (isset($wp_query->query_vars['product_type'])) $product_type = esc_attr($wp_query->query_vars['product_type']);

?>
<? $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
<? // WP_Query arguments
	
	if (isset($wp_query->query_vars['product_type'])){

		$args = array (
			'post_type'             => 'product',
			'post_status'           => 'publish',
			'pagination'            => false,
			'posts_per_page'        => -1,
			'order'                 => 'ASC',
			'orderby'               => 'name',
			'product-type' 			=> $product_type
			//'paged'             	=> $paged,	
		);	

	}else{

		$args = array (
			'post_type'             => 'product',
			'post_status'           => 'publish',
			'pagination'            => false,
			'posts_per_page'        => -1,
			'order'                 => 'ASC',
			'orderby'               => 'name'
			//'paged'             	=> $paged,	
		);			
	}

	// The Query
	$wp_query = new WP_Query( $args );
	$total_products = $wp_query->found_posts;
	$total_pages = $wp_query->max_num_pages;
	//echo $total_products;
	//echo $total_pages;

?>
<div class="row">
	<div class="page-header">
		<h1 class="page-title">Shop Products</h1>
		<a class="product-types-links" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Product Types' ) ) ); ?>">Product Types Defined</a>
	</div>

	<div class="product-filters">
		<form role="form" class="form-inline" type="post" action="" id="productFilterForm">
			<fieldset>
				<legend>Product Type</legend>
				<div class="form-group">
					<label class="radio-inline">
					  <input type="radio" class="radio" id="allproducts" name="producttype" value="all" checked="checked"> All Product Types
					</label>
					<?php
						$terms = get_terms("product-type", "hide_empty=0");
						$count = count($terms);
						if ( $count > 0 ){
						 foreach ( $terms as $term ) : ?>
							<label class="radio-inline">
						   		<input type="radio" class="radio" name="producttype" id="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>" <?php if ($term->slug == $product_type){echo 'checked="checked"';}?>><?php echo $term->name;?>
							</label>
						 <?php endforeach;
						}
					?>					
				</div>
			</fieldset>
			<fieldset>
				<legend>Filter</legend>

				<div class="form-group">
					<select name="sleeps" class="form-control">
					  <option value="n/a">N/A</option>
					  <option value="all" selected>Sleeps All</option>
					  <option value="1-2">Sleeps 1-2</option>
					  <option value="1-4">Sleeps up to 4</option>
					  <option value="1-6">Sleeps up to 6</option>
					  <option value="6+">Sleeps 6+</option>
					</select>

					<select name="assembly" class="form-control">
					  <option value="all">All Assembly</option>
					  <option value="easy">Easy Assembly</option>
					  <option value="moderate">Moderate Assembly</option>
					  <option value="expert">Expert Assembly</option>
					</select>

					
					<select name="construction" class="form-control">
						<option value="all">All Construction</option>
						<?php
							$terms = get_terms("construction-type", "hide_empty=0");
							$count = count($terms);
							if ( $count > 0 ){
							 foreach ( $terms as $term ) : ?>
							   <option value="<?php echo $term->slug; ?>"><?php echo $term->name;?></option>
							  
							 <?php endforeach;
							}
						?>
					</select>

					<select name="prices" class="form-control">
					  <option value="all">All Prices</option>
					  <option value="10k-below">Less than 10k</option>
					  <option value="50k-below">Less than 50k</option>
					  <option value="50k-above">50k and up</option>
					</select>
				</div>
				<?php $nonce = wp_create_nonce("my_user_vote_nonce");?>
				<input type="submit" class="btn" value="Sort Product">
		  	</fieldset>
		</form>
	</div>


    <div class="product-grid">
	
	<?php
		// The Loop
		if (have_posts()) {
		?> 
			<?php
			$i = 0;

			while (have_posts()) : the_post(); ?>

				<?php if ($i == 0 || $i % 4 == 0) {echo "<div class='product-row'>";} ?>

				<div class="product">
					<a class="product-link" href="<?php the_permalink();?>">
						<article>
							<div class="product-thumb visible-md visible-lg"><?php the_post_thumbnail('product_thumb'); ?></div>
							<div class="product-thumb hidden-md hidden-lg"><?php the_post_thumbnail('product_thumb_large'); ?></div>
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
								<li class="price">
									<span class="price">Price:</span>
									<?php $meta = get_post_meta( get_the_ID(), '_price' ); ?>
									<?php print_r($meta);?>

								</li>															
							</ul>
						</article>
					</a>
				</div>

				<?php
				$i++;
				if ($i % 4 == 0){echo "</div>";}
				if ($i == $total_products){echo "</div>";}

			endwhile;
		}else{
			echo "<h2>No Products Found</h2>";
		}
	?>	
      
    </div>

</div>


