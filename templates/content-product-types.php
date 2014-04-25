<?php while (have_posts()) : the_post(); ?>
	
    <?php if(get_field('slides')) : ?>

    <div class="row">

    	<div class="featured-slider-wrapper">

    		<ul class="bxslider featured-slider">

				<?php while(has_sub_field('slides')): ?>

					<?php $images = get_sub_field('images'); $i = 0; ?>

	  				<?php if( $images ): ?>

	  					<li>
	  					
							<div class="slide-left">
								<img src="<?php echo $images[0]['url']; ?>" alt="<?php echo $images[0]['alt']; ?>" />             		
          					</div>

							<div class="slide-right">
								<img src="<?php echo $images[1]['url']; ?>" alt="<?php echo $images[1]['alt']; ?>" />             		
          					</div>
	          			</li>

	          		<?php endif; ?>

              	<?php endwhile; ?>

          	</ul>

    	</div>

    </div>

	<?php endif ?>

	<div class="page-header">
		<h1>
			<?php echo roots_title(); ?>
		</h1>
		<hr class="title-divider">

	</div>

	<div class="entry">

		<div class="row">

			<div class="col-xs-12 visible-xs">
	  		<!-- Nav tabs -->
			<?php if(get_field('tabs')): ?>

				<?php $i = 1;?>
			 
				<ul class="nav accordion-nav accordion-tabs nav-tabs">
			 
				<?php while(has_sub_field('tabs')): ?>
			 
					<li <?php if ($i == 1){echo "class='active'";} ?>>
						<a href="#tab<?php echo $i;?>" data-toggle="tab">
							<?php the_sub_field('title');?>
						</a>
					</li>

					<?php $i++;?>
			 
				<?php endwhile; ?>
			 
				</ul>
			 
			<?php endif; ?>					
			</div>


			<div class="col-sm-10">
				<!-- Tab panes -->
				<?php if (get_field('tabs')) : ?>

					<?php $j = 1;?>

					<div class="tab-content accordion-content">

					<?php while(has_sub_field('tabs')): ?>

						<div class="tab-pane accordion-pane fade in <?php if ($j == 1){echo "active";} ?>" id="tab<?php echo $j;?>">
							<h3 class="name"><?php the_sub_field('title');?></h3>							
							<?php the_sub_field('content');?>

							<a href="#" class="btn view-more">View all <?php the_sub_field('title');?></a>
						</div>

					<?php $j++; endwhile ?>

					</div>
				<?php endif; ?>
			</div>

			<div class="col-md-4 col-md-offset-2 col-sm-5 col-sm-offset-1 hidden-xs">
	  		<!-- Nav tabs -->
			<?php if(get_field('tabs')): ?>

				<?php $i = 1;?>
			 
				<ul class="nav accordion-nav accordion-tabs nav-tabs">
			 
				<?php while(has_sub_field('tabs')): ?>
			 
					<li <?php if ($i == 1){echo "class='active'";} ?>>
						<a href="#tab<?php echo $i;?>" data-toggle="tab">
							<?php the_sub_field('title');?>
						</a>
					</li>

					<?php $i++;?>
			 
				<?php endwhile; ?>
			 
				</ul>
			 
			<?php endif; ?>					
			</div>

		</div>	

  	</div>
  	<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>