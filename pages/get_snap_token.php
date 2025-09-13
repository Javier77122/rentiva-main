<?php
// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Ensure POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// Include Midtrans configuration
require_once 'config.php';

try {
    // Get and decode JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON data');
    }

    // Validate required fields
    $requiredFields = ['tanggal_sewa', 'durasi', 'jumlah_jeep', 'total_pembayaran'];
    foreach ($requiredFields as $field) {
        if (empty($input[$field])) {
            throw new Exception("Missing required field: {$field}");
        }
    }

    // Clean amount
    $amount = (int)str_replace(['Rp', '.', ' '], '', $input['total_pembayaran']);
    if ($amount <= 0) {
        throw new Exception('Invalid payment amount');
    }

    // Create unique order ID
    $orderId = 'RENTAL-' . time() . '-' . mt_rand(1000, 9999);

    // Prepare transaction data
    $transaction = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => $amount
        ],
        'item_details' => [
            [
                'id' => 'JEEP-RENTAL',
                'price' => (int)($amount / (int)$input['jumlah_jeep']),
                'quantity' => (int)$input['jumlah_jeep'],
                'name' => "Sewa Jeep Bromo ({$input['durasi']})"
            ]
        ],
        'customer_details' => [
            'first_name' => 'Customer',
            'email' => 'customer@example.com',
            'phone' => '08111222333'
        ],
        'custom_field1' => $input['tanggal_sewa'],
        'custom_field2' => $input['durasi'],
        'custom_field3' => json_encode([
            'tanggal_sewa' => $input['tanggal_sewa'],
            'durasi' => $input['durasi'],
            'jumlah_jeep' => $input['jumlah_jeep']
        ])
    ];

    // Generate Snap token using Midtrans PHP library
    $snapToken = \Midtrans\Snap::getSnapToken($transaction);

    // Log successful token generation
    error_log(date('Y-m-d H:i:s') . " - Snap token generated for order {$orderId}\n", 3, "payment.log");

    // Return success response
    echo json_encode([
        'token' => $snapToken,
        'order_id' => $orderId
    ]);

} catch (Exception $e) {
    // Log error
    error_log(date('Y-m-d H:i:s') . " - Payment error: {$e->getMessage()}\n", 3, "payment_errors.log");

    // Return error response
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}
