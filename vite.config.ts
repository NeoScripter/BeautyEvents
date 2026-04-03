import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import { resolve } from 'path';

export default defineConfig({
    plugins: [tailwindcss()],

    server: {
        port: 5173,
        strictPort: true,
        origin: 'http://localhost:5173',
        proxy: {
            '/': {
                target: 'https://beautyevents.test',
                changeOrigin: true,
                secure: false, // accepts Valet's self-signed cert
            },
        },
    },

    build: {
        outDir: 'assets/dist',
        emptyOutDir: true,
        rollupOptions: {
            input: {
                main: resolve(__dirname, 'assets/src/js/main.js'),
                style: resolve(__dirname, 'assets/src/css/style.css'),
            },
            output: {
                globals: {
                    jquery: 'jQuery', // maps the external to the WP global
                },
                entryFileNames: 'assets/[name].js',
                chunkFileNames: 'assets/[name].js',
                assetFileNames: 'assets/[name].[ext]',
            },
        },
    },
});
