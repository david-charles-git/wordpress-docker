<?php
    if (!defined('ABSPATH')) { exit; }

    /*
     * NOTE: it appears that the $slug nust be a string of length less than or equal to 20. 
     * NOTE: dashicons can be found here: https://developer.wordpress.org/resource/dashicons/
    */

    function regesterCustomPostType($slug = "", $name_plural = "", $name_single = "", $supportingFeatures = ["title"], $icon = "dashicons-buddicons-activity") {
        if (!$slug || !$name_plural || !$name_single) { return; }
        
        $labels = [
            "name"          => __( $name_plural, "custom-post-type-ui" ),
            "singular_name" => __( $name_single, "custom-post-type-ui" ),
        ];
        $args   = [
            "label"                 => __( $name_plural, "custom-post-type-ui" ),
            "labels"                => $labels,
            "description"           => "",
            "public"                => true,
            "publicly_queryable"    => true,
            "show_ui"               => true,
            "show_in_rest"          => true,
            "rest_base"             => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "has_archive"           => true,
            "show_in_menu"          => true,
            "show_in_nav_menus"     => true,
            "delete_with_user"      => false,
            "exclude_from_search"   => false,
            "capability_type"       => "post",
            "map_meta_cap"          => true,
            "hierarchical"          => true,
            "can_export"            => true,
            "rewrite"               => [ "slug" => $slug, "with_front" => true ],
            "query_var"             => true,
            "menu_position"         => 20,
            "menu_icon"             => $icon,
            "supports"              => $supportingFeatures,
            "show_in_graphql"       => true
        ];

        register_post_type($slug, $args);
    }
    
    //Test
    regesterCustomPostType("tests", "Tests", "Test", [ "title", "thumbnail" ]);

    