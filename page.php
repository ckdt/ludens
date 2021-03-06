<?php
/**
 * @package		WordPress
 * @subpackage	Ludens
 * @since 		Ludens 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

$data = Timber::get_context();
$data['page'] = new TimberPost();

$templates = array( 'page-' . $post->post_name . '.twig', 'page.twig' );

// Homepage
if (is_front_page()){

	// Carousel
	$data['slider_images'] = get_field('slider_images');
	$data['slider_intro'] = get_field('slider_intro');
	$data['slider_button_label'] = get_field('slider_button_label');
	$data['slider_button_url'] = get_field('slider_button_url');

	// Programma's
	$data['programma_items'] = Timber::get_posts('post_type=programmas&post_status=publish&orderby=menu_order&order=ASC&posts_per_page=3');

	// Cases
	// Obtain cases by this filter(featured)
	$featured = array(
		'post_type' => 'cases',
		'post_status' => 'publish',
		'order' => 'DESC',
		'post_per_page' => '3',
		'meta_query' => array(
			array(
				'key' => 'featured-checkbox',
				'value' => 'yes',
			)
		)
	);

	$data['case_items'] = Timber::get_posts($featured);

	// Klanten
	$data['client_items'] = Timber::get_posts('post_type=klanten&post_status=publish&orderby=menu_order&order=ASC');

	// Quote's
	$data['quote'] = Timber::get_post('post_type=quotes&post_status=publish&orderby=rand');

	// Blog
	$blog_items = array(
		'post_type'=> 'post',
		'paged' => $paged,
		'posts_per_page'=> 3,
		'status' => 'publish',
		'order' => 'DESC',
	);
	$data['posts'] = Timber::get_posts($blog_items);//get normal posts
	$data['tweets'] = Timber::get_posts('post_type=tweet');//get tweets

	array_unshift($templates, 'home.twig');
}

Timber::render( $templates, $data );
