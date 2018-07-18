<?php
// Pinegrow Starter Theme 2 Theme Tweaks

// To personnalize your theme and ease further maintenance, always prefix your function names with the theme domain (= theme slug in your Pinegrow theme settings, for example st2_FunctionName). 

// Theme localization is done by replacing the (current) 'st2' string with your own theme slug. 
// Note: It is done automatically in functions.php but not for the PHP file provided with the ST2.

// Concerned files:
// - /woocommerce/ all the templates
// - /inc/custom-comments.php
// - /inc/custom-header.php
// - /inc/editor.php
// - comments.php
// - searchform.php


// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

// Customize Selective Refresh Widget
add_theme_support( 'customize-selective-refresh-widgets' );

// Set up the WordPress core custom background feature.
add_theme_support( 'custom-background', apply_filters( 'st2_custom_background_args', array(
	'default-color' => 'ffffff',
	'default-image' => '',
) ) );

// Set up the WordPress Theme logo feature.
add_theme_support( 'custom-logo' );

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'st2_change_logo_class' );

if ( ! function_exists( 'st2_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return mixed
	 */
	function st2_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"' , $html );

		return $html;
	}
}


    // EDITOR TWEAKS
    // Load Editor functions.

require get_template_directory() . '/inc/editor.php';

    // COMMENTS FORM TWEAKS
    // Custom Comments file.

require get_template_directory() . '/inc/custom-comments.php';

    // WIDGETS/SIDEBARS DISPLAY TWEAKS
    // Count number of widgets in a sidebar
    // Used to add classes to widget areas so widgets can be displayed one, two, three or four per row

if ( ! function_exists( 'st2_slbd_count_widgets' ) ) {
	function st2_slbd_count_widgets( $sidebar_id ) {
		// If loading from front page, consult $_wp_sidebars_widgets rather than options
		// to see if wp_convert_widget_settings() has made manipulations in memory.
		global $_wp_sidebars_widgets;
		if ( empty( $_wp_sidebars_widgets ) ) :
			$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
		endif;

		$sidebars_widgets_count = $_wp_sidebars_widgets;

		if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
			$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
			if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
				// Four widgets per row if there are exactly four or more than six
				$widget_classes .= ' col-md-3';
			elseif ( 6 == $widget_count ) :
				// If two widgets are published
				$widget_classes .= ' col-md-2';
			elseif ( $widget_count >= 3 ) :
				// Three widgets per row if there's three or more widgets 
				$widget_classes .= ' col-md-4';
			elseif ( 2 == $widget_count ) :
				// If two widgets are published
				$widget_classes .= ' col-md-6';
			elseif ( 1 == $widget_count ) :
				// If just on widget is active
				$widget_classes .= ' col-md-12';
			endif; 
			return $widget_classes;
		endif;
	}
}


    // WOOCOMMERCE TWEAKS
    // WooCommerce Init

    add_action( 'after_setup_theme', 'st2_woocommerce_support' );
    if ( ! function_exists( 'st2_woocommerce_support' ) ) {

    	// Declares WooCommerce theme support.
    	function st2_woocommerce_support() {
    		add_theme_support( 'woocommerce' );

    		// Add New Woocommerce 3.0.0 Product Gallery support
    		add_theme_support( 'wc-product-gallery-lightbox' );
    		add_theme_support( 'wc-product-gallery-zoom' );
    		add_theme_support( 'wc-product-gallery-slider' );

    	}
    }

    // Remove each style one by one
    add_filter( 'woocommerce_enqueue_styles', 'st2_woocommerce_styles' );
    function st2_woocommerce_styles( $enqueue_styles ) {
    	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
    	// unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
    	// unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
    	return $enqueue_styles;
    }

    // Change Sale Badge Text
    add_filter('woocommerce_sale_flash', 'st2_change_sale_content', 10, 3);
    function st2_change_sale_content($content, $post, $product){
       $content = '<span class="onsale">'.__( 'SALE', 'st2' ).'</span>';
       return $content;
    }

    // JETPACK TWEAKS
    // Jetpack setup function.
    // See: https://jetpack.me/support/infinite-scroll/
    // See: https://jetpack.me/support/responsive-videos/

add_action( 'after_setup_theme', 'st2_components_jetpack_setup' );

if ( ! function_exists ( 'st2_components_jetpack_setup' ) ) {
	function st2_components_jetpack_setup() {
		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'components_infinite_scroll_render',
			'footer'    => 'page',
		) );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );

		// Add theme support for Social Menus
		add_theme_support( 'jetpack-social-menu' );

	}
}

    // Custom render function for Infinite Scroll.

if ( ! function_exists ( 'st2_components_infinite_scroll_render' ) ) {
	function st2_components_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			if ( is_search() ) :
				get_template_part( 'loop-templates/content', 'search' );
			else :
				get_template_part( 'loop-templates/content', get_post_format() );
			endif;
		}
	}
}

if ( ! function_exists ( 'st2_components_social_menu' ) ) {
	function st2_components_social_menu() {
		if ( ! function_exists( 'jetpack_social_menu' ) ) {
			return;
		} else {
			jetpack_social_menu();
		}
	}
}


	// Temporary Hotfix for authenticated arbitrary file deletion vulnerability in the WordPress core
	// https://blog.ripstech.com/2018/wordpress-file-delete-to-code-execution/
	add_filter( 'wp_update_attachment_metadata', 'st2_rips_unlink_tempfix' );

	function st2_rips_unlink_tempfix( $data ) {
		if( isset($data['thumb']) ) {
			$data['thumb'] = basename($data['thumb']);
		}
	
		return $data;
	}

	// Theme Check Fix comment-reply
	// https://codex.wordpress.org/Migrating_Plugins_and_Themes_to_2.7/Enhanced_Comment_Display

	if ( ! function_exists( 'st2_comment_reply' ) ) {
		function st2_comment_reply() {
				if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'st2_comment_reply' );


	// Theme Check Fix sanitization callback function
	// For new projects function is included in functions.php.
	// For existing projects needs to be added at the end of functions.php
	
	function pgwp_sanitize_placeholder($input) { return $input; }


	// FUNCTIONALITY PLUGIN FEATURES

	//* Remove 'Editor' from 'Appearance' Menu.
	//* This stops users and hackers from being able to edit files from within WordPress.
	define( 'DISALLOW_FILE_EDIT', true );


	//* Add the ability to use shortcodes in widgets
	add_filter( 'widget_text', 'do_shortcode' );


	//* Prevent WordPress from compressing images
	add_filter( 'jpeg_quality', create_function( '', 'return 100;' ) );


	//* Disable any and all mention of emoji's
	//* Source code credit: http://ottopress.com/
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );


	//* Remove items from the <head> section
	remove_action( 'wp_head', 'wp_generator' );							//* Remove WP Version number
	remove_action( 'wp_head', 'wlwmanifest_link' );						//* Remove wlwmanifest_link
	remove_action( 'wp_head', 'rsd_link' );								//* Remove rsd_link
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );			//* Remove shortlink
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );	//* Remove previous/next post links


	//* Limit the number of post revisions to keep
	add_filter( 'wp_revisions_to_keep', 'st2_set_revision_max', 10, 2 );
	function st2_set_revision_max( $num, $post ) {

		$num = 5; //change 5 to match your preferred number of revisions to keep
		return $num;

	}

	//* Login Screen: Set 'remember me' to be checked
	add_action( 'init', 'st2_login_checked_remember_me' );
	function st2_login_checked_remember_me() {

	add_filter( 'login_footer', 'st2_rememberme_checked' )
	;
	}

	function st2_rememberme_checked() {

	echo "<script>document.getElementById('rememberme').checked = true;</script>";

	}

	//* Login Screen: Don't inform user which piece of credential was incorrect
	add_filter ( 'login_errors', 'st2_failed_login' );
	function st2_failed_login () {

	return 'The login information you have entered is incorrect. Please try again.';

	}

	//* Modify the admin footer text
	add_filter( 'admin_footer_text', 'st2_modify_footer_admin' );
	function st2_modify_footer_admin () {

	echo '<span id="footer-thankyou">Theme Development by <a href="http://pinegrow.com" target="_blank">Pinegrow Web Editor</a></span>';

	}

	//* Add theme info box into WordPress Dashboard
	add_action('wp_dashboard_setup', 'st2_add_dashboard_widgets' );
	function st2_add_dashboard_widgets() {

	wp_add_dashboard_widget('wp_dashboard_widget', 'Theme Details', 'st2_theme_info');

	}


	function st2_theme_info() {

	echo "<ul>
	<li><strong>Theme:</strong> Starter Theme 2</li>
	<li><strong>Developed By:</strong> Pinegrow Web Editor</li>
	<li><strong>Website:</strong> <a href='http://pinegrow.com'>pinegrow.com</a></li>
	<li><strong>Contact:</strong> <a href='mailto:support@pinegrow.com'>support@pinegrow.com</a></li>
	</ul>";

	}

	//* Add Custom Post Types to Tags and Categories in WordPress
	//* https://premium.wpmudev.org/blog/add-custom-post-types-to-tags-and-categories-in-wordpress/
	//* If you’d like to add only specific post types to listings of tags and categories you can replace the line:
	//* $post_types = get_post_types();
	//* with
	//* $post_types = array( 'post', 'your_custom_type' );
	function st2_add_custom_types_to_tax( $query ) {
	if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {

	//* Get all your post types
	$post_types = get_post_types();

	$query->set( 'post_type', $post_types );
	return $query;
	}
	}
	add_filter( 'pre_get_posts', 'st2_add_custom_types_to_tax' );

	//* Remove Jetpack Sharing Buttons to appear in Excerpts
	//* https://wordpress.org/support/topic/sharing-icons-show-after-excerpt-and-content
	function st2_jptweak_remove_exshare() {
		remove_filter( 'the_excerpt', 'sharing_display',19 );
	}
	add_action( 'loop_end', 'st2_jptweak_remove_exshare' );


	//* Jetpack Social menu
	//* https://themeshaper.com/2016/02/12/jetpack-social-menu/
	//* https://jetpack.com/support/social-menu/
	function st2_jetpackme_social_menu() {
		if ( ! function_exists( 'st2_jetpackme_social_menu' ) ) {
			return;
		} else {
			jetpack_social_menu();
		}
	}

	//* Change Jetpack Related Post Headline
	//* https://jetpack.com/support/related-posts/customize-related-posts/#headline
	function st2_jetpackme_related_posts_headline( $headline ) {
	$headline = sprintf(
	'<h3 class="jp-relatedposts-headline"><strong>%s</strong></h3>',
	esc_html( 'Similar Stuff Going On' )//change your headline here
	);
	return $headline;
	}
	add_filter( 'jetpack_relatedposts_filter_headline', 'st2_jetpackme_related_posts_headline' );

	//* Remove the Related Posts from your posts
	//* https://jetpack.com/support/related-posts/customize-related-posts/
	function st2_jetpackme_remove_rp() {
		if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
			$jprp = Jetpack_RelatedPosts::init();
			$callback = array( $jprp, 'filter_add_target_to_dom' );
			remove_filter( 'the_content', $callback, 40 );
		}
	}
	add_filter( 'wp', 'st2_jetpackme_remove_rp', 20 );


	?>