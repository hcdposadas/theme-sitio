<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 29/12/17
 * Time: 10:04
 */

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


function meta_hcd() {

	$output = "<meta name=\"description\" content=\"Honorable Concejo Deliberante de la Ciudad de Posadas\" />";
	$output .= "<meta name=\"robots\" content=\"ALL\" />";
	$output .= "<meta name=\"revisit-after\" content=\"15 days\" />";
	$output .= "<meta name=\"classification\" content=\"Government\" />";
	$output .= "<meta name=\"resource-type\" content=\"document\" />";
	$output .= "<meta name=\"abstract\" content=\"HCD Posadas\" />";
	$output .= "<meta name=\"copyright\" content=\"(CC-BY) Honorable Concejo Deliberante de la Ciudad de Posadas\" />";
	$output .= "<meta name=\"doc-rights\" content=\"Los contenidos del sitio del Honorable Concejo Deliberante de la Ciudad de Posadas están licenciados bajo Creative Commons Reconocimiento 2.5 Argentina License\" />";
	$output .= "<meta name=\"doc-type\" content=\"Public\" />";
	$output .= "<meta name=\"doc-publisher\" content=\"Honorable Concejo Deliberante de la Ciudad de Posadas\" />";
	$output .= "<meta name=\"Keywords\" content=\"Honorable Concejo Deliberante de la Ciudad de Posadas, Provincia de Misiones, Misiones, Gobierno, Gobierno de Misiones, Ecología, Turismo, Posadas, San Ignacio, Iguazú, Cataratas, Forestación, Yerba Mate, Te, Reservas Naturales, HCD\" />";
	$output .= "<meta name=\"Author\" content=\"Matias Solis de la Torre\" />";

	echo $output;
}

add_action( 'wp_head', 'meta_hcd' );

function poncho_enqueue_styles() {

}

add_action( 'wp_enqueue_scripts', 'poncho_enqueue_styles' );

function poncho_enqueue_scripts() {

	wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/bundle.js', [], '1.0.0', false );

	wp_enqueue_style( 'hcd-css', get_stylesheet_directory_uri() . '/hcd.css' );

}

add_action( 'wp_enqueue_scripts', 'poncho_enqueue_scripts' );


add_theme_support( 'custom-logo',
	array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );


add_action( 'customize_register', 'registrar_customizer' );
function registrar_customizer( WP_Customize_Manager $wp_customize ) {
	require_once get_stylesheet_directory() . '/inc/dropdown-categoria.php';
	$wp_customize->add_section( 'homepage',
		array(
			'title' => esc_html_x( 'Homepage Options', 'customizer section title', 'poncho' ),
		) );
	$wp_customize->add_setting( 'poncho_categoria_dropdown',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		) );
	$wp_customize->add_control( new DropdownCategoria( $wp_customize, 'poncho_categoria_dropdown', array(
		'section'     => 'homepage',
		'label'       => esc_html__( 'Categoría', 'poncho' ),
		'description' => esc_html__( 'Elegi una categoría para que sea mostrada en esta sección.', 'poncho' ),
		// Uncomment to pass arguments to wp_dropdown_categories()
		//'dropdown_args' => array(
		//	'taxonomy' => 'post_tag',
		//),
	) ) );
}


function poncho_pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo '<div class="row"><div class="col-md-12 text-center">';
		echo '<ul class="pagination">';
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<li><a href='" . get_pagenum_link( 1 ) . "'><span aria-hidden='true'>&laquo; Primero</span></a></li>";
		}
		if ( $paged > 1 && $showitems < $pages ) {
			echo "<li><a href='" . get_pagenum_link( $paged - 1 ) . " aria-label='Anterior'><span aria-hidden='true'>«</span></a></li>";
		}

		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? "<li class='active'><a href='#'>" . $i . "</a></li>" : "<li><a href='" . get_pagenum_link( $i ) . "' >" . $i . "</a></li>";
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo "<li><a href='" . get_pagenum_link( $paged + 1 ) . "' aria-label='Siguiente'><span aria-hidden='true'>»</span></a></li>";
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<li><a href='" . get_pagenum_link( $pages ) . "'><span aria-hidden='true'>Último &raquo;</span></a></li>";
		}
		echo "</ul>\n";
		echo '</div></div>';
	}
}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}


// widgets
function poncho_placas_widget( $content ) {
	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
		dynamic_sidebar( 'poncho-placas' );
	}

	return $content;
}

//add_filter( 'the_content', 'poncho_placas_widget' );

//register_sidebar( array(
//	'id'            => 'poncho-placas',
//	'name'          => 'Placas',
//	'description'   => 'Widgets Placas',
//	'before_widget' => '<div class="col-md-4">',
//	'after_widget'  => '</div>',
//) );


// widgets
function social_widget( $content ) {
	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
		dynamic_sidebar( 'poncho-social' );
	}

	return $content;
}

add_filter( 'the_content', 'social_widget' );

register_sidebar( array(
	'id'            => 'poncho-social',
	'name'          => 'Social',
	'description'   => 'Widgets Social',
	'before_widget' => '<div class="col-md-4">',
	'after_widget'  => '</div>',
) );

add_filter( 'flamingo_map_meta_cap', function( $meta_caps ) {
	$meta_caps = array_merge( $meta_caps, array(
		'flamingo_edit_inbound_message' => 'flamingo_inbound',
		'flamingo_edit_inbound_messages' => 'flamingo_inbound',
	) );

	return $meta_caps;
} );

/* cambios nuevos */

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');

add_theme_support( 'post-thumbnails' );

add_filter( 'use_default_gallery_style', '__return_false' );

add_filter('onesignal_send_notification', 'onesignal_send_notification_filter', 10, 4);
function onesignal_send_notification_filter($fields, $new_status, $old_status, $post) {
	$fields_pod = $fields;
    $fields_pod['isAndroid'] = true;
    $fields_pod['isIos'] = true;
    $fields_pod['isAnyWeb'] = false;
    $fields_pod['isWP'] = false;
    $fields_pod['isAdm'] = false;
    $fields_pod['isChrome'] = false;
	$fields_pod['data'] = array(
        "myappurl" => $fields_pod['url'],
		"id" => $post->ID,
		"tipo" => 'post'
	); 
	/* Unset the URL to prevent opening the browser when the notification is clicked */
    unset($fields_pod['url']);
    return $fields_pod;
}

add_filter('onesignal_exclude_post', 'onesignal_exclude_post_filter', 10, 3);
function onesignal_exclude_post_filter($new_status, $old_status, $post) {
	if ( in_category('Comisiones') ) {
  		return true;
	}
}

/* agregar custom fields a json */

add_filter('json_api_encode', 'json_api_encode_acf');

function json_api_encode_acf($response) 
{
    if (isset($response['posts'])) {
        foreach ($response['posts'] as $post) {
            json_api_add_acf($post); // Add specs to each post
        }
    } 
    else if (isset($response['post'])) {
        json_api_add_acf($response['post']); // Add a specs property
    }

    return $response;
}

function json_api_add_acf(&$post) 
{
    $post->acf = get_fields($post->id);
}

/*
 * Add Menu Order field to portfolio
 */
 
add_action('admin_init', 'mpe_add_portfolio_page_attributes');
function mpe_add_portfolio_page_attributes(){
 
    add_post_type_support( 'autoridad', 'page-attributes' );
 
}

?>