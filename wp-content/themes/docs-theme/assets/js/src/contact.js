// =========================================================================
// contact.js (お問い合わせフォーム専用の機能モジュール)
// =========================================================================

/**
 * Contact Form 7 の送信関連処理（二重送信防止＆サンクスページへのリダイレクト）
 */
export const initContactForm = () => {
  const form = document.querySelector('.wpcf7-form');
  const submitButton = document.querySelector('.p-contact-form__submit');

  // フォームと送信ボタンが存在するページ（お問い合わせページ）のみ実行
  if (!form || !submitButton) return;

  // 送信ボタンが押されたら、連打できないように disabled にする
  form.addEventListener('submit', () => {
    submitButton.disabled = true;
  });

  // メールの送信が【成功】した時の処理（リダイレクト）
  document.addEventListener('wpcf7mailsent', () => {
    // functions.phpで定義した myGlobalData からURLを取得し、Thanksページへリダイレクトさせる
    if (typeof myGlobalData !== 'undefined' && myGlobalData.thanksUrl) {
      window.location.href = myGlobalData.thanksUrl;
    }
  });

  // もし入力エラー（必須項目が空など）で送信に【失敗】した時は、ボタンの無効化を解除する
  document.addEventListener('wpcf7invalid', () => {
    submitButton.disabled = false;
  });

  // スパム判定やサーバーエラーで失敗した時もボタンの無効化を解除する
  document.addEventListener('wpcf7spam', () => {
    submitButton.disabled = false;
  });
  document.addEventListener('wpcf7mailfailed', () => {
    submitButton.disabled = false;
  });
};