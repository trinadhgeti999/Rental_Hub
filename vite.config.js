import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  server: {
    hmr: {
      overlay: false,
    },
  },
  resolve: {
    alias: {
      // Polyfill the 'crypto' module
      crypto: path.resolve(__dirname, 'node_modules/crypto-browserify')
    }
  },
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
});
