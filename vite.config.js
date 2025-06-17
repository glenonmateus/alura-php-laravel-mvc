import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "0.0.0.0",
        port: 3000,
        open: false,
    },
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/css/app.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
