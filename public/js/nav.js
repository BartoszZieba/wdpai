(function () {
    'use strict';

    document.documentElement.classList.add('js');

    function init() {
        var toggle = document.querySelector('.nav-toggle');
        var nav = document.getElementById('site-nav');

        if (!toggle || !nav) {
            return;
        }

        var label = toggle.querySelector('.visually-hidden');

        function setOpen(open) {
            nav.classList.toggle('is-open', open);
            document.body.classList.toggle('nav-open', open);
            toggle.setAttribute('aria-expanded', String(open));

            if (label) {
                label.textContent = open ? 'Zamknij menu' : 'Otwórz menu';
            }
        }

        toggle.addEventListener('click', function () {
            setOpen(!nav.classList.contains('is-open'));
        });

        nav.addEventListener('click', function (event) {
            if (event.target.closest('a')) {
                setOpen(false);
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && nav.classList.contains('is-open')) {
                setOpen(false);
                toggle.focus();
            }
        });

        document.addEventListener('click', function (event) {
            if (!nav.classList.contains('is-open')) {
                return;
            }

            if (nav.contains(event.target) || toggle.contains(event.target)) {
                return;
            }

            setOpen(false);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
