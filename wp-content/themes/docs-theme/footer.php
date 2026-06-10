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
        <li class="l-footer__nav-item">
          <a class="l-footer__nav-link" href="#" data-text="カテゴリー名">カテゴリー名</a>
        </li>
        <li class="l-footer__nav-item">
          <a class="l-footer__nav-link" href="#" data-text="カテゴリー名">カテゴリー名</a>
        </li>
        <li class="l-footer__nav-item">
          <a class="l-footer__nav-link" href="#" data-text="カテゴリー名">カテゴリー名</a>
        </li>
        <li class="l-footer__nav-item">
          <a class="l-footer__nav-link" href="#" data-text="カテゴリー名">カテゴリー名</a>
        </li>
        <li class="l-footer__nav-item">
          <a class="l-footer__nav-link" href="#" data-text="カテゴリー名">カテゴリー名</a>
        </li>
        <li class="l-footer__nav-item">
          <a class="l-footer__nav-link" href="#" data-text="カテゴリー名">カテゴリー名</a>
        </li>
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
</div>
<?php wp_footer(); ?>
</body>

</html>