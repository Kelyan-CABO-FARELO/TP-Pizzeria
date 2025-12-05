<div class="relative w-full min-h-screen bg-black/50">
    <div class="pt-12 pb-8 flex flex-col items-center justify-center text-center text-white px-4">
        <h2 class="text-3xl text-white font-bold">Ajouter une nouvelle taille</h2>
    </div>

    <div class="container mx-auto px-4 pb-20 max-w-lg">
        <div class="bg-white rounded-lg shadow-md p-6">

            <form action="/addsize" method="POST">

                <input type="hidden" name="_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nom de la taille (ex: XL, Géante)</label>
                    <input type="text" name="label" placeholder="Nom de la taille" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Supplément de prix (€)</label>
                    <input type="number" step="0.01" name="price_supplement" placeholder="0.00" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <p class="text-xs text-gray-500 mt-1">Mettez une valeur négative (ex: -2.00) pour réduire le prix.</p>
                </div>

                <div class="flex items-center justify-between">
                    <a href="/sizeprice" class="text-gray-600 hover:text-gray-800 font-bold">Annuler</a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Créer la taille
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>