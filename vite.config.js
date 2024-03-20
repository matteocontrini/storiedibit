import {defineConfig} from 'vite';
import kirby from 'vite-plugin-kirby';

export default defineConfig(({mode}) => ({
  base: mode === 'development' ? '/' : '/assets/dist/',
  root: 'assets',
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    assetsDir: '',
    rollupOptions: {
      input: ['assets/src/main.ts']
    }
  },
  plugins: [kirby()],
}));
