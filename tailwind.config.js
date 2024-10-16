import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "selector",
    safelist: [
        {
            pattern:
                /bg-(blue|red|green|cyan|teal|yellow|white|slate|gray)(-[0-9]{3})?/,
            variants: ["hover", "focus", "lg:hover", "target"],
        },
        {
            pattern:
                /outline-(blue|red|green|cyan|teal|yellow|white|slate|gray)(-[0-9]{3})?/,
            variants: ["hover", "focus", "lg:hover", "target"],
        },
        {
            pattern:
                /text-(blue|red|green|cyan|teal|yellow|white|slate|gray|black)(-[0-9]{3})?/,
            variants: [
                "hover",
                "focus",
                "lg:hover",
                "target",
                "dark",
                "dark:hover",
            ],
        },
        {
            pattern:
                /border-(blue|red|green|cyan|teal|yellow|white|slate|gray)(-[0-9]{3})?/,
            variants: ["hover", "focus", "lg:hover", "target"],
        },
        {
            pattern:
                /w-([0-9]{1,3})?/,
            variants: [],
        },
        {
            pattern:
                /hidden?/,
            variants: [],
        },
    ],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
        screens: {
            "2xs": "160px",
            // => @media (min-width: 320px) { ... }

            xs: "320px",
            // => @media (min-width: 320px) { ... }

            sm: "640px",
            // => @media (min-width: 640px) { ... }

            md: "768px",
            // => @media (min-width: 768px) { ... }

            lg: "1024px",
            // => @media (min-width: 1024px) { ... }

            xl: "1280px",
            // => @media (min-width: 1280px) { ... }

            "2xl": "1536px",
            // => @media (min-width: 1536px) { ... }
        },
        fontWeight: {
            xthin: "50",
            thin: "100",
            extralight: "200",
            light: "300",
            normal: "400",
            medium: "500",
            semibold: "600",
            bold: "700",
            extrabold: "800",
            black: "900",
        },
    },

    plugins: [forms],
};
