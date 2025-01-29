<?php
require 'phpqrcode/qrlib.php';

// MikroTik Hotspot Login Script URL
$hotspot_url = "http://your-server-ip/autologin.php"; // Change to your server IP

// Generate QR Code pointing to the login script
$qr_file = 'hotspot_qr.png';
QRcode::png($hotspot_url, $qr_file, QR_ECLEVEL_L, 10);

// Display the QR Code
echo "<h2>Scan this QR Code to Connect to MikroTik WiFi:</h2>";
echo "<img src='$qr_file' alt='Hotspot QR Code'>";
?>
