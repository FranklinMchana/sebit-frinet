<?php
require 'phpqrcode/qrlib.php';

// MikroTik Hotspot Login URL
$login_url = "http://192.168.88.1/login";

// Generate QR Code pointing to login script
$qr_data = "$login_url?autologin=true";
$qr_file = 'hotspot_qr.png';

// Generate QR Code
QRcode::png($qr_data, $qr_file, QR_ECLEVEL_L, 10);

// Display the QR Code
echo "<h2>Scan this QR Code to Connect to MikroTik WiFi:</h2>";
echo "<img src='$qr_file' alt='Hotspot QR Code'>";
?>
