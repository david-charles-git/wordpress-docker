<?php
    if (!defined('ABSPATH')) { exit; }

    //Variables
    $postType_slug = "page";
    $postType_name = "Page Details";

    //Layouts
    $customCSSandJSDetailsLayouts = array (
        //Custom Page CSS
        array (
            'key'          => $postType_slug . '-customCSSandJS-1',
            'label'        => 'Custom Page CSS',
            'name'         => 'customPageCSS',
            'type'         => 'textarea',
            'column_width' => '50%',
            'prepend'      => '',
            'formatting'   => 'html',
            'instructions' => ""
        ),
        //Custom Page CSS
        array (
            'key'          => $postType_slug . '-customCSSandJS-2',
            'label'        => 'Custom Page JS',
            'name'         => 'customPageJS',
            'type'         => 'textarea',
            'column_width' => '50%',
            'prepend'      => '',
            'formatting'   => 'html',
            'instructions' => ""
        )
    );

    if (function_exists("register_field_group")) {
        register_field_group (
            array (
                'id'     => 'acf_' . $postType_slug,
                'title'  => $postType_name . ' Details',
                'fields' => array (
                    //Instructions
                    array (
                        'key'          => $postType_slug . '-instructions',
                        'label'        => 'Instruictions',
                        'name'         => 'instructions',
                        'type'         => 'group',
                        'layout'       => 'block',
                        'instructions' => "Style Guide post type documentation",
                        'sub_fields'   => array ()
                    ),
                    //Style Guide
                    array (
                        'key'           => $postType_slug . '-styleGuide',
                        'label'         => 'Style Guide',
                        'name'          => 'styleGuide',
                        'type'          => 'post_object',
                        'post_type'     => 'style-guides',
                        'taxonomy'      => [],
                        'allow_null'    => 0,
                        'multiple'      => 0,
                        'column_width'  => '100%',
                        'return_format' => 'id'
                    ),
                    //Custom CSS & JS Group
                    array (
                        'key'        => $postType_slug . '-customCSSandJS',
                        'label'      => 'Custom CSS & JS Details',
                        'name'       => 'customCSSandJS',
                        'type'       => 'group',
                        'layout'     => 'block',
                        'sub_fields' => $customCSSandJSDetailsLayouts
                    )
                ),
                'location' => array (
                    array (
                        array (
                            'param'    => 'post_type',
                            'operator' => '==',
                            'value'    => $postType_slug
                        )
                    )
                ),
                'options' => array (
                    'position'       => 'normal',
                    'layout'         => 'no_box',
                    'hide_on_screen' => array ()
                ),
                'menu_order'      => 0,
                "show_in_rest"    => true,
                "show_in_graphql" => true
            )
        );
    }