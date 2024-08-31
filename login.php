<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .form-input {
            border-color: #d1d5db;
            border-width: 2px;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 1px #3b82f6;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: none;
            width: 300px;
        }
    </style>
</head>

<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="" class="bg-gray-50 flex flex-col items-center justify-center min-h-screen">
    <?php include 'header.php' ?>

    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8 border border-gray-200">
        <h1 class="text-3xl font-bold text-indigo-600 mb-6">Log In</h1>
        <div id="notification" class="notification p-4 mb-4 border rounded-lg">
            <strong id="notification-title" class="font-bold"></strong>
            <p id="notification-message"></p>
        </div>
        <form action="login_auth.php" method="POST">

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="form-input mt-1 block w-full rounded-md shadow-sm" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="form-input mt-1 block w-full rounded-md shadow-sm" required>
            </div>

            <div class="flex justify-center mb-4">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150">
                    Log In
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? <a href="signup.php" class="text-indigo-600 hover:underline">Sign Up</a>
                </p>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('notification');
            const notificationTitle = document.getElementById('notification-title');
            const notificationMessage = document.getElementById('notification-message');

            const urlParams = new URLSearchParams(window.location.search);
            const messageType = urlParams.get('message_type');
            const messageText = urlParams.get('message_text');

            if (messageType && messageText) {
                notification.style.display = 'block';
                if (messageType === 'success') {
                    notificationTitle.textContent = 'Success!';
                    notification.className = 'notification p-4 mb-4 text-white bg-green-500 border border-green-400 rounded-lg';
                } else if (messageType === 'error') {
                    notificationTitle.textContent = 'Error!';
                    notification.className = 'notification p-4 mb-4 text-white bg-red-500 border border-red-400 rounded-lg';
                }
                notificationMessage.textContent = messageText;

                setTimeout(function() {
                    notification.style.display = 'none';

                    const newUrl = window.location.pathname;
                    window.history.replaceState({}, document.title, newUrl);
                }, 5000);
            }
        });


        function noBack() {
            window.history.forward();
        }
        window.history.forward();
    </script>
</body>

</html>