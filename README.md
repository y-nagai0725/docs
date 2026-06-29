# Mikanbako Docs<!-- omit in toc -->
![サイトトップ画像]()

## 目次<!-- omit in toc -->
- [概要](#概要)
- [公開URL](#公開url)
- [目的](#目的)
- [こだわったポイント](#こだわったポイント)
- [使用技術](#使用技術)
- [使用フォント](#使用フォント)
- [デザインカンプ](#デザインカンプ)
- [各画面・機能紹介](#各画面機能紹介)
  - [トップページ](#トップページ)
    - [ヘッダー](#ヘッダー)
    - [サイドバー](#サイドバー)
    - [フッター](#フッター)
  - [アーカイブページ](#アーカイブページ)
  - [検索結果ページ](#検索結果ページ)
  - [記事ページ](#記事ページ)
    - [目次自動作成機能](#目次自動作成機能)
    - [デモページ](#デモページ)
  - [お問い合わせページ](#お問い合わせページ)
  - [サンクスページ](#サンクスページ)
  - [プライバシーポリシーページ](#プライバシーポリシーページ)
  - [404ページ](#404ページ)
- [WordPressプラグイン使用による実装](#wordpressプラグイン使用による実装)
  - [Category Order and Taxonomy Terms Order](#category-order-and-taxonomy-terms-order)
  - [SEO SIMPLE PACK](#seo-simple-pack)
  - [SiteGuard WP Plugin](#siteguard-wp-plugin)
  - [WP Mail SMTP](#wp-mail-smtp)
  - [Contact Form 7](#contact-form-7)
    - [デフォルト機能の無効化と独自スタイルの適用](#デフォルト機能の無効化と独自スタイルの適用)
    - [JavaScriptに送信時処理](#javascriptに送信時処理)

## 概要

## 公開URL
[https://docs.mikanbako.jp/](https://docs.mikanbako.jp/)

## 目的

## こだわったポイント
TODO ポイント4つか5つ

## 使用技術
**フロントエンド**
* GSAP
* JavaScript
* Sass (SCSS)
* HTML

**バックエンド**
* WordPress
* PHP

**データベース**
* MySQL

**インフラ・その他**
* さくらVPS
* Apache (Webサーバー)
* Git / GitHub (バージョン管理・デプロイ)

## 使用フォント
* 和文フォント

  [Noto Sans JP](https://fonts.google.com/noto/specimen/Noto+Sans+JP)

* 欧文フォント

  [Roboto](https://fonts.google.com/specimen/Roboto)

## デザインカンプ
[Figmaページ](https://www.figma.com/design/b0P1DBetkNb2B8MXXm0zrc/blog?node-id=0-1&t=5WBI9eidphUCPWPs-1)（Figmaページへのリンクです。閲覧のみ可能です。）

※上記はベースとなったデザインカンプです。アニメーションの追加や細かなUI・レイアウトの調整は実装段階でコードを書きながらブラッシュアップを行ったため、現在の実際のサイトとは一部デザインが異なる箇所がございます。

## 各画面・機能紹介

本サイトの主要なページ構成と、各画面に実装している機能やこだわりポイントについて、実際の動き（webp動画）やスクリーンショットを交えながら紹介します。

### トップページ
![トップページの全体画像]()

>テンプレートファイル: [front-page.php](wp-content/themes/docs-theme/front-page.php)

#### ヘッダー
![ヘッダーの画像]()

>テンプレートファイル: [header.php](wp-content/themes/docs-theme/header.php)

#### サイドバー
![サイドバーの画像]()

>テンプレートファイル: [sidebar.php](wp-content/themes/docs-theme/sidebar.php)

#### フッター
![フッターの画像]()

>テンプレートファイル: [footer.php](wp-content/themes/docs-theme/footer.php)

### アーカイブページ
![アーカイブページの全体画像]()

>テンプレートファイル: [archive.php](wp-content/themes/docs-theme/archive.php)

### 検索結果ページ
![検索結果ページの全体画像]()

>テンプレートファイル: [search.php](wp-content/themes/docs-theme/search.php)

### 記事ページ
![記事ページの全体画像]()

>テンプレートファイル: [single.php](wp-content/themes/docs-theme/single.php)

#### 目次自動作成機能

>関連ファイル: [toc.php](wp-content/themes/docs-theme/inc/toc.php) / [toc.js](wp-content/themes/docs-theme/assets/js/src/toc.js)

#### デモページ
![デモページの全体画像]()

>テンプレートファイル: [single-demo.php](wp-content/themes/docs-theme/single-demo.php)

### お問い合わせページ
![お問い合わせページの全体画像]()

サイト訪問者からのご連絡を受け付けるためのコンタクトフォームです。

ユーザーが迷わず入力できるよう、必要最低限の項目でシンプルかつ分かりやすいUIにしています。

フォームの送信処理やサンクスページへの画面遷移などのシステム的な実装については、後述の「[Contact Form 7](#contact-form-7)」の項目にて詳しく解説します。

>テンプレートファイル: [page.php](wp-content/themes/docs-theme/page.php)

### サンクスページ
![サンクスページの全体画像]()

お問い合わせフォームの送信完了後に遷移するサンクスページです。

送信完了のメッセージや自動返信メールに関するご案内を表示するとともに、HOME（トップページ）へ戻るためのリンクを配置し、ユーザーが送信後も迷わずサイト内を回遊できるようにしています。

>テンプレートファイル: [page.php](wp-content/themes/docs-theme/page.php)

### プライバシーポリシーページ
![プライバシーポリシーページの全体画像]()

>テンプレートファイル: [page.php](wp-content/themes/docs-theme/page.php)

### 404ページ
![404ページの全体画像]()

>テンプレートファイル: [404.php](wp-content/themes/docs-theme/404.php)

## WordPressプラグイン使用による実装

>関連ファイル: [functions.php](wp-content/themes/docs-theme/functions.php)

### Category Order and Taxonomy Terms Order

### SEO SIMPLE PACK

### SiteGuard WP Plugin

### WP Mail SMTP

### Contact Form 7

#### デフォルト機能の無効化と独自スタイルの適用

>関連ファイル: [functions.php](wp-content/themes/docs-theme/functions.php) / [_contact-form](wp-content/themes/docs-theme/assets/scss/object/project/_contact-form.scss)

#### JavaScriptに送信時処理

>関連ファイル: [contact.js](wp-content/themes/docs-theme/assets/js/src/contact.js)