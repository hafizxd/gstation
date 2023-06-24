import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Patua One", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#9D8E05",
                cgray: "#999999",
            },
        },
    },

    plugins: [forms],
};
