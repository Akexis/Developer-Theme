jQuery(document).ready(function($){ //This is the way to use jquery in WP admin

	// using the media uploader

	//logo
	$("input[id^='logo-upload-button']").click(function(e){
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		var id = button.attr('id').replace('-button','');
		wp.media.editor.send.attachment = function(props,attachment){
			$("#logo-upload").val(attachment.url);
			wp.media.editor.send.attachment = send_attachment_bkp;
		}

	wp.media.editor.open(button);
	return false;

	});

	//favicon
	$("input[id^='favicon-upload-button']").click(function(e){
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		var id = button.attr('id').replace('-button','');
		wp.media.editor.send.attachment = function(props,attachment){
			$("#favicon-upload").val(attachment.url);
			wp.media.editor.send.attachment = send_attachment_bkp;
		}

	wp.media.editor.open(button);
	return false;

	});
})