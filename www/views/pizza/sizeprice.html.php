<div class="relative w-full min-h-screen bg-black/50"> <div class="pt-12 pb-8 flex flex-col items-center justify-center text-center text-white px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-2 text-white">
            Gérer les tailles et les prix
        </h1>
    </div>

    <div class="container mx-auto px-4 pb-20 ">
        <?php if (empty($tailles)): ?>
            <div class="text-center text-white text-xl">
                Aucune taille configurée.
            </div>
        <?php else: ?>
            <div class="flex justify-around grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                
                <?php foreach ($tailles as $taille): ?>
                    
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 hover:shadow-xl transition duration-300 flex flex-col h-full">
                        <div class="p-6 flex flex-col flex-grow items-center justify-center text-center">
                            
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                <?= htmlspecialchars($taille->label) ?>
                            </h2>

                            <div class="text-3xl font-bold text-indigo-600 mb-4">
                                <?php 
                                    // Affiche un "+" si le prix est positif
                                    echo ($taille->price_supplement > 0 ? '+' : '') . number_format($taille->price_supplement, 2); 
                                ?> €
                            </div>
                            
                            <p class="text-gray-500 text-sm">Supplément appliqué au prix de base</p>

                            <div class="mt-4 pt-4 w-full border-t border-gray-100">
                                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Modifier</a>
                            </div>
                        </div>
                    </div> <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <a href="#" class="flex justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
            Ajouter une taille
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z"/></svg>
        </a>
    </div>
</div>