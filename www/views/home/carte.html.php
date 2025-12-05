<div class="relative w-full min-h-screen bg-black/50">

    <div class="pt-12 pb-8 flex flex-col items-center justify-center text-center text-white px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-2 text-white">
            La carte
        </h1>
        <p class="text-gray-200 text-sm md:text-base">Découvrez nos recettes artisanales</p>
    </div>

    <div class="container mx-auto px-4 pb-20">
        <?php if (empty($pizzas)): ?>
            <div class="text-center text-white text-xl mt-10">
                Aucune pizza disponible pour le moment.
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($pizzas as $pizza): ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 hover:shadow-xl transition duration-300 flex flex-col h-full">

                        <div class="h-40 overflow-hidden bg-gray-100 relative group">
                            <?php if ($pizza->image_url): ?>
                                <img src="<?= htmlspecialchars($pizza->image_url) ?>"
                                    alt="<?= htmlspecialchars($pizza->name) ?>"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                                    <span class="text-sm">Pas d'image</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="p-4 flex flex-col flex-grow">
                            <h2 class="text-lg font-bold text-gray-800 mb-1 leading-tight">
                                <?= htmlspecialchars($pizza->name) ?>
                            </h2>

                            <p class="text-gray-600 text-xs mb-4 line-clamp-3 flex-grow">
                                <?= htmlspecialchars($pizza->description) ?>
                            </p>

                            <button class="w-full bg-gray-900 hover:bg-gray-800 text-white text-xs font-bold py-2 px-4 rounded transition duration-200 flex items-center justify-center gap-2">
                                <span>Commander</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>