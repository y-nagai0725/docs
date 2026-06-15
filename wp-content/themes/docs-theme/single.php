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
              <div class="p-single__meta">
                <?php
                $category = get_the_category();
                if (!empty($category)) {
                  echo '<span class="p-single__category">' . esc_html($category[0]->cat_name) . '</span>';
                }
                ?>
                <time class="p-single__date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
              </div>

              <h1 class="p-single__title"><?php the_title(); ?></h1>

              <?php if (has_tag()) : ?>
                <div class="p-single__tags">
                  <?php the_tags('<span class="p-single__tag">', '</span><span class="p-single__tag">', '</span>'); ?>
                </div>
              <?php endif; ?>

              <?php if (has_post_thumbnail()) : ?>
                <div class="p-single__thumbnail">
                  <?php the_post_thumbnail('large', array('class' => 'p-single__image')); ?>
                </div>
              <?php endif; ?>
            </header>

            <div class="p-single__body p-entry-content">
              <?php the_content(); ?>
            </div>

          </article>
          <div class="p-post-nav">
            <div class="p-post-nav__prev">
              <?php previous_post_link('%link', '前の記事へ'); ?>
            </div>
            <div class="p-post-nav__next">
              <?php next_post_link('%link', '次の記事へ'); ?>
            </div>
          </div>

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