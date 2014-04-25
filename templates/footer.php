<footer class="content-info" role="contentinfo">
	<div class="container">
		<div class="row">
			
			<div class="col-sm-2 col-footer">
				<h3>About Us</h3>
				<ul>
					<?php $story_id = get_ID_by_slug('our-story');?>
					<?php $team_id = get_ID_by_slug('the-team');?>
					<li><a href="<?php echo get_page_link($story_id); ?>">Our Story</a></li>
					<li><a href="<?php echo get_page_link($team_id); ?>">The Team</a></li>
				</ul>
				<h3>Follow Us</h3>
				<ul class="social">
					<li class="twitter"><a href="#">Twitter</a></li>
					<li class="facebook"><a href="#">Facebook</a></li>
				</ul>
			</div>

			<div class="col-sm-4 col-sm-offset-2 col-footer">
				<h3>Shelters</h3>
				<ul>
					<?php 

						$args = array( 'post_type' => 'product', 'posts_per_page' => -1 );

					    $loop = new WP_Query( $args );


					    while ( $loop->have_posts() ) : $loop->the_post(); 
					    	global $product; ?>

					 		<li>
					 			<a href="<?php the_permalink();?>"><?php the_title();?></a>
					 		</li>
					    <?php
					    endwhile; 


					    wp_reset_query(); 

					?>
				</ul>	
			</div>

			<div class="col-sm-4 col-footer">
				<h3>Services</h3>
				<ul>
					<?php $services_id = get_ID_by_slug('services');?>
					<?php $children = wp_list_pages('title_li=&child_of='.$services_id.'&echo=0'); ?>
					<?php echo $children;?>		
				</ul>					
								
			</div>

			<div class="col-sm-4 col-footer">
				<h3>Contact</h3>
				<ul>
					<li>Close to Home</li>
					<li>220 2nd Ave S. Suite 220</li>
					<li>Seattle, WA  98104</li>
				</ul>
				<ul>
					<li>info@c2hh.com</li>
					<li>p. 206-123-4567</li>
				</ul>
			</div>

		</div>
		<div class="row">
			<hr>
		</div>
		<p class="copy">&copy; Close to Home Housing, 2013</p>
	</div>
</footer>

<?php wp_footer(); ?>