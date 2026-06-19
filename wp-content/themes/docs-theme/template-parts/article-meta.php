<?php
$is_footer = false;
if (isset($args['type']) && $args['type'] === 'footer') {
  $is_footer = true;
}
?>

<div class="p-article-meta">
  <?php if (!$is_footer): ?>
    <div class="p-article-meta__time-wrapper">
      <?php
      $post_date = get_the_date('Y-m-d');
      $update_date = get_the_modified_date('Y-m-d');
      ?>
      <?php if ($post_date === $update_date): ?>
        <time class="p-article-meta__date p-article-meta__date--post" datetime="<?php echo $post_date; ?>"><?php echo $post_date; ?></time>
      <?php else: ?>
        <time class="p-article-meta__date p-article-meta__date--post" datetime="<?php echo $post_date; ?>"><?php echo $post_date; ?></time>
        <time class="p-article-meta__date p-article-meta__date--modified" datetime="<?php echo $update_date; ?>"><?php echo $update_date; ?></time>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php
  $category = get_the_category();
  if (!empty($category)) {
    $category_url = esc_url(get_category_link($category[0]->term_id));
    $category_name = esc_html($category[0]->cat_name);
    echo '<a class="p-article-meta__category-link" href="' . $category_url . '">' . $category_name . '</a>';
  }
  ?>
  <?php if (has_tag()) : ?>
    <?php the_tags('<ul class="p-article-meta__tag-list"><li class="p-article-meta__tag">', '</li><li class="p-article-meta__tag">', '</li></ul>'); ?>
  <?php endif; ?>
</div>