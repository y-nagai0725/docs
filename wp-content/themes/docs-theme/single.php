<?php
// =========================================================================
// 記事ページ テンプレート (single.php)
// =========================================================================
?>

<?php get_header(); ?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<main class="l-main">
  <div class="l-contents">

    <div class="l-contents__main">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post();
      ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('p-single'); ?>>

            <header class="p-single__header">
              <div class="p-single__thumbnail">
                <?php
                if (has_post_thumbnail()) {
                  // アイキャッチ画像が設定されている場合
                  the_post_thumbnail('large', array('class' => 'p-single__image'));
                } else {
                  // 設定されていない場合の「No Image」画像
                  echo '<img src="' . esc_url(get_template_directory_uri()) . '/assets/images/thumbnail/no-image.png" alt="No Image" class="p-single__image">';
                }
                ?>
              </div>

              <h1 class="p-single__title"><?php the_title(); ?></h1>

              <?php get_template_part('template-parts/article-meta'); ?>
            </header>

            <?php
            // ==================================================
            // 記事内の目次（TOC）を出力する
            // ==================================================
            echo get_article_toc();
            ?>

            <div class="p-single__body p-content">
              <?php the_content(); ?>
            </div>

            <footer class="p-single__footer">
              <?php get_template_part('template-parts/article-meta'); ?>
            </footer>

          </article>

          <?php
          // 前後の記事のデータを取得する
          $prev_post = get_previous_post();
          $next_post = get_next_post();

          // どちらかの記事が存在していれば表示する
          if ($prev_post || $next_post) :
          ?>
            <div class="p-post-nav">

              <?php
              // ==================================================
              // 前の記事（古い記事）のカードを出力
              // ==================================================
              if ($prev_post) :
              ?>
                <div class="p-post-nav__item p-post-nav__item--prev">
                  <div class="p-post-nav__label p-post-nav__label--prev">Prev</div>
                  <?php
                  // $post に前の記事のデータを入れる
                  global $post;
                  $post = $prev_post;
                  setup_postdata($post);

                  get_template_part('template-parts/card', null, array('modifier' => 'widget'));

                  // リセット処理
                  wp_reset_postdata();
                  ?>
                </div>
              <?php endif; ?>

              <?php
              // ==================================================
              // 次の記事（新しい記事）のカードを出力
              // ==================================================
              if ($next_post) :
              ?>
                <div class="p-post-nav__item p-post-nav__item--next">
                  <div class="p-post-nav__label p-post-nav__label--next">Next</div>
                  <?php
                  // $post に次の記事のデータを入れる
                  global $post;
                  $post = $next_post;
                  setup_postdata($post);

                  get_template_part('template-parts/card', null, array('modifier' => array('widget', 'reverse')));

                  wp_reset_postdata();
                  ?>
                </div>
              <?php endif; ?>

            </div>
          <?php endif; ?>

          <?php
          // =========================================================================
          // おススメ（関連）記事リンクの取得と表示（タグ優先 + カテゴリー補完）
          // =========================================================================
          $current_post_id = get_the_ID();
          $exclude_ids     = array($current_post_id); // 除外するID（まずは今の記事を除外）
          $related_posts   = array();                   // 取得した記事をストックする
          $max_posts       = 4;                         // 最大表示件数
          global $post;

          // --------------------------------------------------
          // 「同じタグ」を持つ記事をランダムで探す
          // --------------------------------------------------
          $tags = wp_get_post_tags($current_post_id);
          if ($tags) {
            $tag_ids = array();
            foreach ($tags as $tag) {
              $tag_ids[] = $tag->term_id;
            }

            $args_tags = array(
              'tag__in'        => $tag_ids,
              'post__not_in'   => $exclude_ids,
              'posts_per_page' => $max_posts,
              'orderby'        => 'rand', // ランダム取得
            );
            $query_tags = new WP_Query($args_tags);

            if ($query_tags->have_posts()) {
              while ($query_tags->have_posts()) {
                $query_tags->the_post();
                $related_posts[] = $post; // 記事データを入れる
                $exclude_ids[]   = get_the_ID(); // 次の検索で重複しないように除外リストに追加
              }
              wp_reset_postdata();
            }
          }

          // --------------------------------------------------
          // 4件に満たない場合、「同じカテゴリー」の記事で補完する
          // --------------------------------------------------
          $remaining_count = $max_posts - count($related_posts); // あと何件足りないか計算
          if ($remaining_count > 0) {
            $categories = get_the_category($current_post_id);
            if ($categories) {
              $category_ids = array();
              foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
              }

              $args_cats = array(
                'category__in'   => $category_ids,
                'post__not_in'   => $exclude_ids,
                'posts_per_page' => $remaining_count,
                'orderby'        => 'rand',
              );
              $query_cats = new WP_Query($args_cats);

              if ($query_cats->have_posts()) {
                while ($query_cats->have_posts()) {
                  $query_cats->the_post();
                  $related_posts[] = $post; // 記事を追加
                }
                wp_reset_postdata();
              }
            }
          }

          // --------------------------------------------------
          // 取得した記事を出力する
          // --------------------------------------------------
          if (! empty($related_posts)) :
          ?>
            <section class="p-related-articles">
              <h2 class="p-related-articles__title">関連記事</h2>
              <div class="p-related-articles__list">
                <?php
                foreach ($related_posts as $post) :
                  setup_postdata($post);

                  get_template_part('template-parts/card');

                endforeach;
                wp_reset_postdata();
                ?>
              </div>
            </section>
          <?php endif; ?>

      <?php
        endwhile;
      endif;
      ?>
    </div>

    <div class="l-contents__sidebar">
      <?php get_sidebar(); ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>