import { defineConfig } from "vite";
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import debug from 'vite-plugin-debug';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/assets/css/aenginus/style.css",
                "resources/assets/css/public/style.css",

                "resources/assets/js/modules/exists.js",
                "resources/assets/js/modules/new-window.js",
                "resources/assets/js/modules/trix-editor-paragraphs.js",
                "resources/assets/js/modules/trix-editor-toolbar.js",
                "resources/assets/js/modules/turbolinks.js",

                "resources/assets/js/aenginus.js",
                "resources/assets/js/public.js"
            ],
            build: {
                minify: false
            },
            refresh: [
                ...refreshPaths,
                "src/Livewire/Components/**"
            ]
        }),
        debug({
            enabled: true,
            apply: 'serve',
            enabledByKey: 'open',
            enabledByValue: 'true'
        })
    ]
});
