<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto w-full space-y-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-8 text-center">
                <h2 class="text-3xl text-white font-bold">Création de pizza</h2>
                <p class="text-indigo-100 mt-2">Ajouter une nouvelle pizza à la stack technique</p>
            </div>

            <form action="/pizza/create" method="post" enctype="multipart/form-data" class="p-6 space-y-8">
                <input type="hidden" name="_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">

                <?php if (isset($error)): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex">
                        <p class="text-sm text-red-700"><?= $error ?></p>
                    </div>
                <?php endif ?>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="title">Nom de la pizza</label>
                    <input id="title"
                        name="title"
                        type="text"
                        required
                        value="<?= htmlspecialchars($title_value ?? '') ?>"
                        placeholder="ex: La Python"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 placeholder-gray-400">
                </div>

                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-8">

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-4 border-b border-indigo-200 pb-2">🏗️ Les Bases (Frameworks)</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="base" value="Base Tomate" class="ingredient-trigger peer sr-only">
                                <div class="p-3 rounded-lg border-2 border-gray-200 bg-white hover:border-indigo-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all text-center h-full flex items-center justify-center">
                                    <span class="block font-medium text-gray-900 peer-checked:text-indigo-700">🍅 Tomate</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="base" value="Base Tomate Pimentée" class="ingredient-trigger peer sr-only">
                                <div class="p-3 rounded-lg border-2 border-gray-200 bg-white hover:border-indigo-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all text-center h-full flex items-center justify-center">
                                    <span class="block font-medium text-gray-900 peer-checked:text-indigo-700">🌶️ Tomate Pimentée</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="base" value="Base Crème Fraîche" class="ingredient-trigger peer sr-only">
                                <div class="p-3 rounded-lg border-2 border-gray-200 bg-white hover:border-indigo-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all text-center h-full flex items-center justify-center">
                                    <span class="block font-medium text-gray-900 peer-checked:text-indigo-700">🥛 Crème Fraîche</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="base" value="Base Pesto" class="ingredient-trigger peer sr-only">
                                <div class="p-3 rounded-lg border-2 border-gray-200 bg-white hover:border-indigo-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all text-center h-full flex items-center justify-center">
                                    <span class="block font-medium text-gray-900 peer-checked:text-indigo-700">🌿 Pesto Genovese</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="base" value="Base Sauce BBQ" class="ingredient-trigger peer sr-only">
                                <div class="p-3 rounded-lg border-2 border-gray-200 bg-white hover:border-indigo-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all text-center h-full flex items-center justify-center">
                                    <span class="block font-medium text-gray-900 peer-checked:text-indigo-700">🔥 Sauce BBQ</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="base" value="Base Huile & Ail" class="ingredient-trigger peer sr-only">
                                <div class="p-3 rounded-lg border-2 border-gray-200 bg-white hover:border-indigo-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all text-center h-full flex items-center justify-center">
                                    <span class="block font-medium text-gray-900 peer-checked:text-indigo-700">🧄 Bianca (Huile/Ail)</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="base" value="Base Crème Citronnée" class="ingredient-trigger peer sr-only">
                                <div class="p-3 rounded-lg border-2 border-gray-200 bg-white hover:border-indigo-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all text-center h-full flex items-center justify-center">
                                    <span class="block font-medium text-gray-900 peer-checked:text-indigo-700">🍋 Crème Citronnée</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="base" value="Base Pâte Sucrée" class="ingredient-trigger peer sr-only">
                                <div class="p-3 rounded-lg border-2 border-gray-200 bg-white hover:border-indigo-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all text-center h-full flex items-center justify-center">
                                    <span class="block font-medium text-gray-900 peer-checked:text-indigo-700">🍪 Pâte Sucrée</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-3 border-b border-indigo-200 pb-1">🧀 Fromages (Libraries)</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php 
                            $cheeses = ['Mozzarella Fior di Latte', 'Mozzarella Di Bufala', 'Billes de Mozza', 'Burrata', 'Ricotta', 'Cheddar Affiné', 'Chèvre', 'Parmesan', 'Gorgonzola'];
                            foreach($cheeses as $cheese): ?>
                            <label class="flex items-center space-x-2 p-2 border border-gray-200 rounded bg-white hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="<?= $cheese ?>" class="ingredient-trigger w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300">
                                <span class="text-sm text-gray-700"><?= $cheese ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-3 border-b border-indigo-200 pb-1">🥩 Viandes & Poissons (Backend)</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php 
                            $meats = ['Jambon Blanc', 'Jambon de Parme', 'Bacon Croustillant', 'Spianata Piccante', 'Nduja', 'Chorizo', 'Pulled Pork', 'Pepperoni', 'Bœuf Haché', 'Carpaccio Bœuf', 'Poulet Mariné', 'Merguez', 'Saumon Fumé', 'Œuf'];
                            foreach($meats as $meat): ?>
                            <label class="flex items-center space-x-2 p-2 border border-gray-200 rounded bg-white hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="<?= $meat ?>" class="ingredient-trigger w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300">
                                <span class="text-sm text-gray-700"><?= $meat ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-3 border-b border-indigo-200 pb-1">🥦 Légumes & Fruits (Frontend)</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php 
                            $veggies = ['Courgettes Marinées', 'Poivrons Rouges', 'Poivrons Tricolores', 'Piments Jalapeños', 'Oignons Rouges', 'Oignons Frits', 'Oignons Caramélisés', 'Tomates Cerises', 'Champignons', 'Artichauts', 'Roquette', 'Ail Frais', 'Ananas', 'Figues', 'Olives Noires'];
                            foreach($veggies as $veg): ?>
                            <label class="flex items-center space-x-2 p-2 border border-gray-200 rounded bg-white hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="<?= $veg ?>" class="ingredient-trigger w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300">
                                <span class="text-sm text-gray-700"><?= $veg ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-3 border-b border-indigo-200 pb-1">🎨 Finitions (CSS & Styles)</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php 
                            $finishes = ['Miel', 'Crème Balsamique', 'Sauce Curry-Mangue', 'Huile de Truffe', 'Huile Pimentée', 'Basilic Frais', 'Aneth', 'Romarin', 'Pignons de Pin', 'Noix', 'Zestes de Citron'];
                            foreach($finishes as $finish): ?>
                            <label class="flex items-center space-x-2 p-2 border border-gray-200 rounded bg-white hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="<?= $finish ?>" class="ingredient-trigger w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300">
                                <span class="text-sm text-gray-700"><?= $finish ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-3 border-b border-indigo-200 pb-1">🍪 Le Sucré (Cookies)</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php 
                            $sweets = ['Nutella', 'Éclats de Noisettes', 'M&Ms', 'Sucre Glace'];
                            foreach($sweets as $sweet): ?>
                            <label class="flex items-center space-x-2 p-2 border border-gray-200 rounded bg-white hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="<?= $sweet ?>" class="ingredient-trigger w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300">
                                <span class="text-sm text-gray-700"><?= $sweet ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <label for="final_description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Description générée <span class="text-xs font-normal text-gray-500">(modifiable manuellement)</span>
                        </label>
                        <textarea id="final_description"
                            name="description"
                            rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 bg-white"
                            placeholder="Sélectionnez les ingrédients ci-dessus..."></textarea>
                    </div>
                </div>

                <script>
                    const triggers = document.querySelectorAll('.ingredient-trigger');
                    const output = document.getElementById('final_description');

                    function updateDescription() {
                        let text = "";
                        const base = document.querySelector('input[name="base"]:checked');
                        
                        // Ajout de la base
                        if (base) {
                            text += base.value;
                        }

                        // Ajout des garnitures
                        const checked = document.querySelectorAll('input[name="ingredients[]"]:checked');
                        if (checked.length > 0) {
                            if (text) text += ", "; // Virgule si on a déjà une base
                            const values = Array.from(checked).map(cb => cb.value);
                            // On joint les ingrédients joliment
                            const last = values.pop();
                            const ingredientsList = values.length > 0 ? values.join(", ") + " et " + last : last;
                            text += ingredientsList;
                        }
                        
                        if (text) output.value = text + ".";
                        else output.value = "";
                    }

                    triggers.forEach(input => {
                        input.addEventListener('change', updateDescription);
                    });
                </script>

                <div>
                    <label for="base_price" class="block text-sm font-semibold text-gray-700 mb-2">
                        Prix de base (€)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">€</span>
                        </div>
                        <input type="number"
                            step="0.01"
                            id="price"
                            name="price"
                            placeholder="12.50"
                            class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Photo de la pizza</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition-all duration-200 cursor-pointer group">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="media" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                    <span>Télécharger une image</span>
                                    <input id="media" name="media" type="file" class="sr-only" accept="image/jpeg,image/jpg,image/png,image/webp">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, WEBP jusqu'à 10MB</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                    <a href="/dashboard" class="px-6 py-3 text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 font-medium rounded-lg transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Annuler
                    </a>
                    <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl duration-200 transition-all transform hover:-translate-y-0.5 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Enregistrer la pizza
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>