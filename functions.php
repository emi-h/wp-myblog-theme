<?php 
add_action('init', function(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // メニューをサポート
    register_nav_menus([
        'global_nav' => 'グローバルナビゲーション',
    ]);
});

// JS・CSSファイルを読み込む
function add_files() {
	// WordPress提供のjquery.jsを読み込まない
	wp_deregister_script('jquery');
	// jQueryの読み込み
	wp_enqueue_script( 'jquery', get_template_directory_uri() .'/vendor/jquery/jquery.min.js', "", "202207", false );
	// サイト共通JS
	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), '202207', true );
	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/js/clean-blog.min.js', array( 'jquery' ), '202207', true );
	// サイト共通のCSSの読み込み
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css', "", '202207' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/vendor/fontawesome-free/css/all.min.css', "", '202207' );
	wp_enqueue_style( 'main', get_template_directory_uri() . '/css/clean-blog.min.css', "", '202207' );
	wp_enqueue_style( 'font', '//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' );
	wp_enqueue_style( 'font02', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' );
}
add_action('wp_enqueue_scripts', 'add_files');

// アイキャッチ画像がなければ、標準画像を取得する 
function get_eyecatch_with_default()
{
    if (has_post_thumbnail()):
        $id = get_post_thumbnail_id();
        $img = wp_get_attachment_image_src($id,'large');
      else:
        $img = array(get_template_directory_uri().'/img/post-bg.jpg');
      endif;

      return $img;
}