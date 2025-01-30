Just scan & connect.
Modify MikroTik’s Login Page to Pass MAC Cookie
If the default MikroTik Hotspot login page does not store MAC addresses in cookies, edit /hotspot/login.html on MikroTik and add this script inside the <head>:

<script>
document.cookie = "mac=" + document.getElementById("mac").value + "; path=/";
</script>

Set Up Cron Job Run the following command to execute it every 10 minutes:
*/10 * * * * php /path/to/unblock_macs.php

mysql -u root -p mikrotik_qr < ~/mikrotik_qr/schema.sql
