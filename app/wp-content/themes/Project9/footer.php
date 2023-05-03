<?php
	if (!defined('ABSPATH')) { exit; } 
	
	$postID       = get_the_ID();
	$styleGuideID = getStyleGuideID($postID); //found in fucntions.php
	$styleGuideJS = generateStyleSheetDependantScripts($styleGuideID); //found in fucntions.php
?>		
	<footer>
		<div id="toTop">
			<div class="background background-color-black"></div>

			<button class="font-display background-color-custom-1 color-white fontWeight-bold circle" onclick="goToPageTop()"></button>
		</div>
<?php
		wp_footer();
?>
		<!-- Style Guide JS -->
		<script id="styleGuideJS"><?php echo $styleGuideJS; ?></script>

		<!-- Scripts -->
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/JS/dist/JQuery.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/JS/dist/ElementFunctions.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/JS/dist/EnterExitFunctions.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/JS/dist/ParallaxFunctions.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/JS/dist/ParallaxBackgroundFunctions.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/JS/dist/CarouselFunctions.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/JS/dist/SearchBarFunctions.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/JS/dist/LoadMoreFunctions.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/JS/dist/defaultScripts.min.js"></script>
<?php
		if (have_rows('page-customCSSandJS', $postID)) {
			while (have_rows('page-customCSSandJS', $postID)) {
				the_row();

				$customCSS = get_sub_field("customPageCSS");
				$customJS = get_sub_field("customPageJS");
			}
?>
			<style><?php echo $customCSS; ?></style>

			<script><?php echo $customJS; ?></script>
<?php
			wp_reset_postdata();
		}
?>
	</footer>
</body>
</html>