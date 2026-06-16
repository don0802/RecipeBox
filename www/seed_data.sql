-- ============================================================
--  RecipeBox - Voorbeelddata (optioneel)
--  Voer dit pas uit NA database.sql.
--  Inl;oggen kan met:  e-mail: nora@recipebox.nl   wachtwoord: password123
-- ============================================================

USE RecipeBox;

-- Voorbeeldgebruiker (tevens admin) + kookprofiel
INSERT INTO users (naam, email, wachtwoord, rol) VALUES
('Nora', 'nora@recipebox.nl', '$2y$10$/bI02HX4Vbhl26bFHI2YaeKfnGVnYtOcNPjhhU3NI8BUMHUMZ5NU.', 'admin');

SET @user_id = LAST_INSERT_ID();

INSERT INTO cook_profiles (user_id, kookniveau, specialiteit, bio) VALUES
(@user_id, 'expert', 'Italiaans', 'Ik ben gek op koken en deel graag mijn recepten!');

-- Voorbeeldrecepten (category_id: 1=Ontbijt, 2=Lunch, 3=Diner, 4=Dessert, 5=Snacks)
INSERT INTO recipes (titel, omschrijving, bereidingstijd, porties, ingredienten, bereidingswijze, foto_url, category_id, user_id) VALUES
('Pasta Carbonara', 'Klassieke Italiaanse pasta met spek en ei.', 25, 2,
 "200g spaghetti\n100g spekblokjes\n2 eieren\n50g Parmezaanse kaas\nPeper en zout",
 "1. Kook de spaghetti beetgaar.\n2. Bak de spekblokjes knapperig.\n3. Klop de eieren met de kaas.\n4. Meng alles snel door elkaar van het vuur af.\n5. Breng op smaak met peper.",
 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=600', 3, @user_id),

('Pannenkoeken', 'Luchtige pannenkoeken voor een lekker ontbijt.', 20, 4,
 "250g bloem\n500ml melk\n2 eieren\nSnufje zout\nBoter om te bakken",
 "1. Meng bloem, melk, eieren en zout tot een glad beslag.\n2. Verhit boter in een pan.\n3. Bak de pannenkoeken goudbruin aan beide kanten.\n4. Serveer met stroop of suiker.",
 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600', 1, @user_id),

('Tomatensoep', 'Romige tomatensoep met verse basilicum.', 35, 4,
 "1kg tomaten\n1 ui\n2 tenen knoflook\n500ml bouillon\nVerse basilicum\nScheutje room",
 "1. Fruit de ui en knoflook.\n2. Voeg de tomaten toe en laat sudderen.\n3. Giet de bouillon erbij en kook 20 minuten.\n4. Pureer de soep glad.\n5. Werk af met room en basilicum.",
 'https://www.themealdb.com/images/media/meals/stpuws1511191310.jpg', 2, @user_id),

('Chocolademousse', 'Rijke en luchtige chocolademousse.', 30, 4,
 "200g pure chocolade\n4 eieren\n50g suiker\nSnufje zout",
 "1. Smelt de chocolade au bain-marie.\n2. Splits de eieren.\n3. Klop de eiwitten met de suiker stijf.\n4. Roer de dooiers door de chocolade.\n5. Spatel de eiwitten erdoor en laat opstijven in de koelkast.",
 'https://www.themealdb.com/images/media/meals/uttuxy1511382180.jpg', 4, @user_id);
