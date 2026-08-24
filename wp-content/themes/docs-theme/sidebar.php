<?php
// =========================================================================
// サイドバーテンプレート (sidebar.php)
// =========================================================================
?>

<aside class="l-sidebar">

  <section class="p-sidebar-widget p-sidebar-widget--profile">
    <div class="p-profile">
      <div class="p-profile__bg">
        <img class="p-profile__bg-image" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/sidebar/profile-bg.jpg" alt="札幌の街並み">
        <div class="p-profile__icon">
          <?php
          // アイコン画像が登録されていればそれを、なければ元の画像を表示
          $profile_icon = get_theme_mod('profile_icon');
          if ($profile_icon) :
          ?>
            <img class="p-profile__icon-image" src="<?php echo esc_url($profile_icon); ?>" alt="プロフィールアイコン">
          <?php else : ?>
            <img class="p-profile__icon-image" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/sidebar/profile-icon.png" alt="みかん箱">
          <?php endif; ?>
        </div>
      </div>

      <div class="p-profile__info">
        <?php
        // 名前の出力
        $profile_name = get_theme_mod('profile_name');
        $display_name = $profile_name ? $profile_name : 'Author: みかん箱';
        ?>
        <h2 class="p-profile__name"><?php echo esc_html($display_name); ?></h2>

        <?php
        // 紹介文の出力
        $profile_text = get_theme_mod('profile_text');
        $default_text = "北海道札幌市在住。\nweb制作技術の定着の為、記事としてまとめアウトプットしていきます。\n最近はGSAPとWordPressを勉強中です。";
        $display_text = $profile_text ? $profile_text : $default_text;
        ?>
        <p class="p-profile__text"><?php echo nl2br(esc_html($display_text)); ?></p>

        <div class="p-profile__links">
          <?php
          // GitHub URLの出力
          $profile_github = get_theme_mod('profile_github');
          $display_github = $profile_github ? $profile_github : 'https://github.com/y-nagai0725';

          // Portfolio URLの出力
          $profile_portfolio = get_theme_mod('profile_portfolio');
          $display_portfolio = $profile_portfolio ? $profile_portfolio : 'https://portfolio.mikanbako.jp/';
          ?>
          <a href="<?php echo esc_url($display_github); ?>" target="_blank" class="p-profile__link-button p-profile__link-button--github">GitHub</a>
          <a href="<?php echo esc_url($display_portfolio); ?>" target="_blank" class="p-profile__link-button p-profile__link-button--portfolio">Portfolio</a>
        </div>
      </div>
    </div>
  </section>

  <section class="p-sidebar-widget">
    <h2 class="p-sidebar-widget__title p-sidebar-widget__title--category">カテゴリー</h2>
    <ul class="p-sidebar-widget__category-list">
      <?php
      // 記事があるカテゴリーを全取得してループ
      $categories = get_categories();
      foreach ($categories as $category) :
      ?>
        <li class="p-sidebar-widget__category-item">
          <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="p-sidebar-widget__category-link">
            <span class="p-sidebar-widget__category-name"><?php echo esc_html($category->name); ?></span>
            <span class="p-sidebar-widget__category-count"><?php echo esc_html($category->count); ?></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>

  <section class="p-sidebar-widget">
    <h2 class="p-sidebar-widget__title">最近の投稿</h2>
    <div class="p-sidebar-widget__cards">
      <?php
      // 最新の5件を取得するサブループ
      $recent_query = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'no_found_rows'  => true,
      ));

      if ($recent_query->have_posts()) :
        while ($recent_query->have_posts()) : $recent_query->the_post();

          get_template_part('template-parts/card', null, array('modifier' => 'widget'));

        endwhile;
        wp_reset_postdata(); // サブループの後は必ずリセットする
      endif;
      ?>
    </div>
  </section>

  <section class="p-sidebar-widget">
    <h2 class="p-sidebar-widget__title">タグ</h2>
    <div class="p-sidebar-widget__tags-wrapper">
      <div class="p-sidebar-widget__tags">
        <?php
        // 記事があるタグを全取得してループ
        $tags = get_tags();
        if ($tags) :
          foreach ($tags as $tag) :
        ?>
            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="p-sidebar-widget__tag-link">
              <?php echo esc_html($tag->name); ?>
            </a>
        <?php
          endforeach;
        endif;
        ?>
      </div>
    </div>
  </section>

  <?php
  // ==================================================
  // 記事ページ（is_single）の時だけ、サイドバー用の目次を出力する
  // ==================================================
  if (is_single()) {
    echo get_article_toc('sidebar');
  }
  ?>

</aside>