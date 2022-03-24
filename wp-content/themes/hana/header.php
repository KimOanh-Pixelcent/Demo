<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/layout.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	<?php wp_head(); ?>
</head>
<header>
	<div class="logo k-text-center" style="background-color: pink; ">
		<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-tam.png" alt=""></a>
	</div>
</header>
<div id="search">
	<form action="<?php echo site_url(); ?>" method="get" id="search-frm" role="search" class="k-text-center">
	    <input type="search" name="s" value="<?php the_search_query(); ?>" placeholder="Nhập từ khóa để tìm kiếm" />
	    <input type="submit" value="Search">
	</form>
</div>
<body>
	
