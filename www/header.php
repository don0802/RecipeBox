<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<header>
    <h1><a href="index.php">RecipeBox</a></h1>
    <nav>
        <ul>
            <li><a href="recipes_index.php">Recepten</a></li>
            <li><a href="categories_index.php">Categorieën</a></li>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <li><a href="recipe_create.php">Recept toevoegen</a></li>
                <li><a href="my_recipes.php">Mijn recepten</a></li>
                <li><a href="my_favorites.php">Favorieten</a></li>
                <?php if (($_SESSION['role'] ?? '') === 'admin') : ?>
                    <li><a href="recipes_deleted.php">Verwijderd</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Uitloggen</a></li>
            <?php else : ?>
                <li><a href="login.php">Inloggen</a></li>
                <li><a href="register.php">Registreren</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
