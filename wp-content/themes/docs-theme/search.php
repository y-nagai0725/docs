<?php get_header(); ?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<main class="l-main">
  <div class="l-contents">

    <div class="l-contents__main">

      <header class="p-archive-header">
        <?php global $wp_query; ?>
        <h1 class="p-archive-header__title">
          「<?php echo esc_html(get_search_query()); ?>」の検索結果：<?php echo $wp_query->found_posts; ?>件
        </h1>
      </header>

      <?php if (have_posts()) : ?>
        <div class="p-article-list">
          <?php while (have_posts()) : the_post();
            get_template_part('template-parts/card');
          endwhile; ?>
        </div>
        <div class="c-pagination">
          <?php
          the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => '',
            'next_text' => '',
          ));
          ?>
        </div>
      <?php else : ?>
        <div class="p-search-not-found">
          <p class="p-search-not-found__text">
            申し訳ありませんが、検索キーワードに一致する記事は見つかりませんでした。<br>
            よろしければ、こちらの記事も読んでみませんか？
          </p>
        </div>

        <div class="p-article-list p-article-list--no-pagination">
          <?php
          // ランダムに4件取得するサブループ
          $random_query = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 4,
            'orderby'        => 'rand', // ランダム表示
            'no_found_rows'  => true,
          ));

          if ($random_query->have_posts()) :
            while ($random_query->have_posts()) : $random_query->the_post();

              get_template_part('template-parts/card');

            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="l-contents__sidebar">
      <?php get_sidebar(); ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>