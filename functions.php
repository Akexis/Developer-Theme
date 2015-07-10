<?php
	add_action( 'after_setup_theme', 'devTheme_setup' );
	function devTheme_setup(){
		load_theme_textdomain( 'devTheme', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce' );

		$args = array(
			'default-color' => '50ADFB'
		);
		add_theme_support( 'custom-background', $args );

		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 640;
			register_nav_menus(
				array( 
					'main-menu' => __( 'Main Menu', 'devTheme' ),
					'footer-menu' => __( 'Footer Menu', 'devTheme' )
					)
			);
		}

	class Layout_Walker_Nav_Menu extends Walker_Nav_Menu {
	  function start_lvl(&$output, $depth) {
	    $indent = str_repeat("\t", $depth);
	    $output .= "\n$indent<ul class=\"sub-menu-".$depth."\">\n";
	  }
	}
	
	add_action( 'wp_enqueue_scripts', 'devTheme_load_scripts' );
	function devTheme_load_scripts(){
		wp_enqueue_script( 'jquery' );
		}

	//Enable shortcode use in widget-text
	add_filter('widget_text', 'do_shortcode');
	
	add_action( 'comment_form_before', 'devTheme_enqueue_comment_reply_script' );
	function devTheme_enqueue_comment_reply_script(){
		if ( get_option( 'thread_comments' ) ) { 
			wp_enqueue_script( 'comment-reply' );
		 	}
		}
	
	add_filter( 'the_title', 'devTheme_title' );
	function devTheme_title( $title ) {
		if ( $title == '' ) {
			return '&rarr;';
			}
		else {
			return $title;
			}
		}
		
	add_filter( 'wp_title', 'devTheme_filter_wp_title' );
	function devTheme_filter_wp_title( $title ){
		return $title . esc_attr( get_bloginfo( 'name' ) );
		}
		
	//Custom Excerpt
	add_filter('excerpt_more', 'new_excerpt_more');	
	function new_excerpt_more( $more ) {
		return '<br /><a class="readMore" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More >>', 'your-text-domain') . '</a>';
		}
		
	add_action( 'widgets_init', 'devTheme_widgets_init' );
	function devTheme_widgets_init(){
		register_sidebar( array (
			'name' => __( 'Sidebar Widget Area', 'devTheme' ),
			'id' => 'primary-widget-area',
			'before_widget' => '<li>',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
		register_sidebar( array (
			'name' => __( 'Footer Widget Area', 'devTheme' ),
			'id' => 'footer-widget-area',
			'before_widget' => '<div class="col-md-4">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
	}

//SHORTCODES
	//Doesn't add <p> and <br> tags until after shortcodes are processed.
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 12);
		
	//Column Shortcode
	function devTheme_column_function($atts, $content = null){
		$classSize = shortcode_atts(array(
			  'col' => '',
			  'size' => ''
		   ), $atts);
		   
		   $divBoot = '<div class="col-'. $classSize['size'] .'-'. $classSize['col'] .'">' . do_shortcode($content) . '</div>';
		   
		   return $divBoot;
		   
		}

	//Row Shortcode
	function devTheme_row_function($atts, $content = null){
		$classSize = shortcode_atts(array(
			  'class' => ''
		   ), $atts);
		   
		   $divBoot = '<div class="row '. $classSize['class'] .'">' . do_shortcode($content) . '</div>';
		   
		   return $divBoot;
		   
		}

	//Tab Container Shortcode
	function devTheme_tabcontainer_function($atts, $content = null){
	$tabContainerID = shortcode_atts(array(
		  'id' => ''
	   ), $atts);
	   
	   $tabContainer = '<div id="'. $tabContainerID['id'] . '" class="tab-content">' . do_shortcode($content) . '</div>';
	   
	   return $tabContainer;
	   
	}

	//Tab Pane Shortcode
	function devTheme_tabpane_function($atts, $content = null){
	$tabpane = shortcode_atts(array(
		  'id' => '',
		  'active' => 0
	   ), $atts);
	   
	   if($tabpane['active'] === 'true'){
			$tabs = '<div id="'. $tabpane['id'] . '" class="tab-pane active">' . do_shortcode($content) . '</div>';
		}
		else{
			$tabs = '<div id="'. $tabpane['id'] . '" class="tab-pane">' . do_shortcode($content) . '</div>';
		}
	   
	   return $tabs;
	   
	}

	//Tab Menu Shortcode
	function devTheme_tabmncont_function($atts, $content = null){
	   
	   $tabmenucont = '<ul class="nav nav-tabs" role="tablist">' . do_shortcode($content) . '</ul>';
	   
	   return $tabmenucont;
	   
	}

	//Tab Menu Items Shortcode
	function devTheme_tabmnitem_function($atts, $content = null){
	$tabmnitem = shortcode_atts(array(
		  'id' => '',
		  'active' => 0
	   ), $atts);
	   
		if($tabmnitem['active'] === 'true'){
	   		$tabmenuitem = '<li class="active"><a href="#' . $tabmnitem['id'] . '" role="tab" data-toggle="tab">' . do_shortcode($content) . '</a></li>';
		}
		else{
			$tabmenuitem = '<li><a href="#' . $tabmnitem['id'] . '" role="tab" data-toggle="tab">' . do_shortcode($content) . '</a></li>';
		}
	   
	   return $tabmenuitem;
	   
	}

	function devTheme_collapse_function($atts, $content = null){
		$class = shortcode_atts(array(
			  'id' => '',
			  'title' => '',
			  'active' => 0,
			  'container' => ''
		   ), $atts);

		if($class['active'] === 'true'){
		$collapse = '<div class="panel panel-default">
					    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion' . $class['container'] . '" href="#collapse' . $class['id'] . '">
					      <h4 class="panel-title">' . $class['title'] . '</h4>
					    </div>
					    <div id="collapse' . $class['id'] . '" class="panel-collapse collapse in">
					      <div class="panel-body">
					        '. do_shortcode($content) .'
					      </div>
					    </div>
					  </div>';
		}else{
			$collapse = '<div class="panel panel-default">
					    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion' . $class['container'] . '" href="#collapse' . $class['id'] . '">
					      <h4 class="panel-title">' . $class['title'] . '</h4>
					    </div>
					    <div id="collapse' . $class['id'] . '" class="panel-collapse collapse">
					      <div class="panel-body">
					        '. do_shortcode($content) .'
					      </div>
					    </div>
					  </div>';
		}

		return $collapse;
	}

	function devTheme_colWrap_function($atts, $content = null){
		$class = shortcode_atts(array(
			  'id' => ''
		   ), $atts);
		$colWrap = '<div class="panel-group" id="accordion' . $class['id'] . '">'. do_shortcode($content) .'</div>';

		return $colWrap;
	}
		
	function devTheme_lipsum_function($atts, $content = null){
		$classSize = shortcode_atts(array(

		   ), $atts);
		   
		   $lipsum = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit commodo nisi in luctus. Donec est elit, euismod id pulvinar in, vestibulum a libero. Pellentesque tellus lorem, consequat at lectus ut, interdum pulvinar nisi. Nunc congue lacus et vulputate laoreet. Etiam tempus sed quam nec gravida. Aliquam sed ante pulvinar, luctus mi vel, interdum arcu. Mauris sit amet urna vitae libero sollicitudin egestas.</p>

			<p>Etiam congue quam sed tincidunt scelerisque. Nullam pellentesque, augue id vulputate dictum, lorem magna consequat turpis, in mollis justo ligula ut erat. Vestibulum dictum sodales ante, id rutrum libero laoreet ac. Nullam fermentum mollis tempor. Ut auctor porta nunc, ac dignissim est fermentum ac. Ut lacus ligula, accumsan id libero sit amet, ultrices mattis mi. Pellentesque ultricies interdum arcu et feugiat. Vestibulum est nisl, ultricies at velit eget, dignissim ultrices mi.</p>';
		   
		   return $lipsum;
		   
		}

	function devTheme_phone_function($atts, $content = null){
				   
		   $phone = "<span class=\"bodyPhone\">" . get_option('phone') . "</span>";
		   
		   return $phone;
		   
		}


	function devTheme_email_function($atts, $content = null){
				   
		   $email = "<a href=\"mailto:" . get_option('email') . "\">" . get_option('email') . "</a>";
		   
		   return $email;
		   
		}
	
	
	function register_shortcodes(){
		add_shortcode('column', 'devTheme_column_function');
		add_shortcode('row', 'devTheme_row_function');
		add_shortcode('lipsum', 'devTheme_lipsum_function');
		add_shortcode('phone', 'devTheme_phone_function');
		add_shortcode('email', 'devTheme_email_function');
		add_shortcode('tabcontainer', 'devTheme_tabcontainer_function');
		add_shortcode('tabpane', 'devTheme_tabpane_function');
		add_shortcode('tabmenu', 'devTheme_tabmncont_function');
		add_shortcode('tabitem', 'devTheme_tabmnitem_function');
		add_shortcode('colWrap', 'devTheme_colWrap_function');
		add_shortcode('collapse', 'devTheme_collapse_function');
		}
		
	add_action( 'init', 'register_shortcodes');
		
	//Breadcrumbs
	function the_breadcrumb() {
		global $post;
		echo '<ul id="breadcrumbs">';
		if (!is_home()) {
			echo '<li><a href="';
			echo get_option('home');
			echo '">';
			echo 'Home';
			echo '</a></li><li class="separator"> / </li>';
			if (is_category() || is_single()) {
				echo '<li>';
				the_category(' </li><li class="separator"> / </li><li> ');
				if (is_single()) {
					echo '</li><li class="separator"> / </li><li>';
					the_title();
					echo '</li>';
				}
			} elseif (is_page()) {
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separator">/</li>';
					}
					echo $output;
					echo '<strong title="'.$title.'"> '.$title.'</strong>';
				} else {
					echo '<li><strong> '.get_the_title().'</strong></li>';
				}
			}
		}
		elseif (is_tag()) {single_tag_title();}
		elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
		elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
		elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
		elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
		elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
		echo '</ul>';
	}
		
	function devTheme_custom_pings( $comment ){
		$GLOBALS['comment'] = $comment;
?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>

<?php 
		}
		
	add_filter( 'get_comments_number', 'devTheme_comments_number' );
	function devTheme_comments_number( $count ){
		if ( !is_admin() ) {
			global $id;
			$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
			return count( $comments_by_type['comment'] );
			}
		else {
			return $count;
			}
		}

	//Enable shortcode use in widget-text
	add_filter('widget_text', 'do_shortcode');

	// =========================================================================
    // REMOVE JUNK FROM HEAD
    // =========================================================================
    remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_generator'); // remove wordpress version
    remove_action('wp_head', 'rel_canonical'); // remove canonical link

    remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
    remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links

    remove_action('wp_head', 'index_rel_link'); // remove link to index page
    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)

    remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

    function remove_pingback_url( $output, $show ) {
    if ( $show == 'pingback_url' ) $output = '';
    return $output;
	}
	add_filter( 'bloginfo_url', 'remove_pingback_url', 10, 2 );

	//add_filter("gform_confirmation_anchor", create_function("","return true;")); // enables the confirmation anchor on all forms

	include 'admin/admin.php';
	include 'functions-custom.php';

?>