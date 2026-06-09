<?php
// =========================================================================
// テーマの基本的な設定
// =========================================================================
function tech_blog_theme_setup()
{
  // <title>タグを自動出力する
  add_theme_support('title-tag');

  // アイキャッチ画像を有効化する
  add_theme_support('post-thumbnails');

  // HTML5のマークアップを許可する
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script'
  ));
}
add_action('after_setup_theme', 'tech_blog_theme_setup');


// =========================================================================
// CSS / JavaScript の読み込み
// =========================================================================
function tech_blog_enqueue_scripts()
{
  // Google Fonts の読み込み (Noto Sans JP と Roboto)
  wp_enqueue_style(
    'google-fonts',
    'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Roboto:wght@400;700&display=swap',
    array(),
    null
  );

  // コンパイルされたメインのCSSファイルの読み込み
  wp_enqueue_style(
    'tech-blog-style',
    get_template_directory_uri() . '/assets/css/style.css',
    array('google-fonts'), // Google Fontsを先に読み込む
    filemtime(get_template_directory() . '/assets/css/style.css') // キャッシュ対策
  );

  // 共通JavaScriptの読み込み
  wp_enqueue_script(
    'tech-blog-common',
    get_template_directory_uri() . '/assets/js/dist/bundle.js',
    array(),
    filemtime(get_template_directory() . '/assets/js/dist/bundle.js'),
    true
  );
}
add_action('wp_enqueue_scripts', 'tech_blog_enqueue_scripts');

// =========================================================================
// その他の設定・カスタマイズ
// =========================================================================

// Contact Form 7: 自動整形（<p>や<br>の挿入）を無効化
add_filter('wpcf7_autop_or_not', '__return_false');

// Contact Form 7: デフォルトCSSの読み込みを無効化
add_filter('wpcf7_load_css', '__return_false');

// WordPress: 画像の自動縮小機能（長辺2560px制限）を無効化
add_filter('big_image_size_threshold', '__return_false');

// WordPress: 管理画面バーを非表示化
add_filter('show_admin_bar', '__return_false');