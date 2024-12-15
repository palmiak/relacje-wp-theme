// #00AEEF
module.exports = {
	content: ["./views/**/*.twig"],
	darkMode: 'class',
	safelist: [
		'top-0',
		'header-relacje-dark',
		'header-relacje-light'
	],
	corePlugins: {
		aspectRatio: false,
	},
	theme: {
		extend: {
			colors: {
				"relacje-color-accent": "var(--relacje-color-accent)",
				"relacje-color-dark": "#010709",
			},
			fontFamily: {
				"relacje-font-text": ["Atkinson Hyperlegible", "serif"],
				"relacje-font-heading": ["Titan One", "sans-serif"],
			},
			fontSize: {
				'h1sm': '30px',
				'h1md': '60px',
				'h1lg': '100px',

				'h2sm': '25px',
				'h2md': '35px',
				'h2lg': '75px',

				'h3sm': '20px',
				'h3md': '27px',
				'h3lg': '42px',

				'h4sm': '18px',
				'h4md': '20px',
				'h4lg': '24px',
			},
			boxShadow: {
				'relacje-shadow': '8px 40px 67.9px 0px rgba(1, 7, 9, 0.29)',
			}
		},
	},
	plugins: [
		require("@tailwindcss/typography"),
		require('@tailwindcss/aspect-ratio'),
	],
};
