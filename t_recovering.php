
<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Recovering Product | Quality Control Aplication</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="Aplikasi Quality Control" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstrap-css -->
<!-- css -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style_qc.css" type="text/css" media="all" />
<!--// css -->
<!-- font-awesome icons -->
<link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons -->
<!-- font -->
<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>

<!-- //font -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->

<!-- lokasi -->
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<!-- lokasi end -->
</head>
<body >
	<!-- banner -->
	<div class="banner-1 jarallax">
		<div class="agileinfo-dot-1">
			<div class="w3ls-banner-info-bottom">
				<div class="container">
					<div class="banner-address">
						<div class="col-md-4 banner-address-left">
							<p><i class="fa fa-map-marker" aria-hidden="true"></i> Taman Street No.15
Sidoarjo - East Java, 61257</p>
						</div>
						<div class="col-md-3 banner-address-left">
							<p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:marketing@tritunggalmetalworks.com">marketing@tritunggalmetalworks.com</a></p>
						</div>
						<div class="col-md-3 banner-address-left">
							<p><i class="fa fa-phone" aria-hidden="true"></i> (62-31) 7870870</p>
						</div>
						<div class="col-md-2 agileinfo-social-grids">
							<ul>
								<li><a href="https://www.facebook.com/Tritunggal-Metalworks-153338715169247/" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://twitter.com/PT_KCT" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<li><a href="http://localhost/e-matchad/assets/img/menu-tri.png" target="_blank"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<div class="header">
				<div class="container">
					<div class="header-top-grids">
						<div class="agileits-logo">
							<h1><a href="index.html">Style Decor</a></h1>
						</div>
						<div class="top-nav">
							<nav class="navbar navbar-default">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
									<nav>
										<ul class="nav navbar-nav">
											<li><a href="index.html">Home</a></li>
											<li><a href="about.html">About</a></li>
											<li><a href="gallery.html">Gallery</a></li>
											<li><a href="#" class="dropdown-toggle hvr-bounce-to-bottom" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Codes<span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a class="hvr-bounce-to-bottom" href="icons.html">Icons</a></li>
													<li><a class="hvr-bounce-to-bottom" href="typography.html">Typography</a></li>          
												</ul>
											</li>	
											<li class="active"><a href="mail.html">Mail Us</a></li>
										</ul>
									</nav>
								</div>
								<!-- /.navbar-collapse -->
							</nav>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //banner -->
	<!-- contact -->
	<div class="contact">
		<div class="container">
			<h3 class="agileinfo_header">Recovering <span>Product</span></h3>
			<p class="agileits_dummy_para">Isilah data dengan lengkap dan benar.</p>
			<br><br>

			<div class="container">
				<!-- <form id="form_recovering" action="<?php echo base_url();?>recovering/create" method="POST"> -->

				<form  action="<?php echo base_url();?>recovering/create" method="POST">
					<div class="col-md-6 form-line">
			  			<div class="form-group">
			  				<label for="Tanggal">Tanggal :</label>
			  				<?php
			  				date_default_timezone_set('Asia/Jakarta');
			  				$inputsekarang = date("d-M-Y \P\u\k\u\l h:i:s A");?>
							<input type="text" style="text-align: center;" name="tgl" class="form-control" value="<?php echo $inputsekarang;?>" disabled>
					    	<!-- <input type="text" class="form-control" id="" placeholder=" Enter Name"> -->
				  		</div>
				  		
				  		<div class="form-group">
					    	<label for="Nama">Nama PIC :</label>
					    	<input type="text" style="text-align: center;" class="form-control" value="<?= $this->session->userdata('nama_karyawan') ?>" disabled>
					    	<input type="hidden" style="text-align: center;" name="id_karyawan" class="form-control" value="<?= $this->session->userdata('id_karyawan') ?>">
					  	</div>	
					  	<div class="form-group">
					    	<label for="perusahaan">Perusahaan :</label>
					    	<select class="form-control" id="perusahaan" name="perusahaan" required>
						      <option value="">-- Pilih Perusahaan --</option>
						      <option value="PT. Kreasi Cipta Tritunggal">PT. Kreasi Cipta Tritunggal (Tritunggal Metalworks)</option>
						      <option value="PT. Multi Artistikacithra Advertising">PT. Multi Artistikacithra Advertising (Match Advertising)</option>
						      <option value="PT. Wijaya Persada Indonesia">PT. Wijaya Persada Indonesia (Wiperindo)</option>
						    </select>
			  			</div>
			  			<div class="form-group">
			  				<label for="Vendor">Vendor :</label>
			  				<input class="form-control" type="text" name="vendor" placeholder="Nama Vendor" required>
			  			</div>
			  			<div class="form-group">
			  				<label for="Foto">Status Foto :</label>
			  				<select class="form-control" id="status_foto" name="status_foto" required>
						      <option value="">-- Pilih Status Foto --</option>
						      <option value="Siang">Siang</option>
						      <option value="Malam">Malam</option>
						    </select>
			  			</div>			  		
			  		</div>

			  		<!-- ambil latitude -->
			  		<script>
			  			showlocation();
		  				function showlocation() {
						   // One-shot position request.
						   navigator.geolocation.getCurrentPosition(callback);
						}

						function callback(position) {
						   document.getElementById('latitude').innerHTML = position.coords.latitude;
						   document.getElementById('longitude').innerHTML = position.coords.longitude;


						// mulai convert ke alamat ke ajax.php pada folder luar
						   setTimeout(function() {
			                  $.ajax({
			                    url: 'ajax.php',
			                    type: 'POST',
			                    data: {lat: position.coords.latitude, lng: position.coords.longitude},
			                    success: function(data){
			                      $('.resultgps').html(data);
			                      $('.resultgps2').val(data);
			                    },
			                    error: function(){
			                      alert('error!');
			                    }
			                  })
			              }
			              , 1000);
			            };
						

		  			</script>

		  			
		  			
			

					<!-- <div class="resultgps"></div> -->
					
					<!-- <script type="text/javascript">
					setInterval(function() {
						var lihat = $('#gpse').val();
						alert(lihat);
					},5000)
					</script> -->

					 

			  	<!-- <?php

					$lat = -7.2925927;
					$lng= 112.7330891; //longitude
					echo $lat;

				
					$address = getaddress($lat, $lng);
					// $address= getaddress($lat, $lng);
					if($address)
					{
					echo $address;
					}
					else
					{
					echo "Not found";
					}
				

				function getaddress($lat,$lng)
					{
						if(!null == $lat && !null == $lng){
						$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
						$json = @file_get_contents($url);
						$data=json_decode($json);
						$status = $data->status;
						if($status=="OK")
						return $data->results[0]->formatted_address;
						else
						return false;
						}
					}
					?> -->


			  		<div class="col-md-6">
			  			<div class="form-group">
			  				<input type="button" value="Refresh Location" onclick="showlocation()" />
			  				<br>
							Latitude: <span id="latitude"></span>,
							Longitude: <span id='longitude'></span>
							<br>
			  				<label class="form-check-label">Lokasi GPS <input type="radio" class="form-check-input" name="gps" checked="checked" value="gps"/></label> 

							<label class="form-check-label"> &nbsp Input Teks <input type="radio" class="form-check-input" name="gps" value="teks"/> </label>

							<input style="" class="form-control resultgps2" type="text" placeholder="Alamat gps" id="tampil" disabled> <!-- ini ditampilkan saja -->

							<input style="display: none" class="form-control resultgps2" type="text" id="gpse" name="alamat" placeholder="Alamat gps"> <!-- ini inputan -->

							<input style="display: none" class="form-control" type="text" id="tekse" name="alamatteks" placeholder="Alamat" >

							<input style="display: none; margin-top: 10px" class="form-control" type="text" id="kota" name="kota" placeholder="Kota" >

							<input style="display: none; margin-top: 10px" class="form-control" type="text" id="prov" name="prov" placeholder="Provinsi" >
							
							<!-- <input type="text" name="otherAnswer" id="otherAnswer"/> -->
			  			</div>

			  			<script>
			  				$("input[type='radio']").change(function(){
							   if($(this).val()=="teks")
							   {
							      document.getElementById("gpse").style.display = 'none';
							      document.getElementById("tampil").style.display = 'none';
							      // $('#gpse').val('');
							      document.getElementById("tekse").style.display = 'block';
							      document.getElementById("kota").style.display = 'block';
							      document.getElementById("prov").style.display = 'block';
							      document.getElementById("tekse").setAttribute("required", "");
							      document.getElementById("kota").setAttribute("required", "");
							      document.getElementById("prov").setAttribute("required", "");
							      document.getElementById("gpse").removeAttribute("required");

							     	
							      // $("#tekse").show();
							   }
							   else
							   {
							   		// document.getElementById("gpse").style.display = 'block';
							   		document.getElementById("tampil").style.display = 'block';
							   		document.getElementById("tekse").style.display = 'none';
							   		document.getElementById("kota").style.display = 'none';
							      	document.getElementById("prov").style.display = 'none';
							   		document.getElementById("tekse").removeAttribute("required");
							   		document.getElementById("kota").removeAttribute("required");
							   		document.getElementById("prov").removeAttribute("required");
							   		// document.getElementById("gpse").setAttribute("required", "");
							   		
							       // $("#gpse").show();
							       // $("#tekse").hide(); 
							   }

							});
			  			</script>

			  			
			  			<!-- select2 -->
						<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
						<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

						<script>
						  $(document).ready(function() { 
						   $("select.select").select2(); 
						  });
						</script>

						<div class="form-group">
					    	<label for="perusahaan">Jenis Reklame :</label>
							<section>
								<select class="select form-control" id="reklame" name="reklame" required>

								   <option value="">-- Pilih Jenis Reklame --</option>
								   <optgroup label="Outdoor :">
								    <option value="Billboards">Billboards</option>
								    <option value="Baliho">Baliho</option>
								    <option value="Neon Box">Neon Box</option>
								    <option value="Midi Board">Midi Board</option>
								    <option value="Pedestrian Bridge (JPO)">Pedestrian Bridge (JPO)</option>
								    <option value="Videotron">Videotron</option>
								    <option value="Road Sign">Road Sign</option>
								    <option value="Tower Sign">Tower Sign</option>
								    <option value="Bando Jalan">Bando Jalan</option>
								    <option value="Letter Sign">Letter Sign</option>
								   </optgroup>

								   <optgroup label="Indoor :">
								   <option value="Letter Sign (Back Light)">Letter Sign (Back Light)</option>
								    <option value="Letter Sign (Non Light)">Letter Sign (Non Light)</option>
								    <option value="Running Text (Tulisan)">Running Text (Tulisan)</option>
								    <option value="Moving Sign-LED (Gambar)">Moving Sign-LED (Gambar)</option>
								   </optgroup>
								   
								</select>
							</section>
						</div>



			  			<div class="form-group">
			  				<label for ="description">Keterangan :</label>
			  			 	<textarea rows="5"  class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
			  			</div>

			  			<button type="submit" class="btn btn-primary col-md-12"><i class="glyphicon glyphicon-floppy-save" style="color: white"></i>  Simpan</button>


					</div>
				</form>
			</div>
		

			<!-- <div class="contact-form">
				<div class="contact-form-right">
					<div class="contact-form-grid">
						<form action="#" method="post">
							<div class="fields-grid">
								<div class="styled-input agile-styled-input-top">
									<input type="text" name="Full Name" required="">
									<label>Full Name</label>
									<span></span>
								</div>
								<div class="styled-input agile-styled-input-top">
									<input type="text" name="Phone" required=""> 
									<label>Phone</label>
									<span></span>
								</div>
								<div class="styled-input">
									<input type="email" name="Email" required=""> 
									<label>Email</label>
									<span></span>
								</div> 
								<div class="styled-input">
									<input type="text" name="Subject" required="">
									<label>Subject</label>
									<span></span>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="styled-input textarea-grid">
								<textarea name="Message" required=""></textarea>
								<label>Message</label>
								<span></span>
							</div>	 
							<input type="submit" value="SEND">
						</form>
					</div>
				</div>
			</div> -->
			<!-- <div class="w3ls-map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13251.376806128725!2d151.2012371852675!3d-33.86790584050207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12ae401e8b983f%3A0x5017d681632ccc0!2sSydney+NSW+2000%2C+Australia!5e0!3m2!1sen!2sin!4v1484736826477" allowfullscreen></iframe>
			</div> -->
		</div>
	</div>
	<!-- //contact -->
<!-- footer -->
<div class="footer">
		<div class="container">
			<h2 class="agileinfo_header">Subscribe to  <span>Newsletter</span></h2>
				<p class="agileits_dummy_para">vitae scelerisque condimentum, 
						risus orci lobortis nibh, at gravida .</p>
				<div class="news-w3l">
					<form action="#" method="post">
						<input type="email" name="Email" placeholder="Enter Your Email..." required="">
						<input type="submit" value="Send">
					</form>
				</div>
			<div class="agile_footer_copy">
				<div class="w3agile_footer_grids">
					<div class="col-md-4 w3agile_footer_grid">
						<h3>About Us</h3>
						<p>Duis aute irure dolor in reprehenderit in voluptate velit esse.<span>Excepteur sint occaecat cupidatat 
							non proident, sunt in culpa qui officia deserunt mollit.</span></p>
					</div>
					<div class="col-md-4 w3agile_footer_grid">
						<h3>Contact Info</h3>
						<ul>
							<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>1234k Avenue, 4th block, <span>New York City.</span></li>
							<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@example.com</a></li>
							<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 567</li>
						</ul>
					</div>
					<div class="col-md-4 w3agile_footer_grid w3agile_footer_grid1">
						<h3>Navigation</h3>
						<ul>
							<li><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><a href="about.html">About</a></li>
							<li><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><a href="gallery.html">Gallery</a></li>
							<li><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><a href="icons.html">Web Icons</a></li>
							<li><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><a href="mail.html">Mail Us</a></li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="w3_agileits_copy_right_social">
				<div class="col-md-6 agileits_w3layouts_copy_right">
					<p>© 2017 Style Decor. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
				</div>
				<div class="col-md-6 w3_agile_copy_right">
					<ul class="agileinfo_social_icons">
						<li><a href="#" class="w3_agileits_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="wthree_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agileinfo_google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agileits_pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //footer -->
	<!-- jarallax -->
	<script src="<?php echo base_url(); ?>assets/js/jarallax.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/SmoothScroll.min.js"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
	<!-- //jarallax -->

	
</body>	

	

</html>