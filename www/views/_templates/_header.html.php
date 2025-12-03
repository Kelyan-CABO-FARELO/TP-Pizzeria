<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Code</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="font-sans text-gray-900 bg-gray-100 overflow-hidden">

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
                </ul>
            </nav>

            <div class="p-6 border-t border-gray-800">
                <p class="text-xs text-gray-500 text-center">&copy; 2025 Pizza Code</p>
            </div>
        </aside>

        <main class="flex-1 relative overflow-y-auto overflow-x-hidden bg-gray-100">
            <div class="relative w-full h-screen overflow-hidden">