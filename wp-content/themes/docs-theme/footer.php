<footer class="l-footer">
  <div class="l-footer__inner">

    <div class="l-footer__logo-wrapper">
      <a class="l-footer__logo-link" href="<?php echo esc_url(home_url('/')); ?>">
        <?php echo file_get_contents(get_template_directory() . "/assets/images/logo/site-logo-white.svg") ?>
      </a>
      <p class="l-footer__message">
        Web制作技術の定着の為、<br>
        技術をアウトプット!!
      </p>
    </div>

    <nav class="l-footer__nav">
      <ul class="l-footer__nav-list">
        <?php
        $categories = get_categories();
        foreach ($categories as $category) :
          $cat_name = esc_html($category->name);
        ?>
          <li class="l-footer__nav-item">
            <a class="l-footer__nav-link l-footer__nav-link--en" href="<?php echo esc_url(get_category_link($category->term_id)); ?>" data-text="<?php echo $cat_name; ?>">
              <?php echo $cat_name; ?>
            </a>
          </li>
        <?php endforeach; ?>
        <li class="l-footer__nav-item">
          <a class="l-footer__nav-link" href="<?php echo esc_url(home_url('/contact/')); ?>" data-text="お問い合わせ">お問い合わせ</a>
        </li>
        <li class="l-footer__nav-item">
          <a class="l-footer__nav-link l-footer__nav-link--en" href="https://github.com/y-nagai0725" target="_blank" data-text="GitHub">GitHub</a>
        </li>
        <li class="l-footer__nav-item">
          <a class="l-footer__nav-link l-footer__nav-link--en" href="https://portfolio.mikanbako.jp/" target="_blank" data-text="Portfolio">Portfolio</a>
        </li>
      </ul>
    </nav>

    <div class="l-footer__copyright">
      <small class="l-footer__copyright-text">&copy; <?php echo date('Y'); ?> Mikanbako Docs.</small>
    </div>

  </div>
</footer>

<?php
// ==================================================
// スマホ用：目次モーダル本体（※記事ページのみ出力）
// ==================================================
if (is_single()) :
?>
  <div class="p-toc-modal js-toc-modal" aria-hidden="true">
    <div class="p-toc-modal__overlay js-toc-close"></div>

    <div class="p-toc-modal__content">
      <div class="p-toc-modal__header">
        <h2 class="p-toc-modal__title">目次</h2>
        <button type="button" class="p-toc-modal__close-button js-toc-close" aria-label="閉じる"></button>
      </div>

      <div class="p-toc-modal__scroll-area">
        <?php echo get_article_toc('modal'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="p-action-buttons js-action-buttons">
  <?php if (is_single()) : ?>
    <button type="button" class="c-toc-button js-toc-open" aria-label="目次を開く">
      <span class="c-toc-button__icon"></span>
      <span class="c-toc-button__text">目次</span>
    </button>
  <?php endif; ?>

  <button type="button" class="c-pagetop js-pagetop" aria-label="トップへ戻る"></button>
</div>

</div>
<?php wp_footer(); ?>
</body>

</html>