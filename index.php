<!--index.php-->
<?php get_header(); ?>
<div class="row">
    <div class="col-md-8">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'entry' ); ?>
        <?php comments_template(); ?>
        <?php endwhile; endif; ?>

        <div class="pagination">
        	<?php
            global $wp_query;
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages
            ) );
            ?>
        </div>
    </div>
    <div class="col-md-4">
        <?php echo get_option( 'phone' ); ?><br />
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>