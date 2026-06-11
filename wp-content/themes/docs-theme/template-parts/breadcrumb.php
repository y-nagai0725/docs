<nav class="c-breadcrumb" aria-label="Breadcrumb">
  <div class="c-breadcrumb__inner">
    <ul class="c-breadcrumb__list">

      <li class="c-breadcrumb__item">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="c-breadcrumb__link">ホーム</a>
      </li>

      <?php
      // 検索結果ページの場合
      if (is_search()) :
      ?>
        <li class="c-breadcrumb__item">
          <span class="c-breadcrumb__current">「<?php echo esc_html(get_search_query()); ?>」の検索結果</span>
        </li>

      <?php
      // 記事ページ（Single）の場合
      elseif (is_single()) :
        // 記事が属するカテゴリーを取得
        $categories = get_the_category();
        if (! empty($categories)) {
          // 最初のカテゴリーを表示
          $category = $categories[0];
          echo '<li class="c-breadcrumb__item">';
          echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="c-breadcrumb__link">' . esc_html($category->name) . '</a>';
          echo '</li>';
        }
      ?>
        <li class="c-breadcrumb__item">
          <span class="c-breadcrumb__current"><?php the_title(); ?></span>
        </li>

      <?php
      endif;
      ?>

    </ul>
  </div>
</nav>