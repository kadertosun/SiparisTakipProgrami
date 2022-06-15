<?php 
session_start();
if(!isset($_SESSION["oturum"])){header("location:login.php");}


include 'navbar.php';

?>

<!--------- sipariş-modal ve fonksiyonlarımızın bulunduğu sayfa------------------->


<!--- sayfa içerigi başla ------->



  <!-- The Modal -->
  <div class="modal fade bd-example-modal-lg" id="myModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Sipariş Detay</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="siparis_icerik">
          
        </div>

        

        
        <!-- Modal footer -->
        <div class="modal-footer">

          <!--Modal Kaydet---->

        <span class="table-add float-right mb-3 mr-2" > 
          <!-- siparis.php sayfasında bulunan master form isimli tablodaki verileri alıp kayıt işlemi yapar--->
          <button type="button" class="btn btn-success" id="submit"
            onclick="
                   
            var k=$( '#masterform' ).serialize();
            siparis_kaydet(k); ">  Kaydet
             
             </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>


<?php

$sorgu=$baglanti->prepare('SELECT * FROM tbl_siparisler order by  siparisler_id  desc');
$sorgu->execute();
$siparislistele=$sorgu-> fetchAll(PDO::FETCH_OBJ);
 

?>


<!-- Master formu-->

    
<h5 class="card-header text-center font-weight-bold text-uppercase py-4"> Sipariş  Girişi </h5>
</div>
 
   <table class="table table-bordered table-responsive-md table-striped text-center">
  <!--siparis_getir fonksiyonuna 0 parametresi gönderir-->
  <button 
    class="btn btn-outline-primary"   data-toggle="modal" data-target="#myModal"  
          
          onclick="siparis_getir(0)" >
  <i class="fas fa-plus fa-2x" aria-hidden="true"></i></button>

        <thead>
          <tr >
          <th>Siparis No</th>    
          <th>Siparis Tarihi</th>    
          <th>Siparis Veren Personel</th>
          <th>Siparis Veren Departman</th>
          <th colspan="3">İşlemler</th>
          </tr>
        </thead>
        <tbody>
  
        
          <tr>
            <!---siparislistele değişkenine atanan değerleri tabloya atıp listeleme işlemi yapar---->
          <?php
			 foreach($siparislistele as $siparis){?>
			 
			 	<tr> 
			 	<td class="pt-3-half"><?= $siparis->siparisler_id ?></td>
       <td class="pt-3-half" ><?=  date('d.m.Y',strtotime($siparis->siparis_talep_tarihi)); ?> </td>  
			 	<td class="pt-3-half"><?= $siparis->siparis_eden_personel; ?></td>
			 	<td class="pt-3-half"><?= $siparis->siparis_eden_departman; ?></td>
        <td> 
            
         
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"  
          
          onclick="siparis_getir(<?php echo $siparis->siparisler_id; ?>)"> Detay
  </button>
        
        
        
        </td>
          <td> <button type="reset" class="btn btn-danger" id="delete"
          
          
          onclick="siparis_sil(<?php echo $siparis->siparisler_id; ?>,'tbl_siparisler',0)">Sil</button></td>
          <td>

 <a href="siparisyaz.php?siparis_no=<?php echo $siparis->siparisler_id; ?>"target="_blank"> <button type="button" class="btn btn-primary"
       
      
       
       > Yazdır
  </button></a>
        
        

   
          </td>

        
                 
			    </tr>
				 
			 <?php } ?>
      
  
        </tbody>
      </table>
    



<!-------sayfa sonu ------->

<?php  include 'footer.php'; ?>

<!------------------------- Fonksiyonlar------------------------->
<script>
  
  function siparis_kaydet(str,yenileme=0) {
   
  

  var xmlhttp = new XMLHttpRequest();
  
  xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        
   
          
      if(yenileme>0)
           {
              siparis_getir(yenileme);
           }
           else{
            location.reload();
           }
      

       
     
        }
      };
      xmlhttp.open("GET", "veritabani_islemleri.php?" + str, true);
      xmlhttp.send();
     
    
  
    }

  
  function siparis_getir(siparis_id) {
  




          var xmlhttp = new XMLHttpRequest();

          xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200)
                 {
                
                document.getElementById('siparis_icerik').innerHTML=this.responseText;
                
            
                }
              };
              xmlhttp.open("GET", "siparis.php?siparis_no=" +siparis_id, true);
              xmlhttp.send();
            




  }




  function siparis_sil(str,tablo_adi,yenileme) {
   var kayit=str*-1;
 

   var xmlhttp = new XMLHttpRequest();
   
   xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
         
        // alert(this.responseText); 
 if(yenileme>0)
           {
              siparis_getir(yenileme);
           }
           else{
            location.reload();
           }
      
      
         }
       };
       xmlhttp.open("GET", "veritabani_islemleri.php?id="+kayit+'&tablo_adi='+tablo_adi, true);
       xmlhttp.send();
      
     
   
     }


  </script>
