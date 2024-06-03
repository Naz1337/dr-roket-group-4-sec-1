import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/inertia_app.js',
                'resources/js/modernApp.js',
                'resources/js/draft_form.js',
                'resources/js/draft_index.js',
                'resources/js/draft_show.js',
            ],
            refresh: true,
        }),
        svelte({}),
    ],
});
