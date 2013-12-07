<?php while (have_posts()) : the_post(); ?>
	<?php remove_filter ('the_content', 'wpautop'); ?>
	<? $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
	<?php 
		if ( '' !== get_query_var('industry')){
			$industry_type =  $wp_query->query_vars['industry']; 
		}else{
			$industry_type = "featured";
		}
	?>
	<? // WP_Query arguments
		
		$args = array (
			'post_type'              => 'project',
			'post_status'            => 'published',
			'pagination'             => true,
			'posts_per_page'         => '10',
			'order'                  => 'ASC',
			'orderby'                => 'date',
			'paged'             	 => $paged,
			/*'meta_query'             => array(
				array(
					'key'       => 'industry',
				),
			),*/
		);

		// The Query
		$project_query = new WP_Query( $args );
	?>

	<h2 class="intro"><?php the_content(); ?></h2>
	<div class="secondary-content">	
		<div class="project-list">	
			<?php
				// The Loop
				if ( $project_query->have_posts() ) {
					$i = 0;
					while ( $project_query->have_posts() ) {
						$project_query->the_post();
						
						if ($i == 0 || $i % 2 == 0) {echo "<div class='row'>";}
						?>

							<div class="col-md-6 project-item">
								<div class="image">
									<a href="<?php the_permalink();?>">
										<?php if (get_field('featured')) : ?>
											<div class="featured-icon"><span>Featured</span></div>
										<?php endif ?>
										<?php the_post_thumbnail('project_thumb'); ?>
									</a>
								</div>
								<div class="info">
									<span class="location"><?php the_field('location_city');?>, <?php the_field('location_state');?></span>
									<a class="title" href="<?php the_permalink();?>"><h2 ><?php the_title();?></h2></a>
								</div>
							</div>

						<?php
						$i++;
						if ($i % 2 == 0){echo "</div>";}
					}
				} else {
					// no posts found
				}

				// Restore original Post Data
				wp_reset_postdata();
			?>
		</div>
	  	
	  </div>
<?php endwhile; ?>