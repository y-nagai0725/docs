<?php
// =========================================================================
// テーマの基本的な設定
// =========================================================================
function tech_blog_theme_setup() {
  // <title>タグを自動出力する
  add_theme_support( 'title-tag' );

  // アイキャッチ画像を有効化する
  add_theme_support( 'post-thumbnails' );

  // HTML5のマークアップを許可する
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script'
  ) );
}
add_action( 'after_setup_theme', 'tech_blog_theme_setup' );


// =========================================================================
// CSS / JavaScript の読み込み
// =========================================================================
function tech_blog_enqueue_scripts() {
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
    filemtime( get_template_directory() . '/assets/css/style.css' ) // キャッシュ対策
  );
}
add_action( 'wp_enqueue_scripts', 'tech_blog_enqueue_scripts' );