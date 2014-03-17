<?php while (have_posts()) : the_post(); ?>
	<!--<?php if (has_post_thumbnail()){
		echo "<div class='featured-image'>";
		the_post_thumbnail( 'featured_image' );
		echo "</div>";
	}?>-->
	<div class="entry">
			<?php
			 
			// check if the repeater field has rows of data
			if( have_rows('content_blocks') ):
			 
			 	// loop through the rows of data
			    while ( have_rows('content_blocks') ) : the_row();?>
			 
			       <div class="entry-block clearfix">

			       		<?php if( get_sub_field('image') ) : ?>

			       			<div class="entry-image">

			       				<?php $image_id =  get_sub_field('image');?>
 
								<?php echo wp_get_attachment_image( $image_id, 'full' ); ?>

							</div>
							 
						<?php endif ?>

						<?php if( get_sub_field('title') ) : ?>

			       			<div class="entry-title">

			       				<h2><?php the_sub_field('title');?></h2>

							</div>
							 
						<?php endif ?>	

						<div class="entry-column-left one_half">
							<?php the_sub_field('entry_left');?>
						</div>							
						<div class="entry-column-right one_half">
							<?php the_sub_field('entry_right');?>
						</div>	


			    	</div>

			    	<hr>				

			 
			    <?php endwhile;
			 
			else :
			 
			    // no rows found
			 
			endif;
			 
			?>

  	</div>
  	<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>