<?php
// CONFIG
// Create token
// https://www.tucuota.com/dashboard/developers
$tuCuotaToken = getenv('TC_API_KEY');

// Get current url
$currentUrl = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$currentUrl = strtok($currentUrl, '?');

// Check required data
if (!isset($_GET['customer_id']) || !isset($_GET['customer_name']) || !isset($_GET['customer_email'])) {
    print "A la dirección le faltan datos, tiene que estar construida como <br>" . $currentUrl . "?customer_id=123&customer_name=Pedro Giménez&customer_email=pedro@gimenez.com";
    exit;
}

// set data for request
$endpoint = 'https://www.tucuota.com/api/sessions';
$post_data = [
    'kind' => 'mandate',
    // 'success_url' => $currentUrl,
    'customer_id' => $_GET['customer_id'],
    'customer_name' => $_GET['customer_name'],
    'customer_email' => $_GET['customer_email']
];
$headers = [
    'Authorization: Bearer ' . $tuCuotaToken
];

// Prepare data
$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Api call
$response = curl_exec($ch);
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// close connection
curl_close($ch);

$response = json_decode($response, true);

if ($responseCode >= 400) {
    echo "<pre>" . print_r($response) . "</pre>";
} else {
    header('Location: ' . $response['data']['public_uri']);
    exit;
}
