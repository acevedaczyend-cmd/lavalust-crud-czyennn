<?php /** @var string $pageTitle */ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Czyen Pink Inventory' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 50%, #f472b6 100%);
            min-height: 100vh;
        }
        .pink-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(244, 114, 182, 0.3);
        }
    </style>
</head>
<body class="py-10 px-4 sm:px-8 font-sans text-slate-800">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="pink-glass rounded-2xl p-6 mb-8 shadow-xl flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-extrabold text-pink-600 flex items-center gap-3">
                    <i class="fa-solid fa-[#ff80ab] fa-gem text-pink-500"></i> CZYEN INVENTORY
                </h1>
                <p class="text-sm text-pink-400 mt-1">Aesthetic Pink Management Suite</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?= site_url('products/add_item') ?>" class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-5 py-2.5 rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-plus mr-2"></i>New Item
                </a>
                <a href="<?= site_url('auth/logout') ?>" class="bg-rose-100 hover:bg-rose-200 text-rose-600 font-semibold px-4 py-2.5 rounded-xl transition-all">
                    Logout
                </a>
            </div>
        </div>

        <!-- Inventory Grid Cards View instead of standard plain table -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if(!empty($items)): foreach($items as $row): ?>
            <div class="pink-glass rounded-2xl p-6 shadow-md hover:shadow-xl transition-all flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-slate-800"><?= htmlspecialchars($row['product_name']) ?></h3>
                        <span class="bg-pink-100 text-pink-600 font-semibold text-xs px-3 py-1 rounded-full border border-pink-200">
                            Qty: <?= $row['quantity'] ?>
                        </span>
                    </div>
                    <p class="text-slate-600 text-sm mb-4 line-clamp-2"><?= htmlspecialchars($row['description']) ?></p>
                </div>
                <div>
                    <div class="text-2xl font-black text-pink-600 mb-4">
                        ₱<?= number_format($row['price'], 2) ?>
                    </div>
                    <div class="flex items-center gap-2 border-t border-pink-200/50 pt-4">
                        <a href="<?= site_url('products/modify_item/'.$row['id']) ?>" class="flex-1 text-center bg-white/80 hover:bg-pink-50 text-pink-600 font-medium py-2 rounded-lg border border-pink-200 text-sm transition">
                            <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                        </a>
                        <a href="<?= site_url('products/remove_item/'.$row['id']) ?>" onclick="return confirm('Delete this item?')" class="bg-rose-50 hover:bg-rose-100 text-rose-500 p-2 rounded-lg text-sm transition">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-span-full pink-glass rounded-2xl p-12 text-center text-pink-400">
                <i class="fa-solid fa-box-open text-5xl mb-3 block"></i>
                No items found in the inventory yet.
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>