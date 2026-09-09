<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Czyen's Pink CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 text-gray-800 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg border border-pink-200 transition-all duration-300 hover:border-pink-300">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-pink-600">🌸 Add New Product</h2>
            <p class="text-xs text-pink-400 mt-1">Fill in the details below to add a new item</p>
        </div>
        
        <form action="<?= site_url('products/store'); ?>" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-pink-700 mb-1">Product Name</label>
                <input type="text" name="product_name" required class="w-full bg-pink-50/50 border border-pink-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 rounded-xl p-2.5 text-gray-800 transition duration-200 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-pink-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full bg-pink-50/50 border border-pink-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 rounded-xl p-2.5 text-gray-800 transition duration-200 outline-none"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-pink-700 mb-1">Price (₱)</label>
                    <input type="number" step="0.01" name="price" required class="w-full bg-pink-50/50 border border-pink-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 rounded-xl p-2.5 text-gray-800 transition duration-200 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-pink-700 mb-1">Quantity</label>
                    <input type="number" name="quantity" required class="w-full bg-pink-50/50 border border-pink-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 rounded-xl p-2.5 text-gray-800 transition duration-200 outline-none">
                </div>
            </div>
            <div class="flex justify-between items-center pt-4">
                <a href="<?= site_url('products'); ?>" class="text-pink-400 hover:text-pink-600 font-medium transition">Cancel</a>
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold px-6 py-2.5 rounded-xl transition duration-200 shadow-md shadow-pink-200">Save Product</button>
            </div>
        </form>
    </div>
</body>
</html>