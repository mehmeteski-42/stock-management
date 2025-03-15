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

// Kategori ekleme işlemi
if (isset($_POST['new_category'])) {
    $new_category = $_POST['new_category'];

    // Kategorinin daha önce eklenip eklenmediğini kontrol et
    $sql_check = "SELECT * FROM categories WHERE name = '$new_category'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // Eğer kategori zaten varsa
        echo "Bu kategori zaten mevcut!";
    } else {
        // Kategori veritabanına ekleme
        $sql = "INSERT INTO categories (name) VALUES ('$new_category')";
        if ($conn->query($sql) === TRUE) {
            echo "Yeni kategori başarıyla eklendi!";
        } else {
            echo "Hata: " . $conn->error;
        }
    }
}

// Ürün ekleme işlemi
if (isset($_POST['barcode']) && isset($_POST['product_name']) && isset($_POST['category_id']) && isset($_POST['package_count']) && isset($_POST['box_count']) && isset($_POST['weight']) && isset($_POST['total_quantity'])) {
    $barcode = $_POST['barcode'];
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $package_count = $_POST['package_count'];
    $box_count = $_POST['box_count'];
    $weight = $_POST['weight'];
    $total_quantity = $_POST['total_quantity'];
    
    // Ürün veritabanına ekleme
    $sql = "INSERT INTO products (barcode, name, category_id, package_count, box_count, weight, total_quantity) 
            VALUES ('$barcode', '$product_name', '$category_id', '$package_count', '$box_count', '$weight', '$total_quantity')";
    if ($conn->query($sql) === TRUE) {
        echo "Ürün başarıyla eklendi!";
    } else {
        echo "Hata: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Ekle</title>
</head>
<body>

    <h2>Ürün Ekleme</h2>

    <!-- Ürün Ekleme Formu -->
    <form method="POST">
        <label for="barcode">Barkod:</label>
        <input type="text" id="barcode" name="barcode" required><br><br>

        <label for="product_name">Ürün Adı:</label>
        <input type="text" id="product_name" name="product_name" required><br><br>

        <!-- Kategori Seçim Alanı -->
        <label for="category_id">Kategori Seç:</label>
        <select name="category_id" id="category_id" required>
            <?php
            // Kategorileri veritabanından çekme
            $sql = "SELECT * FROM categories";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="package_count">Paket Sayısı:</label>
        <input type="number" id="package_count" name="package_count" required><br><br>

        <label for="box_count">Koli Sayısı:</label>
        <input type="number" id="box_count" name="box_count" required><br><br>

        <label for="weight">Kilogram:</label>
        <input type="number" step="0.01" id="weight" name="weight" required><br><br>

        <label for="total_quantity">Toplam Adet:</label>
        <input type="number" id="total_quantity" name="total_quantity" required><br><br>

        <input type="submit" value="Ürün Ekle">
    </form>

    <hr>

    <!-- Yeni Kategori Ekleme Formu -->
    <h3>Yeni Kategori Ekle</h3>
    <form method="POST">
        <input type="text" name="new_category" placeholder="Yeni kategori adı" required>
        <input type="submit" value="Kategori Ekle">
    </form>

</body>
</html>

<?php
// Veritabanı bağlantısını kapatma
$conn->close();
?>
