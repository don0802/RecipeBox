-- ============================================================
--  RecipeBox - Database
--  Importeer dit bestand via phpMyAdmin (http://localhost:8000)
--  of via de terminal. Het maakt de database + alle tabellen aan.
-- ============================================================

CREATE DATABASE IF NOT EXISTS RecipeBox
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE RecipeBox;

-- Bestaande tabellen weggooien (handig bij opnieuw importeren)
DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS recipes;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS cook_profiles;
DROP TABLE IF EXISTS users;

-- ------------------------------------------------------------
--  users
-- ------------------------------------------------------------
CREATE TABLE users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    naam       VARCHAR(100)  NOT NULL,
    email      VARCHAR(150)  NOT NULL UNIQUE,        -- unique constraint op email
    wachtwoord VARCHAR(255)  NOT NULL,               -- bevat de password_hash()
    rol        ENUM('admin','user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
--  cook_profiles  (1-op-1 met users)
-- ------------------------------------------------------------
CREATE TABLE cook_profiles (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    user_id      INT NOT NULL UNIQUE,               -- UNIQUE = 1-op-1 relatie
    kookniveau   ENUM('beginner','gevorderd','expert') NOT NULL,
    specialiteit VARCHAR(100),
    bio          TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ------------------------------------------------------------
--  categories  (1-op-veel naar recipes)
-- ------------------------------------------------------------
CREATE TABLE categories (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    naam         VARCHAR(100) NOT NULL,
    omschrijving TEXT,
    foto_url     VARCHAR(500)
);

-- ------------------------------------------------------------
--  recipes  (hoort bij category en user)
-- ------------------------------------------------------------
CREATE TABLE recipes (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    titel           VARCHAR(200) NOT NULL,
    omschrijving    TEXT,
    bereidingstijd  INT NOT NULL,
    porties         INT NOT NULL,
    ingredienten    TEXT NOT NULL,
    bereidingswijze TEXT NOT NULL,
    foto_url        VARCHAR(500),
    category_id     INT NOT NULL,
    user_id         INT NOT NULL,
    deleted_at      TIMESTAMP NULL DEFAULT NULL,     -- NULL = niet verwijderd (soft delete)
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (user_id)     REFERENCES users(id)
);

-- ------------------------------------------------------------
--  favorites
-- ------------------------------------------------------------
CREATE TABLE favorites (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    recipe_id  INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (user_id, recipe_id),                     -- zelfde recept niet 2x bewaren
    FOREIGN KEY (user_id)   REFERENCES users(id)   ON DELETE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE
);

-- ------------------------------------------------------------
--  Voorbeeldcategorieën
-- ------------------------------------------------------------
INSERT INTO categories (naam, omschrijving, foto_url) VALUES
('Ontbijt', 'Recepten om de dag goed mee te beginnen', 'https://www.themealdb.com/images/media/meals/hqaejl1695738653.jpg'),
('Lunch',   'Lichte gerechten voor tussen de middag',  'https://www.themealdb.com/images/media/meals/3m8yae1763257951.jpg'),
('Diner',   'Hoofdgerechten voor de avond',            'https://www.themealdb.com/images/media/meals/04axct1763793018.jpg'),
('Dessert', 'Zoete lekkernijen en toetjes',            'https://www.themealdb.com/images/media/meals/uttuxy1511382180.jpg'),
('Snacks',  'Hapjes en tussendoortjes',                'https://www.themealdb.com/images/media/meals/grhn401765687086.jpg');

-- ============================================================
--  Admin-account aanmaken:
--  1. Registreer eerst normaal via register.php
--  2. Voer daarna deze query uit (vul je eigen e-mail in):
--     UPDATE users SET rol = 'admin' WHERE email = 'jouw@email.nl';
-- ============================================================
