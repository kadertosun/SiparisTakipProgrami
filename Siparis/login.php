<?php
//öncelikle veritabanımızın olduğu sayfayı dahil ediyoruz.

include ("connection.php");

//şimdi ise kullanıcıların giriş yapması için oluşturduğumuz formdan post olayının kontrolünü
//sağlıyoruz..

if($_POST)
{
    //formdan gelen kullanıcı adı ve şifreyi alıyoruz..

    session_start();
    $kullaniciadi=$_POST["kullanici_adi"];
    $kullanicisifre=$_POST["kullanici_sifre"];

    //formdan gelen kullanıcı adı ve şifreye ait veritabanımızda kayıt olup olmadığının kontrolünü yapıyoruz.

    $query=$baglanti->query("SELECT *FROM tbl_kullanicilar where kullanici_adi='$kullaniciadi' && kullanici_sifre='$kullanicisifre'",PDO::FETCH_ASSOC);

    //kayıt saydırma işlemi yapıyoruz bunu $kayitsayisi değişkenine atıyoruz.


    if($kayitsayisi=$query -> rowCount() )
    {
       
        
        //kayit sayısı sıfırdan büyükse böyle bir kullanıcı var ve giriş işlemi gerçekleşir ve kullanıcıyı index.php sayfasına yönlendirir.
        if($kayitsayisi > 0)
        {
       
           $_SESSION["oturum"]=true;
           $_SESSION['kullanici_adi']=$kullaniciadi;
           $_SESSION['kullanici_sifre']=$kullanicisifre;

           header("Location:index.php");
                            
        }
        
                
        
    }
} 

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pektaş Sipariş Takip Programı</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
	<div class="screen">
		<div class="screen__content">
            <!--Kullanıcının  Giriş yapacağı login sayfası -->


            <!--login işlemini aynı sayfada yaptığımız için action boş gönderiyoruz  -->


			<form class="login" action="" method="POST">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" placeholder="Kullanıcı Adı" name="kullanici_adi" required>
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="Şifre" name="kullanici_sifre" required>
				</div>
				<button class="button login__submit">
					<span class="button__text">Giriş Yap</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
		
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</body>

</html>