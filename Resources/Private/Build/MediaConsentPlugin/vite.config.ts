import _config from './_config.js';

const HOST = _config.server.host;
const PORT = _config.server.port;

import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  build: {
    outDir: resolve(__dirname, '../../../Public/JavaScript'),
    minify: 'esbuild', // or 'terser' for UglifyJS
    sourcemap: true,
    rollupOptions: {
      input: {
        MediaConsent: resolve(__dirname, './src/ts/mediaConsent.ts'),
      },
      output: {
        entryFileNames: '[name].js',
        assetFileNames: '[name].[ext]',
        manualChunks: {
          'mockServiceWorker': [],
          'vite': [],
        },
      },
    },
  },
  server: {
    host: HOST,
    port: PORT,
  },
});
