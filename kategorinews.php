<?php include "header.php" ?>
<?php include "menu.php" ?>
<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<h1><?php 
				    $tags = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['tags']);
						$sql=mysqli_query($GLOBALS["___mysqli_ston"], "select * from v_kategori where katberita_seo='$tags'");
						while($s=mysqli_fetch_array($sql)){
						?>
						<?php echo $s['nama_kat'];?> 
						<?php } ?></h1>
							<ol class="breadcrumb bc-3" >
						<li>
				<a href="<?PHP echo MY_PATH?>"><i class="fa fa-home"></i>Home</a>
			</li>	
				<li class="active">
					<a href="news">News</a>
					</li>
					<li class="active">
							<strong><?php   
							$tags= mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['tags']);                     
						$sql=mysqli_query($GLOBALS["___mysqli_ston"], "select * from v_kategori where katberita_seo='$tags'");
						while($s=mysqli_fetch_array($sql)){
						?>
						<?php echo $s['nama_kat'];?> 
						<?php } ?></strong>
					</li>
					</ol>							
			</div>			
		</div>	
	</div>	
</section>
<section class="blog">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="blog-posts">
					<?php 
					error_reporting(0);
        include 'adminku/configurasi/paginationkat.php';
        	$id = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['tags']);       
            $reload = "".MY_PATH."news/kategori/".$id."/";
            $sql =  "SELECT * FROM v_berita WHERE  katberita_seo='$id'  ORDER BY id_berita DESC ";
            $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        
        $rpp = $pagnews; // jumlah record per halaman
        $page = intval($_GET["pag"]);
        if($page<=0) $page = 1;  
        $tcount = mysqli_num_rows($result);
        $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
        $count = 0;
        $i = ($page-1)*$rpp;
        $no_urut = ($page-1)*$rpp;
        ?>
                    <?php
              if ($tcount > 0) {
             while(($count<$rpp) && ($i<$tcount)) {
                        mysqli_data_seek($result, $i);
                        $data = mysqli_fetch_array($result);
                        $isi= substr($data['deskripsi'],0,400);
                        $tglpublish=tgl_indo($data['tgl_masuk']);
                          $link_article ="".MY_PATH."news/". strip_tags(htmlentities($data['nama_beritaseo'])).".html";

                    ?>
                     <div class="blog-post">
                    <div class="post-thumb">
							<?php 
						echo "<a href=\"".$link_article."\">";
								echo"<img src='".MY_PATH."adminku/foto_berita/small_$data[gambar]' class='img-rounded' />";
								?>
								<span class="hover-zoom"></span>
							</a>	
					</div>
						<div class="post-details">	
							<h3>
								<?php echo"<a href=\"".$link_article."\">";
							 ?>
							 <?php echo $data ['nama_berita']; ?> <?php echo"</a>"; ?>
							</h3>
							<div class="post-meta">	
								<div class="meta-info">
									<i class="entypo-calendar"></i> <?php echo $tglpublish ?> </div>
								<div class="meta-info">
									<i class="entypo-comment"></i>
									<?php echo $data ['komentar']; ?> Comments
								</div>
								<div class="meta-info">
									<i class="entypo-tag"></i>
									<?php echo $data ['nama_kat']; ?>
								</div>
								<div class="meta-info">
									<i class="entypo-user"></i>
									<?php echo $data ['pembuat']; ?>
								</div>
					       </div>
							<?php echo $isi ; ?>...
							 <?php echo"<p> <a href=\"".$link_article."\" class='btn btn-success'>Baca Selengkapnya</a></p>";
							 ?>
						</div>
						 </div>
                    <?php
					  $i++; 
                        $count++;
                     }
                }else{
    echo "<p align=center>Belum ada berita pada kategori ini.</p>";
                }
                    ?>           
 </p>
  <?php echo paginate_one($reload, $page, $tpages); ?> 
				</div>	
			</div>
			<div class="col-sm-4">
				<div class="right-side">
				<div class="right-side-konten">
					<form method="get" action="<?PHP echo MY_PATH?>search/" class="form-group has-feedback"> 

  <input name="keyword" class="form-control search-form" placeholder="Pencarian artikel..." type="text"><span class="fa fa-search form-control-feedback"></span>

</form>
				<h4><span>Follow Us</span>
				</h4>
				<a href="">
					<div class="sosial-button sosial-facebook"></div></a>
					<a href="">
						<div class="sosial-button sosial-twitter"></div></a>
						<a href="">
							<div class="sosial-button sosial-whatsapp"></div></a>
							<a href="">
								<div class="sosial-button sosial-google"></div></a>
							</div>
							<div class="right-side-konten">
								<h4><span>Artikel Populer</span></h4>
						<?php 
						$artikel=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id_berita,nama_berita,nama_kat,gambar,nama_beritaseo From v_berita ORDER BY id_berita DESC limit 5");
						while ($r=mysqli_fetch_array($artikel)) {
							 $link_article ="".MY_PATH."news/". strip_tags(htmlentities($r['nama_beritaseo'])).".html";

							echo"<div class='populer-artikel-right-box media'>
	<div class='img-box media-left'>
	<img src='".MY_PATH."adminku/foto_berita/small_$r[gambar]'/></div>
	<div class='media-body konten-body'>
	<h4><a href=\"".$link_article."\" class='name'><h5>$r[nama_berita]</h5></a></h4>
	</div></div>



	";
						}

								?>

							</div>

	<div class="right-side-konten">
		<h4><span>Tags</span></h4>
		<?php
			              $kategori=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM v_kategori");
            $no=1;
            while($k=mysqli_fetch_array($kategori)){
            	$link_tags ="".MY_PATH."news/kategori/".$k['katberita_seo']."";
                echo "<a href=$link_tags>
			<span class='label label-info label-tag'>$k[nama_kat]</span></a>";
              $no++;
            }
            ?>
		</div>
	</div>

 </div>				
			</div>			
				
		</div>
	</div>
</section>	
<?php include "footer.php" ?>