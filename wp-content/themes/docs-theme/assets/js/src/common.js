import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

// 定数読み込み
import { GSAP_DEFAULT } from "./constants";

// 目次機能用
import { initTocScrollTrigger, initTocModal } from "./toc";

/**
 * 全ページ共通のJavaScript
 */
document.addEventListener("DOMContentLoaded", () => {
  // // GSAPプラグインの登録
  gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

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
   * トップへ戻るボタン
   * @type {HTMLElement | null}
   */
  const pagetopButton = document.querySelector(".js-pagetop");

  /**
   * アクションボタンラッパー
   * @type {HTMLElement | null}
   */
  const actionButtons = document.querySelector(".js-action-buttons");

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
   * リサイズイベントの初期化
   */
  const initResizeEvent = () => {
    const mql = window.matchMedia("(min-width: 1024px)");

    mql.addEventListener("change", (e) => {
      // 画面幅が1024px以上（PCサイズ）になった瞬間だけ実行
      if (e.matches) {
        // SPメニューが開いていたら閉じる
        if (spNavWrapper?.classList.contains("is-open")) {
          closeSpMenu();
        }

        // SP検索フォームが開いていたら閉じる
        if (searchWrapper?.classList.contains("is-open")) {
          closeSpSearchForm();
        }
      }
    });
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
   * スクロール時処理
   */
  const handleScroll = () => {
    const scrollAmount = window.scrollY;

    // 300px以上スクロールしている時に「アクションボタン群」を表示させる
    if (scrollAmount >= 300) {
      actionButtons?.classList.add("is-active");
    } else {
      actionButtons?.classList.remove("is-active");
    }
  };

  /**
   * スクロールイベントの初期化
   */
  const initScrollEvent = () => {
    window.addEventListener("scroll", handleScroll);
  };

  /**
   * トップへ戻るボタンのクリックイベント
   * ScrollToPluginを使用して滑らかにスクロールさせる
   */
  const initBackToTop = () => {
    pagetopButton?.addEventListener('click', () => {
      gsap.to(window, {
        ...GSAP_DEFAULT,
        scrollTo: {
          y: 0,
          autoKill: true, // 途中でユーザーの操作があればスクロール動作を止める
        },
      });
    });
  };

  /**
   * ページ内リンクのスムーススクロール（全画面共通）
   * ScrollToPluginを使用して滑らかにスクロールさせる
   */
  const initSmoothScroll = () => {
    // hrefが「#」から始まるリンクをすべて取得( href="#" は除外)
    const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');

    anchorLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault(); // ブラウザ標準の動きをキャンセル

        const targetId = link.getAttribute('href');

        // targetIdが存在し、かつ要素が見つかる場合のみ実行
        if (targetId && targetId !== '#') {
          const targetElement = document.querySelector(targetId);

          if (targetElement) {
            // ヘッダーの高さを動的に取得
            const header = document.querySelector('.l-header');
            const headerHeight = header ? header.offsetHeight : 0;

            // ヘッダーの高さ + 少しの余白（2.4rem = 24px想定）で止める
            const offset = headerHeight + 24;

            gsap.to(window, {
              ...GSAP_DEFAULT,
              scrollTo: {
                y: targetElement,
                offsetY: offset,
                autoKill: true, // アニメーション中にユーザーがスクロール操作したら止める
              }
            });
          }
        }
      });
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
    initScrollEvent();
    initBackToTop();
    initSmoothScroll();
    initTocScrollTrigger();
    initTocModal();
  };

  init();
});