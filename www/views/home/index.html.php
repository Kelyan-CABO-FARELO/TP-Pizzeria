<div class="relative w-full h-screen overflow-hidden">

    <video
        class="absolute top-0 left-0 w-full h-full object-cover"
        autoplay
        loop
        muted
        playsinline>
        <source src="assets/Vidéo_de_plans_de_coupe_générée.mp4" type="video/mp4" />
    </video>

    <div class="flex justify-end relative z-10 absolute top-4 right-4 flex gap-4">
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

    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
        <img src="assets/pizzeria logo-Photoroom.png" class="w-64 h-64" alt="Logo Pizza Code">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">
            Bienvenue à Pizza Code
        </h1>
        <p class="text-xl md:text-2xl mb-8">
            Une expérience unique au monde, où informatique et pizza se rencontrent
        </p>
        <a href="/carte" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded transition inline-block">
            Voir la carte
        </a>
    </div>

</div>