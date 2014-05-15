<article <?php post_class(); ?>>
	<div class="post-thumb">
		<?php 
			if ( '' != get_the_post_thumbnail() ) {
				the_post_thumbnail('thumbnail');
			}else{ ?>

				<img width="100" height="100" src="<?php bloginfo('stylesheet_directory');?>/assets/img/search_image_placeholder.png" class="attachment-thumbnail wp-post-image" alt="image placeholder">

			<?php
			}
		?>
	</div>

	<div class="article-content">
		<header>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
