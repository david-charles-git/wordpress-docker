<?php
    if (!defined('ABSPATH')) { exit; }

    //Variables
    $postName = "Default";
    $postType = "default";

    //Pagination Details
    $previousButtonContent = "Previous";
    $nextButtonContent     = "Next";
    $paginationFeedArgs    = [ 
        "postType"              => $postType,
        "previousButtonContent" => $previousButtonContent,
        "nextButtonContent"     => $nextButtonContent
    ];

    //Search Details
    $searchArgs = array (
        "postType"             => $postType,
        "postsPerSearch"       => 5,
        "searchBarPlaceholder" => "Search " . $postTitle . "..."
    );

    //Spacer heights
    $spacerHeightDesktop = 100;
    $spacerHeightLaptop  = 80;
    $spacerHeightTablet  = 50;
    $spacerHeightMobile  = 30;

    get_header();
?>    
    <main class="background-color-black">
        <!-- Hero Banner --> 
        <section class="HeroBanner hasEnterExit hasParallaxBackground background-color-black">
            <div class="background background-color-black parallaxBackgroundItem" style="background-image: url(<?php echo get_stylesheet_directory_uri() . "/assets/images/background.webp"; ?>);" data-parallax-rate-y="-0.3"></div>

            <div class="container-outer">
                <div class="container-inner">
                    <h1 class="enterExitItem postTitle fontWeight-bold color-white" data-enter-exit-offset-y="200"><?php echo $postTitle; ?></h1>
                </div>
            </div>
        </section>
        
        <div class="spacer background-color-custom-3-50">
            <span class="desktop" style="height: <?php echo $spacerHeightDesktop; ?>px"></span>
            <span class="laptop" style="height: <?php echo $spacerHeightLaptop; ?>px"></span>
            <span class="tablet" style="height: <?php echo $spacerHeightTablet; ?>px"></span>
            <span class="mobile" style="height: <?php echo $spacerHeightMobile; ?>px"></span>
        </div> 

        <!-- Search Bar -->
        <?php get_template_part('ACF/Components/SearchBars/default', null, $searchArgs); ?>

        <div class="spacer background-color-custom-3-50">
            <span class="desktop" style="height: <?php echo $spacerHeightDesktop; ?>px"></span>
            <span class="laptop" style="height: <?php echo $spacerHeightLaptop; ?>px"></span>
            <span class="tablet" style="height: <?php echo $spacerHeightTablet; ?>px"></span>
            <span class="mobile" style="height: <?php echo $spacerHeightMobile; ?>px"></span>
        </div> 

        <!-- Feed -->
        <section id="standardsFeed"> 
            <div class="background background-color-custom-3-50"></div>

            <div class="container-outer">
                <div class="container-inner">
                    <?php get_template_part('ACF/Components/PaginationFeeds/default', null, $paginationFeedArgs); ?>
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