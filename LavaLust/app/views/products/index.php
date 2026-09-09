<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List - Czyen's Pink CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 text-gray-800 min-h-screen p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-extrabold text-pink-600">🌸 Product Management</h1>
                <p class="text-xs text-pink-400 mt-1">Czyen's Aesthetic Inventory Dashboard</p>
            </div>
            <div class="space-x-2">
                <a href="<?= site_url('products/create'); ?>" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2.5 rounded-xl font-bold transition duration-200 shadow-md shadow-pink-200">+ Add Product</a>
                <a href="<?= site_url('logout'); ?>" onclick="return confirm('Are you sure you want to logout?');" class="bg-rose-100 hover:bg-rose-200 text-rose-600 border border-rose-300 px-4 py-2.5 rounded-xl font-semibold transition duration-200">Logout</a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-pink-200">
            <table class="w-full text-left">
                <thead class="bg-pink-100/70 text-pink-700 uppercase text-xs font-bold">
                    <tr>
                        <th class="p-4">Name</th>
                        <th class="p-4">Description</th>
                        <th class="p-4">Price</th>
                        <th class="p-4">Qty</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-100">
                    <?php if(!empty($products)): foreach($products as $p): ?>
                        <tr class="hover:bg-pink-50/60 transition duration-150">
                            <td class="p-4 font-bold text-gray-800"><?= htmlspecialchars($p['product_name']); ?></td>
                            <td class="p-4 text-pink-900/70"><?= htmlspecialchars($p['description']); ?></td>
                            <td class="p-4 text-pink-600 font-bold">₱<?= number_format($p['price'], 2); ?></td>
                            <td class="p-4 font-medium text-gray-600"><?= $p['quantity']; ?></td>
                            <td class="p-4 text-center space-x-3">
                                <a href="<?= site_url('products/edit/' . $p['id']); ?>" class="text-pink-500 hover:text-pink-700 font-bold transition">Edit</a>
                                <a href="<?= site_url('products/delete/' . $p['id']); ?>" onclick="return confirm('Are you sure you want to delete this product?')" class="text-rose-400 hover:text-rose-600 font-bold transition">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="5" class="p-6 text-center text-pink-400 font-medium">No products found. Click + Add Product to start!</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>