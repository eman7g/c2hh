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
				<?php wp_nav_menu( array('menu' => 'Footer Menu 1' )); ?>
			</div>

			<div class="col-sm-4 col-footer">
				<?php wp_nav_menu( array('menu' => 'Footer Menu 2' )); ?>				
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