import pluginVue from 'eslint-plugin-vue';
import {
    defineConfigWithVueTs,
    vueTsConfigs,
} from '@vue/eslint-config-typescript';
import skipFormatting from '@vue/eslint-config-prettier/skip-formatting';
import betterTailwindcss from 'eslint-plugin-better-tailwindcss';

export default defineConfigWithVueTs(
    {
        name: 'app/files-to-lint',
        files: ['resources/js/**/*.{ts,mts,tsx,vue,js}'],
    },
    {
        name: 'app/files-to-ignore',
        ignores: [
            'public/**',
            'vendor/**',
            'node_modules/**',
            'bootstrap/ssr/**',
        ],
    },
    pluginVue.configs['flat/recommended'],
    vueTsConfigs.recommended,
    {
        name: 'app/tailwindcss',
        files: ['resources/js/**/*.{vue,ts,tsx,js}'],
        plugins: {
            'better-tailwindcss': betterTailwindcss,
        },
        settings: {
            'better-tailwindcss': {
                entryPoint: 'resources/css/app.css',
            },
        },
        rules: {
            'better-tailwindcss/enforce-consistent-class-order': 'warn',
            'better-tailwindcss/enforce-consistent-variant-order': 'warn',
            'better-tailwindcss/no-duplicate-classes': 'warn',
            'better-tailwindcss/enforce-consistent-line-wrapping': [
                'warn',
                {
                    group: 'newLine',
                    preferSingleLine: true,
                    printWidth: 100,
                    indent: 4,
                },
            ],
        },
    },
    skipFormatting,
);