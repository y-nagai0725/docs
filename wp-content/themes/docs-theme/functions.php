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

  // エディタースタイル機能を有効化
  add_theme_support('editor-styles');

  // コンパイル済みのCSSファイルを読み込む
  add_editor_style(get_template_directory_uri() . '/assets/css/style.css');
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
    array('google-fonts', 'prism-style'), // Google Fonts, prism.css を先に読み込む
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

  // prism.css
  wp_enqueue_style(
    'prism-style',
    get_template_directory_uri() . '/assets/css/prism.css',
    array(),
    filemtime(get_template_directory() . '/assets/css/prism.css')
  );

  // prism.js
  wp_enqueue_script(
    'prism-script',
    get_template_directory_uri() . '/assets/js/prism.js',
    array(),
    filemtime(get_template_directory() . '/assets/js/prism.js'),
    true
  );

  if (is_page('contact')) {
    // PHPからJSへデータを渡す（サンクスページのURL等）
    wp_localize_script('tech-blog-common', 'myGlobalData', array(
      'thanksUrl' => esc_url(home_url('/thanks/'))
    ));
  }
}
add_action('wp_enqueue_scripts', 'tech_blog_enqueue_scripts');

// =========================================================================
// その他の設定・カスタマイズ
// =========================================================================

/**
 * アーカイブタイトルの余計な文字（「カテゴリー:」など）を削除
 */
add_filter('get_the_archive_title', function ($title) {
  if (is_category()) {
    $title = single_cat_title('', false);
  } elseif (is_tag()) {
    $title = single_tag_title('', false);
  }
  return $title;
});

// Contact Form 7: 自動整形（<p>や<br>の挿入）を無効化
add_filter('wpcf7_autop_or_not', '__return_false');

// Contact Form 7: デフォルトCSSの読み込みを無効化
add_filter('wpcf7_load_css', '__return_false');

// WordPress: 画像の自動縮小機能（長辺2560px制限）を無効化
add_filter('big_image_size_threshold', '__return_false');

// WordPress: 管理画面バーを非表示化
add_filter('show_admin_bar', '__return_false');

/**
 * ブロックエディタ専用のJavaScriptを読み込む
 */
add_action('enqueue_block_editor_assets', function () {
  wp_enqueue_script(
    'mikanbako-editor-script',
    get_template_directory_uri() . '/assets/js/editor.js',
    array('wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-rich-text', 'wp-element', 'wp-block-editor'),
    filemtime(get_template_directory() . '/assets/js/editor.js'),
    true // フッターで読み込む
  );
});

/**
 * 検索キーワードが未入力（空文字）の場合、トップページへリダイレクト
 */
add_action('template_redirect', function () {
  // 検索ページ（is_search）で、かつ検索クエリが空の場合
  if (is_search() && empty(get_search_query())) {
    wp_safe_redirect(home_url('/'));
    exit;
  }
});

/**
 * カスタム投稿タイプ「デモ（demo）」の登録
 */
add_action('init', function () {
  register_post_type('demo', array(
    'label'         => 'デモページ',
    'public'        => true,
    'has_archive'   => false, // デモの一覧ページは不要なのでfalse
    'menu_position' => 5,     // 管理画面の「投稿」のすぐ下に配置
    'menu_icon'     => 'dashicons-laptop', // ノートパソコンのアイコン
    'supports'      => array('title', 'editor', 'custom-fields'),
    'show_in_rest'  => true,  // ブロックエディタ（Gutenberg）を有効化
  ));
});

// =========================================================================
// 段落（p）のブロックスタイル登録
// =========================================================================
$paragraph_block_styles = array(
  'warning' => '警告',
  'caution' => '注意',
  'correct' => '正解',
  'note'    => 'ノート',
  'hint'    => 'ヒント',
);

foreach ($paragraph_block_styles as $slug => $label) {
  // アイコンなしパターンの登録
  register_block_style('core/paragraph', array(
    'name'  => 'box-' . $slug,
    'label' => $label . '（アイコンなし）',
  ));

  // アイコンありパターンの登録
  register_block_style('core/paragraph', array(
    'name'  => 'box-' . $slug . '-icon',
    'label' => $label . '（アイコンあり）',
  ));
}

// =========================================================================
// リスト（ul/ol）のブロックスタイル登録
// =========================================================================
$list_styles = array(
  'default' => 'スタイル無し',
  'check' => 'チェック',
  'dot'   => 'ドット',
  'number' => '数字',
  'step' => 'ステップ'
);

foreach ($list_styles as $slug => $label) {
  register_block_style('core/list', array(
    'name'  => 'list-' . $slug,
    'label' => $label,
  ));
}

// =========================================================================
// テーブル（table）のブロックスタイル登録
// =========================================================================
$table_styles = array(
  'header-bg'    => '1行目背景',
  'first-col-bg' => '1列目背景',
  'stripe'       => 'ストライプ'
);

foreach ($table_styles as $slug => $label) {
  register_block_style('core/table', array(
    'name'  => 'table-' . $slug,
    'label' => $label,
  ));
}

// =========================================================================
// ショートコードの登録：ブログカード（関連記事）
// =========================================================================
function mikanbako_card_shortcode($atts)
{
  $atts = shortcode_atts(array(
    'id' => '', // デフォルトは空にする
  ), $atts, 'card');

  $post_id = intval($atts['id']);

  // IDが指定されていない場合は何も表示しない
  if (empty($post_id)) {
    return '';
  }

  // 指定されたIDの記事データを探す
  $args = array(
    'p'           => $post_id,    // IDを指定
    'post_type'   => 'post',      // 通常の投稿記事
    'post_status' => 'publish',   // 公開済みの記事
  );
  $query = new WP_Query($args);

  // 記事が見つかった場合
  if ($query->have_posts()) {

    // ここから出力されるHTMLを画面にすぐ出さずに、一旦ストックしておく
    ob_start();

    while ($query->have_posts()) {
      $query->the_post();

      // .c-card コンポーネントを呼び出す
      get_template_part('template-parts/card', null, array('modifier' => 'in-article'));
    }

    // リセット処理
    wp_reset_postdata();

    // ストックしておいたHTMLを戻り値として返す
    return ob_get_clean();
  }

  // 記事が見つからなかった場合は何も返さない
  return '';
}

// 'card' という名前のショートコードを登録
add_shortcode('card', 'mikanbako_card_shortcode');

// =========================================================================
// 各種機能ファイルの読み込み
// =========================================================================
require_once get_template_directory() . '/inc/toc.php';
