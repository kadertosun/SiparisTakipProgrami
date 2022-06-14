<?php
//oturumun açık olmadığında login sayfasına yönlendirme yapılıyor. 
session_start();
if(!isset($_SESSION["oturum"]))
{
    header("location:login.php");
}
//sayfaya diğer tüm alanlarda kullanacağımız navbar sayfası dahil ediliyor.
include 'navbar.php';

?>







<!--- sayfa içeriği başlatılıyor ------->


















<!-------sayfa sonu ------->

<!-- sayfanın sonunda body ve html etiketini kapatmak için footer.php sayfası dahil ediliyor-->
<?php  include 'footer.php'; ?>