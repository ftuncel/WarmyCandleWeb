<?php
$servername = "localhost";
//$username = "admin";
//$password = "Uzay2020";
$username = "root";
$password = "123456";
$dbname = "warmycandle";

// Create connection
//$dbconn= new mysqli($servername, $username, $password);
//
// Check connection
//if ($dbconn->connect_error) {
//  die("Connection failed: " . $dbconn->connect_error);
//}
//echo "Connected successfully";


try {
    // PDO baglantisini olusturma
    //$dbconn= new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbconn= new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    //echo "Bağlantı başarılı";
    // PDO istisnalarini görüntülemek için hata raporlamasini etkinlestirme
    //$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*
    // Tablolari sorgulama
    $sql = "SHOW TABLES";
    $stmt = $dbconn->query($sql);

    // Tablolari ekrana yazdirma
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['Tables_in_'.$dbname] . "<br>";
    }
*/
} catch(PDOException $e) {
    echo "Baglanti hatasi: " . $e->getMessage();
}

// Baglantiyi kapatma
// $dbconn= null;
?>