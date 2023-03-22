import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',// bootstrap
                'resources/css/app.css', // tailwindcss
                'resources/js/app.js',
                'resources/css/index.css',
            ],
            refresh: true,
        }),
        react(),
    ],
});
