<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Read Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }

        table {
            min-width: 100vw;
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

<body class="bg-gray-50 flex flex-col items-center justify-center min-h-screen">
    <?php include 'header.php'; ?>

    <div class="w-full max-w-screen-xl bg-white shadow-lg rounded-lg p-8 border border-gray-200">
        <h1 class="text-3xl font-bold text-indigo-600 mb-6">User Data</h1>

        <div id="notification" class="notification p-4 mb-4 border rounded-lg">
            <strong id="notification-title" class="font-bold"></strong>
            <p id="notification-message"></p>
        </div>

        <div class="table-container">
            <table class="w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Name</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Email</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Passport Image</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Contact No</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">DOB</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Gender</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Address</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Country</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">State</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">City</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Pin Code</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "advance";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT c.*, co.name AS country_name, s.name AS state_name, ci.name AS city_name 
                            FROM customers c 
                            LEFT JOIN countries co ON c.country = co.id
                            LEFT JOIN states s ON c.state = s.id
                            LEFT JOIN cities ci ON c.city = ci.id";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='px-6 py-4 text-sm text-center font-medium text-gray-900 whitespace-nowrap'>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap'>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500'>";
                            $imagePath = htmlspecialchars($row['passport_image']);
                            if ($imagePath) {
                                echo "<img src='" . $imagePath . "' alt='Passport Image' class='w-16 h-16 object-cover'>";
                            } else {
                                echo "No Image";
                            }
                            echo "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap'>" . htmlspecialchars($row['contact_no']) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap'>" . htmlspecialchars($row['dob']) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap'>" . htmlspecialchars($row['gender']) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap'>" . htmlspecialchars($row['address']) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap'>" . htmlspecialchars($row['country_name']) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap'>" . htmlspecialchars($row['state_name']) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap'>" . htmlspecialchars($row['city_name']) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap'>" . htmlspecialchars($row['pin_code']) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap'>";
                            echo "<div class='flex space-x-2'>";
                            echo "<a href='edit.php?id=" . htmlspecialchars($row['id']) . "' class='bg-indigo-600 px-4 py-2 text-white rounded hover:bg-indigo-700'>Edit</a>";
                            echo "<a href='delete.php?id=" . htmlspecialchars($row['id']) . "' class='bg-red-600 px-4 py-2 text-white rounded hover:bg-red-700'>Delete</a>";

                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='13' class='px-6 py-4 text-sm text-gray-500 text-center'>No records found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
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
    </script>
</body>

</html>