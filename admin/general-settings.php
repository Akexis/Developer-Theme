<?php

if(!get_option('phone')){
	update_option('phone', '555-555-5555');
}

if(!get_option('email')){
	update_option('email', 'email@domain.com');
}

if(!get_option('tagline')){
	update_option('tagline', 'Tagline Goes Here');
}

if(!get_option('logo')){	
	$tempLogo = get_template_directory_uri() . '/img/logo.png';
	update_option('logo', $tempLogo);
}

if(!get_option('footer')){	
	update_option('footer', 'Footer Text');
}

?>
<div id="general">	
	<!--Logo-->
	<label>Upload Your Logo</label><br />
	<input type="text" id="logo-upload" name="logo-upload" value="<?php echo get_option('logo'); ?>" /> | <input id="logo-upload-button" type="button" value="Upload Image" />
	<?php
	if(get_option('logo') != ''){
		?>
	<p><img id="main-logo" src="<?php echo get_option('logo'); ?>" width="500" /></p>
	<?php
	}
	?>

	<!--Favicon-->
	<p>&nbsp;</p>
	<label>Upload Your Favicon</label><br />
	<input type="text" id="favicon-upload" name="favicon-upload" value="<?php echo get_option('favicon'); ?>" /> | <input id="favicon-upload-button" type="button" value="Upload Favicon" />
	<?php
	if(get_option('favicon') != ''){
		?>
	<p><img id="fav" src="<?php echo get_option('favicon'); ?>" width="64" /></p>
	<?php
	}
	?>
	<p>&nbsp;</p>
	<label>Tagline</label><br />
	<textarea id="tagline-upload"><?php echo get_option('tagline'); ?></textarea>
	<p>&nbsp;</p>
	<label>Phone Number</label><br />
	<input type="text" id="phone-number" name="phone-number" value="<?php echo get_option('phone'); ?>" />
	<p>&nbsp;</p>
	<label>Email</label><br />
	<input type="text" id="email" name="email" value="<?php echo get_option('email'); ?>" />
	<p>&nbsp;</p>
	<label>Footer Text</label><br />
	<input type="text" id="footer" name="footer" value="<?php echo get_option('footer'); ?>" />
	<p>&nbsp;</p>
	<a href="#" id="general-button">Save General Settings</a>
	<div id="savemessagegeneral1" style="display:none"></div>
</div>