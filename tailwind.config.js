/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./includes/**/*.php", "./app/Views/**/*.php", "./js/**/*.js"],
  theme: {
    extend: {
      colors: {
        espresso: "#1f130c",
        cafe: "#5a2a12",
        caramelo: "#b8742f",
        crema: "#f6efe5",
        "crema-oscura": "#efe3d1",
        papel: "#fbf7f1",
        borde: "#e2cfb4",
        bordo: "#8b1e1e",
        texto: "#3b2a20",
        suave: "#6b5444",
      },
      fontFamily: {
        titulo: ['"Playfair Display"', "Georgia", "serif"],
        mono: ['"DM Mono"', '"Courier New"', "monospace"],
        sans: ["Inter", "system-ui", "sans-serif"],
      },
    },
  },
  plugins: [],
};
