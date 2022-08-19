/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    dark: "class",

    plugins: [require("daisyui")],

    daisyui: {
        themes: ["dark"],
    },
};
