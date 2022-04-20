module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            sm: "480px",
            md: "768px",
            lg: "976px",
            xl: "1440px",
        },
        opacity: {
          '0': '0',
          '20': '0.2',
          '40': '0.4',
          '60': '0.6',
          '80': '0.8',
          '100': '1',
        },
        colors: {
            blue: "#1fb6ff",
            purple: "#7e5bef",
            pink: "#ff49db",
            orange: "#ff7849",
            green: "#13ce66",
            yellow: "#ffc82c",
            "gray-dark": "#273444",
            gray: "#8492a6",
            "gray-light": "#d3dce6",
        },
        fontFamily: {
            sans: ["Graphik", "sans-serif"],
            serif: ["Merriweather", "serif"],
        },
        extend: {
            spacing: {
                13: "3.25rem",
                15: "3.75rem",
                128: "32rem",
                144: "36rem",
            },
            borderRadius: {
                "4xl": "2rem",
            },
        },
    },
    plugins: [],
};
