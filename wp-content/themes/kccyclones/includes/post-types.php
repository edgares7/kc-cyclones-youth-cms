<?php
function create_team_member_post_type() 
{

    $labels = array(
        'name'                  => 'Team Members',
        'singular_name'         => 'Team Member',
        'menu_name'             => 'Team Members',
        'name_admin_bar'        => 'Team Members',
        'archives'              => '',
        'attributes'            => '',
        'parent_item_colon'     => '',
        'all_items'             => 'All Team Members',
        'add_new_item'          => 'Add New Team Member',
        'add_new'               => 'Add New',
        'new_item'              => 'New Team Member',
        'edit_item'             => 'Edit Team Member',
        'update_item'           => 'Update Team Member',
        'view_item'             => 'View Team Member',
        'view_items'            => 'View Team Members',
        'search_items'          => 'Search Team Member',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into Team member',
        'uploaded_to_this_item' => 'Uploaded to this Team member',
        'items_list'            => 'Team Members list',
        'items_list_navigation' => 'Team Members list navigation',
        'filter_items_list'     => 'Filter Team Members list',
    );

    $args = array(
        'label'                 => 'Team Member',
        'description'           => 'Post type to represent Team members',
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', 'revisions' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => false,
        'capability_type'       => 'page',
    );

    register_post_type( 'team_member', $args );

}

add_action( 'init', 'create_team_member_post_type', 0 );

?>