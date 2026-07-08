/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        "./templates/**/*.twig",
        "./src/**/*.php",
        "./public/**/*.php"
    ],
    safelist: [
        'lg:grid',
        'lg:block',
        'lg:hidden',
        'lg:col-span-1',
        'lg:gap-8',
        'lg:grid-cols-[1fr_280px]',
        'md:grid',
        'md:block',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Custom branding if needed, but standard Slate/Indigo is perfect for "Tailwind UI" look
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
