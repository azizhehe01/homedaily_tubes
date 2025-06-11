import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
            publicDirectory: "public",
        }),
    ],
    resolve: {
        alias: {
            "@": "/resources",
        },
    },
    define: {
        "process.env": {
            PUSHER_APP_KEY: "6d73d4fcc6952df0b86",
            PUSHER_APP_CLUSTER: "ap1",
        },
    },
});
