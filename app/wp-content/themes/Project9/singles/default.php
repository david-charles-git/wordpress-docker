<?php
    if (!defined('ABSPATH')) { exit; }

    //Post Details
    $postID            = get_the_ID();
    $postType          = str_replace("-", " ", get_post_type());
    $postTypePermalink = get_post_type_archive_link(get_post_type());
    $postTitle         = get_the_title();

    //Spacer heights
    $spacerHeightDesktop = 100;
    $spacerHeightLaptop  = 80;
    $spacerHeightTablet  = 50;
    $spacerHeightMobile  = 30;

    get_header();
?>
    <style>
    
    </style>

    <main>
        <!-- Hero Banner -->
        <section class="heroBanner background-color-black">
            <div class="background hasParallax" style="background-image: url(<?php echo get_stylesheet_directory_uri() . "/assets/images/background.webp"; ?>);" data-parallax-rate="-0.25" data-parallax-offset="0"></div>

            <div class="container-outer grid">
                <div class="left">
                    <a href="<?php echo $postTypePermalink; ?>" class="fontSize-s fontStyle-uppercase font-display color-white"><?php echo $postType; ?></a>

                    <h1 class="fontWeight-bold color-white"><?php echo $postTitle; ?></h1>
                </div>

                <div class="right">
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