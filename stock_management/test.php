<?php
require_once "db.php";

if ($conn) {
    echo "Veritabanına başarıyla bağlanıldı!";
} else {
    echo "Bağlantı başarısız!";
}
?>
