<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>
<link rel="shortcut icon" href="<?php echo get_option('favicon'); ?>">
<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/animate.css" />
<script src="<?php bloginfo('template_directory');?>/js/jquery-2.1.0.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap.min.js"></script>
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/styles-ie8.css" />
<![endif]-->
<!--respond.js has to be here to make media queries work in IE9-->
<script src="<?php bloginfo('template_directory');?>/js/respond.js"></script>
<!--Google Fonts: Controlled in Theme Settings-->

<?php
if (!get_option( 'font' )){
	update_option('font', 'Lato');
	update_option('fontFamily', "font-family: 'Lato', sans-serif;");
	update_option('fontPick', 'lato');
} 
?>
<link href='http://fonts.googleapis.com/css?family=<?php echo get_option( 'font' ); ?>' rel='stylesheet' type='text/css'>
<style>
	h1, h2, h3, h4, h5, h6{
		<?php echo get_option( 'fontFamily' ); ?>;
	}
</style>
</head>
<body <?php body_class(); ?>>
<div class="main padAdj">
	<div class="container">
		<div class="col-md-4">
			<a href="/"><img src="<?php echo get_option( 'logo' ); ?>" class="img-responsive" width="200" /></a>
		</div>
		<div class="col-md-4">
			<?php echo get_option( 'tagline' ); ?>
		</div>
		<div class="col-md-4">
			Phone: <?php echo get_option( 'phone' ); ?>
		</div>
	</div>
</div>
<div class="tertiary">
	<div class="container">
		<div id="phoneMenu">+ Menu</div>
		<div class="col-md-12 menu">
	    <?php wp_nav_menu( array( 
			'theme_location' => 'main-menu',
			'container' => false,
			'menu_class' => 'nav-item',
			'walker' => new Layout_Walker_Nav_Menu()
		) ); ?>
	    </div>
	</div>
</div>
<?php  // check if the post has a Featured Image.
    if ( has_post_thumbnail() )
	{
		?>
<div class="secondary padAdj">
	<div class="container">
		<div class="col-md-12">
		<?php
		echo '<div class="featImg">';
 		the_post_thumbnail();
 		echo '</div>';
		$textSet = get_post_meta($post->ID, 'Image Text', true);
		$videoSet = get_post_meta($post->ID, 'Video', true);
		$specialClass = get_post_meta($post->ID, 'Class', true);
		$grayBox = get_post_meta($post->ID, 'Gray Box', true);
		if(!$textSet && !$videoSet){
			//Does not generate divs if there's not any image text.
		}elseif(!$textSet){ ?>

		<div class="vidText">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
				<?php echo get_post_meta($post->ID, 'Video', true); ?>
					</div>

				<?php //Image Text Custom Field ?>
					<div class="col-md-5">
						&nbsp;
		 			</div>
		 		</div>
	 		</div>
	 	</div>

		<?php
		}elseif(!$videoSet){ ?>

		<div class="vidText">
			<div class="container">
				<div class="row">
				<?php //Image Text Custom Field ?>
					<div class="col-md-12">
						<div class="featImgText" style="width:60%;">
							<?php echo do_shortcode(get_post_meta($post->ID, 'Image Text', true)); ?>
		 				</div>
		 			</div>
		 		</div>
	 		</div>
	 	</div>

		<?php
		}elseif(!$grayBox){
		?>

		<div class="vidText">
			<div class="container">
				<div class="row">
				<?php //Image Text Custom Field ?>
					<div class="col-md-5">
						<div class="basicText">
				<?php echo do_shortcode(get_post_meta($post->ID, 'Image Text', true)); ?>
		 				</div>
		 			</div>
		 			<div class="col-md-7">
				<?php echo get_post_meta($post->ID, 'Video', true); ?>
					</div>
		 		</div>
	 		</div>
	 	</div>

		<?php
		}else{
		?>
		<div class="vidText">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
				<?php echo get_post_meta($post->ID, 'Video', true); ?>
					</div>

				<?php //Image Text Custom Field ?>
					<div class="col-md-5">
						<div class="featImgText changePosition">
				<?php echo do_shortcode(get_post_meta($post->ID, 'Image Text', true)); ?>
							<div class="grayBox"><?php echo do_shortcode(get_post_meta($post->ID, 'Gray Box', true)); ?>
							</div>
		 				</div>
		 			</div>
		 		</div>
	 		</div>
	 	</div>

		<?php
		}

		?>
		</div>
	</div>
</div>

		<?php
    }

    if(is_front_page() ){
    	//If Front Page.
    ?>
<div class="secondary">
	<div class="row">
		<div class="container padAdj">
			<div class="col-md-12">
				<img src="<?php bloginfo('template_directory');?>/img/featured-image-placeholder.jpg" class="img-responsive" />
			</div>
		</div>
	</div>
</div>
    <?php
	
    }

    ?>

<!--Content-->
<div class="tertiary padAdj">
	<div class="container">
		<div class="col-md-12">