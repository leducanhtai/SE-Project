/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./src/**/*.{js,ts,jsx,tsx}",
        "./resources/**/*.blade.php",
    ],
    safelist: [
        "animate-rotate-in",
        "animate-rise-up",
        "delay-[200ms]",
        "delay-[400ms]",
        "delay-[600ms]",
    ],
    theme: {
        extend: {},
    },
    theme: {
        extend: {
            keyframes: {
                rotateIn: {
                    "0%": { transform: "rotate(0deg) scale(0)" },
                    "100%": { transform: "rotate(360deg) scale(1)" },
                },
                riseUp: {
                    "0%": { transform: "translateY(100%)", opacity: "0" },
                    "100%": { transform: "translateY(0)", opacity: "1" },
                },
            },
            animation: {
                "rotate-in": "rotateIn 1s ease-out forwards",
                "rise-up": "riseUp 0.8s ease-out forwards",
            },
        },
    },
    plugins: [],
};
