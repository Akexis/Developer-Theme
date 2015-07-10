<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s"><span class="screen-reader-text"><?php _ex( 'Search for:', 'label', "alexisblank" ); ?></span></label>
	<div class="input-group">
        <input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', "alexisblank" ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', "alexisblank" ); ?>">
        <div class="input-group-btn">
            <button type="submit" class="search-submit btn btn-default"><?php echo esc_attr_x( 'Search', 'submit button', "alexisblank" ); ?></button>
        </div>
    </div>
</form>