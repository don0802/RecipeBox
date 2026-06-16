const knop = document.getElementById('favoriet-knop');
if (knop) {
    knop.addEventListener('click', function () {
        const recipeId = knop.dataset.recipeId;
        const melding = document.getElementById('favoriet-melding');

        fetch('add_to_favorites.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ recipe_id: recipeId })
        })
        .then(response => response.json())
        .then(data => {
            melding.textContent = data.message;
            if (data.success) {
                knop.textContent = 'Opgeslagen ✓';
                knop.disabled = true;
            }
        });
    });
}

const verwijderLinks = document.querySelectorAll('.confirm-delete');
verwijderLinks.forEach(function (link) {
    link.addEventListener('click', function (e) {
        if (!confirm('Weet je zeker dat je dit recept wilt verwijderen?')) {
            e.preventDefault();
        }
    });
});
