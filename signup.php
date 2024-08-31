<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-10">
    <?php
    include 'header.php'
    ?>
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Customer Form</h2>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name:</label>
                <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password:</label>
                <input type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>


         

         

       

            <div class="text-center">
                <button type="submit" class="w-full bg-green-600 text-white p-3 rounded-lg font-semibold hover:bg-green-700">Sign Up</button>
            </div>
        </form>
    </div>
</body>

</html>