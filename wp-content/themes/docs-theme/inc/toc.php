<?php
// =========================================================================
// 目次（TOC: Table of Contents）の自動生成機能
// =========================================================================

/**
 * 本文（the_content）の見出し（h2, h3, h4）にIDを付与する
 */
add_filter('the_content', function ($content) {
  // 記事ページ以外はそのまま返す
  if (!is_single()) {
    return $content;
  }

  // h2, h3, h4 を探し出す正規表現のパターン
  $pattern = '/<(h[2-4])(.*?)>(.*?)<\/\1>/i';

  $counter = 1;
  // 本文中の見出しを順番に見つけて、id="index-1" のようにIDを追加して書き換える
  $content = preg_replace_callback($pattern, function ($matches) use (&$counter) {
    $tag   = $matches[1]; // h2, h3, h4
    $attrs = $matches[2]; // classなどの属性
    $text  = $matches[3]; // 見出しのテキスト

    $id = 'index-' . $counter;
    $counter++;

    return '<' . $tag . ' id="' . $id . '"' . $attrs . '>' . $text . '</' . $tag . '>';
  }, $content);

  return $content;
});

/**
 * 目次のHTMLを生成して返す関数（single.phpで呼び出す）
 */
function get_article_toc()
{
  global $post;
  if (empty($post)) return '';

  // 記事の本文データから、ショートコードタグを取り除く
  $content = strip_shortcodes($post->post_content);

  // 本文から h2, h3, h4 を抽出
  preg_match_all('/<(h[2-4]).*?>(.*?)<\/\1>/i', $content, $matches);

  // 見出しが1つもなければ空を返して目次を生成しない
  if (empty($matches[0])) {
    return '';
  }

  // 目次の一番外側のHTMLを組み立てていく
  $html = '<div class="p-toc">';
  $html .= '<div class="p-toc__title">目次</div>';
  $html .= '<ul class="p-toc__list">';

  $counter  = 1;
  $count_h2 = 0; // h2の連番用
  $count_h3 = 0; // h3の連番用
  $count_h4 = 0; // h4の連番用

  foreach ($matches[1] as $index => $tag) {
    $text = strip_tags($matches[2][$index]);
    $id = 'index-' . $counter;
    $tag_lower = strtolower($tag);

    // ==================================================
    // 連番を生成する
    // ==================================================
    $number_text = '';
    if ($tag_lower === 'h2') {
      $count_h2++;
      $count_h3 = 0; // h2が出たらh3とh4をリセット
      $count_h4 = 0;
      $number_text = $count_h2 . '.';
    } elseif ($tag_lower === 'h3') {
      $count_h3++;
      $count_h4 = 0; // h3が出たらh4をリセット
      $number_text = $count_h2 . '.' . $count_h3 . '.';
    } elseif ($tag_lower === 'h4') {
      $count_h4++;
      $number_text = $count_h2 . '.' . $count_h3 . '.' . $count_h4 . '.';
    }

    $level_class = 'p-toc__item--' . $tag_lower;

    $html .= '<li class="p-toc__item ' . $level_class . '">';
    $html .= '<a href="#' . $id . '" class="p-toc__link">';
    $html .= '<span class="p-toc__number">' . $number_text . '</span> ' . $text;
    $html .= '</a>';
    $html .= '</li>';

    $counter++;
  }

  $html .= '</ul>';
  $html .= '</div>';

  return $html;
}
