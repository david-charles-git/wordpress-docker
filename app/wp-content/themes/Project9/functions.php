<?php
	if (!defined('ABSPATH')) { exit; }

	// WP settings
	@ini_set('upload_max_size', '64M');
	@ini_set('post_max_size', '64M');
	@ini_set('max_execution_time', '300');

	// Allow Feature Images
	add_theme_support('post-thumbnails');

	// Include Custom Post Types
	include get_template_directory() . '/ACF/PostTypeBuilders/postTypeBuilder.php';

	// Include Custom Taxonomies
	include get_template_directory() . '/ACF/TaxonomyBuilders/taxonomyBuilder.php'; 

	// Include Page Builders
	include get_template_directory() . '/ACF/PageBuilders/allPosts.php';
	include get_template_directory() . '/ACF/PageBuilders/optionPages.php';

	// Style Guide Functions
	include get_template_directory() . '/PHP/StyleGuideFunctions.php';
    
    // Read More Functions
	include get_template_directory() . '/PHP/ReadMoreFunctions.php';

	// Allow File Types to be uploaded
	function cc_mime_types($mimes) {
		$mimes['svg']   = 'image/svg+xml';
		$mimes['webp']  = 'image/webp';
		$mimes['woff']  = 'application/x-font-woff';
		$mimes['woff2'] = 'application/x-font-woff2';

		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');
	
	// Allow Webp Images to be previewed in WP
	function webp_is_displayable($result, $path) {
		if ($result === false) {
			$displayable_image_types = array(IMAGETYPE_WEBP);
			$info                    = @getimagesize($path);

			if (empty($info)) {
				$result = false;

			} elseif (!in_array($info[2], $displayable_image_types)) {
				$result = false;
				
			} else {
				$result = true;
			}
		}

		return $result;
	}
	add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);
   
    // Use Different Directories
    function useDifferentSingleDirectory($template) {
        foreach (get_post_types() as $postType) {
            if (is_singular($postType)) {
                if ($_template = locate_template('singles/single-' . $postType . '.php')) { $template = $_template; }
            }
        }            
     
        return $template;
    }
    function useDifferentArchiveDirectory($template) {
        foreach (get_post_types() as $postType) {
            if (is_post_type_archive($postType)) {
                if ($_template = locate_template('archives/archive-' . $postType . '.php')) { $template = $_template; }
            }
        }            
     
        return $template;
    }
    add_filter('template_include', 'useDifferentSingleDirectory');
    add_filter('template_include', 'useDifferentArchiveDirectory');

    // Get Custom Post Types
    function getCustomPostTypeObjects() {
        $args               = array ('public' => true);
        $output             = 'objects'; // 'names' or 'objects' (default: 'names')
        $operator           = 'and'; // 'and' or 'or' (default: 'and')
        $allPostTypes       = get_post_types($args, $output, $operator);
        $customPostTypeObjects    = [];

        foreach ($allPostTypes as $postType) {
            $postName = $postType -> name;
            $exclusions = ["post", "page", "attachment"];

            if (array_search($postName, $exclusions) > -1) { continue; }

            $customPostTypeObjects[$postName] = $postType;
        }

        return $customPostTypeObjects;
    }
    function getCustomPostTypeNames() {
        $args               = array ('public' => true);
        $output             = 'objects'; // 'names' or 'objects' (default: 'names')
        $operator           = 'and'; // 'and' or 'or' (default: 'and')
        $allPostTypes       = get_post_types($args, $output, $operator);
        $customPostTypeNames    = [];

        foreach ($allPostTypes as $postType) {
            $postName = $postType -> name;
            $exclusions = ["post", "page", "attachment"];

            if (array_search($postName, $exclusions) > -1) { continue; }

            $customPostTypeNames[$postName] = str_replace("-", " ", $postType -> labels -> name);
        }

        return $customPostTypeNames;
    }

    // Get Active Plugins
    function getActivePlugins() {
        if (!function_exists('get_plugins')) { require_once ABSPATH . 'wp-admin/includes/plugin.php'; }

        $allPlugins    = get_plugins();
        $activePlugins = get_option('active_plugins');
        $plugins       = [];

        foreach ($activePlugins as $index => $plugin) {
            if (array_key_exists($plugin, $allPlugins)){
                $pluginName = $allPlugins[ $plugin ][ 'Name' ];

                $plugins[str_replace(" ", "-", $pluginName)] = $pluginName;
            }
        }

        return $plugins;
    }

    // Get Pagination Bar
    function getPaginationBar($postQuery = null, $previousButtonContent = "", $nextButtonContent = "") {
        if (!$postQuery) { return; }

        $totalPages = $postQuery -> max_num_pages;
        $bigInteger = 999; // need an unlikely integer
    
        if ($totalPages > 1) {
            $currentPage       = max(1, get_query_var('paged'));
            $paginationBarArgs = array (
                'base'      => str_replace($bigInteger, '%#%', esc_url(get_pagenum_link($bigInteger))),
                'format'    => '?paged=%#%',
                'current'   => $currentPage,
                'total'     => $totalPages,
                'prev_text' => $previousButtonContent,
                'next_text' => $nextButtonContent,
                'end_size'  => 1,
                'mid_size'  => 1
            );

            $paginationBar = "<div class='paginationBar'><nav class='align-center'>" . paginate_links($paginationBarArgs) . "</nav></div>";

            return $paginationBar;
        }
    }

    //Search Function
    function getSearchResults() {
        if (isset($_GET)) {
            $response  = "";
            $postQuery = new WP_Query(array (
                'post_type'      => $_GET['postType'],
                'posts_per_page' => $_GET['postsPerPage'],
                's'              => $_GET['postSearch'],
                'orderby'        => "title",
                'order'          => "ASC"
            ));

            if ($postQuery -> have_posts()) {
                while ($postQuery -> have_posts()) {
                    $postQuery -> the_post();

                    $response .= "<div class='searchResult' data-search-result-permalink='" . get_the_permalink() . "' onclick='setSeachParameters()'>";
                    $response .="<p class='color-white linkText'>" . get_the_title() . "</p>";
                    $response .= "</div>";
                }

                wp_reset_postdata();
            }

            echo $response;
        }

        wp_die();
    }
    add_action("wp_ajax_getSearchResults", "getSearchResults");
    add_action("wp_ajax_nopriv_getSearchResults", "getSearchResults");

    //Load More Function
    function getLoadMoreResults() {
        if (isset($_GET)) {
            $content       = "";
            $postQueryArgs = array (
                'post_type'      => $_GET['postType'],
                'posts_per_page' => $_GET['postsPerPage'],
                'offset'         => $_GET['postOffset'],
                'orderby'        => "title",
                'order'          => "ASC"
            );

            if ($_GET['serachValue']) { $postQueryArgs['s'] = $_GET['serachValue']; }

            $postQuery = new WP_Query($postQueryArgs);

            if ($postQuery -> have_posts()) {
                while ($postQuery -> have_posts()) {
                    $postQuery -> the_post();
                    
                    $content .= "<div class='item grid align-center background-color-black' data-id='" . get_the_ID() . "'>";
                    $content .= "<div class='background' style='background-image: url(" . get_the_post_thumbnail_url(get_the_ID(), "full") . "'></div>";
                    $content .= "<a href='" . get_the_permalink() . "' class='linkWrapper'></a>";
                    $content .= "<div class='inner'>";
                    $content .= "<a class='font-display fontSize-h5 color-white fontWeight-bold' href='" . get_the_permalink() . "'>" . get_the_title() . "</a>";
                    $content .= "</div>";
                    $content .= "</div>";
                }

                wp_reset_postdata();
            }

            $response = [
                "allPostsDispalyed" => count($postQuery -> posts) + $_GET['postOffset'] >= $postQuery -> found_posts,
                "content"           => $content
            ];

            echo json_encode($response);
        }

        wp_die();
    }
    add_action("wp_ajax_getLoadMoreResults", "getLoadMoreResults");
    add_action("wp_ajax_nopriv_getLoadMoreResults", "getLoadMoreResults");