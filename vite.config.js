import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/bootstrap.min.css',
                'resources/js/app.js',
                'resources/js/Table_Paginate.js',
                'resources/js/Table_Sort.js',
            ],
            refresh: true,
        }),
    ],
});
