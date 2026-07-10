<?php
// =========================================================================
// デモリンクカード用テンプレートパーツ (demo-card.php)
// ショートコード [demo id="xxx"] にて呼び出されるデモページへのリンクを出力します。
// =========================================================================
?>
<article class="c-card c-card--in-article c-card--demo">
  <a href="<?php the_permalink(); ?>" class="c-card__link" target="_blank" rel="noopener">

    <div class="c-card__thumbnail">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/thumbnail/demo-image.png" alt="Demo Image" class="c-card__image">
    </div>

    <div class="c-card__body">
      <div class="c-card__meta">
        <span class="c-card__category c-card__category--demo">Demo</span>
        </div>

      <h2 class="c-card__title"><?php the_title(); ?></h2>
    </div>

  </a>
</article>