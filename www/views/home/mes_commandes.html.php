<div class="relative w-full min-h-screen bg-black/50 pt-24 px-4">
    <div class="container mx-auto max-w-4xl bg-white rounded-xl shadow-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">Mes Commandes</h1>

        <?php if (empty($commandes)): ?>
            <p>Vous n'avez pas encore passé de commande.</p>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($commandes as $cmd): ?>
                    <div class="border border-gray-200 rounded-lg p-4 flex justify-between items-center hover:bg-gray-50 transition">
                        <div>
                            <div class="font-bold text-lg">Commande #<?= $cmd->id ?></div>
                            <div class="text-gray-500 text-sm"><?= $cmd->created_at ?></div>
                            <div class="font-semibold text-indigo-600 mt-1"><?= number_format($cmd->total_price, 2) ?> €</div>
                        </div>
                        
                        <?php 
                            $statusLabel = $statusMap[$cmd->status_id] ?? 'Inconnu';
                            $colorClass = match($cmd->status_id) {
                                1 => 'bg-gray-200 text-gray-800', // Validée
                                2 => 'bg-yellow-200 text-yellow-800', // En préparation
                                3 => 'bg-blue-200 text-blue-800', // En livraison
                                4 => 'bg-green-200 text-green-800', // Livré
                                default => 'bg-gray-100'
                            };
                        ?>
                        <span class="px-4 py-2 rounded-full font-bold text-sm <?= $colorClass ?>">
                            <?= htmlspecialchars($statusLabel) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    setTimeout(function(){
       location.reload();
    }, 30000);
</script>