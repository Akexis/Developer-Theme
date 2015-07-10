<?php

add_action('admin_menu','devTheme_admin');

function devTheme_admin(){
	$page_title = "Theme Settings";
	$menu_title = "Theme Settings";
	$role = "administrator";
	$menu_slug = "devTheme-theme-settings";
	$function = "devTheme_theme_menu";
	$icon_url = get_template_directory_uri() . '/img/cog.png';

	add_menu_page($page_title,$menu_title,$role,$menu_slug,$function, $icon_url);
}

// This is the view
function devTheme_theme_menu(){
	// check if current user has permission
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;

	if(!user_can($user_id, 'create_users'))
		return false;

?>

<div class="wrap">
	<h2>Theme Settings</h2>
</div>

<div>
	<?php
		general_settings();
	?>
</div>

<?php
}

// Adding in scripts for further admin panel functionality
function devTheme_enqueue_script(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('devTheme-admin-script', get_template_directory_uri() . '/admin/admin-script.js');
	wp_enqueue_style('devTheme-admin-style', get_template_directory_uri() . '/admin/admin-style.css');
	wp_enqueue_media();
}

add_action('admin_enqueue_scripts','devTheme_enqueue_script');

function general_settings(){
	?>
	<ul class="admin-menu">
		<li id="general-change"><span>General Settings</span></li>
		<li id="fonts-change"><span>Fonts</span></li>
		<li id="dev-change"><span>Developer Notes</span></li>
		<li id="log-change"><span>Log</span></li>
	</ul>
	<?php 

	include('general-settings.php');
	include('fonts.php');
	include('dev-notes.php');
	include('log.php');
	
}

add_action('admin_footer','js_init');
function js_init(){
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		//Menu Change
		$('#general-change').click(function(){
			if($('#general').css('display','none')){
				$('#fonts').css('display', 'none');
				$('#devNotes').css('display', 'none');
				$('#log').css('display', 'none');
				$('#general').fadeToggle();	
			}		
		});
		$('#fonts-change').click(function(){
			if($('#fonts').css('display','none')){
				$('#general').css('display', 'none');
				$('#devNotes').css('display', 'none');
				$('#log').css('display', 'none');
				$('#fonts').fadeToggle();
			}		
		});
		$('#dev-change').click(function(){
			if($('#devNotes').css('display', 'none')){
				$('#general').css('display', 'none');
				$('#fonts').css('display', 'none');
				$('#log').css('display', 'none');
				$('#devNotes').fadeToggle();
			}	
		});
		$('#log-change').click(function(){
			if($('#log').css('display', 'none')){
				$('#general').css('display', 'none');
				$('#fonts').css('display', 'none');
				$('#devNotes').css('display', 'none');
				$('#log').fadeToggle();
			}
		});

		$('#shrt').click(function(){
			if($('#shortcodes').css('display', 'none')){
				$('#themeDev').css('display', 'none');
				$('#shortcodes').fadeToggle();
			}
		});
		$('#thm').click(function(){
			if($('#themeDev').css('display', 'none')){
				$('#shortcodes').css('display', 'none');
				$('#themeDev').fadeToggle();
			}
		});

		//Set current font to checked
		var currentFont = "<?php echo get_option( 'fontPick' ); ?>";
		console.log(currentFont);
		$('input[name="font-options"][value="' + currentFont + '"]').prop('checked', true);


		//General
		$('#general-button').live('click',function(){
			var themelogo = $('#logo-upload').val();
			var themefavicon = $('#favicon-upload').val();
			var themetagline = $('#tagline-upload').val();
			var themephone = $('#phone-number').val();
			var themeemail = $('#email').val();
			var themefooter = $('#footer').val();

			var data = {
				action: 'general_settings_action',
				logo: themelogo,
				favicon: themefavicon,
				tagline: themetagline,
				phone: themephone,
				email: themeemail,
				footer: themefooter
			};

			$.post(ajaxurl, data, function(response){
				$('#savemessagegeneral1').html("Loading...");
				$('#savemessagegeneral1').show(2000);
			})
			.success(function(){})
			.error(function(){alert('error');})
			.complete(function(){$('#savemessagegeneral1').html('General Settings Saved!').hide(2000);})
		});

		//Fonts
		$('#font-button').live('click',function(){	
			var font = document.getElementsByName('font-options');

			var fontChoice;
			for(i=0;i<font.length;i++){
				if(font[i].checked){
					fontChoice = font[i].value;
				}
			}

			var useFont;
			var fontFamily;
			var fontPick; 
			switch(fontChoice){
				case 'lato':
					useFont = "Lato";
					fontFamily = "font-family: 'Lato', sans-serif;";
					fontPick = 'lato'; //Same value as input value
					break;
				case 'open-sans':
					useFont = "Open+Sans";
					fontFamily = "font-family: 'Open Sans', sans-serif;";
					fontPick = 'open-sans'; //Same value as input value
					break;
				case 'oswald':
					useFont = "Oswald";
					fontFamily = "font-family: 'Oswald', sans-serif;";
					fontPick = 'oswald'; //Same value as input value
					break;
				case 'roboto':
					useFont = "Roboto";
					fontFamily = "font-family: 'Roboto', sans-serif;";
					fontPick = 'roboto'; //Same value as input value
					break;
			}
			
			var data = {
				action: 'font_settings_action',
				font: useFont,
				fontFamily: fontFamily,
				fontPick: fontPick
			};

			$.post(ajaxurl, data, function(response){
				$('#savemessagegeneral3').html("Loading...");
				$('#savemessagegeneral3').show(2000);
			})
			.success(function(){})
			.error(function(){alert('error');})
			.complete(function(){$('#savemessagegeneral3').html('Font Settings Saved!').hide(2000);})
		});

	})
	</script>
	<?php
}

//Update General Settings
add_action('wp_ajax_general_settings_action','general_settings_save');
function general_settings_save(){

	$logo = $_POST['logo'];
	$favicon = $_POST['favicon'];
	$tagline = $_POST['tagline'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$footer = $_POST['footer'];

	// Save in WP Options database table
	update_option('logo', $logo);
	update_option('favicon', $favicon);
	update_option('tagline', $tagline);
	update_option('phone', $phone);
	update_option('email', $email);
	update_option('footer', $footer);

	echo "Success";

	die;
}

//Update Font Settings
add_action('wp_ajax_font_settings_action','font_settings_save');
function font_settings_save(){

	$font = $_POST['font'];
	$fontFamily = stripslashes( $_POST['fontFamily'] );
	$fontPick = $_POST['fontPick'];

	// Save in WP Options database table

	update_option('font', $font);
	update_option('fontFamily', $fontFamily);
	update_option('fontPick', $fontPick);

	echo "Success";

	die;
}
?>