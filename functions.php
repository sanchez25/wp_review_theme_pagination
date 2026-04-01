<?php

remove_action( 'wp_head', 'wp_shortlink_wp_head' );

remove_action('wp_head', 'wp_generator');

remove_action ('wp_head', 'rsd_link');

remove_action('wp_head', 'rest_output_link_wp_head', 10);

add_action( 'init', 'wpkama_disable_embed_route', 99 );
function wpkama_disable_embed_route(){

	remove_action( 'rest_api_init', 'wp_oembed_register_route' );

	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	add_filter( 'rewrite_rules_array', function ( $rules ){

		foreach( $rules as $rule => $rewrite ){
			if( false !== strpos( $rewrite, 'embed=true' ) ){
				unset( $rules[$rule] );
			}
		}

		return $rules;
	} );
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Page options',
		'menu_title'	=> 'Options theme',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

add_action( 'after_setup_theme', function(){
	register_nav_menus( [
		'main' => 'Меню в шапке',
		'footer' => 'Меню в подвале'
	] );
} );

add_theme_support( 'post-thumbnails' );

add_theme_support(
	'custom-logo',
	array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	)
);

function delete_intermediate_image_sizes( $sizes ){
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}

add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );

function remove_image_size_attributes($html) {
	return str_replace('size-full', '', $html);
}

add_filter( 'the_content', 'remove_image_size_attributes' );

function wpassist_remove_block_library_css(){
	wp_dequeue_style('wp-block-library');
}

add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );

function my_init() {
    if ( !is_admin() ) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', false);
    }
}
add_action('init', 'my_init');

add_action( 'wp_enqueue_scripts', 'style_theme' );

function style_theme() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}

function is_amp() {
	return ($_GET['amp']) ? true : false;
}

add_filter( 'upload_mimes', 'svg_upload_allow' );

function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	if ( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ) {
		$dosvg = in_array( $real_mime, ['image/svg', 'image/svg+xml'] );
	}
	else {
		$dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );
	}

	if ($dosvg) {
		if ( current_user_can('manage_options') ) {
			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		} else {
			$data['ext']  = false;
			$data['type'] = false;
		}
	}
	return $data;
}

function wrap_content($content){

	$result = str_replace(
		array( '<h2' ), 
		array( '</section><section class="section-block"><h2' ), 
	
	$content);

	$section__counter = 1;
	$header__counter = 1;

	$result = preg_replace_callback('|<section(.*)>|Uis', function($matches) {

		global $section__counter;
		$section__counter++;

		return '<section class="section-block" id="section__'. $section__counter .'">';
	
	}, $result);

	$content = preg_replace_callback('|<h2(.*)</h2>|Uis', function($matches) use (&$headers) {

		$match = trim(strip_tags($matches[1]));
		$match = strstr($match, '>');
		$match = str_replace('>', '', $match);
		$heading = strtolower($match);
		$heading = str_replace(
			array(' ', ',', '!', '?', ':', '.','&nbsp;','(',')','¿'), 
			array('-', '','','','','','','','',''),
			$heading
		);
		
		$dash = ( is_numeric($match[0]) ? '_' : '' );

		return '<h2 id="'.$dash.$heading.'">' . $match . '</h2>';
	
	}, $result);

	$content = str_replace('</section><section class="section-block" id="section__1">', '<section class="section-block" id="section__1">', $content );
	$content .= '<div class="section-content"></div>';
	$content = str_replace('<div class="section-content"></div>', '<div class="section-content"></div></section>', $content );
	$content = str_replace('frameborder="0"', '', $content);
	return $content;

}

add_filter('the_content', 'wrap_content');

function content_banner($atts){

	$atts = shortcode_atts( array(
		'link' => '#',
		'img' => '/wp-content/uploads/2023/10/content-banner.webp',
		'alt' => 'paywall set'
	), $atts );

	$output = '<div class="banner-link">';
				if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) :
					$output .= '<button class="banner-img" on="tap:AMP.navigateTo(url=\''.$atts['link'].'\')">';
				else:
					$output .= '<button class="banner-img" onclick="window.open(\''.$atts['link'].'\')">';
				endif;
					$output .= '
						<img width="600" height="400" src="'.$atts['img'].'" alt="'.$atts['alt'].'">
					</button>
			</div>';

	return $output;

}
add_shortcode( 'content-banner', 'content_banner' );

function content_btn($atts){

	$atts = shortcode_atts( array(
		'link' => '#',
		'text' => 'تحميل',
	), $atts );

	$output = '<div class="btn-content">';
				if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) :
					$output .= '<button class="btn banner_button" on="tap:AMP.navigateTo(url=\''.$atts['link'].'\')">';
				else:
					$output .= '<button class="btn banner_button" onclick="window.open(\''.$atts['link'].'\')">';
				endif;
					$output .= '
						<span>'.$atts['text'].'</span>
					</button>
			</div>';

	return $output;

}
add_shortcode( 'content-btn', 'content_btn' );

function apk_banner($atts) {

	$atts = shortcode_atts( array(
		'link' => '#',
		'text' =>'قم بتنزيل التطبيق',
		'btn' => 'تنزيل APK',
		'color' => 'rgb(7,66,14)',
		'img' => '/wp-content/uploads/2024/09/apk-banner.webp'
	), $atts );

	$output = '<div class="apk-banner" style="background-color: '.$atts['color'].'">
				<p>'.$atts['text'].'</p>
				<img src="'.$atts['img'].'" alt="'.$atts['text'].'">';
				if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) :
					$output .= '<button class="btn banner_button" on="tap:AMP.navigateTo(url=\''.$atts['link'].'\')">';
				else:
					$output .= '<button class="btn banner_button" onclick="location.href=\''.$atts['link'].'\'">';
				endif;
					$output .= '
						<span>'.$atts['btn'].'</span>
					</button>
			</div>';

	return $output;

}
add_shortcode( 'apk-banner', 'apk_banner' );

function posts_block($atts) {

	ob_start();

	echo '<div class="offers">';
		$offers = get_field('offers', 'option');
		foreach ($offers as $offer) { ?>
			<div class="cards__items-item">
				<div class="cards__items-img" style="background-color: <?php echo $offer['logo_color']; ?>">  
					<img src="<?php echo $offer['image']; ?>" alt="<?php echo $offer['name']; ?>">
				</div>
				<div class="cards__items-rating">
					<div class="cards__items-title">
						<?php echo $offer['name']; ?>
					</div>
					<div class="stars">
						<span class="star-item">☆</span>
						<span class="star-item">☆</span> 
						<span class="star-item">☆</span> 
						<span class="star-item">☆</span> 
						<span class="star-item">☆</span> 
						<div class="stars-color" style="width: <?php echo $offer['rating']; ?>%;">
							<span class="star-item">★</span>
							<span class="star-item">★</span> 
							<span class="star-item">★</span> 
							<span class="star-item">★</span>
							<span class="star-item">★</span>
						</div>
					</div>
				</div>
				<div class="cards__items-bonus">
					<span><?php echo $offer['bonus']; ?></span>
				</div>
				<div class="cards__items-buttons">
					<button onclick="window.open('<?php echo $offer['offer_link']; ?>', '_blank')" class="btn">راهن الآن</button>
				</div>
			</div>
		<?php }
	echo '</div>';

	return ob_get_clean();

}
add_shortcode( 'posts-block', 'posts_block' );