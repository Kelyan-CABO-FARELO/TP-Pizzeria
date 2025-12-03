<div class="relative w-full h-screen overflow-hidden">

    <video
        class="absolute top-0 left-0 w-full h-full object-cover"
        autoplay
        loop
        muted
        playsinline>
        <source src="assets/Vidéo_de_plans_de_coupe_générée.mp4" type="video/mp4" />
    </video>

    <div class="relative z-10 justify-self-end text-center px-4">
        <form action="/auth/login" method="post">
            <?php
    
            use JulienLinard\Core\View\ViewHelper; ?>
            <input type="hidden" name="_token" value="<?= htmlspecialchars(ViewHelper::csrfToken()) ?>">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 font-bold py-3 px-6 rounded transition inline-block text-sm text-white hover:text-white">
                Connexion
            </button>
        </form>
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