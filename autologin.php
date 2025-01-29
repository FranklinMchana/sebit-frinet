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

    // Get User MAC Address from MikroTik Hotspot Cookies
    if (!isset($_COOKIE['mac'])) {
        die("MAC Address not detected. Ensure you are connecting via MikroTik Hotspot.");
    }

    $mac_address = $_COOKIE['mac'];

    // Auto-login user by adding them to the Hotspot active users list
    $query = (new Query('/ip/hotspot/active/add'))
        ->equal('mac-address', $mac_address)
        ->equal('server', 'hotspot1') // Change to your Hotspot name
        ->equal('limit-uptime', '30m'); // Set session duration (30 min)

    $client->query($query)->read();

    echo "Login successful! You are now connected for 30 minutes.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
