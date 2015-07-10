<!--woocommerce.php-->
<?php get_header(); ?>
<div style="text-align:center;"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></div>
<div class="col-md-3">
	<ul class="dynSide">
	<?php dynamic_sidebar( 'primary-widget-area' ); ?>
	</ul>
</div>
<div class="col-md-9">
<?php woocommerce_content(); ?>
</div>
<?php get_footer(); ?>