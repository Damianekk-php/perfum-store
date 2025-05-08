
    document.querySelectorAll('.delete').forEach(button => {
    button.addEventListener('click', function (e) {
        if (!confirm('Czy na pewno chcesz usunąć ten produkt?')) {
            e.preventDefault();
        }
    });
});

