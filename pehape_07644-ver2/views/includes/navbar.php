<nav class="bg-blue-600 p-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center">
            <img src="views/includes/navbar-logo.png" alt="Logo Moka POS" class="h-8 w-auto  mr-0">
            <span class="text-white font-bold text-xl">oka POS</span>
        </div>
        <div class="text-white">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <span class="mr-4"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <span class="mr-4"><?php echo htmlspecialchars($_SESSION['role']); ?></span>
                <button onclick="window.location.href='logout.php'" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Logout
                </button>
            <?php else: ?>
                <span class="mr-4">Not logged in</span>
            <?php endif; ?>
        </div>
    </div>
</nav>