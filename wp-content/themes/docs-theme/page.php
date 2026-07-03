<?php
// =========================================================================
// 固定ページ テンプレート (page.php)
// =========================================================================
?>

<?php get_header(); ?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<main class="l-main">
  <div class="l-contents">

    <div class="l-contents__main">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

          <article class="p-page">
            <header class="p-archive-header">
              <h1 class="p-archive-header__title"><?php the_title(); ?></h1>
            </header>

            <div class="p-page__content p-content">
              <?php the_content(); ?>
            </div>
          </article>

      <?php endwhile;
      endif; ?>
    </div>

    <div class="l-contents__sidebar">
      <?php get_sidebar(); ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>