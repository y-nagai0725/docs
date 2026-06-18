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
<button type="button" class="c-pagetop" id="js-pagetop"></button>

<?php
// ==================================================
// スマホ用：目次を開くフローティングボタン & モーダル本体
// ※記事ページのみ出力する
// ==================================================
if (is_single()) :
?>
  <button type="button" class="c-toc-button js-toc-open" aria-label="目次を開く">
    <span class="c-toc-button__icon">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
        <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z" />
      </svg>
    </span>
    <span class="c-toc-button__text">目次</span>
  </button>

  <div class="p-toc-modal js-toc-modal" aria-hidden="true">
    <div class="p-toc-modal__overlay js-toc-close"></div>

    <div class="p-toc-modal__content">
      <div class="p-toc-modal__header">
        <h2 class="p-toc-modal__title">目次</h2>
        <button type="button" class="p-toc-modal__close-button js-toc-close" aria-label="閉じる">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
          </svg>
        </button>
      </div>

      <div class="p-toc-modal__scroll-area">
        <?php echo get_article_toc('modal'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

</div>
<?php wp_footer(); ?>
</body>

</html>