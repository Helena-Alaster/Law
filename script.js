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