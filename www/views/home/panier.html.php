<div class="relative w-full min-h-screen bg-black/50">
    <div class="pt-24 pb-8 flex flex-col items-center justify-center text-center text-white px-4">
        <h1 class="text-4xl font-bold mb-2">Votre Panier</h1>
    </div>

    <div class="container mx-auto px-4 pb-20 max-w-4xl">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <?php if (empty($items)): ?>
                <div class="p-8 text-center text-gray-500">
                    Votre panier est vide. <a href="/carte" class="text-indigo-600 font-bold hover:underline">Retour à la carte</a>
                </div>
            <?php else: ?>
                <div class="p-6">
                    <?php foreach ($items as $item): ?>
                        <div class="flex justify-between items-center border-b border-gray-200 py-4 last:border-0">
                            <div class="flex items-center gap-4">
                                <?php if ($item['pizza']->image_url): ?>
                                    <img src="<?= $item['pizza']->image_url ?>" class="w-16 h-16 object-cover rounded-md">
                                <?php endif; ?>
                                <div>
                                    <h3 class="font-bold text-gray-800"><?= htmlspecialchars($item['pizza']->name) ?></h3>
                                    <span class="text-sm text-gray-500">Taille : <?= htmlspecialchars($item['taille']->label) ?></span>
                                </div>
                            </div>
                            <div class="flex items-center gap-6">
                                <span class="font-bold text-indigo-600"><?= number_format($item['price'], 2) ?> €</span>
                                <a href="/panier/remove/<?= $item['index'] ?>" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="bg-gray-50 p-6 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-2xl font-bold text-gray-800">
                        Total : <span class="text-indigo-600"><?= number_format($total, 2) ?> €</span>
                    </div>
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="/commande/validate" method="POST">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition transform hover:-translate-y-0.5">
                                Valider la commande
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="/login" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition">
                            Connectez-vous pour commander
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>