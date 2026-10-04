// Отключаем контекстное меню (правая кнопка мыши)
document.addEventListener('contextmenu', function(event) {
    event.preventDefault();
});

// Отключаем копирование по Ctrl+C / Cmd+C
document.addEventListener('keydown', function(event) {
    if ((event.ctrlKey || event.metaKey) && (event.key === 'c' || event.key === 'C')) {
        event.preventDefault(); // Предотвращаем стандартную реакцию
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const burger = document.querySelector('.burger-btn');
    const nav = document.querySelector('.nav-list');

    if (burger && nav) {
        burger.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            // Меняем состояние кнопки для скринридеров
            this.setAttribute('aria-expanded', String(!isExpanded));
            this.classList.toggle('active', !isExpanded);

            // Меняем состояние меню
            nav.classList.toggle('active', !isExpanded);

            // Блокировка скролла body при открытом меню (опционально, но рекомендуется)
            if (!isExpanded) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });

        /* Закрытие меню при клике на ссылку (UX-стандарт) */
        nav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                burger.setAttribute('aria-expanded', 'false');
                burger.classList.remove('active');
                nav.classList.remove('active');
                document.body.style.overflow = '';
            });
        });

        /* Закрытие меню по нажатию на Esc */
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && nav.classList.contains('active')) {
                burger.setAttribute('aria-expanded', 'false');
                burger.classList.remove('active');
                nav.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
});
