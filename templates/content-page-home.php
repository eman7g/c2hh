<?php while (have_posts()) : the_post(); ?>
	<div class="row">
		<div class="featured-text col-md-offset-3 col-md-10"><?php the_content(); ?></div>
	</div>
	<hr>
	<?php $pageid =  get_the_ID(); $i = 1; ?>
    <?php if(get_field('features')): ?>
    	<div class="row">
		<?php while(has_sub_field('features')): ?>
			<div class="col-md-8">
				<article class="home-feature">
					<header>
						<h2><?php the_sub_field('title');?></h2>
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