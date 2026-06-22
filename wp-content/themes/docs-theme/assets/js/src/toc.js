// =========================================================================
// toc.js (目次専用の機能モジュール)
// =========================================================================

import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

// 定数読み込み
import { GSAP_DEFAULT } from "./constants";

/**
 * PC用：目次のカレント表示処理
 * @returns
 */
export const initTocScrollTrigger = () => {
  const tocLinks = document.querySelectorAll('.js-toc-link');

  // 目次がないページ（トップページなど）では、ここで処理を終了する
  if (tocLinks.length === 0) return;

  const headingsData = [];

  tocLinks.forEach(link => {
    // href属性（#index-1など）を取得する
    // 例: "http://example.com/#index-1" -> "#index-1"
    const targetUrl = link.getAttribute('href');
    const targetId = targetUrl.substring(targetUrl.indexOf('#'));

    // targetIdが正しく取得できているか、また、そのIDを持つ要素が存在するか確認
    if (targetId && targetId !== '#') {
      const heading = document.querySelector(targetId);
      if (heading) {
        headingsData.push({
          linkItem: link.parentElement, // リンクの親要素のli要素にクラスの付け替えをする為
          heading: heading
        });
      }
    }
  });

  headingsData.forEach((data, index) => {
    const nextData = headingsData[index + 1];

    ScrollTrigger.create({
      trigger: data.heading,
      start: "top 20%",
      endTrigger: nextData ? nextData.heading : "html",
      end: nextData ? "top 20%" : "bottom top",
      toggleClass: {
        targets: data.linkItem,
        className: "is-active"
      }
    });
  });
};

/**
 * SP/Tab用：目次モーダルの開閉アニメーション設定
 * @returns
 */
export const initTocModal = () => {
  // 目次表示ボタン
  const openBtn = document.querySelector('.js-toc-open');

  // オーバーレイと閉じるボタンの両方を取得
  const closeBtns = document.querySelectorAll('.js-toc-close');

  // モーダル
  const modal = document.querySelector('.js-toc-modal');

  // モーダル内のリンク
  const modalLinks = document.querySelectorAll('.p-toc-modal-list__link');

  // モーダルやボタンが存在しないページ（トップページなど）では処理をスキップ
  if (!openBtn || !modal) return;

  // GSAPタイムラインの準備
  const tl = gsap.timeline({ paused: true });

  tl.to(modal, {
    autoAlpha: 1,
    duration: 0.4,
    ease: GSAP_DEFAULT.ease,
  });

  // モーダルを開く処理
  const openModal = () => {
    document.body.style.overflow = 'hidden'; // スクロール禁止
    modal.setAttribute('aria-hidden', 'false');
    tl.play(); // アニメーション再生
  };

  // モーダルを閉じる処理
  const closeModal = () => {
    document.body.style.overflow = ''; // スクロール禁止を解除
    modal.setAttribute('aria-hidden', 'true');
    tl.reverse(); // アニメーションを逆再生して隠す
    openBtn.focus();
  };

  // 目次表示ボタンをクリックした時に開く
  openBtn.addEventListener('click', openModal);

  // 閉じるボタン（×）と背景（オーバーレイ）をクリックした時に閉じる
  closeBtns.forEach(btn => {
    btn.addEventListener('click', closeModal);
  });

  // 目次のリンクをクリックして移動した時も、モーダルを閉じる
  modalLinks.forEach(link => {
    link.addEventListener('click', closeModal);
  });

  // 1024px以上かどうかを判定するメディアクエリの準備
  const mql = window.matchMedia("(min-width: 1024px)");

  // ウィンドウ幅が1024px以上になったときに、モーダルを閉じる
  mql.addEventListener("change", (e) => {
    // 画面幅が1024px以上になり、かつモーダルが開いている（aria-hiddenがfalse）場合
    if (e.matches && modal.getAttribute('aria-hidden') === 'false') {

      // スクロール禁止を解除して、GSAPの逆再生でモーダルを隠す
      document.body.style.overflow = '';
      modal.setAttribute('aria-hidden', 'true');
      tl.reverse();
    }
  });

  /**
   * スクロールイベントの初期化
   */
  window.addEventListener("scroll", () => {
    // スクロール量
    const scrollAmount = window.scrollY;

    // 300px以上スクロールしている時に「目次表示ボタン」を表示させる
    if (scrollAmount >= 300) {
      openBtn.classList.add("is-active");
    } else {
      openBtn.classList.remove("is-active");
    }
  });
};