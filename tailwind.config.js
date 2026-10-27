import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Primary Professional Base (Image 1: Deep Navy / Petrol / Rose-Mauve gradients)
                'tvet-dark': '#0f2d4d',       // Deepest Navy (Gradient 05 base)
                'tvet-primary': '#174871',    // Rich Ocean Blue (Professional anchor)
                'tvet-mauve': '#a77693',      // Soft Muted Rose-Mauve (Gradient 03/04 accent)
                'tvet-sand': '#ded1c6',       // Warm Sand/Champagne (Light elegant tint)
                'tvet-light': '#f8fafc',      // Crisp, clean background for high readability

                // Light-up Palette (Image 2: Modern Pastel Glow Accents)
                'tvet-mint': '#86e3ce',       // Fresh Mint
                'tvet-lime': '#d0e6a5',       // Soft Pastel Lime
                'tvet-butter': '#ffdd94',     // Warm Sunshine Butter
                'tvet-coral': '#fa897b',      // Vibrant Soft Coral Pop (Call-to-Action)
                'tvet-lavender': '#ccabdb',   // Gentle Lavender

                // Compatibility aliases
                'tvet-secondary': '#a77693',  // Map to soft mauve
                'tvet-accent': '#fa897b',     // Map to vibrant coral CTA
                'tvet-celadon': '#86e3ce',    // Map to fresh mint
                'tvet-columbia': '#ded1c6',   // Map to sand/champagne
            },
        },
    },

    plugins: [forms],
};