<div id="social-icons" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

	<?php 
	$social = array(
				"facebook",
				"twitter",
				"google-plus",
				"instagram",
				"youtube",
				"pinterest-p",
				"vimeo-square",
				"envelope"
			  );
			  
	foreach ($social as $i) { 
		if (get_theme_mod($i)) {
	?>
		<a target="_blank" href="<?php echo get_theme_mod($i); ?>" title="<?php echo $i ?>"><i class="fa fa-<?php echo $i ?>"></i></a>
	<?php }
	}
	?>

</div>