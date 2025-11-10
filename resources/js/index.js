(function() {
    'use strict';

    const ThemeManager = {
        init() {
            this.applyTheme();
            this.setupToggleButton();
            this.watchSystemPreference();
        },

        getTheme() {
            return localStorage.getItem('theme');
        },

        setTheme(theme) {
            localStorage.setItem('theme', theme);
            this.applyTheme();
        },

        isDarkMode() {
            const theme = this.getTheme();
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            return theme === 'dark' || (!theme && prefersDark);
        },

        applyTheme() {
            const theme = this.getTheme();
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (theme === 'dark' || (!theme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else if (theme === 'light') {
                document.documentElement.classList.remove('dark');
            }
        },

        toggleTheme() {
            const isDark = document.documentElement.classList.contains('dark');
            this.setTheme(isDark ? 'light' : 'dark');
        },

        setupToggleButton() {
            const toggleButton = document.querySelector('[data-theme-toggle]');
            if (toggleButton) {
                toggleButton.addEventListener('click', () => {
                    this.toggleTheme();
                });
            }
        },

        watchSystemPreference() {
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            mediaQuery.addEventListener('change', (e) => {
                if (!this.getTheme()) {
                    if (e.matches) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            });
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => ThemeManager.init());
    } else {
        ThemeManager.init();
    }

    window.ThemeManager = ThemeManager;
})();
