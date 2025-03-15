<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";  // kullanıcı adınız
$password = "";      // şifreniz
$dbname = "stock_management";  // veritabanı adınız

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ürünleri veritabanından çekme
$sql = "SELECT products.id, products.barcode, products.name AS product_name, categories.name AS category_name, 
        products.package_count, products.box_count, products.weight, products.total_quantity
        FROM products
        JOIN categories ON products.category_id = categories.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>
</head>
<body>

    <h2>Ürünler Listesi</h2>

    <table border="1">
        <tr>
            <th>Barkod</th>
            <th>Ürün Adı</th>
            <th>Kategori</th>
            <th>Paket Sayısı</th>
            <th>Koli Sayısı</th>
            <th>Kilo</th>
            <th>Toplam Adet</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            // Her ürünü listele
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['barcode'] . "</td>
                        <td>" . $row['product_name'] . "</td>
                        <td>" . $row['category_name'] . "</td>
                        <td>" . $row['package_count'] . "</td>
                        <td>" . $row['box_count'] . "</td>
                        <td>" . $row['weight'] . " kg</td>
                        <td>" . $row['total_quantity'] . "</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Hiç ürün bulunamadı.</td></tr>";
        }
        ?>

    </table>

</body>
</html>

<?php
// Veritabanı bağlantısını kapatma
$conn->close();
?>
