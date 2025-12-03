<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-8 text-center">
                <h2 class="text-3xl text-white font-bold">Connexion</h2>
                <p class="text-indigo-100 mt-2">Accéder à votre espace personnel</p>
            </div>

            <form class="p-6 space-y-6" action="/auth/login" method="post">

                <input type="hidden" name="_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">

                <?php if (isset($error)): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex">
                        <p class="text-sm text-red-700"><?= $error ?></p>
                    </div>
                <?php endif ?>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">Votre email</label>
                    <input class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 placeholder-gray-400"
                        type="email"
                        name="email"
                        id="email"
                        placeholder="votre@email.com"
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="password">Votre mot de passe</label>
                    <input class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 placeholder-gray-400"
                        type="password"
                        name="password"
                        id="password"
                        placeholder="********"
                        required>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Se souvenir de moi
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="/password/reset" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                            Mot de passe oublié ?
                        </a>
                    </div>
                </div>

                <div>
                    <button class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl duration-200 transition-all transform hover:-translate-y-0.5" type="submit">
                        Se connecter
                    </button>
                </div>

                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        Pas encore de compte ?
                        <a class="font-semibold text-indigo-600 hover:text-indigo-700 transition-colors" href="/register">
                            S'inscrire
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>