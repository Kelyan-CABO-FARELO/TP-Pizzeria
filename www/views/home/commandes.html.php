<div class="relative w-full min-h-screen bg-gray-900 pt-24 px-4">
    <div class="container mx-auto max-w-6xl bg-white rounded-xl shadow-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Gestion des Commandes (Cuisine/Livraison)</h1>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6">ID</th>
                        <th class="py-3 px-6">Date</th>
                        <th class="py-3 px-6">Total</th>
                        <th class="py-3 px-6">Statut Actuel</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($commandes as $cmd): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 font-bold">#<?= $cmd->id ?></td>
                            <td class="py-3 px-6"><?= $cmd->created_at ?></td>
                            <td class="py-3 px-6"><?= number_format($cmd->total_price, 2) ?> €</td>
                            <td class="py-3 px-6">
                                Statut ID: <?= $cmd->status_id ?>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <form action="/admin/commande/status" method="POST" class="flex gap-2 justify-center">
                                    <input type="hidden" name="commande_id" value="<?= $cmd->id ?>">
                                    <select name="status_id" class="border rounded p-2 bg-white text-gray-800 font-medium">
                                        <?php foreach ($statuts as $statut): ?>
                                            <option value="<?= $statut->id ?>" <?= $cmd->status_id == $statut->id ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($statut->label) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded">
                                        OK
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>