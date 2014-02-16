<?php 

// Init a variable to store the values of the original WP Query
$temp_query = $wp_query;

global $post;
$post_slug=$post->post_name;

?>
<? $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
<? // WP_Query arguments
	
	$args = array (
		'post_type'             => 'product',
		'post_status'           => 'publish',
		'pagination'            => false,
		'posts_per_page'        => -1,
		'order'                 => 'ASC',
		'orderby'               => 'name'
		//'paged'             	=> $paged,	
	);	

	// The Query
	$wp_query = new WP_Query( $args );
	$total_products = $wp_query->found_posts;
	$total_pages = $wp_query->max_num_pages;
	//echo $total_products;
	//echo $total_pages;

?>
<div class="row">
	<div class="page-header">
		<h1 class="page-title">Shop Product</h1>
		<a class="product-types-links" href="#">Product Types Defined</a>
	</div>

	<div class="product-filters">
		<form role="form" class="form-inline">
			<fieldset>
				<legend>Product Type</legend>
				<div class="form-group">
					<label class="radio-inline">
					  <input type="radio" id="allproducts" name="producttype" value="all" checked="checked"> All Product Types
					</label>
					<label class="radio-inline">
					  <input type="radio" id="emergency" name="producttype" value="emergency"> Emergency Shelters
					</label>
					<label class="radio-inline">
					  <input type="radio" id="dwelling" name="producttype" value="dwelling"> Dwelling Units
					</label>						
					<label class="radio-inline">
					  <input type="radio" id="commercial" name="producttype" value="commercial"> Commercial Units
					</label>
					<label class="radio-inline">
					  <input type="radio" id="other" name="producttype" value="other"> Other Products
					</label>						
				</div>
			</fieldset>
			<fieldset>
				<legend>Filter</legend>

				<div class="form-group">
					<select name="sleeps" class="form-control">
					  <option>Sleeps All</option>
					  <option>Sleeps 1-2</option>
					  <option>Sleeps up to 4</option>
					  <option>Sleeps up to 6</option>
					  <option>Sleeps 6+</option>
					</select>

					<select name="assembly" class="form-control">
					  <option>All Assembly</option>
					  <option>Easy Assembly</option>
					  <option>Moderate Assembly</option>
					  <option>Expert Assembly</option>
					</select>

					<select name="construction" class="form-control">
					  <option>Shipping Container</option>
					  <option>Modular/Prefab</option>
					  <option>Dome</option>
					  <option>Tent</option>
					  <option>Inflatable</option>
					  <option>On Wheels</option>
					  <option>Fold out</option>
					</select>

					<select name="prices" class="form-control">
					  <option>All Prices</option>
					  <option>Less than 10k</option>
					  <option>Less than 30k</option>
					  <option>30k and up</option>
					</select>
				</div>

				<button type="submit" class="btn">Sort Product</button>
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
							</ul>
						</article>
					</a>
				</div>

				<?php
				$i++;
				if ($i % 4 == 0){echo "</div>";}
				if ($i == $total_products){echo "</div>";}

			endwhile;
		}
	?>	
      
    </div>

</div>