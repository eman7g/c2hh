<footer class="content-info" role="contentinfo">
	<div class="container">
		<div class="row">
			<div class="row-row">
				<div class="col-sm-4 col-xs-8 col-footer">
					<?php wp_nav_menu( array('menu' => 'Footer Menu' )); ?>
				</div>

				<div class="col-sm-4  col-xs-8 col-footer">
					<h3>Product Types</h3>
					<?php
						$terms = get_terms("product-type");
						 if ( !empty( $terms ) && !is_wp_error( $terms ) ){
						     echo "<ul>";
						     foreach ( $terms as $term ) {
						       //echo "<li>" . $term->name . "</li>";
						       ?>
						       	<li>
						       		<a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Products' ) ) ); ?>?product_type=<?php echo $term->slug;?>"><?php echo $term->name;?></a></li>
						       <?php
						        
						     }
						     echo "</ul>";
						 }
					?>
				</div>
			</div>
			<div class="row-row">

				<div class="col-sm-4 col-xs-8 col-footer">
					<h3>Contact</h3>
					<ul>
						<li>Close to Home</li>
						<li>220 2nd Ave S. Suite 220</li>
						<li>Seattle, WA  98104</li>
					</ul>
					<ul>
						<li><a href="mailto:<?php echo get_theme_mod( 'contact_email' ); ?>"><?php echo get_theme_mod( 'contact_email' ); ?></a></li>
						<li>p. <?php echo get_theme_mod( 'contact_phone' ); ?></li>
					</ul>
				</div>
				<div class="col-sm-4 col-xs-8 col-footer">
					<h3>Follow Us</h3>
					<ul class="social">
						
						<?php if( get_theme_mod( 'twitter_checkbox' ) == true) : ?>
							<li class="twitter"><a target="_blank" href="<?php echo get_theme_mod( 'twitter_setting' ); ?>">Twitter</a></li>
						<?php endif ?>
						<?php if (get_theme_mod( 'facebook_checkbox' ) == true) : ?>
							<li class="facebook"><a target="_blank" href="<?php echo get_theme_mod( 'facebook_setting' ); ?>">Facebook</a></li>
						<?php endif ?>
						<?php if (get_theme_mod( 'pinterest_checkbox' ) == true) : ?>
							<li class="pinterest"><a target="_blank" href="<?php echo get_theme_mod( 'pinterest_setting' ); ?>">Pinterest</a></li>
						<?php endif ?>
						<?php if (get_theme_mod( 'instagram_checkbox' ) == true) : ?>
							<li class="instagram"><a target="_blank" href="<?php echo get_theme_mod( 'instagram_setting' ); ?>">Instagram</a></li>
						<?php endif ?>
					</ul>
				</div>
			</div>

		</div>
		<div class="row">
			<hr>
		</div>
		<p class="copy"><?php echo get_theme_mod( 'footer_copyright' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>