module.exports = {
	content: ["./views/**/*.twig"],
	darkMode: 'class',
	safelist: [
		'top-0',
	],
	theme: {
		extend: {
			colors: {
				"mundre-green": "#d2d5c8",
				"mundre-green-dark": "#828D75",
				"mundre-grey": "#645c57",
				"mundre-grey-light": "#8A8691",
				"mundre-white": "#ffffff",
				"mundre-pink": "#efcbd2",
				"mundre-pink-dark": "#A16F80",
			},
			fontFamily: {
				mundreFontSerif: ["Playfair Display", "serif"],
				mundreFontSans: ["Rubik", "sans-serif"],
			},
			fontSize: {
				'h1sm': '30px',
				'h1md': '50px',
				'h1lg': '60px',

				'h2sm': '25px',
				'h2md': '35px',
				'h2lg': '40px',

				'h3sm': '18px',
				'h3md': '25px',
				'h3lg': '35px',
			}
		},
	},
	plugins: [
		require("@tailwindcss/typography"),
		require('@tailwindcss/aspect-ratio'),
	],
};
