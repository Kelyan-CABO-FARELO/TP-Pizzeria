<div class="relative w-full min-h-screen bg-black/50">
    <div class="pt-12 pb-8 flex flex-col items-center justify-center text-center text-white px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-2 text-white">
            Gérer les tailles et les prix
        </h1>
    </div>

    <div class="container mx-auto px-4 pb-20">
        <?php if (empty($tailles)): ?>
            <div class="text-center text-white text-xl">
                Aucune taille configurée.
            </div>
        <?php else: ?>
            <div class=" flex justify-center grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <?php foreach ($tailles as $taille): ?>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 hover:shadow-xl transition duration-300 flex flex-col h-full">
                        <div class="p-6 flex flex-col flex-grow items-center justify-center text-center">

                            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                <?= htmlspecialchars($taille->label) ?>
                            </h2>

                            <div class="text-3xl font-bold text-indigo-600 mb-4">
                                <?php
                                echo ($taille->price_supplement > 0 ? '+' : '') . number_format($taille->price_supplement, 2);
                                ?> €
                            </div>

                            <p class="text-gray-500 text-sm">Supplément appliqué</p>

                            <div class="mt-4 pt-4 w-full border-t border-gray-100 flex justify-center gap-4">
                                <a href="/modifysizeprice/<?= $taille->id ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Modifier
                                </a>

                                <a href="/sizeprice/delete/<?= $taille->id ?>"
                                    onclick="return confirm('Supprimer cette taille ?');"
                                    class="text-red-600 hover:text-red-800 font-semibold text-sm flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="mt-8 flex justify-center gap-4">
            <a href="/pizza" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-bold shadow-lg transition">
                Retour
            </a>
            <a href="/addsize" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold shadow-lg transition">
                Ajouter une taille
            </a>
        </div>
    </div>
</div>