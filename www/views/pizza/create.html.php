<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-gray-50">
    <div class="max-w-2xl w-full">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-8 text-center">
                <h2 class="text-3xl text-white font-bold">Création de pizza</h2>
                <p class="text-indigo-100 mt-2">Ajouter une nouvelle pizza au menu</p>
            </div>

            <form action="/pizza/create" method="post" enctype="multipart/form-data" class="p-6 space-y-6">
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
                        placeholder="ex: La Royale"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 placeholder-gray-400">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="description">Description / Ingrédients</label>
                    <textarea id="description"
                        name="description"
                        rows="4"
                        required
                        placeholder="ex: Sauce tomate, mozzarella, jambon, champignons..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 placeholder-gray-400"><?= htmlspecialchars($description_value ?? '') ?></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                            Prix (€)
                        </label>
                        <input type="number"
                            step="0.01"
                            id="price"
                            name="price"
                            placeholder="12.50"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900">
                    </div>

                    <div class="flex flex-col justify-center">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Photo</label>
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
                    <a href="/dashboard" class="px-6 py-3 text-gray-700 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition text-sm transform hover:-translate-y-0.5">
                        Annuler
                    </a>
                    <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl duration-200 transition-all transform hover:-translate-y-0.5">
                        Enregistrer la pizza
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>