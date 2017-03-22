<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Simpel
 */
?>

		</div><!-- #content -->
	</div><!-- #page -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div id="footer-sidebar" class="widget-area clear container" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>
	<?php 
		if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
		<div class="footer-column col-lg-3 col-md-3 col-sm-12 col-xs-12"> <?php
			dynamic_sidebar( 'sidebar-2'); 
		?> </div> <?php	
		}
			
		if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
		<div class="footer-columncol-lg-3 col-md-3 col-sm-12 col-xs-12"> <?php
			dynamic_sidebar( 'sidebar-3'); 
		?> </div> <?php	
		}

		if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
		<div class="footer-columncol-lg-3 col-md-3 col-sm-12 col-xs-12"> <?php
			dynamic_sidebar( 'sidebar-4'); 
		?> </div> <?php	
		}
		
		if ( is_active_sidebar( 'sidebar-5' ) ) { ?>
		<div class="footer-columncol-lg-3 col-md-3 col-sm-12 col-xs-12"> <?php
			dynamic_sidebar( 'sidebar-5'); 
		?> </div> <?php	
		}
		?>	 		
	</div>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'simpel' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'simpel' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'simpel' ), 'Simpel', '<a href="http://www.divjot.co/" rel="designer">Divjot Singh</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
<?php wp_footer(); ?>

</body>
</html>
