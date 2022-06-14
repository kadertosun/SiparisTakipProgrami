<!-- Tüm sayfalarda kullanmak üzere oluşturduğumuz veritabanı bağlantımız-->

<?php
	$host = "localhost"; //host
	$user = "root";  // host id
	$password = "";  // password local olduğu için varsayılan şifre boş
	$databasename = "siparis_hazirla"; // veritabanı adımız
	

	//veritabanı bağlantımızın durumunu kontrol ediyoruz.


	try
    
    {
		$baglanti = new PDO("mysql:host=$host;dbname=$databasename",$user,$password);
		// türkçe karakter için utf8
		$baglanti->exec("SET CHARSET UTF8");


		//die("Veritabanı bağlantısı başarılı");
      
		//eğer hata olursa pdo nun exception komutu ile ekrana yazdırıyoruz

	}
    catch(PDOException $e)
    {
		die ("Veritabanına baglanamadı!!!");
	}


?>

	
