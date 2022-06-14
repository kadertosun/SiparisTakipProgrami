<!--Oturumun geçerli durumu kontrol ediliyor açık olması halinde navbar.php sayfasını dahil ederek yonetici islem sayfası çalıştırılıyor -->
<!-- aksi durumda login.php sayfasına yönlendirme yapılıyor -->


<?php 
session_start();
if(!isset($_SESSION["oturum"])){header("location:login.php");}
include 'navbar.php';

?>



<!--- sayfa içerigi başlatılıyor ------->


<div class="container">


  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Kullanıcı İşlemleri</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->


        <!--modalımızın body bölümüne kullanıcı_detay idsini veriyoruz bu sayede yazmış olduğumuz kullanıcı_getir fonksiyonu ile
        kullanıcı_idsini alıp kullanıcı.php sayfasında   id'nin varlığını kontrol ediyoruz kullanıcı_id var ise
        bize veritabanındaki değerleri getiriyor. Parametre gönderme işlemi ise detay butonunun onclick olayında gerçekleşiyor.
         -->



        <div class="modal-body" id="kullanici_detay">
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>


          <!-- kullanıcı.php sayfasında bulunan formun id numarası ile formadaki verileri çekiyoruz ve bunları da kullanici_kaydet()
        fonksiyonuna yolluyoruz.  -->


          <button type="button" class="btn btn-success" data-toggle="modal"


          onclick="var k=$( '#kullaniciformu' ).serialize();
           kullanici_kaydet(k);">

          Kaydet</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>



  

     


<?php
/* veritabanında bulunan kayıtları son eklenen kayda göre çekiyoruz */

$sorgu=$baglanti->prepare('SELECT * FROM tbl_kullanicilar order by  kullanici_id  desc');
$sorgu->execute();
$kullanicilistele=$sorgu-> fetchAll(PDO::FETCH_OBJ);
 

?>




    

 <!-- Kullanıcıları listeleyeceğimiz tabloyu hazırlıyoruz-->
 <br>

   <table class="table table-bordered table-responsive-md table-striped text-center">

       <!-- Tablo Başlığımız-->

        <thead>
  <!--kullanıcı getir fonksiyonuna parametre olarak kullanıcı_id gönderip buna göre işlem yapıyorduk burada ise
kullanıcı_id 0 olarak gönderiyoruz ki sistemde böyle bir kayıt olmadığını gösterip bize modalı boş olarak getiriyor.  -->

          <tr> <button class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal"
           
          
          onclick="kullanici_getir(0)" >
         
          <i class="fas fa-plus fa-2x" aria-hidden="true"></i></button></tr>
    
          <tr >
                   <th>Kullanıcı No</th>    
                   <th>Kullanici Adı</th>    
                   <th>Kullanıcı Şifre</th>
                   <th>Kullanıcı Yetki</th>
                   <th colspan="2">İşlemler</th>
          </tr>
        </thead>

        <tbody>
   <tr>
        <!-- Veritabanında bulunan kullanıcıları yukarıda yazmış olduğumuz kullanıcılistele querysi yardımıyla
         tabloya çekiyoruz -->

        
          <?php
			         foreach($kullanicilistele as $kullanici)
               {
          ?>
			 
			 	<tr> 
			 	        <td class="pt-3-half"><?= $kullanici->kullanici_id; ?></td>
                <td class="pt-3-half"><?=$kullanici->kullanici_adi; ?> </td>  
			        	<td class="pt-3-half" type="password"><?= $kullanici->kullanici_sifre; ?></td>
			 	        <td class="pt-3-half"><?= $kullanici->kullanici_yetki; ?></td>


              <!--Detay butonunu önce modalın idsi ile bağlıyoruz daha sonra ise onclick olayı ile 
              kullanıcı_idsini parametre olarak gönderiyoruz -->

                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"

                onclick="kullanici_getir(<?php echo $kullanici->kullanici_id;?>)">Detay </button> </td>
                
                
                <td><button type="reset" class="btn btn-danger" 
                
                onclick="kullanici_sil(<?php echo $kullanici->kullanici_id; ?>,'tbl_kullanicilar')"
                
                
                >Sil</button></td>
     </tr>

        <?php

        }
        ?>
        </tr>
        </tbody>
      </table>
    



<!-------sayfa sonu------->

<?php  include 'footer.php'; ?>
<script>

  /* kullanıcı_getir fonksiyonu kullanıcı_id parametresi alan ve bu paramtreyi kullanici.php sayfasına gönderen
  bir fonksiyondur.
  burada detayları görüntülemek için modal id bağlanmıştır ancak parametre kontolünün yapıldığı ve buna göre 
  dönecek sonucu hazırlayan sayfa kullanici.php sayfasıdır.*/




  

function kullanici_getir(kullanici_id) 
{
/*kullanıcı verilerini görüntülemek için kullanıcı id yeterli olacaktır */

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
         {
        
        document.getElementById('kullanici_detay').innerHTML=this.responseText;
        
    
        }
      };
      xmlhttp.open("GET", "kullanici.php?kullanici_no=" +kullanici_id, true);
      xmlhttp.send();
    
}


function kullanici_kaydet(str) {
   
  

   var xmlhttp = new XMLHttpRequest();
   
   xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
         
      this.responseText;
 
           
      
             location.reload();
            
       
 
        
      
         }
       };
       xmlhttp.open("GET", "veritabani_islemleri.php?" + str, true);
       xmlhttp.send();
      
     
   
     }





/* Kullanıcı sil fonksiyonu ile birlikte veritabanında bulunan kullanıcı kaydını sileriz bunun için yapmamız gereken
kullanıcıdan dönen bir kullanici_id ve tablo_adi parametrelerini almak olacaktır.   */





/*silme işlemi yapmak için bize negetif bir değer gerekiyor bunun için str parametresini - ile çarpıp 
veritabanı_islemleri sayfasına gönderiyoruz. karşı taraf bu veriyi veritabanıyla karşılaştırdığı zaman
bir sonuş bulamayacağı için orada yazdığımız queryde aldığımız değeri eksi ile çarpıyoruz. */



function kullanici_sil(str,tablo_adi) {
   var kayit=str*-1;


   var xmlhttp = new XMLHttpRequest();
   
   xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
         
        this.responseText; 
//işlem gerçekleştikten sonra sayfamızı yeniliyoruz
            location.reload();
           
      
      
         }
       };
       xmlhttp.open("GET", "veritabani_islemleri.php?id="+kayit+'&tablo_adi='+tablo_adi, true);
       xmlhttp.send();
      
     
   
     }

</script>

