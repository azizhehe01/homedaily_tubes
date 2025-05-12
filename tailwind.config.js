/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                warning: "#FFA500",
                primary: "#F99F2F",
                secondary: "#64748B",
                success: "#22C55E",
                danger: "#EF4444",
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
