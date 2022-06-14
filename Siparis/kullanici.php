<?php
 /*veritabanı baglantısı dahil ediliyor */

include 'connection.php';


/*aldığımız kullanıcı numarası ile veritabanında bulunan kullanici_id değeri karşılaştırılıyor eğer bir kullanıcı_no
geliyorsa bu işlemleri yap*/


if (isset($_REQUEST['kullanici_no'])) 
 {

/*Gelen kullanici_no sıfırdan büyükse veritabanında böyle bir değer olup olmadığını kontrol et*/

if ($_REQUEST['kullanici_no']>0) 

        {
//kullanıcı no sfırdan büyük ve kullanıcı id ile eşleşiyorsa veritabanındaki değerleri listele

          $sorgu=$baglanti->prepare( 'SELECT * FROM tbl_kullanicilar where  kullanici_id='.$_REQUEST['kullanici_no'] );
          $sorgu->execute();
          $kullanicilistele=$sorgu-> fetchAll(PDO::FETCH_OBJ);

          foreach($kullanicilistele as $kullanici)  {    }
        
          $kullanici_adi=$kullanici->kullanici_adi;
          $kullanici_sifre=$kullanici->kullanici_sifre;
          $kullanici_yetki= $kullanici->kullanici_yetki; 
          
        }



else
     {
//değer sıfırdan büyük değilse alanları boş getir

          $kullanici_adi='';
          $kullanici_sifre='';
          $kullanici_yetki= ''; 

      }

}


?>

 <!-- Üzerinde işlemleri yapacağımız kullanıcı formunu oluşturuyoruz-->

<div class="card">

  <div class="card-body">

     <form action=""  id="kullaniciformu" method="POST">

    <div class="form-row" >
      
                 <div class="form-group col-md-12">
                  <label for="inputkullaniciadi" >Kullanıcı Adı:</label>
                  <input type="text" class="form-control" id="kullanici_adi" 

                 name="kullanici_adi" placeholder="Kullanıcı Adı" value="<?php echo $kullanici_adi; ?>">
                </div>
    </div>



      <div class="form-row" >

              <div class="form-group col-md-12"  >
              <label for="inputKullanicisifre" >Kullanıcı Şifre:</label>
              <input type="password" class="form-control" id="kullanici_sifre" 
              name="kullanici_sifre" placeholder="Kullanıcı Şifre" value="<?php echo $kullanici_sifre; ?>" >
            </div>

      </div>

  
      <div class="form-row" >
  
                      <div class="form-group col-md-12" >
                      <label for="inputKullaniciYetki">Kullanıcı Yetki:</label>
                      <select id="kullanici_yetki" class="form-control" name="kullanici_yetki">
                        
                      
                           <option selected placeholder="Kullanici Yetki"></option>
                           <option value="Yönetici"  <?php echo $kullanici_yetki=='Yönetici' ? 'selected' : ''?>  >Yönetici</option>
                           <option value="Personel" <?php echo $kullanici_yetki=='Personel' ? 'selected' : ''?>   >Personel</option>
    
                      </select>
                      
                  
                      </div>
      </div>

      



<input type="text" class="form-control" id="id" name="id"  value="<?php echo $_REQUEST['kullanici_no'];?>" hidden >
<input type="text" class="form-control" id="tablo_adi" name="tablo_adi"  value="tbl_kullanicilar" hidden>


              </form>


          </div>

  </div>





<?php 
include 'footer.php';

?>

    







<!---------------- Sayfa Sonu ------------------->


