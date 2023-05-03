<?php
    if (!defined('ABSPATH')) { exit; }
    
    function registerCustomTaxonomy($slug = "", $postTypeSlugs = [""], $name_plural = "", $name_single = "") { 
        if (!$slug || !$postTypeSlugs || !$name_plural || !$name_single) { return; }
        
        register_taxonomy (
            $slug, //what its called
            $postTypeSlugs, //the post types it is included in
            array(
                'hierarchical' => true,
                'labels'       => array (
                    'name'              => _x( $name_plural, 'taxonomy general name' ),
                    'singular_name'     => _x( $name_single, 'taxonomy singular name' ),
                    'search_items'      =>  __( 'Search ' . $name_plural ),
                    'all_items'         => __( 'All ' . $name_plural ),
                    'parent_item'       => __( 'Parent ' . $name_single ),
                    'parent_item_colon' => __( $name_single . ':' ),
                    'edit_item'         => __( 'Edit ' . $name_single ),
                    'update_item'       => __( 'Update ' . $name_single ),
                    'add_new_item'      => __( 'Add New ' . $name_single ),
                    'new_item_name'     => __( 'New' .$name_single . 'Name' ),
                    'menu_name'         => __( $name_plural ),
                ),
                // Control the slugs used for this taxonomy
                'rewrite' => array (
                    'slug'         => $slug, // This controls the base slug that will display before each term
                    'with_front'   => false, // Display the category base before "/locations/"
                    'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
                ),
                'show_in_rest' => true
            )
        );
        
        return;
    }

    //Tests
     registerCustomTaxonomy("testing", ["tests"], "testing", "testing");

    