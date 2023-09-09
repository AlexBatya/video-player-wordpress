<?php 
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/main.css' );

    wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js');
	wp_register_script( 'jquery-mobile', 'https://code.jquery.com/mobile/1.5.0/jquery.mobile-1.5.0.min.js');

	wp_enqueue_script( 'jquery');
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'));
    
});

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');

add_filter( 'upload_mimes', 'svg_upload_allow' );

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}
add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = ''){

	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	}
	else {
		$dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
	}

	if( $dosvg ){

		if( current_user_can('manage_options') ){

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		else {
			$data['ext']  = false;
			$data['type'] = false;
		}

	}

	return $data;
}?>