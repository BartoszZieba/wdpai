(() => {
    'use strict';

    const STORAGE_KEY = 'maturakorki-theme';
    const root = document.documentElement;
    const media = window.matchMedia
        ? window.matchMedia('(prefers-color-scheme: dark)')
        : null;

    function readStoredTheme() {
        try {
            const stored = window.localStorage.getItem(STORAGE_KEY);
            return stored === 'light' || stored === 'dark' ? stored : null;
        } catch (error) {
            return null;
        }
    }

    function systemTheme() {
        return media && media.matches ? 'dark' : 'light';
    }

    function currentTheme() {
        return root.dataset.theme === 'dark' ? 'dark' : 'light';
    }

    function updateControls() {
        const isDark = currentTheme() === 'dark';
        const label = isDark ? 'Włącz tryb jasny' : 'Włącz tryb ciemny';

        document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
            button.setAttribute('aria-pressed', String(isDark));
            button.setAttribute('title', label);
        });

        const themeColor = document.querySelector('meta[name="theme-color"]');
        if (themeColor) {
            themeColor.setAttribute('content', isDark ? '#0d141f' : '#FBF8F3');
        }
    }

    function applyTheme(theme, persist) {
        root.dataset.theme = theme;

        if (persist) {
            try {
                window.localStorage.setItem(STORAGE_KEY, theme);
            } catch (error) {
                // Prywatny tryb przeglądarki może blokować localStorage.
            }
        }

        updateControls();
    }

    function initControls() {
        applyTheme(readStoredTheme() || systemTheme(), false);

        document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                window.alert('Witaj');
                applyTheme(currentTheme() === 'dark' ? 'light' : 'dark', true);
            });
        });

        if (media) {
            const handleSystemChange = (event) => {
                if (!readStoredTheme()) {
                    applyTheme(event.matches ? 'dark' : 'light', false);
                }
            };

            if (typeof media.addEventListener === 'function') {
                media.addEventListener('change', handleSystemChange);
            } else if (typeof media.addListener === 'function') {
                media.addListener(handleSystemChange);
            }
        }

        window.addEventListener('storage', (event) => {
            if (event.key === STORAGE_KEY) {
                applyTheme(readStoredTheme() || systemTheme(), false);
            }
        });
    }

    // Ustawiamy motyw od razu, jeszcze przed pierwszym renderowaniem body.
    applyTheme(readStoredTheme() || systemTheme(), false);

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initControls, { once: true });
    } else {
        initControls();
    }
})();
