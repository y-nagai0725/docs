// =========================================================================
// editor.js (WordPressブロックエディタ関連のカスタマイズ用js)
// =========================================================================

wp.domReady(function () {
  // Gutenbergの描画を待つために、定期的にチェックするタイマーをセットする
  const checkEditorInterval = setInterval(() => {

    // 最近のWordPress（iframe版）の中を探す
    const iframe = document.querySelector('iframe[name="editor-canvas"]');
    let editorWrapper = null;

    if (iframe && iframe.contentDocument) {
      // iframeの中から探す
      editorWrapper = iframe.contentDocument.querySelector('.editor-styles-wrapper');
    } else {
      // 以前のWordPress（iframeなし版）から探す
      editorWrapper = document.querySelector('.editor-styles-wrapper');
    }

    // 要素が見つかったら、クラスを追加して終了
    if (editorWrapper) {
      editorWrapper.classList.add('p-content');
      clearInterval(checkEditorInterval); // タイマーを止める
    }

  }, 500); // 0.5秒（500ミリ秒）ごとにチェックし続ける
});

// =========================================================================
// Format API: インラインの文字装飾ボタンをツールバーに追加
// =========================================================================
(function (wp) {
  const { registerFormatType, toggleFormat } = wp.richText;
  const { RichTextToolbarButton } = wp.blockEditor;
  const { createElement } = wp.element;

  // 追加したいフォーマットを配列にまとめる
  const customFormats = [
    {
      name: 'mikanbako/marker-yellow',
      title: 'マーカー（黄）',
      className: 'c-marker',
      icon: 'edit' // 鉛筆マーク
    },
    {
      name: 'mikanbako/text-red',
      title: '赤文字',
      className: 'c-text-red',
      icon: 'editor-textcolor' // テキストカラーのアイコン
    },
    {
      name: 'mikanbako/text-blue',
      title: '青文字',
      className: 'c-text-blue',
      icon: 'editor-textcolor'
    },
    {
      name: 'mikanbako/font-en',
      title: '欧文フォント',
      className: 'c-font-en',
      icon: 'editor-spellcheck' // アルファベットのチェックアイコン
    }
  ];

  // ループで登録していく
  customFormats.forEach(function (format) {
    registerFormatType(format.name, {
      title: format.title,
      tagName: 'span',
      className: format.className,
      edit: function (props) {
        return createElement(RichTextToolbarButton, {
          icon: format.icon,
          title: format.title,
          onClick: function () {
            props.onChange(toggleFormat(props.value, { type: format.name }));
          },
          isActive: props.isActive,
        });
      },
    });
  });
})(window.wp);