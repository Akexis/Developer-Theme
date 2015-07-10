		</div>
	</div>
</div>

<div class="secondary">
	<div class="container">
		<div class="col-md-9">
	        <?php wp_nav_menu( array( 
				'theme_location' => 'footer-menu',
				'container' => false,
				'menu_class' => 'ft-nav'
				) ); ?>
	    </div>
	    <div class="col-md-3">
			<?php echo get_option( 'phone' ); ?>
	    </div>
	</div>
</div>
<div class="quad padAdj">
	<div class="container">
		<div class="col-md-12">
			<?php echo get_option( 'footer' ); ?>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
<script>
if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
	$('.menu-item').has('.sub-menu-0').append('<i class="glyphicon glyphicon-chevron-down"></i>');

	$('.sub-menu-0 li').has('ul').addClass('liExpand');


	$('li').click(function(){
		$(this).find('.sub-menu-0').fadeToggle();
		var currentItem = $(this).find('i');
		if(currentItem.hasClass('glyphicon-chevron-up')){
			currentItem.removeClass('glyphicon-chevron-up');
			currentItem.addClass('glyphicon-chevron-down');
		}else if(currentItem.hasClass('glyphicon-chevron-down')){
			currentItem.removeClass('glyphicon-chevron-down');
			currentItem.addClass('glyphicon-chevron-up');
		}

	});

	$('#phoneMenu').click(function(){
		$('.menu').slideToggle();
	});
}
else{
	$('.menu-item').hover(function(){
		$(this).find('.sub-menu-0').toggle();
	});

	$('.sub-menu-0 li').hover(function(){
		$(this).find('.sub-menu-1').toggle();
	});

	$('.menu-item li').has('ul').addClass('liExpand');
}
</script>
</body>
</html>