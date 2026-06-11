<aside class="l-sidebar">

  <section class="p-sidebar-widget p-sidebar-widget--profile">
    <div class="p-profile">
      <div class="p-profile__bg">
        <img class="p-profile__bg-image" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/sidebar/profile-bg.jpg" alt="札幌の街並み">
        <div class="p-profile__icon">
          <img class="p-profile__icon-image" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/sidebar/profile-icon.png" alt="みかん箱">
        </div>
      </div>
      <div class="p-profile__info">
        <h2 class="p-profile__name">Author: みかん箱</h2>
        <p class="p-profile__text">
          北海道札幌市在住。<br>
          web制作技術の定着の為、記事としてまとめアウトプットしていきます。<br>
          最近はGSAPとWordPressを勉強中です。
        </p>
        <div class="p-profile__links">
          <a href="https://github.com/y-nagai0725" target="_blank" class="p-profile__link-button">GitHub</a>
          <a href="https://portfolio.mikanbako.jp/" target="_blank" class="p-profile__link-button">Portfolio</a>
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

          get_template_part('template-parts/card', null, array('modifier' => 'horizontal'));

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

</aside>