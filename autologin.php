<?php
require 'vendor/autoload.php'; // Include MikroTik API client

use \RouterOS\Client;
use \RouterOS\Query;

try {
    // Connect to MikroTik API
    $client = new Client([
        'host' => '192.168.88.1', // MikroTik Router IP
        'user' => 'admin', // MikroTik Admin Username
        'pass' => 'admin123', // MikroTik Admin Password
        'port' => 8728, // API Port
    ]);

    // Get User MAC Address from HTTP Headers
    $mac_address = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '';

    if (!$mac_address) {
        die("MAC Address not found. Ensure you are connecting via a MikroTik Hotspot.");
    }

    // Check if MAC address exists in MikroTik Hotspot Users
    $query = (new Query('/ip/hotspot/user/print'))
        ->where('mac-address', $mac_address);

    $existingUser = $client->query($query)->read();

    if (empty($existingUser)) {
        die("MAC Address not registered. Please contact support.");
    }

    // Auto-login the user
    $login_url = "http://192.168.88.1/login?username=$mac_address";

    // Redirect user to the login page
    header("Location: $login_url");
    exit();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
