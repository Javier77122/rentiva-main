<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once 'config.php';

try {
    // Log request method and content type
    error_log("Request Method: " . $_SERVER['REQUEST_METHOD']);
    error_log("Content-Type: " . ($_SERVER['CONTENT_TYPE'] ?? 'not set'));

    // Get input data
    $input = $_POST;
    if (empty($input)) {
        $rawInput = file_get_contents('php://input');
        error_log("Raw input: " . $rawInput);
        $input = json_decode($rawInput, true);
    }

    error_log("Processed input: " . print_r($input, true));

    // Validate input
    if (empty($input)) {
        throw new Exception('No input data received');
    }

    // Extract and validate required fields
    $tanggal_sewa = $input['tanggal_sewa'] ?? '';
    $durasi = $input['durasi'] ?? '';
    $jumlah_jeep = $input['jumlah_jeep'] ?? '';
    $total_pembayaran = $input['total_pembayaran'] ?? '';

    if (!$tanggal_sewa || !$durasi || !$jumlah_jeep || !$total_pembayaran) {
        throw new Exception('Missing required fields: ' . print_r($input, true));
    }

    // Clean amount (remove 'Rp', spaces, and dots)
    $clean_amount = (int)str_replace(['Rp', '.', ' '], '', $total_pembayaran);
    
    if ($clean_amount <= 0) {
        throw new Exception('Invalid amount: ' . $total_pembayaran);
    }

    // Prepare transaction data
    $transaction_data = [
        'transaction_details' => [
            'order_id' => 'RENTAL-' . time(),
            'gross_amount' => $clean_amount
        ],
        'item_details' => [
            [
                'id' => 'JEEP-1',
                'price' => (int)($clean_amount / (int)$jumlah_jeep),
                'quantity' => (int)$jumlah_jeep,
                'name' => "Sewa Jeep Bromo ($durasi)"
            ]
        ],
        'custom_field1' => $tanggal_sewa,
        'custom_field2' => $durasi
    ];

    error_log("Transaction data: " . print_r($transaction_data, true));

    // Get Snap Token
    $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);
    
    error_log("Snap Token generated: " . $snapToken);

    // Return success response
    echo json_encode([
        'status' => 'success',
        'token' => $snapToken
    ]);

} catch (Exception $e) {
    error_log("Error in get_snap_token.php: " . $e->getMessage());
    
    // Return error response
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'debug_info' => [
            'request_method' => $_SERVER['REQUEST_METHOD'],
            'content_type' => $_SERVER['CONTENT_TYPE'] ?? 'not set',
            'raw_input' => file_get_contents('php://input')
        ]
    ]);
}
