<?php
if ( ! function_exists( 'st2_setup' ) ) :

function st2_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    /* Pinegrow generated Load Text Domain Begin */
    load_theme_textdomain( 'st2', get_template_directory() . '/languages' );
    /* Pinegrow generated Load Text Domain End */

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 825, 510, true );

    // Add menus.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'st2' ),
        'social'  => __( 'Social Links Menu', 'st2' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    /*
     * Enable support for Post Formats.
     */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
    ) );
}
endif; // st2_setup

add_action( 'after_setup_theme', 'st2_setup' );


if ( ! function_exists( 'st2_init' ) ) :

function st2_init() {


    // Use categories and tags with attachments
    register_taxonomy_for_object_type( 'category', 'attachment' );
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );

    /*
     * Register custom post types. You can also move this code to a plugin.
     */
    /* Pinegrow generated Custom Post Types Begin */

    /* Pinegrow generated Custom Post Types End */

    /*
     * Register custom taxonomies. You can also move this code to a plugin.
     */
    /* Pinegrow generated Taxonomies Begin */

    /* Pinegrow generated Taxonomies End */

}
endif; // st2_setup

add_action( 'init', 'st2_init' );


if ( ! function_exists( 'st2_widgets_init' ) ) :

function st2_widgets_init() {

    /*
     * Register widget areas.
     */
    /* Pinegrow generated Register Sidebars Begin */

    register_sidebar( array(
        'name' => __( 'Bottom Full', 'st2' ),
        'id' => 'footerfull',
        'description' => 'Full bottom widget with dynamic grid',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s '. st2_slbd_count_widgets( 'footerfull' ) .'">',
        'after_widget' => '</div><!-- .footer-widget -->',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'A1', 'st2' ),
        'id' => 'a1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widgettitle">',
        'after_title' => '</h1>'
    ) );

    register_sidebar( array(
        'name' => __( 'A2', 'st2' ),
        'id' => 'a2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widgettitle">',
        'after_title' => '</h1>'
    ) );

    /* Pinegrow generated Register Sidebars End */
}
add_action( 'widgets_init', 'st2_widgets_init' );
endif;// st2_widgets_init



if ( ! function_exists( 'st2_customize_register' ) ) :

function st2_customize_register( $wp_customize ) {
    // Do stuff with $wp_customize, the WP_Customize_Manager object.

    /* Pinegrow generated Customizer Controls Begin */

    $wp_customize->add_section( 'footer_settings', array(
        'title' => __( 'ST2 Footer Settings', 'st2' ),
        'description' => __( 'Footer Settings', 'st2' ),
        'priority' => '2'
    ));

    $wp_customize->add_section( 'header_settings', array(
        'title' => __( 'ST2 Header Settings', 'st2' ),
        'description' => __( 'Header Settings', 'st2' ),
        'priority' => '1'
    ));

    $wp_customize->add_section( 'theme_settings', array(
        'title' => __( 'ST2 Theme Settings', 'st2' ),
        'description' => __( 'Theme Settings > CAUTION: Work in Progress', 'st2' ),
        'priority' => '0'
    ));
    $pgwp_sanitize = function_exists('pgwp_sanitize_placeholder') ? 'pgwp_sanitize_placeholder' : null;

    $wp_customize->add_setting( 'jumbotron_heading_color', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'jumbotron_heading_color', array(
        'label' => __( 'Jumbotron Heading Color', 'st2' ),
        'type' => 'color',
        'section' => 'header_settings'
    ) ) );

    $wp_customize->add_setting( 'footer_img3', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'footer_img3', array(
        'label' => __( 'Payment Icon', 'st2' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'footer_settings'
    ) ) );

    $wp_customize->add_setting( 'footer_img4', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'footer_img4', array(
        'label' => __( 'Payment Icon', 'st2' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'footer_settings'
    ) ) );

    $wp_customize->add_setting( 'footer_img5', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'footer_img5', array(
        'label' => __( 'Payment Icon', 'st2' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'footer_settings'
    ) ) );

    $wp_customize->add_setting( 'footer_img6', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'footer_img6', array(
        'label' => __( 'Payment Icon', 'st2' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'footer_settings'
    ) ) );

    $wp_customize->add_setting( 'footer_img7', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'footer_img7', array(
        'label' => __( 'Payment Icon', 'st2' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'footer_settings'
    ) ) );

    $wp_customize->add_setting( 'footer_img8', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'footer_img8', array(
        'label' => __( 'Payment Icon', 'st2' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'footer_settings'
    ) ) );

    $wp_customize->add_setting( 'footer_text', array(
        'type' => 'theme_mod',
        'default' => __( '&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est', 'st2' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'footer_text', array(
        'label' => __( 'Footer Content', 'st2' ),
        'type' => 'textarea',
        'section' => 'footer_settings'
    ));

    $wp_customize->add_setting( 'footer_img', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'footer_img', array(
        'label' => __( 'Footer Image2', 'st2' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'footer_settings'
    ) ) );

    $wp_customize->add_setting( 'footer_img2', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'footer_img2', array(
        'label' => __( 'Footer Image', 'st2' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'footer_settings'
    ) ) );

    $wp_customize->add_setting( 'footer_text', array(
        'type' => 'theme_mod',
        'default' => 'Proudly powered by WordPress | Theme: Starter Theme 2 by Pinegrow 2018. (Version: 0.0.0)',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'footer_text', array(
        'label' => __( 'Footer Content', 'st2' ),
        'type' => 'textarea',
        'section' => 'footer_settings'
    ));

    /* Pinegrow generated Customizer Controls End */

}
add_action( 'customize_register', 'st2_customize_register' );
endif;// st2_customize_register


if ( ! function_exists( 'st2_enqueue_scripts' ) ) :
    function st2_enqueue_scripts() {

        /* Pinegrow generated Enqueue Scripts Begin */

    wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'carousel_init', get_template_directory_uri() . '/assets/js/carousel_init.js', null, null, true );

    wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.js', null, null, true );

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', null, null, true );

    wp_enqueue_script( 'reporter', 'https://scripts.usehawk.com/5b8bc7985f431a00597e787a/reporter.min.js?a=5b8bc7685f431a00597e7875', null, null, true );

    /* Pinegrow generated Enqueue Scripts End */

        /* Pinegrow generated Enqueue Styles Begin */

    wp_deregister_style( 'style' );
    wp_enqueue_style( 'style', get_bloginfo('stylesheet_url'), false, null, 'all');

    wp_deregister_style( 'bootstrap' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.css', false, null, 'all');

    wp_deregister_style( 'woocommerce' );
    wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css', false, null, 'all');

    wp_deregister_style( 'imagehover' );
    wp_enqueue_style( 'imagehover', 'https://cdnjs.cloudflare.com/ajax/libs/imagehover.css/1.0/css/imagehover.min.css', false, null, 'all');

    wp_deregister_style( 'hovermin' );
    wp_enqueue_style( 'hovermin', 'https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css', false, null, 'all');

    wp_deregister_style( 'style-1' );
    wp_enqueue_style( 'style-1', 'https://fonts.googleapis.com/css?family=Abhaya+Libre:400,500,600,700,800', false, null, 'all');

    wp_deregister_style( 'style-2' );
    wp_enqueue_style( 'style-2', 'https://fonts.googleapis.com/css?family=Anaheim', false, null, 'all');

    wp_deregister_style( 'style-3' );
    wp_enqueue_style( 'style-3', 'https://fonts.googleapis.com/css?family=Abel', false, null, 'all');

    wp_deregister_style( 'custom' );
    wp_enqueue_style( 'custom', get_template_directory_uri() . '/custom.css', false, null, 'all');

    wp_deregister_style( 'theme' );
    wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css', false, null, 'all');

    wp_deregister_style( 'style-4' );
    wp_enqueue_style( 'style-4', 'https://fonts.googleapis.com/css?family=Roboto', false, null, 'all');

    wp_deregister_style( 'animate' );
    wp_enqueue_style( 'animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css', false, null, 'all');

    /* Pinegrow generated Enqueue Styles End */

    }
    add_action( 'wp_enqueue_scripts', 'st2_enqueue_scripts' );
endif;

/*
 * Resource files included by Pinegrow.
 */
/* Pinegrow generated Include Resources Begin */
require_once "inc/bootstrap/wp_bootstrap4_navwalker.php";

    /* Pinegrow generated Include Resources End */

/* Don't add custom your custom snippets here, but use inc/custom.php */
/* ST2 Include Resources Begin */
require_once "inc/custom.php";

?>
