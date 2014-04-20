<?php while (have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail()){
		echo "<div class='featured-image'>";
		the_post_thumbnail( 'featured_image' );
		echo "</div>";
	}?>
	<div class="entry">
	    <div class="row">
  			<div class="col-sm-8">
  				<?php get_template_part('templates/page', 'header'); ?>

  				<ul class="contact-list">
	  				<?php
						// check if the repeater field has rows of data
						if( have_rows('contacts') ):
						 
						 	// loop through the rows of data
						    while ( have_rows('contacts') ) : the_row();?>
						 
						        <li>
						        	<h3><?php the_sub_field('location'); ?></h3>
						        	<div class="info">
						        		<?php the_sub_field('name'); ?>,
						        		<?php the_sub_field('position'); ?><br />
						        		<?php the_sub_field('number'); ?>
						        	</div>
						        	<div class="connect">
						        		<?php if (get_sub_field('twitter')) : ?>
						        			<a class="twitter" href="<?php the_sub_field('twitter');?>"><?php the_sub_field('twitter');?></a>
						        		<?php endif ?>
						        		<?php if (get_sub_field('email')) : ?>
						        			<a class="email" href="mailto:<?php the_sub_field('email');?>"><?php the_sub_field('email');?></a>
						        		<?php endif ?>
						        	</div>

						    	</li>
						 
						    <?php endwhile;
						 
						endif;
					?>
				</ul>

  			</div>      			
  			<div class="col-sm-8">
  				 <?php the_content(); ?>
  			</div>
  		</div>

  	</div>
  	<?php //wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>