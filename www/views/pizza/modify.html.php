<div class="relative w-full min-h-screen bg-black/50">

    <div class="pt-12 pb-8 flex flex-col items-center justify-center text-center text-white px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-2 text-white">
            Modifier les pizzas
        </h1>
        <p class="text-gray-200 text-sm md:text-base">Quelles pizzas voulez-vous modifier ?</p>
    </div>

    <div class="container mx-auto px-4 pb-20">
        <?php if (empty($pizzas)): ?>
            <div class="text-center text-white text-xl mt-10">
                Aucune pizza pour le moment.
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

                            <a href="/pizza/edit/<?= $pizza->id ?>" class="w-full bg-gray-900 hover:bg-gray-800 text-white text-xs font-bold py-2 px-4 rounded transition duration-200 flex items-center justify-center gap-2">
                                Modifier
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"/><path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3"/></g></svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <a href="/pizza" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-bold shadow-lg transition">
            Retour
        </a>
</div>