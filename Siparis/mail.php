<?php
session_start();
if(isset($_POST))

{
	if($_POST["siparis_eden_personel"] && $_POST["siparis_eden_departman"] && $_POST["siparis_talep_tarihi"])
	{



		$alert = array
		{
			"message" =>"mail gönderildi",
			"type"   =>"success"
		};
		$_SESSION["alert"]=$alert;
		header("location:siparisgiris.php");
	}
	else
	{
		$alert=array
		{
            "message"=>"lütfen alanları doldurunuz",
			"type"=>"danger"
		};
		$_SESSION("alert")=$alert;
		header("location:siparis.php");
	}
}


?>



