<?php 
session_start();
include 'connection.php';


if(isset($_SESSION["alert"])){
  $alert=$_SESSION["alert"];
}


/* alınan siparisno değerine göre  işlem yapıyoruz*/


if(isset($_REQUEST['siparis_no']))


{
  /* siparis no sıfırdan büyükse yazdığımız sorguyla siparis tarihi,personel adını ve departman
  bilgilerini alıyoruz. sıfırdan büyük olması veritabanında böyle bir kaydın olduğu anlamına gelmektedir.*/ 
  if($_REQUEST['siparis_no']>0)
{
  $sorgu=$baglanti->prepare('SELECT *FROM tbl_siparisler WHERE siparisler_id='.$_REQUEST['siparis_no']);
  $sorgu->execute();
  $siparislistele=$sorgu-> fetchAll(PDO::FETCH_OBJ);

  
  foreach($siparislistele as $siparisler){ }
  $siparis_talep_tarihi=$siparisler->siparis_talep_tarihi;
  $siparis_eden_personel=$siparisler->siparis_eden_personel;
  $siparis_eden_departman=$siparisler->siparis_eden_departman;

}
else /* veritabınında veri yoksa değerler boş gelir tarih olarak ise bugünün değeri gelir. */ 
{
  
  $siparis_talep_tarihi= date('Y-m-d');
  $siparis_eden_personel='';
  $siparis_eden_departman='';
}
}

?>





<!-- sayfa başı -->
<?php
if(isset ($_SESSION["alert"])){;?>
<div class="alert alert-<?php echo $_SESSION["alert"] ["type"]; ?>">

  <?php echo $_SESSION["alert"]["message"];?>
  
</div>
<?php unset($_SESSION["alert"]);?>

<?php 
}
?>



<!------------------siparis tarihi, personel ve departman bilgilerinin alındığı master formu ---------------->

<div class="card">

   <div class="card-body">
  
   <form action="mail.php" id="masterform" method="POST">
  
   <div class="form-row">

      <div class="form-group col-md-12">

            <label for="inputsiparistarihi"> Sipariş Tarihi:</label>
            <input type="date" class="form-control" id="siparis_talep_tarihi" 
            name="siparis_talep_tarihi" placeholder="Tarih" value="<?php echo $siparis_talep_tarihi; ?>">

     </div>

   </div>

      <div class="form-row">
        <div class="form-group col-md-12">

            <label for="inputpersonel">Siparis Veren Personel:</label>
            <!------ detaya basıldığı zaman verileri ilgili alana çeker    --->
            <input type="text" class="form-control" id="siparis_eden_personel"
            name="siparis_eden_personel" placeholder="Ad Soyad" value="<?php echo $siparis_eden_personel;?>">

        </div>
      </div>


  <div class="form-row">
<!---------------------------Comboboxda seçilen değerin veritabanına gönderilmesi sağlanıyor ----------------->
    <div class="form-group col-md-12">

             <label for="inputdepartman"> Siparis Veren Departman:</label>

        <select name="siparis_eden_departman" id="siparis_eden_departman" class="form-control">

              <option selected aria-placeholder="Departman"></option>
              <option value="Bilgi İşlem" <?php echo $siparis_eden_departman=='Bilgi İşlem' ? 'selected' : '' ?> > Bilgi İşlem</option>
              <option value="Depo Sevkiyat"<?php echo $siparis_eden_departman=='Depo Sevkiyat' ? 'selected' : '' ?>> Depo Sevkiyat</option>
              <option value="Kalite Kontrol" <?php echo $siparis_eden_departman=='Kalite Kontrol' ? 'selected' : '' ?>> Kalite Kontrol</option>
              <option value="Muhasebe" <?php echo $siparis_eden_departman=='Muhasebe' ? 'selected' : '' ?>> Muhasebe </option>
              <option value="Satış" <?php echo $siparis_eden_departman=='Satış' ? 'selected' : '' ?>> Satış</option>
              <option value="Satın Alma" <?php echo $siparis_eden_departman=='Satın Alma' ? 'selected' : '' ?>>Satın Alma</option>
              <option value="Pazarlama" <?php echo $siparis_eden_departman=='Pazarlama' ? 'selected' : '' ?>>Pazarlama</option>
              <option value="Planlama" <?php echo $siparis_eden_departman=='Planlama' ? 'selected' : '' ?>>Planlama</option>
              <option value="Üretim" <?php echo $siparis_eden_departman=='Üretim' ? 'selected' : ''?>> Üretim</option>
   
         </select>
          
    </div>

  </div>


<!---------------------------formdaki verileri input da bulunan siparisno ve tablo adı ile veritabaına gönderip ilgili tabloya kayıt yapar ------------------>
              <input type="text" class="form-control" id="id" name="id" value="<?php echo $_REQUEST['siparis_no'];?> " hidden>
              <input type="text" class="form-control" id="tablo_adi" name="tablo_adi" value="tbl_siparisler" hidden>
              <br>
              <div class="from-row">
<button type="submit" class="btn btn-success"> Bildir</button>
</div>
  </form>
  
  </div>

</div>



<!----------------- Satirlar Tablosu----------------------->



   <!------- tbl_siparis_satirlar tablosundan verileri çekip siparis_satirlar değişkenine atıyoruz--->



  <div class="card">

  <div class="card-body">

  <?php 
  
     $sorgu=$baglanti->prepare('SELECT * FROM tbl_siparis_satirlar where  siparis_id='.$_REQUEST['siparis_no'].' order by  satirlar_id desc');
     $sorgu->execute();
     $siparis_satirlar=$sorgu-> fetchAll(PDO::FETCH_OBJ);
 
  ?><!----Siparis satır formu------------>

             <table class="table">
        <thead>
                <tr>
                   <th colspan="5">
                     <button class="btn btn-primary" onclick="
         
                     siparis_kaydet('id=0&siparis_id=<?php echo $_REQUEST['siparis_no'] ?>&tablo_adi=tbl_siparis_satirlar',<?php echo $_REQUEST['siparis_no'] ?>);"> Ekle 
                     </button>
                     <a href="mail.php"><button class="btn btn-success" >Bildir</button></a>
       
                    </th>    
                   
                     
                </tr>
             <tr>                    
                  <th>Malzeme Kodu</th>    
                  <th>Malzeme Tanimi</th>
                  <th>Malzeme Miktari</th>
                  <th>Malzeme Birimi</th>
                  <th>Malzeme Açıklamasi</th>
                  <th colspan="2">İşlemler</th>
             </tr>
         </thead>
        <tbody>

    <?php
            foreach($siparis_satirlar as $satirlar)
    
    {?>

 <tr>

<form action="" id="form_satir<?= $satirlar->satirlar_id ?>">

  
                <td class="pt-3-half" hidden><?= $satirlar->satirlar_id ?></td>
                <td class="pt-3-half"><input type="text" form="form_satir<?=$satirlar->satirlar_id?>" value="<?=$satirlar->malzeme_kodu; ?>" name="malzeme_kodu" ></td>
                <td class="pt-3-half"><input type="text" form="form_satir<?=$satirlar->satirlar_id?>" value="<?=$satirlar->malzeme_tanimi; ?>" name="malzeme_tanimi" ></td>
                <td class="pt-3-half"><input type="text" form="form_satir<?= $satirlar->satirlar_id ?>" value="<?=$satirlar->malzeme_miktari; ?> " name="malzeme_miktari" style="width: 80px;" > </td>  
                <td class="pt-3-half"><input type="text" form="form_satir<?=$satirlar->satirlar_id?>" value="<?=$satirlar->malzeme_birimi;?>" name="malzeme_birimi"></td>
                <td class="pt-3-half"><input type="text" form="form_satir<?=$satirlar->satirlar_id?>" value="<?=$satirlar->malzeme_aciklama;?>" name="malzeme_aciklama"></td>

  <td> 
    
 <!--------------Form_satir formundaki verileri kaydetme işlemi yapar---------->

    <button type="button" class="btn btn-primary"  onclick="
  
        var k=$('#form_satir<?= $satirlar->satirlar_id ?>').serialize();

        siparis_kaydet(k,<?php echo $satirlar->siparis_id ?>);" > Kaydet

    </button>



</td>

  <td> 
    
  
         <button type="reset" class="btn btn-danger"  onclick="

         siparis_sil(<?php echo $satirlar->satirlar_id; ?>,'tbl_siparis_satirlar',<?php echo $satirlar->siparis_id?>)">Sil
      
         </button>
    
  </td>
  
        <input type="text" class="form-control" id="siparis_id" name="siparis_id" form="form_satir<?= $satirlar->satirlar_id ?>" value="<?php echo $satirlar->siparis_id; ?>" hidden >
  
        <input type="text" class="form-control" id="id" name="id" form="form_satir<?= $satirlar->satirlar_id ?>" value="<?php echo $satirlar->satirlar_id; ?>" hidden >
  
        <input type="text" class="form-control" id="tablo_adi" name="tablo_adi" form="form_satir<?= $satirlar->satirlar_id ?>"  value="tbl_siparis_satirlar" hidden>

   
</form>
  

  </tr>

  
 
<?php } 
          
          ?>


</tbody>
         
             </table>
        
        </div>
                  
  </div>



