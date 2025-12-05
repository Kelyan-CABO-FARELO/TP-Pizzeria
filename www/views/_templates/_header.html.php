<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Code</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>


<body class="font-sans text-gray-900 bg-gray-100">


    <div class="flex justify-end z-50 absolute top-4 right-4 gap-4">
        <?php
        $app = \JulienLinard\Core\Application::getInstance();
        $container = $app->getContainer();
        $auth = $container->make(\JulienLinard\Auth\AuthManager::class);
        $user = $auth->user();
        ?>

        <?php if ($user): ?>
            <div class="flex items-center gap-4 bg-black bg-opacity-50 p-2 rounded-lg text-white">
                <span>Bonjour, <strong><?= htmlspecialchars($user->lastname) ?></strong> !</span>
                <a href="/logout"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition text-sm">
                    Se déconnecter
                </a>
            </div>
        <?php else: ?>
            <div class="flex gap-2">
                <a href="/auth/login"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition text-sm">
                    Se connecter
                </a>
                <a href="/register"
                    class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition text-sm">
                    S'inscrire
                </a>
            </div>
        <?php endif; ?>
    </div>
    <div class="flex h-screen w-full">

        <aside class="w-64 bg-gray-900 text-white flex flex-col flex-shrink-0 transition-all duration-300 z-50">
            <div class="p-6 flex items-center justify-center border-b border-gray-800">
                <a href="/" class="flex items-center gap-3 text-2xl font-bold text-yellow-500 uppercase tracking-wider">
                    <img src="assets/pizzeria logo-Photoroom.png" class="w-8 h-8" alt="Logo Pizza Code">
                    <span>Pizza Code</span>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto py-6">
                <ul class="space-y-2">
                    <li>

                        <?php
                        // On compte les éléments du panier stocké en session
                        $panierCount = isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0;
                        ?>

                        <a href="/panier" class="relative group flex items-center gap-1 px-3 py-2 text-white hover:text-yellow-400 transition-colors duration-200">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>

                            <span class="font-bold hidden md:inline">Panier</span>

                            <?php if ($panierCount > 0): ?>
                                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-md border border-white">
                                    <?= $panierCount ?>
                                </span>
                            <?php endif; ?>

                        </a>

                        <a href="/" class="block py-3 px-6 hover:bg-gray-800 hover:text-yellow-400 border-l-4 border-transparent hover:border-yellow-400 transition-colors">
                            <i class="fas fa-home w-6"></i> Accueil
                        </a>
                    </li>
                    <li>
                        <a href="/pizzeria" class="block py-3 px-6 hover:bg-gray-800 hover:text-yellow-400 border-l-4 border-transparent hover:border-yellow-400 transition-colors">
                            <i class="fas fa-pizza-slice mr-2"></i> La pizzeria
                        </a>
                    </li>
                    <li>
                        <a href="/carte" class="block py-3 px-6 hover:bg-gray-800 hover:text-yellow-400 border-l-4 border-transparent hover:border-yellow-400 transition-colors">
                            <i class="fas fa-utensils w-6"></i> La Carte
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-3 px-6 hover:bg-gray-800 hover:text-yellow-400 border-l-4 border-transparent hover:border-yellow-400 transition-colors">
                            <i class="fas fa-map-marker-alt w-6"></i> Accès & Horaires
                        </a>
                    </li>

                    <?php if ($user && $user->role == "ADMIN"): ?>
                        <li>
                            <a href="/pizza" class="block py-3 px-6 hover:bg-gray-800 hover:text-yellow-400 border-l-4 border-transparent hover:border-yellow-400 transition-colors">
                                <i class="fa-solid fa-pen-to-square w-6"></i> Gérer les pizzas
                            </a>
                        </li>

                        <li>
                            <a href="/commandes" class="block py-3 px-6 hover:bg-gray-800 hover:text-yellow-400 border-l-4 border-transparent hover:border-yellow-400 transition-colors">
                                <i class="fa-solid fa-bell-concierge w-6"></i>Gérer les commandes
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>

            <div class="p-6 border-t border-gray-800">
                <p class="text-xs text-gray-500 text-center">&copy; 2025 Pizza Code</p>
            </div>
        </aside>

        <main class="flex-1 relative overflow-y-auto overflow-x-hidden bg-gray-100">
            <div class="relative w-full h-screen">