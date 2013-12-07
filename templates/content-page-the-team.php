<?php while (have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail()){
		echo "<div class='featured-image'>";
		the_post_thumbnail( 'featured_image' );
		echo "</div>";
	}?>
  	<?php the_content(); ?>

  	<div class="team-members">
  		<!-- Nav tabs -->
		<ul class="nav team-nav team-tabs nav-tabs">
		  <li class="active"><a href="#member1" data-toggle="tab"><img src="<?php bloginfo('template_url'); ?>/assets/img/team_member1.jpg" /></a></li>
		  <li><a href="#member2" data-toggle="tab"><img src="<?php bloginfo('template_url'); ?>/assets/img/team_member2.jpg" /></a></li>
		  <li><a href="#member3" data-toggle="tab"><img src="<?php bloginfo('template_url'); ?>/assets/img/team_member3.jpg" /></a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content team-content">
			<div class="tab-pane team-pane fade in active" id="member1">
				<h3 class="name">Rachel Stamm</h3>
				<h4 class="position">Founder & CEO, MBA</h4>
				
				<p>Rachel has an MBA in Sustainable Systems & a Certificate in the Sustainable Built Environment, both from Bainbridge Graduate Institute, & 13 years experience in housing people as a Seattle Real Estate Broker. </p>

				<p>An advocate for the necessary shift toward a sustainable built environment, Rachel understands the impact that the space in which we spend our time has upon our health, mindset and spirit.  Rachel is invested in making the business case for sustainable, healthy housing that supports, in multiple ways, the people in need of emergency housing.  She believes this work is a social justice issue.</p>

			</div>
			<div class="tab-pane team-pane fade in" id="member2">
				<h3 class="name">Rachel Stamm</h3>
				<h4 class="position">Founder & CEO, MBA</h4>
				<p>Rachel has an MBA in Sustainable Systems & a Certificate in the Sustainable Built Environment, both from Bainbridge Graduate Institute, & 13 years experience in housing people as a Seattle Real Estate Broker. </p>

				<p>An advocate for the necessary shift toward a sustainable built environment, Rachel understands the impact that the space in which we spend our time has upon our health, mindset and spirit.  Rachel is invested in making the business case for sustainable, healthy housing that supports, in multiple ways, the people in need of emergency housing.  She believes this work is a social justice issue.</p>		  
			</div>
			<div class="tab-pane team-pane fade in" id="member3">
				<h3 class="name">Rachel Stamm</h3>
				<h4 class="position">Founder & CEO, MBA</h4>
				<p>Rachel has an MBA in Sustainable Systems & a Certificate in the Sustainable Built Environment, both from Bainbridge Graduate Institute, & 13 years experience in housing people as a Seattle Real Estate Broker. </p>

				<p>An advocate for the necessary shift toward a sustainable built environment, Rachel understands the impact that the space in which we spend our time has upon our health, mindset and spirit.  Rachel is invested in making the business case for sustainable, healthy housing that supports, in multiple ways, the people in need of emergency housing.  She believes this work is a social justice issue.</p>		  
			</div>
		</div>
	</div>

	<hr>

	<div class="advisory-board">
		<h1 class="section-title">Advisory Board</h1>
	</div>

  	<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>