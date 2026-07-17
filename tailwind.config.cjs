/** @type {import('tailwindcss').Config} */

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            // Konfigurasi Warna
            colors: {
                yaguwipa: {
                    red: "#B91C1C",
                    dark: "#1F2937",
                },
            },
            // Konfigurasi Font
            fontFamily: {
                serif: [
                    '"Playfair Display"',
                    "ui-serif",
                    "Georgia",
                    "Cambria",
                    '"Times New Roman"',
                    "serif",
                ],
                sans: ["Inter", "ui-sans-serif", "system-ui", "sans-serif"],
            },
            // Konfigurasi Animasi Tambahan
            animation: {
                "spin-slow": "spin 3s linear infinite",
            },
        },
    },
    plugins: [],
};
