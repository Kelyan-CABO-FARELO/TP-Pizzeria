<div class="relative w-full min-h-screen bg-black/50 flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

        <div class="w-full md:w-1/2 h-64 md:h-auto bg-gray-100 relative">
            <?php if ($pizza->image_url): ?>
                <img src="<?= htmlspecialchars($pizza->image_url) ?>"
                    alt="<?= htmlspecialchars($pizza->name) ?>"
                    class="w-full h-full object-cover">
            <?php else: ?>
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                    Pas d'image
                </div>
            <?php endif; ?>
        </div>

        <div class="w-full md:w-1/2 p-8 flex flex-col">

            <div class="flex justify-between items-start mb-4">
                <h1 class="text-3xl font-bold text-gray-900 leading-tight">
                    <?= htmlspecialchars($pizza->name) ?>
                </h1>
                <span class="text-2xl font-bold text-yellow-600">
                    <?= number_format($pizza->base_price, 2) ?> €
                </span>
            </div>

            <p class="text-gray-600 mb-8 leading-relaxed">
                <?= htmlspecialchars($pizza->description) ?>
            </p>

            <hr class="border-gray-200 mb-6">

            <form action="/panier/add" method="POST" class="mt-auto">
                <input type="hidden" name="pizza_id" value="<?= $pizza->id ?>">

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Choisissez votre taille</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="size" value="S" class="peer sr-only">
                            <div class="rounded-lg border border-gray-300 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 py-3 text-center transition-all hover:border-yellow-400">
                                <div class="font-bold text-gray-800">Petite</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="size" value="M" class="peer sr-only" checked>
                            <div class="rounded-lg border border-gray-300 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 py-3 text-center transition-all hover:border-yellow-400">
                                <div class="font-bold text-gray-800">Moyenne</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="size" value="L" class="peer sr-only">
                            <div class="rounded-lg border border-gray-300 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 py-3 text-center transition-all hover:border-yellow-400">
                                <div class="font-bold text-gray-800">Grande</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex gap-4">
                    <a href="/carte" class="px-6 py-3 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300 transition text-center">
                        Retour
                    </a>
                    <button type="submit" class="flex-grow bg-gray-900 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-lg transition shadow-lg flex justify-center items-center gap-2">
                        Ajouter au panier
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>