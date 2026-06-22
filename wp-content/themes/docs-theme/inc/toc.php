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
 * 目次のHTMLを生成して返す関数
 * $context: 'article' (デフォルト・記事内用) または 'sidebar' (サイドバー用) または 'modal' (sp, tab表示時用)
 */
function get_article_toc($context = 'article')
{
  global $post;
  if (empty($post)) return '';

  $content = strip_shortcodes($post->post_content);
  preg_match_all('/<(h[2-4]).*?>(.*?)<\/\1>/i', $content, $matches);

  if (empty($matches[0])) {
    return '';
  }

  $b_class = 'p-toc'; // デフォルトは記事内（article）
  if ($context === 'sidebar') {
    $b_class = 'p-toc-sidebar';
  } elseif ($context === 'modal') {
    $b_class = 'p-toc-modal-list';
  }

  $html = '<div class="' . $b_class . '">';
  if ($context !== 'modal') {
    $html .= '<div class="' . $b_class . '__title">目次</div>';
  }
  $html .= '<ul class="' . $b_class . '__list">';

  $counter  = 1;
  $count_h2 = 0;
  $count_h3 = 0;
  $count_h4 = 0;

  foreach ($matches[1] as $index => $tag) {
    $text = strip_tags($matches[2][$index]);
    $id = 'index-' . $counter;
    $tag_lower = strtolower($tag);

    $number_text = '';
    if ($tag_lower === 'h2') {
      $count_h2++;
      $count_h3 = 0;
      $count_h4 = 0;
      $number_text = $count_h2 . '.';
    } elseif ($tag_lower === 'h3') {
      $count_h3++;
      $count_h4 = 0;
      $number_text = $count_h2 . '.' . $count_h3 . '.';
    } elseif ($tag_lower === 'h4') {
      $count_h4++;
      $number_text = $count_h2 . '.' . $count_h3 . '.' . $count_h4 . '.';
    }

    $level_class = $b_class . '__item--' . $tag_lower;

    $html .= '<li class="' . $b_class . '__item ' . $level_class . '">';

    // カレント表示の付け外しをするために、'js-toc-link' クラスをつけておく
    $html .= '<a href="#' . $id . '" class="' . $b_class . '__link js-toc-link">';

    // 記事内用（article）の時だけ、連番の数字を出力する
    if ($context === 'article') {
      $html .= '<span class="' . $b_class . '__number">' . $number_text . '</span> ';
    }

    $html .= '<span class="' . $b_class . '__text">' . $text . '</span>';
    $html .= '</a>';
    $html .= '</li>';

    $counter++;
  }

  $html .= '</ul>';
  $html .= '</div>';

  return $html;
}
