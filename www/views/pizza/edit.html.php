<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto w-full space-y-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-8 text-center">
                <h2 class="text-3xl text-white font-bold">Modifier : <?= htmlspecialchars($pizza->name) ?></h2>
                <p class="text-indigo-100 mt-2">Modifiez les ingrédients et le prix de votre pizza</p>
            </div>

            <form action="/pizza/edit/<?= $pizza->id ?>" method="post" enctype="multipart/form-data" class="p-6 space-y-8">

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
                        value="<?= htmlspecialchars($pizza->name) ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900">
                </div>

                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-8">

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-4 border-b border-indigo-200 pb-2">🏗️ Les Bases</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <?php
                            $bases = [
                                'Base Tomate' => '🍅 Tomate',
                                'Base Tomate Pimentée' => '🌶️ Tomate Pimentée',
                                'Base Crème Fraîche' => '🥛 Crème Fraîche',
                                'Base Pesto' => '🌿 Pesto Genovese',
                                'Base Sauce BBQ' => '🔥 Sauce BBQ',
                                'Base Huile & Ail' => '🧄 Bianca',
                                'Base Crème Citronnée' => '🍋 Crème Citronnée',
                                'Base Pâte Sucrée' => '🍪 Pâte Sucrée'
                            ];
                            foreach ($bases as $val => $label):
                                // On vérifie si la description contient le nom de la base
                                $checked = str_contains($pizza->description, $val) ? 'checked' : '';
                            ?>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="base" value="<?= $val ?>" class="ingredient-trigger peer sr-only" <?= $checked ?>>
                                    <div class="p-3 rounded-lg border-2 border-gray-200 bg-white hover:border-indigo-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all text-center h-full flex items-center justify-center">
                                        <span class="block font-medium text-gray-900 peer-checked:text-indigo-700"><?= $label ?></span>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-3 border-b border-indigo-200 pb-1">🧀 Fromages</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php
                            $cheeses = ['Mozzarella Fior di Latte', 'Mozzarella Di Bufala', 'Billes de Mozza', 'Burrata', 'Ricotta', 'Cheddar Affiné', 'Chèvre', 'Parmesan', 'Gorgonzola'];
                            foreach ($cheeses as $cheese):
                                $isChecked = str_contains($pizza->description, $cheese) ? 'checked' : '';
                            ?>
                                <label class="cursor-pointer relative group">
                                    <input type="checkbox" name="ingredients[]" value="<?= $cheese ?>" class="ingredient-trigger peer sr-only" <?= $isChecked ?>>
                                    <div class="flex items-center space-x-2 p-2 border border-gray-200 rounded bg-white hover:bg-gray-50 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:ring-1 peer-checked:ring-indigo-500 transition-all">
                                        <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:bg-indigo-600 peer-checked:border-indigo-600"></div>
                                        <span class="text-sm text-gray-700 font-medium"><?= $cheese ?></span>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-3 border-b border-indigo-200 pb-1">🥩 Viandes & Poissons</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php
                            $meats = ['Jambon Blanc', 'Jambon de Parme', 'Bacon Croustillant', 'Spianata Piccante', 'Nduja', 'Chorizo', 'Pulled Pork', 'Pepperoni', 'Bœuf Haché', 'Carpaccio Bœuf', 'Poulet Mariné', 'Merguez', 'Saumon Fumé', 'Œuf'];
                            foreach ($meats as $meat):
                                $isChecked = str_contains($pizza->description, $meat) ? 'checked' : '';
                            ?>
                                <label class="cursor-pointer relative group">
                                    <input type="checkbox" name="ingredients[]" value="<?= $meat ?>" class="ingredient-trigger peer sr-only" <?= $isChecked ?>>
                                    <div class="flex items-center space-x-2 p-2 border border-gray-200 rounded bg-white hover:bg-gray-50 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:ring-1 peer-checked:ring-indigo-500 transition-all">
                                        <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:bg-indigo-600 peer-checked:border-indigo-600"></div>
                                        <span class="text-sm text-gray-700 font-medium"><?= $meat ?></span>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-3 border-b border-indigo-200 pb-1">🥦 Légumes & Fruits</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php
                            $veggies = ['Courgettes Marinées', 'Poivrons Rouges', 'Poivrons Tricolores', 'Piments Jalapeños', 'Oignons Rouges', 'Oignons Frits', 'Oignons Caramélisés', 'Tomates Cerises', 'Champignons', 'Artichauts', 'Roquette', 'Ail Frais', 'Ananas', 'Figues', 'Olives Noires'];
                            foreach ($veggies as $veg):
                                $isChecked = str_contains($pizza->description, $veg) ? 'checked' : '';
                            ?>
                                <label class="cursor-pointer relative group">
                                    <input type="checkbox" name="ingredients[]" value="<?= $veg ?>" class="ingredient-trigger peer sr-only" <?= $isChecked ?>>
                                    <div class="flex items-center space-x-2 p-2 border border-gray-200 rounded bg-white hover:bg-gray-50 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:ring-1 peer-checked:ring-indigo-500 transition-all">
                                        <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:bg-indigo-600 peer-checked:border-indigo-600"></div>
                                        <span class="text-sm text-gray-700 font-medium"><?= $veg ?></span>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-3 border-b border-indigo-200 pb-1">🎨 Finitions</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php
                            $finishes = ['Miel', 'Crème Balsamique', 'Sauce Curry-Mangue', 'Huile de Truffe', 'Huile Pimentée', 'Basilic Frais', 'Aneth', 'Romarin', 'Pignons de Pin', 'Noix', 'Zestes de Citron'];
                            foreach ($finishes as $finish):
                                $isChecked = str_contains($pizza->description, $finish) ? 'checked' : '';
                            ?>
                                <label class="cursor-pointer relative group">
                                    <input type="checkbox" name="ingredients[]" value="<?= $finish ?>" class="ingredient-trigger peer sr-only" <?= $isChecked ?>>
                                    <div class="flex items-center space-x-2 p-2 border border-gray-200 rounded bg-white hover:bg-gray-50 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:ring-1 peer-checked:ring-indigo-500 transition-all">
                                        <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:bg-indigo-600 peer-checked:border-indigo-600"></div>
                                        <span class="text-sm text-gray-700 font-medium"><?= $finish ?></span>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <span class="block text-lg font-semibold text-indigo-700 mb-3 border-b border-indigo-200 pb-1">🍪 Le Sucré</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php
                            $sweets = ['Nutella', 'Éclats de Noisettes', 'M&Ms', 'Sucre Glace'];
                            foreach ($sweets as $sweet):
                                $isChecked = str_contains($pizza->description, $sweet) ? 'checked' : '';
                            ?>
                                <label class="cursor-pointer relative group">
                                    <input type="checkbox" name="ingredients[]" value="<?= $sweet ?>" class="ingredient-trigger peer sr-only" <?= $isChecked ?>>
                                    <div class="flex items-center space-x-2 p-2 border border-gray-200 rounded bg-white hover:bg-gray-50 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:ring-1 peer-checked:ring-indigo-500 transition-all">
                                        <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:bg-indigo-600 peer-checked:border-indigo-600"></div>
                                        <span class="text-sm text-gray-700 font-medium"><?= $sweet ?></span>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <label for="final_description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Description générée
                        </label>
                        <textarea id="final_description"
                            name="description"
                            rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 bg-white"><?= htmlspecialchars($pizza->description) ?></textarea>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        const triggers = document.querySelectorAll('.ingredient-trigger');
                        const output = document.getElementById('final_description');

                        function updateDescription() {
                            let text = "";

                            // 1. Récupérer la base
                            const base = document.querySelector('input[name="base"]:checked');
                            if (base) {
                                text += base.value;
                            }

                            // 2. Récupérer les ingrédients
                            const checked = document.querySelectorAll('input[name="ingredients[]"]:checked');
                            if (checked.length > 0) {
                                if (text) text += ", ";

                                const values = Array.from(checked).map(cb => cb.value);

                                if (values.length > 1) {
                                    const last = values.pop();
                                    text += values.join(", ") + " et " + last;
                                } else {
                                    text += values[0];
                                }
                            }

                            // 3. Mettre à jour (avec un point final)
                            output.value = text ? text + "." : "";
                        }

                        triggers.forEach(input => {
                            input.addEventListener('change', updateDescription);
                        });
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
                            value="<?= $pizza->base_price ?>"
                            required
                            class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Photo de la pizza</label>

                    <?php if ($pizza->image_url): ?>
                        <div class="mb-4 flex items-center gap-4 p-4 bg-gray-50 border rounded-lg">
                            <img src="<?= htmlspecialchars($pizza->image_url) ?>" alt="Actuelle" class="h-24 w-24 object-cover rounded shadow-sm">
                            <div class="text-sm text-gray-600">
                                <p class="font-medium text-gray-900">Image actuelle</p>
                                <p>Laissez le champ vide pour conserver cette image.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition-all duration-200 cursor-pointer group">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="media" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                    <span>Changer l'image</span>
                                    <input id="media" name="media" type="file" class="sr-only" accept="image/jpeg,image/jpg,image/png,image/webp">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, WEBP jusqu'à 10MB</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200 mt-6">

                    <a href="/pizza/delete/<?= $pizza->id ?>"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette pizza ? Cette action est irréversible.');"
                        class="px-6 py-3 bg-red-100 text-red-700 hover:bg-red-200 border border-red-200 rounded-lg font-bold transition-colors">
                        Supprimer la pizza
                    </a>

                    <div class="flex space-x-4">
                        <a href="/modify" class="px-6 py-3 text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                            Annuler
                        </a>

                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                            Mettre à jour
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>