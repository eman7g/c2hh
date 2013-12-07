<?php while (have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail()){
		echo "<div class='featured-image'>";
		the_post_thumbnail( 'featured_image' );
		echo "</div>";
	}?>
  	<?php the_content(); ?>
  	<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>