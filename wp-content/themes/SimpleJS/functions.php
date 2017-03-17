<?php

/*  Register Scripts and Style */

function theme_register_scripts() {
    wp_enqueue_style( 'simplejs-style', get_stylesheet_uri() );
    wp_enqueue_script( 'vue', esc_url( trailingslashit( get_template_directory_uri() ) . 'node_modules/vue/dist/vue.min.js' ), array(), '', true );
    wp_enqueue_script( 'vue-router', esc_url( trailingslashit( get_template_directory_uri() ) . 'node_modules/vue-router/dist/vue-router.min.js' ), array(), '', true );
    wp_enqueue_script( 'vue-resource', esc_url( trailingslashit( get_template_directory_uri() ) . 'node_modules/vue-resource/dist/vue-resource.min.js' ), array(), '', true );
    wp_enqueue_script( 'app', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/app.js' ), array(), '', true );
    
}
add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );


/* Add menu support */
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}

/* Add post image support */
add_theme_support( 'post-thumbnails' );


/* Add custom thumbnail sizes */
if ( function_exists( 'add_image_size' ) ) {
    //add_image_size( 'custom-image-size', 500, 500, true );
}

/* Add widget support */
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name'          => 'SidebarOne',
        'id'            => 'SidebarOne',
	    'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name'          => 'SidebarTwo',
        'id'            => 'SidebarTwo',
	    'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));


/*  EXCERPT 
    Usage:
    
    <?php echo excerpt(100); ?>
*/

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
    } else {
    $excerpt = implode(" ",$excerpt);
    } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}


