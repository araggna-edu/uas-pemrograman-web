<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <style>
        .tab {
            cursor: pointer;
        }
        .tab.active {
            background-color: #4A5568; /* Tailwind gray-700 */
            color: white;
        }
        .form-container {
            display: none;
        }
        .form-container.active {
            display: block;
        }
    </style>
    <script>
        function showForm(formId) {
            document.querySelectorAll('.form-container').forEach(function(form) {
                form.classList.remove('active');
            });
            document.getElementById(formId).classList.add('active');

            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.classList.remove('active');
            });
            document.querySelector('[data-target="' + formId + '"]').classList.add('active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    showForm(this.getAttribute('data-target'));
                });
            });

            // Show the login form by default
            showForm('login-form');
        });
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-md">
    <div class="flex justify-around bg-gray-200 p-4">
        <span class="tab active p-2 rounded cursor-pointer" data-target="login-form">Login</span>
        <span class="tab p-2 rounded cursor-pointer" data-target="register-form">Register</span>
    </div>

    <div class="p-4">
        <div id="login-form" class="form-container active">
            <form method="post" action="/login" class="space-y-4">
                <div>
                    <label for="useremail" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" name="useremail" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                </div>
                <div>
                    <label for="userpassword" class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" name="userpassword" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
            </form>
            <?php if (session()->get('loginError')): ?>
                <p class="mt-4 text-red-500 text-sm"><?= session()->get('loginError') ?></p>
            <?php endif; ?>
        </div>

        <div id="register-form" class="form-container">
            <form method="post" action="/register" class="space-y-4">
                <div>
                    <label for="useremail" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" name="useremail" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                </div>
                <div>
                    <label for="userpassword" class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" name="userpassword" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                </div>
                <div>
                    <label for="userfullname" class="block text-sm font-medium text-gray-700">Full Name:</label>
                    <input type="text" name="userfullname" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                </div>
                <button type="submit" class="w-full bg-green-500 text-white p-2 rounded">Register</button>
            </form>
            <?php if (session()->get('registerError')): ?>
                <p class="mt-4 text-red-500 text-sm"><?= session()->get('registerError') ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
