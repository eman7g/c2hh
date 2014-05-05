<article <?php post_class(); ?>>
	<div class="post-thumb">
		<?php the_post_thumbnail('thumbnail'); ?>
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
