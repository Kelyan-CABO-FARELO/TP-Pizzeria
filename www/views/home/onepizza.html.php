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
                    <span id="display-price" data-base-price="<?= $pizza->base_price ?>">
                        <?= number_format($pizza->base_price, 2) ?>
                    </span> €
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
                        
                        <?php foreach ($tailles as $taille): ?>
                            <?php 
                                // Calcul PHP : Si base_price = 12 et supplement = -2, alors total = 10
                                $prixTotalTaille = $pizza->base_price + $taille->price_supplement;
                                
                                // On détermine si c'est la taille par défaut (celle qui a 0 de supplément, donc la Moyenne)
                                $isDefault = ($taille->price_supplement == 0);
                            ?>
                            <label class="cursor-pointer group">
                                <input type="radio" 
                                       name="size" 
                                       value="<?= $taille->id ?>" 
                                       data-supplement="<?= $taille->price_supplement ?>"
                                       class="peer sr-only size-selector"
                                       <?= $isDefault ? 'checked' : '' ?> 
                                >
                                <div class="rounded-lg border border-gray-300 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 py-3 text-center transition-all hover:border-yellow-400 flex flex-col justify-center h-full">
                                    
                                    <span class="font-bold text-gray-800 text-sm">
                                        <?= htmlspecialchars($taille->label) ?>
                                    </span>
                                    
                                    <span class="text-xs text-gray-500 font-semibold mt-1 group-hover:text-yellow-600 peer-checked:text-yellow-700">
                                        <?= number_format($prixTotalTaille, 2) ?> €
                                    </span>

                                </div>
                            </label>
                        <?php endforeach; ?>

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

<script>
document.addEventListener('DOMContentLoaded', () => {
    const priceDisplay = document.getElementById('display-price');
    const basePrice = parseFloat(priceDisplay.dataset.basePrice);
    const sizeInputs = document.querySelectorAll('.size-selector');

    function updatePrice() {
        let supplement = 0;
        
        // Trouver le bouton coché
        sizeInputs.forEach(input => {
            if (input.checked) {
                // parseFloat gère très bien les nombres négatifs ("-2.00" devient -2)
                supplement = parseFloat(input.dataset.supplement);
            }
        });

        // L'addition fonctionne comme une soustraction si le nombre est négatif
        // Exemple : 12 + (-2) = 10
        const total = basePrice + supplement;
        
        priceDisplay.textContent = total.toFixed(2);
    }

    sizeInputs.forEach(input => {
        input.addEventListener('change', updatePrice);
    });

    // Lancement au chargement pour afficher le bon prix par défaut
    updatePrice();
});
</script>