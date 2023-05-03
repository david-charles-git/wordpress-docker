<?php
	if (!defined('ABSPATH')) { exit; }
	
	get_header();
?>
	<style>
		body{background-color:#000;}
	</style>
	<main class="background-color-black">
        <!-- Hero Banner --> 
        <section class="HeroBanner hasEnterExit hasParallaxBackground background-color-black">
            <div class="background background-color-black parallaxBackgroundItem" style="background-image: url(<?php echo get_stylesheet_directory_uri() . "/assets/images/background.webp"; ?>);" data-parallax-rate-y="-0.3"></div>

            <div class="container-outer">
                <div class="container-inner">
                    <h1 class="enterExitItem postTitle fontWeight-bold color-white" data-enter-exit-offset-y="200">404 - Page Not Found</h1>
                </div>
            </div>
        </section>

        <div class="spacer background-color-custom-3-50">
            <span class="desktop" style="height: <?php echo 3 * $spacerHeightDesktop; ?>px"></span>
            <span class="laptop" style="height: <?php echo 3 * $spacerHeightLaptop; ?>px"></span>
            <span class="tablet" style="height: <?php echo 3 * $spacerHeightTablet; ?>px"></span>
            <span class="mobile" style="height: <?php echo 3 * $spacerHeightMobile; ?>px"></span>
        </div>
	</main>
<?php
	get_footer();