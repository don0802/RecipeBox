USE RecipeBox;
-- 16 extra recepten uit TheMealDB (afbeelding hoort gegarandeerd bij het gerecht)
SET @uid = (SELECT id FROM users WHERE email = 'nora@recipebox.nl' LIMIT 1);
INSERT INTO recipes (user_id, titel, omschrijving, bereidingstijd, porties, ingredienten, bereidingswijze, foto_url, category_id) VALUES
(@uid, 'Adana kebab', 'Heerlijk dinergerecht uit de Turkish keuken.', 50, 4, '2 large Romano Pepper
800g Lamb Mince
3  tablespoons Red Pepper Paste
1 tablespoon Pul Biber
3  tablespoons Sunflower Oil', 'step 1
Finely chop the peppers in a food processor, then tip them in a sieve and press into the sieve so that the peppers release all of their juices. Tip into a bowl along with the mince, red pepper paste, pul biber, 1½ tsp flaky sea salt, and 2 tbsp of the oil. Mix together, kneading well for at least 2-3 mins. If you need to, wet your hands with cold water to prevent the mixture from sticking. The mixture should be sticky when ready. Cover and chill for at least 2 hrs, or up to 12 hrs.

step 2
When ready to cook, heat the grill to high or an oven to 220C/200C fan/gas 6. Divide the mixture into 12 equal portions, around 85g each. If you’d like to skewer them, divide into 8 equal portions and roll into balls. Using wet hands, thread the balls onto the end of the skewers, massaging the mixture down the skewers in between the palms of your hands, until evenly distributed. Ensure that the mixture is fully wrapped tightly around the skewers without any exposed metal. Alternatively, lay them on a large baking tray lined with parchment paper if cooking in the oven, or foil if cooking under the grill. Shape into 20cm-long köfte. Wet your fingers with a little cold water and make indents all along the köfte for the traditional shape.

step 3
Gently brush each köfte with the remaining 1 tbsp oil and cook under the grill, on the top shelf for 10-12 mins, turning regularly, or cook in the oven for 16-18 mins, until crispy on the outside and juicy in the middle', 'https://www.themealdb.com/images/media/meals/04axct1763793018.jpg', 3),
(@uid, 'Air Fryer Egg Rolls', 'Heerlijk snacksgerecht uit de Chinese keuken.', 25, 4, '1 tablespoon Olive Oil
1 lb Ground Pork
1 clove peeled crushed Garlic
1 tablespoon Ginger
1 medium Carrots
3 chopped Scallions
3 Cups Cabbage
1 tablespoon Soy Sauce
1 tablespoon Rice Vinegar
12 Egg Roll Wrappers
For brushing Oil
To serve Duck Sauce
To serve Plum Sauce
To serve Soy Sauce', 'Alternative Pan Fry Method: If you don’t have access to an air fryer, you can make these egg rolls using a traditional pan fry method. Add enough oil to a medium skillet with high walls so the oil is about 1/2 inch up the side of the skillet. Heat oil on medium high heat until it reaches 350°F. Add egg rolls and fry for 3 to 4 minutes, flip, and fry for another 3 to 4 minutes until golden brown. Remove and let them drain and cool on a few paper towels.

Cook the filling:
In a large skillet over medium heat, add the olive oil along with the ground pork or chicken. Break apart the meat with a spatula or wooden spoon as it cooks. Cook until the meat is cooked through, 6 to 8 minutes.

Add garlic, ginger, carrot, scallions, and cabbage. Continue to cook until cabbage wilts down and is soft, another 3 to 4 minutes, stirring regularly. Season the filling with soy sauce and rice wine vinegar, and take off the heat to cool. (This filling can be made in advance.)

Assemble the egg rolls:
Place a single egg roll wrapper on a dry surface with one point of the square facing you (like a diamond). Place about 1/4 cup of the egg roll filling mixture in the middle of the wrapper.

Dip your fingers in water and run around the edges of the wrapper. Then fold the edges of the wrapper over the center and start rolling the egg roll away from you to form a tight cylinder. Place on a plate and repeat until you are out of filling. You should get at least a dozen egg rolls.

Air fry the egg rolls:
Place the egg rolls in the basket of your air fryer. Spray or brush them lightly with oil. Add as many as you can without stacking the egg rolls, making sure they don’t touch. Air needs to circulate around them. Brush the egg rolls lightly with oil.

Place the basket in the air fryer and turn the air fryer to 350°F. Cook for 6 to 7 minutes, then flip the egg rolls, spray or brush with oil a second time on the bottom side, and cook for another 4 to 5 minutes.

Finished egg rolls should be golden brown and crispy! Serve immediately.', 'https://www.themealdb.com/images/media/meals/grhn401765687086.jpg', 5),
(@uid, 'Air fryer patatas bravas', 'Heerlijk lunchgerecht uit de Spanish keuken.', 35, 4, '900g Potatoes
3  tablespoons Olive Oil
1 chopped Onion
1 clove peeled crushed Garlic
1 tblsp Paprika
1 tblsp Tomato Puree
225g Tinned Tomatos
To serve Basil Leaves', 'step 1
Soak the potatoes in just-boiled water for 30 mins, then drain and leave to air-dry for 5 mins. Heat the air fryer to 200C. Tip the potatoes into a bowl and drizzle over 1 tbsp of the oil and add 1/2 tsp each of salt and freshly ground black pepper. Mix to coat the potatoes all over, then tip into the air fryer basket and cook for 20-30 mins until crisp and golden.

step 2
Meanwhile, heat the remaining oil in a small pan over a medium-low heat and fry the onion for 8-10 mins until softened but not golden. Stir in the garlic and cook for a minute before adding the paprika and cooking for 30 seconds more. Stir in the tomato purée, cook for 1 min, then tip in the chopped tomatoes. Cook for 5-10 mins over a medium heat until thickened slightly.

step 3
Once the potatoes are cooked, tip out onto a platter and pour over the tomato sauce. Sprinkle with the basil leaves, then serve.', 'https://www.themealdb.com/images/media/meals/3m8yae1763257951.jpg', 2),
(@uid, 'Ajo blanco', 'Heerlijk snacksgerecht uit de Spanish keuken.', 25, 4, '150g White bread
200g Almonds
50 ml Extra Virgin Olive Oil
1 Garlic Clove
1 ½ tbsp Red Wine Vinegar', 'step 1
Tip the bread into a bowl and pour over 350ml water. Leave to soak for 10 mins.

step 2
Blend the ingredients together with 350ml water and 1 tsp salt.

step 3
Let the soup cool in the fridge for 1 hr or so, then serve with a drizzle of oil and some black pepper.', 'https://www.themealdb.com/images/media/meals/5jdtie1763289302.jpg', 5),
(@uid, 'Alfajores', 'Heerlijk dessertgerecht uit de Argentina keuken.', 45, 4, '300g All purpose flour
200g Cornstarch
200g Butter
100g Sugar
2 Egg Yolks
1 teaspoon Lemon Zest
Dulce de leche
Sprinkling Desiccated Coconut', 'Make the Dough: Cream butter and sugar. Add egg yolks and lemon zest. Gradually mix in flour and cornstarch to form a dough. Chill for 1 hour.
Bake the Cookies: Roll out the dough, cut into circles, and bake at 180°C (350°F) for 12-15 minutes. Let cool.
Assemble: Spread dulce de leche on one cookie, then sandwich with another. Roll the edges in coconut flakes.
Pro Tips:

Chill the dough before rolling it out to make it easier to handle and to prevent the cookies from spreading too much while baking.
Dip the alfajores in melted chocolate and let them set on a wire rack for an extra decadent treat.', 'https://www.themealdb.com/images/media/meals/a4kgf21763075288.jpg', 4),
(@uid, 'Algerian Bouzgene Berber Bread with Roasted Pepper Sauce', 'Heerlijk snacksgerecht uit de Algerian keuken.', 25, 4, '2 Red Pepper
4 Tomato
1 tablespoon Olive Oil
4 Cloves Chopped Garlic
1 chopped Jalapeno
To taste Salt
2 Lbs Semolina
1 1/2 tsp Salt
3 Cups Water
4 tablespoons Olive Oil
6 tablespoons Olive Oil', 'Preheat your oven''s broiler. Place red bell peppers and tomatoes on a baking sheet, and roast under the broiler for about 8 minutes, turning occasionally. This should blacken the skin and help it peel off more easily. Cool, then scrape the skins off of the tomatoes and peppers, and place them in a large bowl. Remove cores and seeds from the bell peppers.

Heat 1 tablespoon of olive oil in a skillet over medium heat. Add the jalapenos and garlic, and cook until tender, stirring frequently. Remove from heat, and transfer the garlic and jalapeno to the bowl with the tomatoes and red peppers. Using two sharp steak knives (one in each hand), cut up the tomatoes and peppers to a coarse and soupy consistency. Stir, and set sauce aside.

Place the semolina in a large bowl, and stir in salt and 4 tablespoons of olive oil. Gradually add water while mixing and squeezing with your hand until the dough holds together without being sticky or dry, and molds easily with the hand. Divide into 6 pieces and form into balls.

For each round, heat 1 tablespoon of olive oil in a large heavy skillet over medium heat. Roll out dough one round at a time, to no thicker than 1/4 inch. Fry in the hot skillet until dark brown spots appear on the surface, and they are crispy. Remove from the skillet, and wrap in a clean towel while preparing the remaining flat breads.

To eat the bread and sauce, break off pieces of the bread, and scoop them into the sauce. It will slide off, but just keep reaching in!', 'https://www.themealdb.com/images/media/meals/se5vhk1764114880.jpg', 5),
(@uid, 'Algerian Flafla (Bell Pepper Salad)', 'Heerlijk lunchgerecht uit de Algerian keuken.', 35, 4, '3 Green Pepper
1 tablespoon Olive Oil
1 tablespoon chopped Red Onions
1 clove peeled crushed Garlic
To taste Salt
To taste Pepper
1 Diced Plum Tomatoes', 'Preheat an oven to 450 degrees F (230 degrees C). Place the whole peppers on aluminum foil. Bake until the skin is spotted black and the peppers are soft, 30 to 45 minutes, turning the peppers once if necessary.

Remove peppers from the oven and set aside to cool for 10 minutes. Peel off the skin and remove the stem and seeds. Chop the roasted peppers into half-inch pieces.

Heat the olive oil in a skillet over medium heat. Stir in the onion and cook, stirring frequently, until the onion has softened and turned translucent, about 5 minutes. Add the garlic, salt, and pepper; stir in the chopped peppers and tomato. Cook over medium heat, stirring occasionally, until the tomato is soft and the mixture is well incorporated, about 5 minutes.', 'https://www.themealdb.com/images/media/meals/tbj1bs1764118062.jpg', 2),
(@uid, 'Algerian Kefta (Meatballs)', 'Heerlijk dinergerecht uit de Algerian keuken.', 50, 4, '1 lb Ground Beef
4 Cloves Crushed Garlic
1/2 cup Onion
To taste Salt
To taste Pepper
3 Plum Tomatoes
1 tsp Parsley
1/2 cup Water', 'Combine ground beef with 1/2 of the minced garlic and 1 tablespoon chopped onion in a large bowl. Mix with your hands until fully incorporated. Shape meat mixture into 1 1/2-inch oblong patties; you should have 12 to 14 meatballs.

Heat a large skillet over medium-high heat. Brown patties in batches in the hot skillet until crispy on both sides and no longer pink in the center, about 10 minutes. Set meatballs aside in a rimmed serving dish.

Reduce heat to medium and stir remaining chopped onion into drippings in the skillet. Season with salt and pepper. Cook, stirring constantly, until onion has softened and turned translucent, about 5 minutes. Stir in remaining garlic and cook for 30 seconds. Stir in Roma tomatoes, dried parsley, and ras el hanout. Pour in water. Cook until tomatoes are soft, about 5 minutes.

Pour tomato sauce over meatballs to serve.', 'https://www.themealdb.com/images/media/meals/8rfd4q1764112993.jpg', 3),
(@uid, 'Antiguan Breakfast (Chop Up and ‘Saltfish’)', 'Heerlijk ontbijtgerecht uit de internationale keuken.', 20, 4, '4 Egg Plants
8 oz Callaloo
1 lb Pumpkin
3 cloves Chopped Garlic
1 Diced Onion
2 oz Butter
1/2 tsp Salt
1/4 tsp Black Pepper', 'Peel and chop eggplant and pumpkin into medium-sized pieces.

Heat butter and add onions and garlic in a medium sized pot set to medium to high heat. Sauté for 2 minutes until softened but not browned.
Add pumpkin and eggplant. Sauté for an additional two to three minutes.
Add water just to cover the vegetables. Bring to a boil, reduce heat to a simmer and cook until the vegetables are soft.
Add the chopped spinach, stir and cook for an additional 3 minutes.
Pour the vegetable mixture into a colander and let drain.
After vegetable mixture has been drained return it to the pot and mash vigorously with a potato masher or a thick whisk.
Add salt and pepper. Adjust seasoning to taste.', 'https://www.themealdb.com/images/media/meals/jvjnoh1780086318.jpg', 1),
(@uid, 'Anzac biscuits', 'Heerlijk dessertgerecht uit de Australian keuken.', 45, 4, '85g Porridge oats
85g Desiccated Coconut
100g Plain Flour
100g Caster Sugar
100g Butter
1 tblsp Golden Syrup
1 teaspoon Bicarbonate Of Soda', 'step 1
Heat oven to 180C/fan 160C/gas 4. Put the oats, coconut, flour and sugar in a bowl. Melt the butter in a small pan and stir in the golden syrup. Add the bicarbonate of soda to 2 tbsp boiling water, then stir into the golden syrup and butter mixture.

step 2
Make a well in the middle of the dry ingredients and pour in the butter and golden syrup mixture. Stir gently to incorporate the dry ingredients.

step 3
Put dessertspoonfuls of the mixture on to buttered baking sheets, about 2.5cm/1in apart to allow room for spreading. Bake in batches for 8-10 mins until golden. Transfer to a wire rack to cool.', 'https://www.themealdb.com/images/media/meals/q47rkb1762324620.jpg', 4),
(@uid, 'Apam balik', 'Heerlijk dessertgerecht uit de Malaysian keuken.', 45, 4, '200ml Milk
60ml Oil
2 Eggs
1600g Flour
3 tsp Baking Powder
1/2 tsp Salt
25g Unsalted Butter
45g Sugar
3 tbs Peanut Butter', 'Mix milk, oil and egg together. Sift flour, baking powder and salt into the mixture. Stir well until all ingredients are combined evenly.

Spread some batter onto the pan. Spread a thin layer of batter to the side of the pan. Cover the pan for 30-60 seconds until small air bubbles appear.

Add butter, cream corn, crushed peanuts and sugar onto the pancake. Fold the pancake into half once the bottom surface is browned.

Cut into wedges and best eaten when it is warm.', 'https://www.themealdb.com/images/media/meals/adxcbq1619787919.jpg', 4),
(@uid, 'Arepa Pabellón', 'Heerlijk dinergerecht uit de Venezuela keuken.', 50, 4, '2 Corn Arepa Filled With Mozarella Cheese
1 Fried Ripe Bananas
1 Can Black Beans
1 Pico De Gallo Sauce
2kg Shredded Meat
1 chopped Tomato
Pinch Salt
Pinch Pepper', 'Prepare the meat in a skillet and add salt and pepper to taste, heat the beans over medium heat in a pan, fry or grill the ripe plantains as indicated on its package and cut the tomato into small cubes. Reserve these ingredients until filling. 
Preheat the grill or pan and grill the arepa, putting it once on each side until they are golden brown. 
With the help of a knife, open it by the edge through the middle, creating a space to fill it with the ripe plantain, the beans, meat and chopped tomato. 
Serve with a little pico de gallo or guacamole dip sauce.', 'https://www.themealdb.com/images/media/meals/13fg4j1764441982.jpg', 3),
(@uid, 'Arepa pelua', 'Heerlijk dinergerecht uit de Venezuela keuken.', 50, 4, '500g Beef
1 Onion
1 Red Pepper
2 cloves Garlic
1 tsp Cumin
1 tsp Oregano
1 tsp Paprika
1 L Beef Stock
2 1/2 cups Water
Pinch Salt
200g Cheese
Pinch Extra Virgin Olive Oil', 'Cook the meat: Place the flank steak in a pot with broth or water and salt. Cook over low heat for about 2 hours, until tender and easy to shred.
Shred the meat: Once cooked, drain and shred the meat using two forks.
Prepare the vegetables: Sauté chopped onion, bell pepper, and garlic in a little oil. Add cumin, oregano, paprika, and salt. Stir in the meat and cook for a few minutes until the flavors are well combined.
Make the dough: In a bowl, mix the cornmeal with warm water and salt until a soft dough forms. Let it rest for 5 minutes.
Form the arepas: Divide the dough into 6 portions, shape into balls, and flatten into thick discs.
Cook: Cook the arepas on a griddle or skillet over medium heat for 2–3 minutes on each side until golden. You can then bake them for a few minutes if you prefer them crispier.
Fill: Slice the arepas open on one side, fill with the hot shredded beef, and top with grated cheese.', 'https://www.themealdb.com/images/media/meals/jgl9qq1764437635.jpg', 3),
(@uid, 'Arroz al horno (baked rice)', 'Heerlijk dinergerecht uit de Spanish keuken.', 50, 4, '2 tbsp Extra Virgin Olive Oil
800g Pork belly slices
150g Black Pudding
100g Bacon lardon
1 chopped Onion
2 Red Pepper
1 chopped Plum Tomatoes
8 Garlic Clove
4 teaspoons Paprika
1/2 teaspoon Chilli Flakes
200g Dried white beans
1 1/2 L Chicken Stock
6 parts Thyme
375g Paella Rice
1 Lemon Juice', 'step 1
Heat oven to 200C/180C/gas 6. Heat half the oil in a deep frying or sauté pan (or shallow casserole dish) measuring around 30cm in diameter. Over a high heat, colour the pork belly slices on each side in several batches, then transfer to a bowl. Add the remaining oil to the pan and lower the heat to medium, then add the black pudding and bacon and fry all over for several mins. Remove with a slotted spoon. Fry the onion and peppers for around 10 mins until soft and pale gold, then add the tomato and cook until soft. Add the garlic, smoked paprika and chilli flakes and cook for another 2 mins, then put the pork, black pudding and bacon back in the pan. Add the beans, stock and whichever herb you''re using, and bring everything to the boil.

step 2
Sprinkle the rice around the pork belly, pushing it underneath the stock. Let the stock come to the boil again, season well, then transfer to the oven (leave it uncovered). Cook for 20 mins without stirring, then check to see how the rice is doing. The rice should be tender and the stock absorbed. If it’s not ready, put back in the oven for another 5 mins, then check again. Taste for seasoning.

step 3
Squeeze lemon juice over the top and drizzle over some extra virgin olive oil just before serving, if you like.', 'https://www.themealdb.com/images/media/meals/qt4i0n1763256454.jpg', 3),
(@uid, 'Aubergine & hummus grills', 'Heerlijk lunchgerecht uit de Turkish keuken.', 35, 4, '2 Aubergine
2 tablespoons Vegetable Oil
3 sliced thinly Bread
300g Hummus
100g Walnuts
40g Parsley
200g Cherry Tomatoes
Juice of 1/2 Lemon
Splash Extra Virgin Olive Oil', 'step 1
Lay the aubergine out in one layer on a large baking sheet. Brush sparingly with vegetable oil, then season generously. Grill for 15 mins, turning twice and brushing with oil until the slices are softened and cooked through. Meanwhile, whizz the bread into crumbs. Add 2 tsp oil and whizz briefly again, to coat.

step 2
Spread a couple of tsps of hummus on top of each slice of aubergine. Tip the breadcrumbs onto a large plate, then press the hummus side of the aubergines into the crumbs to coat. Grill again, crumb-side up, for about 3 mins until golden.

step 3
Toss the walnuts, parsley and cherry tomatoes in a bowl, season, then add the lemon juice and olive oil and toss again. Serve the grills with the salad, a dollop more hummus and some pitta bread.', 'https://www.themealdb.com/images/media/meals/zub3s91764110535.jpg', 2),
(@uid, 'Bread omelette', 'Heerlijk ontbijtgerecht uit de India keuken.', 20, 4, '2 Bread
2 Egg
0.5 Salt', 'Make and enjoy', 'https://www.themealdb.com/images/media/meals/hqaejl1695738653.jpg', 1);
