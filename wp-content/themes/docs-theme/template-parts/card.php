
<?php
// 呼び出し元から 'modifier' という引数が渡されていたらクラス名に追加する処理
$modifier_class = isset($args['modifier']) ? ' c-card--' . $args['modifier'] : '';
?>
<article class="c-card<?php echo esc_attr($modifier_class); ?>">
  <a href="<?php the_permalink(); ?>" class="c-card__link">

    <div class="c-card__thumbnail">
      <?php
      if (has_post_thumbnail()) {
        // アイキャッチ画像が設定されている場合
        the_post_thumbnail('large', array('class' => 'c-card__image'));
      } else {
        // 設定されていない場合の「No Image」画像
        echo '<img src="' . esc_url(get_template_directory_uri()) . '/assets/images/thumbnail/no-image.png" alt="No Image" class="c-card__image">';
      }
      ?>
    </div>

    <div class="c-card__body">
      <div class="c-card__meta">
        <?php
        // 記事が属する最初のカテゴリーを取得して表示
        $category = get_the_category();
        if (! empty($category)) :
        ?>
          <span class="c-card__category"><?php echo esc_html($category[0]->cat_name); ?></span>
        <?php endif; ?>

        <time class="c-card__date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
      </div>

      <h2 class="c-card__title"><?php the_title(); ?></h2>

    </div>

  </a>
</article>