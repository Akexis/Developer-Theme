<!--page.php-->
<?php get_header(); ?>
<div class="row">
	<div class="col-md-8">
		<?php the_breadcrumb(); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>

		<?php the_content(); ?>
		<div class="entry-links"><?php wp_link_pages(); ?></div>

		</article>
		<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
		<?php endwhile; endif; ?>
	</div>
	<div class="col-md-4">
		<?php echo get_option( 'phone' ); ?><br />
		
		<?php
		if(is_front_page()){

		}/*elseif(is_page(42)){
			echo get_post_meta($post->ID, 'Sidebar-PageName', true);
		}*/else{
		?>
		<ul class="dynSide">
			<?php dynamic_sidebar( 'primary-widget-area' ); ?>
		</ul>
		<?php
		}
		 
		?>
	</div>
</div>
<?php get_footer(); ?>