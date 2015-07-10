<!--single.php-->
<?php get_header(); ?>
<div class="row">
	<div class="col-md-8">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'entry' ); ?>
		<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
		<?php endwhile; endif; ?>
	</div>
	<div class="col-md-4">
		<ul class="dynSide">
		<?php dynamic_sidebar( 'primary-widget-area' ); ?>
		</ul>
	</div>
</div>
<?php get_footer(); ?>