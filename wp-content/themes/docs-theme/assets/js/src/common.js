/**
 * 全ページ共通のJavaScript
 */
document.addEventListener("DOMContentLoaded", () => {

  /**
   * ハンバーガーボタン
   * @type {HTMLElement | null}
   */
  const hamburgerButton = document.querySelector(".l-header__hamburger-button");

  /**
   * SPナビゲーションメニューを閉じるボタン
   * @type {HTMLElement | null}
   */
  const spNavCloseButton = document.querySelector(".l-header__nav-close-button");

  /**
   * SP表示時のヘッダー内の検索ボタン
   * @type {HTMLElement | null}
   */
  const spSearchButton = document.querySelector(".l-header__sp-search-button");

  /**
   * 検索フォームラッパー
   * @type {HTMLElement | null}
   */
  const searchWrapper = document.querySelector(".l-header__search-wrapper");

  /**
   * SPナビゲーションメニューラッパー
   * @type {HTMLElement | null}
   */
  const spNavWrapper = document.querySelector(".l-header__sp-nav-wrapper");

  /**
   * カテゴリーラッパー
   * @type {HTMLElement | null}
   */
  const categoryWrapper = document.querySelector(".l-header__category-wrapper");

  /**
   * SPナビゲーションメニューを開く
   */
  const openSpMenu = () => {
    spNavWrapper?.classList.add("is-open");

    // メニューを開いた時にスクロールを禁止
    document.body.style.overflow = "hidden";
  };

  /**
   * SPナビゲーションメニューを閉じる
   */
  const closeSpMenu = () => {
    spNavWrapper?.classList.remove("is-open");

    // メニューを閉じた時にスクロールを元に戻す
    document.body.style.overflow = "";
  };

  /**
   * SP検索フォームを開く
   */
  const openSpSearchForm = () => {
    spSearchButton?.classList.add("is-open");
    searchWrapper?.classList.add("is-open");
  };

  /**
   * SP検索フォームを閉じる
   */
  const closeSpSearchForm = () => {
    spSearchButton?.classList.remove("is-open");
    searchWrapper?.classList.remove("is-open");
  };

  /**
   * SP検索フォームの開閉制御
   */
  const toggleSpSearchForm = () => {
    const isOpen = spSearchButton?.classList.contains('is-open');

    if (isOpen) {
      closeSpSearchForm();
    } else {
      openSpSearchForm();
    }
  };

  /**
   * ハンバーガーボタンのイベント初期化
   */
  const initHamburgerButton = () => {
    hamburgerButton?.addEventListener("click", openSpMenu);
  };

  /**
   * SPナビゲーションメニュー閉じるボタンのイベント初期化
   */
  const initSpNavCloseButton = () => {
    spNavCloseButton?.addEventListener("click", closeSpMenu);
  };

  /**
   * SP検索ボタンのイベント初期化
   */
  const initSpSearchButton = () => {
    spSearchButton?.addEventListener("click", toggleSpSearchForm);
  };

  /**
   * SPナビゲーションメニュー内のリンククリック時にメニューを閉じる
   */
  const initSpNavLinks = () => {
    const navLinks = document.querySelectorAll('.l-header__sp-nav-link');
    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (spNavWrapper?.classList.contains('is-open')) {
          closeSpMenu();
        }
      });
    });
  };

  /**
   * デバウンス関数（連続して発火するイベントを間引きする）
   * @param {Function} func - 実行したい関数
   * @param {number} wait - 待機するミリ秒
   */
  const debounce = (func, wait) => {
    let timeout;
    return (...args) => {
      clearTimeout(timeout);
      timeout = setTimeout(() => {
        func(...args);
      }, wait);
    };
  };

  /**
   * ウィンドウリサイズ時の処理
   */
  const handleResize = () => {
    //  CSSのメディアクエリと判定が一致するように、matchMedia を使う
    if (window.matchMedia("(min-width: 1024px)").matches) {

      // SPメニューが開いていたら閉じる
      if (spNavWrapper?.classList.contains("is-open")) {
        closeSpMenu();
      }

      // SP検索フォームが開いていたら閉じる
      if (searchWrapper?.classList.contains("is-open")) {
        closeSpSearchForm();
      }
    }
  };

  /**
   * リサイズイベントの初期化
   */
  const initResizeEvent = () => {
    // 250ミリ秒（0.25秒）操作が止まったら handleResize を実行する
    window.addEventListener("resize", debounce(handleResize, 250));
  };

  /**
   * SPナビゲーションのメニュー外（背景部分）をクリックした時に閉じる
   */
  const initSpNavWrapperClick = () => {
    spNavWrapper?.addEventListener("click", (e) => {
      // クリックされた対象(e.target)が、spNavWrapper 自身（ぼやけている背景部分）だった場合のみ閉じる
      if (e.target === spNavWrapper) {
        closeSpMenu();
      }
    });
  };

  /**
   * 全体の初期化処理
   */
  const init = () => {
    initHamburgerButton();
    initSpNavCloseButton();
    initSpSearchButton();
    initSpNavLinks();
    initResizeEvent();
    initSpNavWrapperClick();
  };

  init();
});