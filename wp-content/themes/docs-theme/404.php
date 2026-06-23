<?php get_header(); ?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<main class="l-main">
  <div class="l-contents">

    <div class="l-contents__main">

      <header class="p-archive-header">
        <h1 class="p-archive-header__title">
          404 Not Found
        </h1>
      </header>

      <div class="p-not-found">
        <p class="p-not-found__text">
          お探しのページは見つかりませんでした。<br>
          一時的にアクセスできない状態にあるか、移動もしくは削除された可能性があります。<br>
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

    </div>

    <div class="l-contents__sidebar">
      <?php get_sidebar(); ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>