<?php


/* veritabanına erişmek için veritabanı sayfamızı dahil ediyoruz  */
include 'connection.php';
 
/* gerekli işlemleri yapmak için parametre alıp bunları değişkenlere atıyoruz soru işsareti öncesinde olan 
alanda elimizde bu isimde bir veri varsa bu veriyi kullan : sonrasında ise elimizde böyle bir veri yoksa o zaman 
bu değeri boş olarak geçiyoruz ki ihtiyaç duymadığımız yerlerde sorunlar yaşamayalım */

$departman = isset($_REQUEST['siparis_eden_departman']) ? $_REQUEST['siparis_eden_departman'] : '' ;
$personel = isset($_REQUEST['siparis_eden_personel']) ?  $_REQUEST['siparis_eden_personel'] : '' ;
$tarih = isset($_REQUEST['siparis_talep_tarihi']) ?  $_REQUEST['siparis_talep_tarihi'] : '' ;  
$aciklama=isset($_REQUEST['urun_aciklamasi']) ? $_REQUEST['urun_aciklamasi']:'';
$miktar=isset($_REQUEST['urun_miktar']) ? $_REQUEST['urun_miktar'] : '';
$siparisid=isset($_REQUEST['siparis_id']) ? $_REQUEST['siparis_id'] : '';
$ad=isset($_REQUEST['kullanici_adi']) ? $_REQUEST['kullanici_adi']: '';
$sifre=isset($_REQUEST['kullanici_sifre']) ? $_REQUEST['kullanici_sifre'] :'';
$yetki=isset($_REQUEST['kullanici_yetki']) ? $_REQUEST['kullanici_yetki'] : '';
$malzemekodu=isset($_REQUEST['malzeme_kodu']) ? $_REQUEST['malzeme_kodu'] : '';
$malzemetanimi=isset($_REQUEST['malzeme_tanimi']) ? $_REQUEST['malzeme_tanimi'] :'';
$malzememiktari=isset($_REQUEST['malzeme_miktari']) ? $_REQUEST['malzeme_miktari']:'';
$malzemebirimi=isset($_REQUEST['malzeme_birimi']) ? $_REQUEST['malzeme_birimi']:'';
$malzemeaciklama=isset($_REQUEST['malzeme_aciklama']) ? $_REQUEST['malzeme_aciklama']:'';



$tablo_adi = $_REQUEST['tablo_adi'];


 




/*gelen id numarası ve tablo isimlerine göre veritabanı işlemleri yapıyoruz */



//****** Kayıt işlemi **********///




if ($_REQUEST['id']==0 ) {

/*gelen id numarası sıfıra eşit ve tablo adı tbl_kullanicilar ise o zaman kayıt işlemi yap */

if($tablo_adi=='tbl_kullanicilar')
{
  $sqlekle="INSERT INTO $tablo_adi ( kullanici_adi,kullanici_sifre,kullanici_yetki) 
  VALUES ('$ad','$sifre','$yetki')";
}
            
            
if ($tablo_adi=='tbl_siparisler') {
  $sqlekle="INSERT INTO $tablo_adi (siparis_eden_departman, siparis_eden_personel,siparis_talep_tarihi) VALUES ('$departman','$personel','$tarih')";
} 
if($tablo_adi=='tbl_siparis_satirlar')
{
  $sqlekle="INSERT INTO $tablo_adi(siparis_id,malzeme_kodu,malzeme_tanimi,malzeme_miktari,malzeme_birimi,malzeme_aciklama) VALUES ('$siparisid','$malzemekodu','$malzemetanimi','$malzememiktari','$malzemebirimi','$malzemeaciklama')";

}
  
                $baglanti->exec($sqlekle);
                print $baglanti->lastInsertId();


}

//******* Güncelleme İşlemi ****//


if ($_REQUEST['id']>0) {

/* gelen id numarası sıfırdan büyük ve tablo adı tbl_kullanicilar ise guncelleme işlemi yapıyoruz*/

if($tablo_adi=='tbl_kullanicilar')
{
  $sqlguncelle= "UPDATE $tablo_adi SET kullanici_adi='$ad',kullanici_sifre='$sifre', kullanici_yetki='$yetki' where kullanici_id=".$_REQUEST['id'];
}

if($tablo_adi=='tbl_siparisler')

{
  $sqlguncelle="UPDATE $tablo_adi SET siparis_eden_departman='$departman',siparis_eden_personel='$personel',siparis_talep_tarihi='$tarih' where siparisler_id=".$_REQUEST['id'];
}

if($tablo_adi=='tbl_siparis_satirlar')
{
  $sqlguncelle="UPDATE $tablo_adi SET malzeme_kodu='$malzemekodu',malzeme_miktari='$malzememiktari',malzeme_birimi='$malzemebirimi',malzeme_aciklama='$malzemeaciklama',malzeme_tanimi='$malzemetanimi' where satirlar_id=".$_REQUEST['id'];
}




    
    $baglanti->exec($sqlguncelle);
    
     print $baglanti->lastInsertId();
    
    
    }

//**********Silme işlemi********//



    if ($_REQUEST['id']<0) 
    {

        
        //aldığımız id değeri negatif ancak veritabanında negatif bir değer olmadığı için değerimizi if bolğu
        //içerisine girdikten sonra 1 ile çapıyoruz.
        if($tablo_adi=='tbl_kullanicilar')
        {
          $sqlsil="DELETE FROM  $tablo_adi  where kullanici_id =".$_REQUEST['id']*-1;
        }

        if($tablo_adi=='tbl_siparisler')
        {
          $sqlsil="DELETE FROM $tablo_adi WHERE siparisler_id=".$_REQUEST['id']*-1;
        }
        if($tablo_adi=='tbl_siparis_satirlar')
        {
          $sqlsil="DELETE FROM $tablo_adi WHERE satirlar_id=".$_REQUEST['id']*-1;
        }

        

        


$baglanti->exec($sqlsil);

print $baglanti->lastInsertId();


}



?>
 
