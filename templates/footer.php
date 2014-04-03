<footer class="content-info" role="contentinfo">
	<div class="container">
		<div class="row">
			
			<div class="col-sm-2 col-footer">
				<h3>About Us</h3>
				<ul>
					<?php $about_id = get_ID_by_slug('home');?>
					<?php $children = wp_list_pages('title_li=&child_of='.$about_id.'&echo=0'); ?>
					<?php echo $children;?>
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
					<?php $shelters_id = get_ID_by_slug('shelters');?>
					<?php $children = wp_list_pages('title_li=&child_of='.$shelters_id.'&echo=0'); ?>
					<?php echo $children;?>		
				</ul>	
			</div>

			<div class="col-sm-4 col-footer">
				<h3>Services</h3>
				<ul>
					<?php $services_id = get_ID_by_slug('services');?>
					<?php $children = wp_list_pages('title_li=&child_of='.$services_id.'&echo=0'); ?>
					<?php echo $children;?>		
				</ul>					
				<h3>Resources</h3>
				<ul>
					<?php $resources_id = get_ID_by_slug('resources');?>
					<?php $children = wp_list_pages('title_li=&child_of='.$resources_id.'&echo=0'); ?>
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