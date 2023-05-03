<?php
    if (!defined('ABSPATH')) { exit; }

    if (function_exists("acf_add_options_page")) {
        /* add options page */
        acf_add_options_page(array(
            'page_title'    => 'Site Options',
            'menu_title'    => 'Site Options',
            'menu_slug'     => 'siteOptions',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
        
        /* add option sub pages */
        // acf_add_options_sub_page(array(
        //     'page_title'    => 'Navigation - Main Menu',
        //     'menu_title'    => 'Navigation - Main Menu',
        //     'menu_slug'     => 'navigation_main_menu',
        //     'parent_slug'   => 'general_settings',
        //     'capability'    => 'edit_posts',
        //     'redirect'      => false
        // ));
    }