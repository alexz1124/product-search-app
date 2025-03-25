<?php
// Static product data
$staticProducts = [
    'A12345' => [
        'aircraft_name' => 'Boeing 737',
        'maintenance_level' => 'Heavy Maintenance',
        'system' => 'Avionics',
        'product_id' => 'A12345',
        'product_name' => 'Main Landing Gear Assembly',
        'part_number' => 'BCS-737-LG-001',
        'quantity' => 1,
        'unit' => 'Set',
        'standard_price' => 250000.00,
        'unit_price' => 250000.00,
        'total_price' => 250000.00,
        'fiscal_year' => '2024'
    ],
    'B67890' => [
        'aircraft_name' => 'Airbus A320',
        'maintenance_level' => 'Medium Maintenance',
        'system' => 'Hydraulic',
        'product_id' => 'B67890',
        'product_name' => 'Hydraulic Pump',
        'part_number' => 'ABS-A320-HP-002',
        'quantity' => 2,
        'unit' => 'Piece',
        'standard_price' => 75000.00,
        'unit_price' => 37500.00,
        'total_price' => 75000.00,
        'fiscal_year' => '2023'
    ]
];

// Variables to store search results
$product = null;
$error = null;
$product_id_input = "";

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = trim($_POST['product_id']);
    $product_id_input = $product_id;

    // Validate input format
    if (!empty($product_id) && preg_match("/^[A-Za-z0-9\-]+$/", $product_id)) {
        // Search in static products
        if (isset($staticProducts[$product_id])) {
            $product = $staticProducts[$product_id];
        } else {
            $error = "Product not found";
        }
    } else {
        $error = "Invalid product ID format";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-900 bg-opacity-50">
    <div class="bg-white bg-opacity-30 backdrop-blur-md p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-4xl font-bold text-center text-white mb-6">Product Search System</h2>

        <form method="POST" action="">
            <div class="mb-6">
                <label class="block text-white mb-2 text-2xl font-semibold">Enter Product ID:</label>
                <input type="text" name="product_id" required value="<?= htmlspecialchars($product_id_input) ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-2xl">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-lg hover:bg-blue-700 text-2xl">
                Search
            </button>
        </form>

        <!-- Product Details Section -->
        <?php if ($product): ?>
            <div class="mt-4 p-6 bg-white-500 bg-opacity-30 shadow-lg rounded-lg backdrop-blur-md">
                <h3 class="text-2xl font-bold text-white mb-6">Product Details</h3>

                <div class="grid grid-cols-3 gap-2 text-white text-2xl">
                    <p><strong>Aircraft Name:</strong> <?= htmlspecialchars($product['aircraft_name']) ?></p>
                    <p><strong>Maintenance Level:</strong> <?= htmlspecialchars($product['maintenance_level']) ?></p>
                    <p><strong>System:</strong> <?= htmlspecialchars($product['system']) ?></p>
                    <p><strong>Product ID:</strong> <?= htmlspecialchars($product['product_id']) ?></p>
                    <p><strong>Product Name:</strong> <?= htmlspecialchars($product['product_name']) ?></p>
                    <p><strong>Part Number:</strong> <?= htmlspecialchars($product['part_number']) ?></p>
                    <p><strong>Quantity:</strong> <?= htmlspecialchars($product['quantity']) ?>
                        <?= htmlspecialchars($product['unit']) ?>
                    </p>
                    <p><strong>Standard Price:</strong> <?= number_format($product['standard_price'], 2) ?> THB</p>
                    <p><strong>Unit Price:</strong> <?= number_format($product['unit_price'], 2) ?> THB</p>
                    <p><strong>Total Price:</strong> <?= number_format($product['total_price'], 2) ?> THB</p>
                    <p><strong>Fiscal Year:</strong> <?= htmlspecialchars($product['fiscal_year']) ?></p>
                </div>
            </div>
        <?php elseif ($error): ?>
            <div class="mt-8 p-6 bg-red-100 rounded-lg text-red-700 text-xl">
                <?= $error ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>