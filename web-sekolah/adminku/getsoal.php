<?php 
include ('cek.php');
include ('../config/config.php');
include ('fungsi.php');
?>
<?php
$querydosen = mysqli_query ($mysqli, "SELECT kodesoal FROM jawaban WHERE nis='$username'");
						if($querydosen == false){
						die ("Terjadi Kesalahan : ". mysqli_error($mysqli));
						}
						while ($ar = mysqli_fetch_array ($querydosen)){
					    
$qu = mysqli_query ($mysqli, "SELECT * FROM ujian where kodesoal='$ar[kodesoal]'");
						if($qu == false){
							die ("Terjadi Kesalahan : ". mysqli_error($mysqli));
						}
						while ($rr = mysqli_fetch_array ($qu)){
						if($rr['acak'] > 1)
				        {
					    $acak = "nomersoal ASC";
				        }
				        else
				        {
					    $acak = "RAND ()";
					    }

$query = mysqli_query ($mysqli, "SELECT * FROM soal CROSS JOIN jawaban USING (kodesoal) WHERE nis='$username' ORDER by status ASC, $acak");
						if($query == false){
						die ("Terjadi Kesalahan : ". mysqli_error($mysqli));
						$i=1;
						}
						while ($ar = mysqli_fetch_array ($query)){

						$result = mysqli_query($mysqli, "SELECT * FROM soal WHERE kodesoal='$ar[kodesoal]'");
						$rows = mysqli_num_rows($result);
						$ks=$ar["kodesoal"];
						$ip=$ar["kunci"];
						
						if(!$ar['audio']=='')
				        {
					    $audio = "<audio src='../gbr/$ar[audio]' controls controlsList='nodownload'></audio>";
				        }
				        else
				        {
					    $audio = "";
				        }	
				        
						if(!$ar['gambarsoal']=='')
				        {
					    $gambarsoal = "<img src='../gbr/$ar[gambarsoal]' alt='Nature' class='responsive' align=center style='max-width:450px;height:auto' ><br>";
				        }
				        else
				        {
					    $gambarsoal = "";
					    }
					    
					    if(!$ar['gambar_a']=='')
				        {
					    $gambar_a = "<img src='../gbr/$ar[gambar_a]' class='responsive' align=center style='max-width:200px;height:auto' >";
				        }
				        else
				        {
					    $gambar_a = "";
				        }
				        if(!$ar['pilihan1']=='')
				        {
					    $pilihan_a = "$ar[pilihan1]";
				        }
				        else
				        {
					    $pilihan_a = "";
				        }
				        if(!$ar['gambar_b']=='')
				        {
					    $gambar_b = "<img src='../gbr/$ar[gambar_b]' class='responsive' align=center style='max-width:200px;height:auto' >";
				        }
				        else
				        {
					    $gambar_b = "";
				        }
				        if(!$ar['pilihan2']=='')
				        {
					    $pilihan_b = "$ar[pilihan2]";
				        }
				        else
				        {
					    $pilihan_b = "";
				        }
				        if(!$ar['gambar_c']=='')
				        {
					    $gambar_c = "<img src='../gbr/$ar[gambar_c]' class='responsive'  align=center style='max-width:200px;height:auto' >";
				        }
				        else
				        {
					    $gambar_c = "";
				        }
				        if(!$ar['pilihan3']=='')
				        {
					    $pilihan_c = "$ar[pilihan3]";
				        }
				        else
				        {
					    $pilihan_c = "";
				        }
				        if(!$ar['gambar_d']=='')
				        {
					    $gambar_d = "<img src='../gbr/$ar[gambar_d]' class='responsive' align=center style='max-width:200px;height:auto' >";
				        }
				        else
				        {
					    $gambar_d = "";
				        }
				        if(!$ar['pilihan4']=='')
				        {
					    $pilihan_d = "$ar[pilihan4]";
				        }
				        else
				        {
					    $pilihan_d = "";
				        }
					     if(!$ar['gambar_e']=='')
				        {
					    $gambar_e = "<img src='../gbr/$ar[gambar_e]' class='responsive' align=center style='max-width:200px;height:auto' >";
				        }
				        else
				        {
					    $gambar_e = "";
				        }
				        if(!$ar['pilihan5']=='')
				        {
					    $pilihan_e = "$ar[pilihan5]";
				        }
				        else
				        {
					    $pilihan_e = "";
				        }
						$i++;
						if($i==$rows)
				        {
					    $sampun = "<button id='done' type='button' class='btn btn-success' data-target='#ModalImport' data-toggle='modal'>
					                <span class='hidden-lg hidden-md'><i class='fa fa-check'></i> FINISH</span>
                                    <span class='hidden-xs hidden-sm'><i class='fa fa-check'></i> MENYELESAIKAN UJIAN</span>
					               </button>";
				        }
				        else
				        {
					    $sampun = "";
					    }
						if($ar['status']>1)
				        {
					    $statussoal = "hidden";
				        }
				        else
				        {
					    $statussoal = "show";
				        }
						if($ar['status']>1)
				        {
					    $simpanjawab = "jawabanuraian";
				        }
				        else
				        {
					    $simpanjawab = "jawabansiswa";
				        }
						if($ar['status']>1)
				        {
					    $statussoalurai = "show";
				        }
				        else
				        {
					    $statussoalurai = "hidden";
				        }
$query2 = mysqli_query ($mysqli, "SELECT * FROM jawaburaian WHERE nis='$username' AND nomersoal='$ar[nomersoal]' AND kodesoal='$ks'");
$ur = mysqli_fetch_array ($query2);
						if($ar['status']>1)
				        {
					    $area = "
<form>
<textarea class='form-control' rows='5' id='token$i' name='token$ar[nomersoal]' type='text' onchange='return nilaiUH$ar[nomersoal]()'>$ur[jawaban]</textarea>

<p id='result$i' style='font-size:11px;font-style: italic;font-style: bold;background-image: linear-gradient(to right, green , white);color:white'></p>
<script>
	function nilaiUH$ar[nomersoal]()
	{
	var token= document.getElementById('token$i').value;
	var dataString = 'nomersoal=$ar[nomersoal]&unik=$ks-$ar[nomersoal]-$nis&kodemapel=$ks&token=' + token; 
	$.ajax({type:'post',url:'jawaburaian.php',data:dataString,cache:false,
		success: function(html) {
		$('#result').html(html);
		$('#result$i').html('&#10004; jawaban tersimpan');
		}});
	return false;
	}
</script> 
";
				        }
				        else
				        {
					    $area = "<div class='col-xs-12' id='opsi$statussoal'>
                                <input  hidden type='radio' name='$simpanjawab$ar[nomersoal]' id='X$i' value='X' checked='checked' ></div>";
				        }
?>
 


<div class="soalnye cls<?php echo $i; ?>">
            
                <button id="keto" type="button" class="no btn-primary"><b>NOMER SOAL</b></button>
                <!-------no soal------>
                <button id="nomer" type="button" class="soal btn-default"><b><?php echo "$i"; ?></b></button></br></br>
                    <span class="resizable-content">
                    <p><b><?php echo "$ar[soal]"; ?></b></p>
                    <br><br>
                    <!-------gambar soal------>
                    <a class='open_modal' style='font-decoration:none;color:#222;' id='<?php echo "$ar[id]"; ?>'><?php echo "$gambarsoal"; ?></a>
                    <?php echo "$audio"; ?><br><br>
                    
                    <!-------pilihan------>
                    
                    <input type="hidden" name="jumlah<?php echo "$ar[nomersoal]"; ?>" id="jumlah<?php echo "$ar[nomersoal]"; ?>" value="<?php echo $rows; ?>">                    
                    <input type="hidden" name="km<?php echo "$ar[nomersoal]"; ?>" id="km<?php echo "$ar[nomersoal]"; ?>" value="<?php echo $km; ?>">
                    <input type="hidden" name="ks<?php echo "$ar[nomersoal]"; ?>" id="ks<?php echo "$ar[nomersoal]"; ?>" value="<?php echo $ks; ?>">
				
                    <?php echo "$area"; ?>
				   <label class="custom-radio-button">
                        <div class="col-xs-12" id="opsi<?php echo $statussoal;?>">
                                <input type="radio" name='<?php echo "$simpanjawab"; ?><?php echo "$ar[nomersoal]"; ?>' id='jawabansiswaA<?php echo "$i"; ?>' value="A"<?php echo ($ar['jawabansiswa'][$ar['nomersoal']-1]=='A')?'checked="checked"':'' ?>/> 
                                    <span class="helping-el"></span>
                                <span class="label-text">a</span>
                                <p id="cho"><?php echo "$pilihan_a"; ?><?php echo "$gambar_a"; ?></p>
                        </div>
                    </label>
                    <br>
                    <label class="custom-radio-button">
                        <div class="col-xs-12" id="opsi<?php echo $statussoal;?>">
                                <input type="radio" name='<?php echo "$simpanjawab"; ?><?php echo "$ar[nomersoal]"; ?>' id='jawabansiswaB<?php echo "$i"; ?>' value="B"<?php echo ($ar['jawabansiswa'][$ar['nomersoal']-1]=='B')?'checked="checked"':'' ?>/> 
                                    <span class="helping-el"></span>
                                <span class="label-text">b</span>
                                <p id="cho"><?php echo "$pilihan_b"; ?><?php echo "$gambar_b"; ?></p>
                        </div>
                    </label>
                    <br>
                    <label class="custom-radio-button">
                        <div class="col-xs-12" id="opsi<?php echo $statussoal;?>">
                                <input type="radio" name='<?php echo "$simpanjawab"; ?><?php echo "$ar[nomersoal]"; ?>' id='jawabansiswaC<?php echo "$i"; ?>' value="C"<?php echo ($ar['jawabansiswa'][$ar['nomersoal']-1]=='C')?'checked="checked"':'' ?>/> 
                                    <span class="helping-el"></span>
                                <span class="label-text">c</span>
                                <p id="cho"><?php echo "$pilihan_c"; ?><?php echo "$gambar_c"; ?></p>
                        </div>
                    </label>
                    <br>
                    <label class="custom-radio-button">
                        <div class="col-xs-12" id="opsi<?php echo $statussoal;?>">
                                <input type="radio" name='<?php echo "$simpanjawab"; ?><?php echo "$ar[nomersoal]"; ?>' id='jawabansiswaD<?php echo "$i"; ?>' value="D"<?php echo ($ar['jawabansiswa'][$ar['nomersoal']-1]=='D')?'checked="checked"':'' ?>/> 
                                    <span class="helping-el"></span>
                                <span class="label-text">d</span>
                                <p id="cho"><?php echo "$pilihan_d"; ?><?php echo "$gambar_d"; ?></p>
                        </div>
                    </label>
                    <br>
                    <label id="opsi<?php echo $rr['opsi'];?>" class="custom-radio-button">
                    <div class="col-xs-12" id="opsi<?php echo $statussoal;?>">
                                <input type="radio" name='<?php echo "$simpanjawab"; ?><?php echo "$ar[nomersoal]"; ?>' id='jawabansiswaE<?php echo "$i"; ?>' value="E"<?php echo ($ar['jawabansiswa'][$ar['nomersoal']-1]=='E')?'checked="checked"':'' ?>/> 
                                    <span class="helping-el"></span>
                                <span class="label-text">e</span>
                                <p id="cho"><?php echo "$pilihan_e"; ?><?php echo "$gambar_e"; ?></p>
                        </div>
                    </label>
                    <br><br>
                   <label id="ragu" class="btn btn-warning"><input type="checkbox" id="test<?php echo $i; ?>" value="supress">
                    <span class='hidden-lg hidden-md'><b>RAGU</b></span>  
                    <span class='hidden-sm hidden-xs'><b>&emsp;&emsp;&emsp;&emsp;RAGU - RAGU&emsp;&emsp;&emsp;&emsp;</b></span>  
                    </label>
					</span>


</div>
<?php
						}}}?>