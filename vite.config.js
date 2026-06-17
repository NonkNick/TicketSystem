import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',        // listen on all interfaces so the mapped port works
        port: 5173,
        hmr: {
            host: 'localhost',  // tell the browser's HMR client where to connect
        },
        watch: {
            usePolling: true,   // bind-mounted files on Linux+Docker often miss native fs events
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
