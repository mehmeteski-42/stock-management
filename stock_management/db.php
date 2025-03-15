<?php
$host = "localhost";  // Eğer Laragon kullanıyorsanız localhost olacak.
$dbname = "stock_management";  // Veritabanı adımız
$username = "root";  // Varsayılan MySQL kullanıcı adı
$password = "";  // Eğer şifre koymadıysanız boş bırakın

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Veritabanına başarıyla bağlanıldı!";  // Test için açabilirsiniz
} catch (PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}
?>
