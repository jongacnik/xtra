<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php bloginfo('name'); ?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	    <link rel="shortcut icon" href="/favicon.ico"/>

		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen,projection" />
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style/shadowbox.css" type="text/css" media="screen,projection" />
		<?php wp_head(); ?>
	</head>
<body>
	    <div class="wrap">
	    	<div id="main">
	    	<!-- HEADER -->
	    	<header class="padding-fix">
	    		<div id="header-toplinks">
	    			<a href="<?php bloginfo('url'); ?>" id="xtra-link" class="century">X-TRA Contemporary Art Quarterly</a>
	    			<ul id="static-pages" class="gothic meta">
	    				<?php wp_list_pages('include=3041,3578,4592&title_li=&depth=1&sort_column=menu_order'); ?>
	    				<li><a href="https://secure.x-traonline.org/store/product/153">Subscribe</a></li>
	    			</ul>
	    		</div>
	    		<div id="logo-banner"><a href="<?php bloginfo('url'); ?>" id="logo-link"><img src="<?php bloginfo('template_url'); ?>/_img/logo.png"></a></div>
	    	</header>
	    	
	    	<div id="stickable-boundary">
	    	
	    	<!-- NAV -->
	    	<nav class="padding-fix sticker">
	    		<ul id="main-nav-links" class="century">
	    			<?php wp_list_pages('title_li=&depth=1&sort_column=menu_order&exclude=3041,3060,3578,4592,4665'); ?>
	    			<li><a href="https://secure.x-traonline.org/store/">Store</a></li>
	    		</ul>
	    		<?php get_search_form(); ?>
	    	</nav>