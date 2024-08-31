<?php
include 'header.php';
include 'db.php';
include 'location.php';

$database = new Database();
$db = $database->getConnection();
$location = new Location($db);

$countries = $location->getCountries();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-10">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Customer Form</h2>
        <form action="process.php" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name:</label>
                <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="contact" class="block text-gray-700 font-semibold mb-2">Contact No:</label>
                <input type="text" id="contact" name="contact" class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="dob" class="block text-gray-700 font-semibold mb-2">DOB:</label>
                <input type="date" id="dob" name="dob" class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="passport" class="block text-gray-700 font-semibold mb-2">Passport Image:</label>
                <input type="file" id="passport" name="passport" class="w-full p-3 border border-gray-300 rounded-lg" accept="image/*" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Gender:</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="male" class="form-radio text-blue-600" required>
                        <span class="ml-2">Male</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="female" class="form-radio text-blue-600" required>
                        <span class="ml-2">Female</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="other" class="form-radio text-blue-600" required>
                        <span class="ml-2">Other</span>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-semibold mb-2">Address:</label>
                <textarea id="address" name="address" rows="3" class="w-full p-3 border border-gray-300 rounded-lg" required></textarea>
            </div>

            <div class="mb-4">
                <label for="country" class="block text-gray-700 font-semibold mb-2">Country:</label>
                <select id="country" name="country" class="form-select mt-1 block w-full rounded-md shadow-sm" required>
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country) : ?>
                        <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="state" class="block text-gray-700 font-semibold mb-2">State:</label>
                <select id="state" name="state" class="form-select mt-1 block w-full rounded-md shadow-sm" required disabled>
                    <option value="">Select State</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="city" class="block text-gray-700 font-semibold mb-2">City:</label>
                <select id="city" name="city" class="form-select mt-1 block w-full rounded-md shadow-sm" required disabled>
                    <option value="">Select City</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="pincode" class="block text-gray-700 font-semibold mb-2">Pin Code:</label>
                <input type="text" id="pincode" name="pincode" class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div class="text-center">
                <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg font-semibold hover:bg-blue-700">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countryDropdown = document.getElementById('country');
            const stateDropdown = document.getElementById('state');
            const cityDropdown = document.getElementById('city');

            countryDropdown.addEventListener('change', function() {
                const countryId = this.value;

                stateDropdown.innerHTML = '<option value="">Select State</option>';
                cityDropdown.innerHTML = '<option value="">Select City</option>';
                stateDropdown.disabled = true;
                cityDropdown.disabled = true;

                if (countryId) {
                    fetch('getData.php?type=state&id=' + countryId)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                data.data.forEach(state => {
                                    const option = document.createElement('option');
                                    option.value = state.id;
                                    option.textContent = state.name;
                                    stateDropdown.appendChild(option);
                                });
                                stateDropdown.disabled = false;
                            } else {
                                alert('Failed to fetch states.');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching states:', error);
                        });
                }
            });

            stateDropdown.addEventListener('change', function() {
                const stateId = this.value;

                cityDropdown.innerHTML = '<option value="">Select City</option>';
                cityDropdown.disabled = true;

                if (stateId) {
                    fetch('getData.php?type=city&id=' + stateId)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                data.data.forEach(city => {
                                    const option = document.createElement('option');
                                    option.value = city.id;
                                    option.textContent = city.name;
                                    cityDropdown.appendChild(option);
                                });
                                cityDropdown.disabled = false;
                            } else {
                                alert('Failed to fetch cities.');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching cities:', error);
                        });
                }
            });
        });
    </script>
</body>

</html>