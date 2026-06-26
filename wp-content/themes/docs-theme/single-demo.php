<?php
// =========================================================================
// デモページ専用テンプレート（ヘッダー・フッターなしの真っ白なページ）
// =========================================================================
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php
  wp_head();
  ?>

  <?php
  $demo_cdn = get_post_meta(get_the_ID(), 'demo_cdn', true);
  if ($demo_cdn) {
    echo $demo_cdn;
  }
  ?>

  <style>
    html,
    body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      background-color: #ffffff;
    }
  </style>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <main class="l-demo-main">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();

        // 記事の本文（ブロックエディタで作った中身）だけを純粋に出力
        the_content();

      endwhile;
    endif;
    ?>
  </main>

  <?php
  wp_footer();
  ?>
</body>

</html>