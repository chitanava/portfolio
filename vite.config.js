import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/front.css', 'resources/css/back.css', 
                'resources/js/back.js', 'resources/js/front.js'
            ],
            refresh: true,
        }),
    ],
});
