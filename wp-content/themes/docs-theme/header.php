<?php
// =========================================================================
// ヘッダーテンプレート (header.php)
// =========================================================================
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head();
  ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div class="l-wrapper">
    <header class="l-header">
      <div class="l-header__inner">
        <?php
        // トップページなら 'h1'、それ以外は 'div' にする
        $logo_tag = (is_front_page() || is_home()) ? 'h1' : 'div';
        ?>
        <<?php echo $logo_tag; ?> class="l-header__logo">
          <a class="l-header__logo-link" href="<?php echo esc_url(home_url('/')); ?>">
            <img class="l-header__logo-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo/site-logo-black.svg" alt="Mikanbako Docs">
          </a>
        </<?php echo $logo_tag; ?>>
        <div class="l-header__actions">
          <div class="l-header__category-wrapper">
            <span class="l-header__category-heading">カテゴリー</span>
            <ul class="l-header__category-list">
              <?php
              // 記事があるカテゴリーを全取得してループ
              $categories = get_categories();
              foreach ($categories as $category) :
              ?>
                <li class="l-header__category-item">
                  <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="l-header__category-link"><?php echo esc_html($category->name); ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="l-header__search-wrapper">
            <form class="l-header__search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
              <input class="l-header__search-input" type="text" name="s" id="s" placeholder="記事検索キーワード" value="<?php echo get_search_query(); ?>">
              <button class="l-header__search-button" type="submit"></button>
            </form>
          </div>
          <div class="l-header__contact-wrapper">
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="l-header__contact-link">
              お問い合わせ
            </a>
          </div>
          <button class="l-header__sp-search-button"></button>
          <button class="l-header__hamburger-button"></button>
        </div>
      </div>
      <div class="l-header__sp-nav-wrapper">
        <nav class="l-header__sp-nav">
          <div class="l-header__nav-close-button-wrapper">
            <button class="l-header__nav-close-button"></button>
          </div>
          <ul class="l-header__sp-nav-list">
            <li class="l-header__sp-nav-item">
              <a href="<?php echo esc_url(home_url('/')); ?>" class="l-header__sp-nav-link">ホーム</a>
            </li>
            <li class="l-header__sp-nav-item">
              <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="l-header__sp-nav-link">お問い合わせ</a>
            </li>
            <?php
            foreach ($categories as $category) :
            ?>
              <li class="l-header__sp-nav-item">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="l-header__sp-nav-link l-header__sp-nav-link--en"><?php echo esc_html($category->name); ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </nav>
      </div>
    </header>