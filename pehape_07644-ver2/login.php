<?php
session_start();
require_once 'models/model_user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $obj_user = new modelUser();
    $users = $obj_user->getUsers();

    foreach ($users as $user) {
        if ($user->username === $username && $user->password === $password) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user->role->role_name;
            header('location: index.php');
            exit;
        }
    }
    $error = "Username atau password salah.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-center mb-4">
            <img src="views/includes/login-logo.png" alt="Moka POS Logo" class="w-32">
        </div>
        <form method="POST">
            <!-- Input Username -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                <input type="text" id="username" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Username" required>
            </div>

            <!-- Input Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Password" required>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
            </div>
        </form>

        <!-- Error Message -->
        <?php if (isset($error)): ?>
            <p class="mt-4 text-red-500 text-sm text-center"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>

</body>
</html>
