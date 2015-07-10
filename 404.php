<!--404.php-->
<?php get_header(); ?>
<div class="row">
	<div class="col-md-8">
		<h1 class="entry-title"><?php _e( 'Not Found', 'alexisblank' ); ?></h1>

		<p><?php _e( 'Nothing found for the requested page. Try a search instead?', 'alexisblank' ); ?></p>
		<?php get_search_form(); ?>

	</div>
	<div class="col-md-4">
		<?php echo get_option( 'phone' ); ?><br />
		
		<ul class="dynSide">
			<?php dynamic_sidebar( 'primary-widget-area' ); ?>
		</ul>
	</div>
<?php get_footer(); ?>