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
                'resources/scss/focus_index.scss',
                'resources/js/focus_item_create.js',
                'resources/js/focus_create.js',
                'resources/js/ed_report.js',
                'resources/js/draft_edit.js',
                'resources/js/crmp_draft_progress.js',
                'resources/js/crmp_index.js'
            ],
            refresh: true,
        }),
        svelte({}),
    ],
});
