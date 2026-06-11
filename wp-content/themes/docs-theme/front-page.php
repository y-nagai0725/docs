<?php

/**
 * Template Name: Front Page
 * Description: トップページ用のテンプレートです。
 */
?>

<?php get_header(); ?>
<main class="l-main">
  <div class="l-contents">

    <div class="l-contents__main">
      <div class="p-article-list">
        <?php
        // メインループの開始
        if (have_posts()) :
          while (have_posts()) : the_post();

            // 記事カードコンポーネントを呼び出し
            get_template_part('template-parts/card');

          endwhile;
        else :
        ?>
          <p>記事がまだありません。</p>
        <?php endif; ?>
      </div>
      <div class="c-pagination">
        <?php
        the_posts_pagination(array(
          'mid_size'  => 2, // 現在のページの左右に何ページ分のリンクを表示するか
          'prev_text' => '',
          'next_text' => '',
        ));
        ?>
      </div>

    </div>

    <div class="l-contents__sidebar">
      <?php get_sidebar(); ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>