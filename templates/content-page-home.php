<?php while (have_posts()) : the_post(); ?>

	<div class="row">
		<div class="home-grid home-grid-mobile visible-xs">
			
			<?php
				$image = get_field('image');
 
				if( !empty($image) ): ?>
				 
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				 
			<?php endif; ?>

		</div>
	    <!--<div class="home-grid hidden-xs">
	      <hr>
	      <div class="home-grid-inner clearfix">
	 
	        <div class="block-column-large block-column">
	          <div class="block large image">
	            <?php 
	              $product_blocks = get_field('grid_product_blocks');
	              $page_blocks = get_field('grid_page_blocks');
	              $grid_feature  = get_field('grid_large_image');
	              echo wp_get_attachment_image( $grid_feature, 'grid_large' );
	            ?>
	          </div>
	        </div>

	        <div class="block-column">
	          <a class="block small image" href="<?php echo $product_blocks[0]['link'];?>">
	            <?php 
	              echo wp_get_attachment_image( $product_blocks[0]['image'], 'grid_small' );
	            ?>   
	          </a>
	          <a class="block small green" href="<?php echo $page_blocks[0]['page_link'];?>">
	            <h4><?php echo $page_blocks[0]['title'];?></h4>
	          </a>
	        </div>

	        <div class="block-column">
	          <a class="block small blue" href="<?php echo $page_blocks[1]['page_link'];?>">
	              <h4><?php echo $page_blocks[1]['title'];?></h4>
	          </a>
	          <a class="block small image" href="<?php echo $product_blocks[1]['link'];?>">
	            <?php 
	              echo wp_get_attachment_image( $product_blocks[1]['image'], 'grid_small' );
	            ?>   
	          </a>
	        </div>


	      </div>
	    </div>-->
	    <div class="home-grid">
	    	<div class="row row-flex">
	    		<div class="col-sm-8 col-flex">
						<div class="block-column-large block-column">
		          <div class="block large image">
		            <?php 
		              $grid_blocks = get_field('grid_blocks');
		              //print_r($product_blocks);
		              //$page_blocks = get_field('grid_page_blocks');
		              //$grid_feature  = get_field('grid_large_image');
		              if ($grid_blocks[0]['block_type'] == "Feature Block") {
		              	echo wp_get_attachment_image( $grid_blocks[0]['block_image'], 'grid_large' );
		              }
		            ?>
		          </div>
		        </div>
	    		</div>
	    		<div class="col-sm-8 col-flex">
	    			<div class="row row-flex">
							<?php 
								// check if the repeater field has rows of data
								if( $grid_blocks ){
									$i = 0;
								 	// loop through the rows of data
							    foreach($grid_blocks as $block) : $i++; ?>
							      <?php if ($i == 1) continue; ?>
							      <?php if ($i == 6) break; ?>
							      <?php if ($block['block_type'] == "Image Block") : ?>
								      <div class="col-sm-8 col-flex">
							          <a class="block small image" href="<?php $block['block_link'];?>">
							            <?php 
							              echo wp_get_attachment_image( $block['block_image'], 'grid_small' );
							            ?>   
							          </a>
							        </div>
							      <?php else : ?>
							      	<div class="col-sm-8 col-flex">
												<a class="block small <?php if($block['block_color'] == "Green"){echo 'green';}else {echo 'blue';}?>" href="<?php $block['block_link'];?>">
			            				<h4><?php echo $block['block_text'];?></h4>
			          				</a>
			          			</div>
							    	<?php endif; ?>
							    <?php endforeach;
								}
							?>
		        </div>
		      </div>
		    </div>
	      <div class="row row-flex">
  				<?php 
  					$i == 0;
						foreach(array_slice($grid_blocks,5) as $block) : $i++; ?>
				      <?php if ($i < 6) continue; ?>
				      <?php if ($block['block_type'] == "Image Block") : ?>
					      <div class="col-sm-4 col-flex">
				          <a class="block small image" href="<?php $block['block_link'];?>">
				            <?php 
				              echo wp_get_attachment_image( $block['block_image'], 'grid_small' );
				            ?>   
				          </a>
				        </div>
				      <?php else : ?>
				      	<div class="col-sm-4 col-flex">
									<a class="block small <?php if($block['block_color'] == "Green"){echo 'green';}else {echo 'blue';}?>" href="<?php $block['block_link'];?>">
            				<h4><?php echo $block['block_text'];?></h4>
          				</a>
          			</div>
				    	<?php endif ?>
				    <?php endforeach;?>	    		
				</div>
	    </div>
	</div>
	<div class="row">
		<div class="featured-text col-md-offset-3 col-md-10 col-xs-16"><?php the_content(); ?></div>
	</div>
	<div class="row">
		<hr>
	</div>
	<?php $pageid =  get_the_ID(); $i = 1; ?>
    <?php if(get_field('features')): ?>
    	<div class="row">
		<?php while(has_sub_field('features')): ?>
			<div class="col-md-8">
				<article class="home-feature">
					<header>
						<h3><?php the_sub_field('title');?></h3>
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