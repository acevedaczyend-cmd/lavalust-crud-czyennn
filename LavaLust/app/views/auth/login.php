<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Czyen's Pink CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 text-gray-800 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-pink-200">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-pink-500">🌸 Welcome Back</h2>
            <p class="text-sm text-pink-400 mt-1">Please log in to manage products</p>
        </div>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-pink-100 border border-pink-300 text-pink-700 p-3 rounded-xl text-sm mb-4 text-center font-medium">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('authenticate'); ?>" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-pink-700 mb-1">Username</label>
                <input type="text" name="username" placeholder="czyen" required class="w-full bg-pink-50/50 border border-pink-200 rounded-xl p-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-pink-700 mb-1">Password</label>
                <input type="password" name="password" placeholder="••••••••" required class="w-full bg-pink-50/50 border border-pink-200 rounded-xl p-2.5 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>
            <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-2.5 rounded-xl shadow-md shadow-pink-200 transition duration-200">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>