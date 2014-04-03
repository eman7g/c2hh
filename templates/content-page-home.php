<?php while (have_posts()) : the_post(); ?>

	<div class="row">
		<div class="home-grid home-grid-mobile visible-xs">
			<img src="<?php bloginfo('template_directory');?>/assets/img/c2HH_SS_hero.jpg" />
		</div>
	    <div class="home-grid hidden-xs">
	      <hr>
	      <div class="home-grid-inner clearfix">
	 
	        <div class="block-column-large block-column">
	          <div class="block large image">
	            <?php 
	              $attachment_ids = get_field('grid_small_images');
	              $attachment_id = get_field('grid_large_image');
	              echo wp_get_attachment_image( $attachment_id, 'grid_large' );
	            ?>
	          </div>
	        </div>

	        <div class="block-column">
	          <a class="block small image" href="#">
	            <?php 
	              echo wp_get_attachment_image( $attachment_ids[1]['image'], 'grid_small' );
	            ?>   
	          </a>
	          <a class="block small green" href="#">
	            <h4>Our Story</h4>
	          </a>
	        </div>

	        <div class="block-column">
	          <a class="block small blue" href="#">
	              <h4>Compare Shelters</h4>
	          </a>
	          <a class="block small image" href="#">
	            <?php 
	              echo wp_get_attachment_image( $attachment_ids[2]['image'], 'grid_small' );
	            ?>   
	          </a>
	        </div>


	      </div>
	    </div>
	</div>

	<div class="row">
		<div class="featured-text col-md-offset-3 col-md-10 col-xs-16"><?php the_content(); ?></div>
	</div>
	<div class="row">
		<hr>
	</div>
	<?php $pageid =  get_the_ID(); $i = 1; ?>
    <?php if(get_field('features')): ?>
    	<div class="row">
		<?php while(has_sub_field('features')): ?>
			<div class="col-md-8">
				<article class="home-feature">
					<header>
						<h3><?php the_sub_field('title');?></h3>
					</header>
					<div class="entry-content">
						<?php the_sub_field('content');?>
						<a class="learn-more more" href="<?php the_sub_field('page_link');?>">Learn More</a>
					</div>
				</article>
			</div>
		<?php $i++; endwhile;  ?>
		</div>
  	<?php endif; ?>     
<?php endwhile; ?>