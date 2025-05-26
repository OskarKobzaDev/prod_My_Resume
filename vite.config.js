import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                inlineDynamicImports: false,
                manualChunks: undefined,
	    }
        }
    },
    server: {
        host: '0.0.0.0', // Użycie localhost zamiast IPv6
        port: 5173,        // Domyślny port
        cors: {
            origin: 'http://resume.localhost', // Specyfikacja dozwolonego pochodzenia
            methods: ['GET', 'POST', 'PUT', 'DELETE'],
            credentials: true,
        },
        hmr: {
            host: 'localhost',
            port: 5173,
        },
    },
});

