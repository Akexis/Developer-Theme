<div id="devNotes">
	<h1>Developer Notes</h1>
	<ul class="devMenu">
		<li id="shrt">Shortcodes</li>
		<li id="thm">Custom Fields Sidebars</li>
	</ul>
	<div id="shortcodes">
		<h2>Shortcodes</h2>
		<p>This theme uses the <a href="http://getbootstrap.com/" target="_blank">Bootstrap</a> CSS Framework.
		<div class="big">[lipsum]</div>
		<p>This shortcode generates a couple of paragraphs of lipsum content.  Great for testing layout with text.</p>
		<h4>Example:</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit commodo nisi in luctus. Donec est elit, euismod id pulvinar in, vestibulum a libero. Pellentesque tellus lorem, consequat at lectus ut, interdum pulvinar nisi. Nunc congue lacus et vulputate laoreet. Etiam tempus sed quam nec gravida. Aliquam sed ante pulvinar, luctus mi vel, interdum arcu. Mauris sit amet urna vitae libero sollicitudin egestas.</p>
		<p>Etiam congue quam sed tincidunt scelerisque. Nullam pellentesque, augue id vulputate dictum, lorem magna consequat turpis, in mollis justo ligula ut erat. Vestibulum dictum sodales ante, id rutrum libero laoreet ac. Nullam fermentum mollis tempor. Ut auctor porta nunc, ac dignissim est fermentum ac. Ut lacus ligula, accumsan id libero sit amet, ultrices mattis mi. Pellentesque ultricies interdum arcu et feugiat. Vestibulum est nisl, ultricies at velit eget, dignissim ultrices mi.</p>
		<div class="big">[column size=x col=x]content[/column]</div>
		<p>This shortcode uses <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap</a>. In that vein, you can use Bootstrap classes in your content so they can be seen in the visual editor of Wordpress.</p>
		<p>Size needs to be set to any of the following:</p>
		<ul class="list">
			<li>xs</li>
			<li>sm</li>
			<li>md</li>
			<li>lg</li>
		</ul>
		<p>Col should be set to a number in the range of 1 to 12. This creates the grid classes in Bootstrap.</p>
		<h4>Example:</h4>
		<p><strong>[column size=md col=6]Text[/column]</strong></p>
		<p><strong>&#60;div class="col-md-6"&#62;Text&#60;&#47;div&#62;</strong></p>
		<div class="big">[row class=class-name]content[/row]</div>
		<p>This shortcode uses the <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap</a> div with the class 'row'.  This wraps around your grid divs.</p>
		<h4>Example:</h4>
		<p><strong>[row][column size=md col=12]Some text.[/column][/row]</strong></p>
		<p>This is best used as the 'row' class is meant to be used, wrapped around a few div elements to keep their variably sized content in an even row. The class argument is optional in case you want to have a custom class to your 'row' div.</p>
		<h4>Example:</h4>
		<p><strong>[row]<br />
		[column size=md col=4]text 1[/column]<br />
		[column size=md col=4]text 2[/column]<br />
		[column size=md col=4]text 3[/column]<br />
		[/row]</strong></p>
		<h3>Tabs Shortcodes</h3>
		<p>This group of shortcodes needs four parts to work.  It uses <a href="http://getbootstrap.com/javascript/#tabs" target="_blank">Bootstrap's togglable tabs</a>.</p>
		<div class="big">[tabmenu]menu shortcode[/tabmenu]</div>
		<p>This wraps around your menu items.  The markup is a &#60;ul&#62; list and so this shortcode creates the &#60;ul&#62;.
		<div class="big">[tabitem id=x active=true]menu item[/tabitem]</div>
		<p>The argument id needs to be paired with the [tabpane] shortcode the menu item is supposed to open.  The key is the id pairs need to match and be unique.  If you use id=dog for the [tabitem] and [tabpane] pair, you can't use it for any others.  The argument active is placed on the [tabitem] you want showing as active. You can also add extra styling. Do not use active on more than one.</p>
		<div class="big">[tabcontainer]tabs[/tabcontainer]</div>
		<p>Wrap your [tabpane] shortcodes with the [tabcontainer] to group them.</p>
		<div class="big">[tabpane id=x active=true]tabs[/tabpane]</div>
		<p>The argument id must match one of the [tabitem] id arguments in order to work.  Active enables a tabpane by default.  Again, do not use active on more than one.  These will likely need better styling.</p>
		<h4>Example:</h4>
		<p><strong>[tabmenu]<br />
		[tabitem id=one active=true]Menu Item 1[/tabitem]<br />
		[tabitem id=two]Menu Item 2[/tabitem]<br />
		[tabitem id=three]Menu Item 3[/tabitem]<br />
		[/tabmenu]</strong></p>

		<p><strong>[tabcontainer]<br />
		[tabpane id=one active=true]Sample Text 1[/tabpane]<br />
		[tabpane id=two]Sample Text 2[/tabpane]<br />
		[tabpane id=three]Sample Text 3[/tabpane]<br />
		[/tabcontainer]</strong></p>
		<h3>Collapse Shortcodes</h3>
		<p><a href="http://getbootstrap.com/javascript/#collapse" target="_blank">Bootstrap's Collapse</a> feature is a nice way to organize lengthy content.  It requires two shortcodes.
		<div class="big">[colWrap id=x]collapse content[/colWrap]</div>
		<p>The argument id is how you can group collapse elements, meaning you can have more than one group on a single page.  Just match the id with the container argument on the [collapse] shortcode.</p>
		<div class="big">[collapse id=x title="x" active=true container=x]Content[/collapse]</div>
		<p>There are a few arguments to consider here.  The id simply needs to be unique.  It's best to use quotation marks around your title, but this will be the link text shown.  Use active on the one collapse panel you want open by default.  The container argument needs to match the id of the [colWrap] shortcode surrounding your group of [collapse] elements.</p>
		<h4>Example:</h4>
		<p><strong>[colWrap id=sample]<br />
		[collapse id=one active=true container=sample]Sample Text 1[/collapse]<br />
		[collapse id=two container=sample]Sample Text 2[/collapse]<br />
		[collapse id=three container=sample]Sample Text 3[/collapse]<br />
		[/colWrap]</strong></p>
	</div>
	<div id="themeDev">
		<h2>Custom Fields Sidebars</h2>
		<div class="big" style="text-align:left;width:600px;">
		&lt;?php<br />
		<br />
		if(is_front_page()){<br />
		<br />
		}/*elseif(is_page(42)){<br />
		&nbsp;&nbsp;&nbsp;&nbsp;echo get_post_meta($post->ID, 'Sidebar-PageName', true);<br />
		}*/else{<br />
		?&gt;<br />
		&lt;ul class="dynSide"&gt;<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&lt;?php dynamic_sidebar( 'primary-widget-area' ); ?&gt;<br />
		&lt;/ul&gt;<br />
		&lt;?php
		}<br />
		<br />
		?&gt;
		</div>
		<p>Add as many elseif(is_page($page)) sections as you want.  All you need to do is grab the ID of the page you want the sidebar to appear in.</p>
		<p>Enable viewing of custom fields using the Screen Options dropdown.  From there, name your custom field the same as your post_meta.  In the example above that's 'Sidebar-PageName'. Change the PageName to whatever the page is to make it easier to keep track of for maintenance. An example being 'Sidebar-Contact'.</p>
		<p>Custom Fields have to be created once before they're in the dropdown, but the dropdown makes them easier to find.  This has the benefit of making most of your on page content available on the page that needs to be edited.</p>
	</div>
</div>