<?php
session_start();
if(!isset($_SESSION["oturum"])){header("location:login.php");}
include 'connection.php';



?>
<?php
//
isset($_REQUEST['siparis_no']);



$sorgu1=$baglanti->prepare('SELECT *FROM tbl_siparisler where siparisler_id='.$_REQUEST['siparis_no']);
$sorgu1->execute();
$mastergetir=$sorgu1->fetchAll(PDO::FETCH_OBJ);




$sorgu=$baglanti->prepare('
SELECT * FROM tbl_siparisler 
    JOIN tbl_siparis_satirlar ON tbl_siparisler.siparisler_id = tbl_siparis_satirlar.siparis_id
    where
    tbl_siparisler.siparisler_id='.$_REQUEST['siparis_no']
);
$sorgu->execute();
$siparislistele=$sorgu-> fetchAll(PDO::FETCH_OBJ);
 

?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<img align="left" src="img/kablo.png" width="100" height="60">
<h5 class="card-header text-center font-weight-bold text-uppercase py-4">MALZEME TALEP FORMU </h5>


<?php
			 foreach($mastergetir as $master){?>

			 
			 	
<div>
   <label for="inputsiparistarihi"> Sipariş Tarihi:  <?php echo date('d.m.Y',strtotime($master->siparis_talep_tarihi)); ?></label>

</div>

</div>

<div >
  <div >
    <label for="inputpersonel">Siparis Veren Personel: <?php echo $master->siparis_eden_personel; ?></label></label>

  </div>
</div>

<div >
    <label for="inputpersonel">Siparis Veren Departman: <?php echo $master->siparis_eden_departman; ?></label>
   
  </div>
</div>

				 
			 <?php } ?>
      


   <table class="table table-bordered table-responsive-md table text-center">
  

        <thead>
          <tr >
            
          <th>Malzeme Kodu</th>    
          <th>Malzeme Tanımı</th>
          <th>Miktar</th>
          <th>Birim</th>
          <th>Malzeme Açıklama</th>
          
          </tr>
        </thead>
        <tbody>
  
        
          <tr>
          <?php
			 foreach($siparislistele as $siparis){?>

			 
			 	<tr> 
			 	
        <td class="pt-3-half"><?=$siparis->malzeme_kodu; ?> </td>  
			 	<td class="pt-3-half"><?= $siparis->malzeme_tanimi; ?></td>
			 	<td class="pt-3-half"><?= $siparis->malzeme_miktari; ?></td>
        <td class="pt-3-half"><?=$siparis->malzeme_birimi;?></td>
        <td class="pt-3-half"><?=$siparis->malzeme_aciklama;?></td>
        
             

        
                 
			    </tr>
				 
			 <?php } ?>
      
        </tbody>
        
    
      </table>
    <div style="float: left;">
    <label>PEK-FORM-02-01 </label>
    </div>
          <div style="float:right;">
            
         <label> 03.11.2012-0</label>

         
          </div>
<div style="margin-top:10px;clear:both; float:right; ">
<div>
<label  style="font-size:bold;">Satın Alma Onay</label>
</div>

</div>

<script>

window.print() ;
</script>

</body>
</html>