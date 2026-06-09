import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    // 出力先のフォルダ
    outDir: 'assets/js/dist',
    // 出力する前にフォルダの中身を空にする
    emptyOutDir: true,
    rollupOptions: {
      // 読み込むベースとなるファイル（エントリーポイント）
      input: 'assets/js/src/common.js',
      output: {
        // 出力されるファイル名を固定する（WordPressで読み込みやすくするため）
        entryFileNames: 'bundle.js',
        format: 'iife',
      },
    },
  },
});