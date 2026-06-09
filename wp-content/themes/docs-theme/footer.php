<footer class="l-footer" style="background-color: #1BB4D4; color: #FFFFFF; padding: 4rem 2rem; text-align: center; margin-top: 5rem;">
  <div class="l-footer__inner">

    <!-- 1. フッターロゴ -->
    <div class="l-footer__logo" style="margin-bottom: 2rem;">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #FFFFFF; text-decoration: none; font-family: 'M PLUS Rounded 1c', sans-serif; font-size: 2.4rem; font-weight: bold;">
        Mikanbako Docs
      </a>
    </div>

    <!-- 2. フッターナビゲーション -->
    <nav class="l-footer__nav" style="margin-bottom: 2rem;">
      <ul style="list-style: none; padding: 0; display: flex; justify-content: center; gap: 2rem; font-size: 1.4rem;">
        <li><a href="<?php echo esc_url(home_url('/')); ?>" style="color: #FFFFFF; text-decoration: none;">ホーム</a></li>
        <li><a href="#" style="color: #FFFFFF; text-decoration: none;">カテゴリー</a></li>
        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color: #FFFFFF; text-decoration: none;">お問い合わせ</a></li>
        <li><a href="#" style="color: #FFFFFF; text-decoration: none;">GitHub</a></li>
        <li><a href="#" style="color: #FFFFFF; text-decoration: none;">Portfolio</a></li>
      </ul>
    </nav>

    <!-- 3. コピーライト -->
    <div class="l-footer__copyright">
      <small style="font-size: 1.2rem;">&copy; <?php echo date('Y'); ?> Mikanbako Docs.</small>
    </div>

    <!-- 4. ページトップへ戻るボタン（後でJSで動かす用） -->
    <div class="l-footer__pagetop">
      <a href="#" class="c-pagetop" style="position: fixed; bottom: 2rem; right: 2rem; background-color: #FFFFFF; color: #1BB4D4; width: 4rem; height: 4rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-weight: bold;">
        ^
      </a>
    </div>

  </div>
</footer>

<?php wp_footer(); // 必須：JavaScriptやWordPressのシステムコード（管理バーなど）が出力される場所
?>
</body>

</html>