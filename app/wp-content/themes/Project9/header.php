<?php
	if (!defined('ABSPATH')) { exit; } 

	$postID          = get_the_ID();
	$styleGuideID    = getStyleGuideID($postID); //found in fucntions.php
	$styleGuideCSS   = generateStyleSheet($styleGuideID); //found in fucntions.php
	$customPostTypes = getCustomPostTypeObjects(); //found in functions.php
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<!-- Meta Data -->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php
		wp_head();
?>
		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/CSS/dist/defaultStyles.min.css" />

		<!-- Style Guide CSS -->
		<style id="styleGuideCSS" data-style-id="<?php echo $styleGuideID;?>"><?php echo $styleGuideCSS; ?></style>
	</head>

	<body <?php body_class(); ?>>
		<header>
			<!-- Sticky Banner -->
			<section class="stickyBanner background-color-black">
				<div class="background background-color-custom-3-50"></div>
				
				<div class="container-outer">
					<p class="font-display color-white fontSize-s">Screen Parameters | Screen Width: <span id="screenParameter-screenWidth" class="fontSize-s color-custom-1"></span> | Screen Height: <span id="screenParameter-screenHeight" class="fontSize-s color-custom-1"></span> | Device: <span id="screenParameter-device" class="fontSize-s color-custom-1"></span> | Page padding: <span id="screenParameter-pagePadding" class="fontSize-s color-custom-1"></span></span></p>
				</div>
			</section>

			<section class="mainNavigation background-color-black" style="padding: 60px 0 20px 0;">
				<div class="background background-color-custom-3-50"></div>

				<nav class="container-outer grid" style="grid-template-columns: repeat(<?php echo count($customPostTypes) + 1; ?>, auto); justify-content: start;">
					<p class="color-white">
						<a href="<?php echo home_url(); ?>" class="fontWeight-bold">Home</a>
					</p>
<?php
					foreach ($customPostTypes as $customPostType) {
?>
						<p class="color-white">
							<a href="<?php echo home_url() . "/" . $customPostType -> name; ?>/" class="fontWeight-bold"><?php echo $customPostType -> labels -> name; ?></a>
						</p>
<?php
					}
?>
				</nav>
			</section>
		</header>