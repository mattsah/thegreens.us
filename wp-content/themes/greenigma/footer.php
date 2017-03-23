<!-- enigma Callout Section -->
<?php $wl_theme_options = weblizar_get_options(); ?>
<!-- Footer Widget Secton -->
<div class="enigma_footer_widget_area">

<!-- STYLES FOR FOOTER -->
<style>

.soc-media-container {
	display: -webkit-flex;
	display:flex;

	flex-wrap: wrap;
	margin-left: auto;
	margin-right:auto;

	width: 80%;
}

.soc-media-plugin {
	padding: 5%;
	width: 50%;
}

#twitter-widget-0 {
	min-width: 250px !important;
}

.spacer {
	width: 100%;
}
</style>
<!-- END STYLES FOR FOOTER  -->

<div class="enigma_heading_title">
<h3 class="footerTitle" style="color:white;">Social Media</h3>
</div>

<div class="soc-media-container">
<!-- TWITTER PLUGIN -->
<div class="soc-media-plugin">

<a class="twitter-timeline" data-width="278px" data-height="500" data-theme="light" href="<?php echo esc_url($wl_theme_options['twitter_link']); ?>">Tweets</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

</div>
<!-- END TWITTER PLUGIN -->

<!-- FACEBOOK SB FOR JILL WIDGET -->
<div class="soc-media-plugin">

<div style="width: 100%;" class="fb-page" data-href="<?php echo esc_url($wl_theme_options['fb_link']); ?>" data-tabs="timeline,events,messages" data-small-header="false" data-width="500" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?php echo esc_url($wl_theme_options['fb_link']); ?>" class="fb-xfbml-parse-ignore"><a href="<?php echo esc_url($wl_theme_options['fb_link']); ?>">South Bay for Jill Stein</a></blockquote>
</div>

</div>
<!-- END FACEBOOK SB FOR JILL WIDGET -->


</div> <!-- end soc-media-container div -->
	<div class="container">
		<div class="row">
			<?php
			if ( is_active_sidebar( 'footer-widget-area' ) ){
				dynamic_sidebar( 'footer-widget-area' );
			} else
			{
			$args = array(
			'before_widget' => '<div class="col-md-3 col-sm-6 enigma_footer_widget_column">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="enigma_footer_widget_title">',
			'after_title'   => '<div id="" class="enigma-footer-separator"></div></h3>' );
			//the_widget('WP_Widget_Pages', null, $args);
			} ?>
		</div>
	</div>


</div>

<div class="enigma_footer_area">
		<div class="container">
			<div class="col-md-12">
			<p class="enigma_footer_copyright_info">
			<?php if($wl_theme_options['footer_customizations']) { echo esc_attr($wl_theme_options['footer_customizations']); }
			if($wl_theme_options['developed_by_text']) { echo "|" .esc_attr($wl_theme_options['developed_by_text']); } ?>
			<a target="_blank" rel="nofollow" href="<?php if($wl_theme_options['developed_by_link']) { echo esc_url($wl_theme_options['developed_by_link']); } ?>"><?php if($wl_theme_options['developed_by_weblizar_text']) { echo esc_attr($wl_theme_options['developed_by_weblizar_text']); } ?></a></p>


			<?php if($wl_theme_options['footer_section_social_media_enbled'] == '1') { ?>
			<div class="enigma_footer_social_div">
				<ul class="social">
					<?php if($wl_theme_options['fb_link']!='') { ?>
					   <li class="facebook" data-toggle="tooltip" data-placement="top" title="Facebook"><a  href="<?php echo esc_url($wl_theme_options['fb_link']); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<?php } if($wl_theme_options['twitter_link']!='') { ?>
					<li class="twitter" data-toggle="tooltip" data-placement="top" title="Twitter"><a href="<?php echo esc_url($wl_theme_options['twitter_link']) ; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
					<?php } if($wl_theme_options['instagram']!='') { ?>
					<li class="instagram" data-toggle="tooltip" data-placement="bottom" title="Instagram"><a href="<?php echo esc_url($wl_theme_options['instagram']); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
					<?php } if($wl_theme_options['youtube_link']!='') { ?>
					<li class="youtube" data-toggle="tooltip" data-placement="top" title="Youtube"><a href="<?php echo esc_url($wl_theme_options['youtube_link']) ; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
	                <?php } ?>
					</ul>
			</div>
			<?php } ?>
			</div>
		</div>
		<?php if($wl_theme_options['custom_css']) ?>
		<style type="text/css">
			<?php { echo esc_attr($wl_theme_options['custom_css']); } ?>
		</style>

</div>
<!-- /Footer Widget Secton -->
</div>
<a href="#" title="Go Top" class="enigma_scrollup" style="display: inline;"><i class="fa fa-chevron-up"></i></a>
<?php wp_footer(); ?>
</body>
</html>
