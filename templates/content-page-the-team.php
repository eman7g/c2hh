<?php while (have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail()){
		echo "<div class='featured-image'>";
		the_post_thumbnail( 'featured_image' );
		echo "</div>";
	}?>
  	<?php the_content(); ?>

  	<div class="team-members">
  		<!-- Nav tabs -->
		<?php if(get_field('team_members')): ?>

			<?php $i = 1;?>
		 
			<ul class="nav team-nav team-tabs nav-tabs">
		 
			<?php while(has_sub_field('team_members')): ?>
		 
				<li <?php if ($i == 1){echo "class='active'";} ?>>
					<a href="#member<?php echo $i;?>" data-toggle="tab">
						<?php echo wp_get_attachment_image( get_sub_field('image'), 'team_thumb' ); ?>
					</a>
				</li>

				<?php $i++;?>
		 
			<?php endwhile; ?>
		 
			</ul>
		 
		<?php endif; ?>		

		<!-- Tab panes -->
		<?php if (get_field('team_members')) : ?>

			<?php $j = 1;?>

			<div class="tab-content team-content">

			<?php while(has_sub_field('team_members')): ?>

				<div class="tab-pane team-pane fade in <?php if ($j == 1){echo "active";} ?>" id="member<?php echo $j;?>">
					<h3 class="name"><?php the_sub_field('name');?></h3>
					<h4 class="position"><?php the_sub_field('position');?></h4>
					
					<div class="row">
						<div class="col-md-10 col-sm-11">
							<?php the_sub_field('description');?>
						</div>
						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-1">
							<h5>Connect</h5>
							<ul class="connect">
								<?php if (get_sub_field('twitter')) : ?>
									<li class="twitter"><a href="http://<?php the_sub_field('twitter');?>">Twitter</a></li>
								<?php endif ?>
								<?php if (get_sub_field('email')) : ?>
									<li class="email"><a href="mailto:<?php the_sub_field('email');?>">Email</a></li>
								<?php endif ?>
							</ul>
						</div>
					</div>
				</div>

			<?php $j++; endwhile ?>

			</div>
		<?php endif; ?>
	</div>

	<div class="advisory-board">
		<div class="page-header">
			<h1 class="section-title">Advisory Board</h1>
			<hr class="title-divider">
		</div>

		<div class="row">

			<div class="col-sm-12 visible-sm visible-xs">
	  		<!-- Nav tabs -->
			<?php if(get_field('advisory_board')): ?>

				<?php $i = 1;?>
			 
				<ul class="nav advisory-nav advisory-tabs nav-tabs">
			 
				<?php while(has_sub_field('advisory_board')): ?>
			 
					<li <?php if ($i == 1){echo "class='active'";} ?>>
						<a href="#advisor<?php echo $i;?>" data-toggle="tab">
							<?php the_sub_field('name');?>
						</a>
					</li>

					<?php $i++;?>
			 
				<?php endwhile; ?>
			 
				</ul>
			 
			<?php endif; ?>					
			</div>

			<div class="col-md-10">
				<!-- Tab panes -->
				<?php if (get_field('advisory_board')) : ?>

					<?php $j = 1;?>

					<div class="tab-content team-content">

					<?php while(has_sub_field('advisory_board')): ?>

						<div class="tab-pane team-pane fade in <?php if ($j == 1){echo "active";} ?>" id="advisor<?php echo $j;?>">
							<h3 class="name"><?php the_sub_field('name');?></h3>
							<h4 class="position"><?php the_sub_field('position');?></h4>
							
							<?php the_sub_field('description');?>
						</div>

					<?php $j++; endwhile ?>

					</div>
				<?php endif; ?>
			</div>

			<div class="col-md-4 col-md-offset-2 visible-lg visible-md">
	  		<!-- Nav tabs -->
			<?php if(get_field('advisory_board')): ?>

				<?php $i = 1;?>
			 
				<ul class="nav advisory-nav advisory-tabs nav-tabs">
			 
				<?php while(has_sub_field('advisory_board')): ?>
			 
					<li <?php if ($i == 1){echo "class='active'";} ?>>
						<a href="#advisor<?php echo $i;?>" data-toggle="tab">
							<?php the_sub_field('name');?>
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