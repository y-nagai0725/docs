<?php get_header(); ?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<main class="l-main">
  <div class="l-contents">

    <div class="l-contents__main">

      <header class="p-archive-header">
        <h1 class="p-archive-header__title"><?php the_archive_title(); ?></h1>
      </header>
      <div class="p-article-list">
        <?php
        if (have_posts()) :
          while (have_posts()) : the_post();
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
          'mid_size'  => 2,
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