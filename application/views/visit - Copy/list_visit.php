<!DOCTYPE html>
<html>
<head>
	<title>List Visit</title>
	<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">


<style type="text/css">
@media screen and (max-width: 979px) and (min-width: 768px) {
	.hidden-desktop {
		display: none!important;
	}

	.visible-desktop {
		display: inherit!important;
	}
}


@media screen and (max-width: 767px) {	
	.hidden-phone {
		display: inherit!important;
	}

	.visible-phone {
		display:none!important;
	}
}

@media screen and (max-width: 480px) {
	.hidden-phone {
		display: none!important;
	}

	.visible-phone {
		display:inherit!important;
	}
}

.btn-besar {
	padding:11px 19px;
	font-size:18px;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius:6px;
}

#table2 td span {
	border-bottom: 1px solid #ccc;
}	
	</style>


</head>
<body>

<?php $this->load->view('visit/nav_visit'); ?>

<div class="container">
	<div class="row">

		<!-- <section class="content">
			<h1>Table Filter</h1>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-success btn-filter" data-target="pagado">Pagado</button>
								<button type="button" class="btn btn-warning btn-filter" data-target="pendiente">Pendiente</button>
								<button type="button" class="btn btn-danger btn-filter" data-target="cancelado">Cancelado</button>
								<button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>
							</div>
						</div>
						<div class="table-container">
							<table class="table table-filter">
								<tbody>
									<tr data-status="pagado">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox1">
												<label for="checkbox1"></label>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														Lorem Impsum
														<span class="pull-right pagado">(Pagado)</span>
													</h4>
													<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
												</div>
											</div>
										</td>
									</tr>
									<tr data-status="pendiente">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox3">
												<label for="checkbox3"></label>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														Lorem Impsum
														<span class="pull-right pendiente">(Pendiente)</span>
													</h4>
													<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
												</div>
											</div>
										</td>
									</tr>
									<tr data-status="cancelado">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox2">
												<label for="checkbox2"></label>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														Lorem Impsum
														<span class="pull-right cancelado">(Cancelado)</span>
													</h4>
													<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
												</div>
											</div>
										</td>
									</tr>
									<tr data-status="pagado" class="selected">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox4" checked>
												<label for="checkbox4"></label>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star star-checked">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														Lorem Impsum
														<span class="pull-right pagado">(Pagado)</span>
													</h4>
													<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
												</div>
											</div>
										</td>
									</tr>
									<tr data-status="pendiente">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox5">
												<label for="checkbox5"></label>
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														Lorem Impsum
														<span class="pull-right pendiente">(Pendiente)</span>
													</h4>
													<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="content-footer">
					<p>
						Page © - 2016 <br>
						Powered By <a href="https://www.facebook.com/tavo.qiqe.lucero" target="_blank">TavoQiqe</a>
					</p>
				</div>
			</div>
		</section> -->

		

		<div id="identitas" class="row">
			<div class="form-horizontal">
				<div class="form-group">
					<label for="username" class="col-sm-3 control-label" style="">Visitor :</label>
					<div class="col-sm-4">
						<label for="" class="control-label"><?php echo $this->session->userdata('nama_karyawan');?></label>
					</div>
				</div>
				<div class="form-group">
					<label for="jabatan" class="col-sm-3 control-label">Jabatan :</label>
					<div class="col-sm-4">
						<label for="" class="control-label"><?php echo $this->session->userdata('jabatannya');?></label>
					</div>
				</div>
				<div class="form-group">
					<label for="departement" class="col-sm-3 control-label">Departemen :</label>
					<div class="col-sm-5">
						<label for="" class="control-label" style="text-align: left;"><?php echo seperate($dept); ?></label>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive col-lg-12">
                                <table class="table table-striped table-bordered table-hover hidden-phone" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th colspan="2">Lokasi</th>
                                            <th>Perusahaan</th>
                                            <th>Keterangan</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
											//untuk menampilkan data dari table, diambil dari variable table yg ada di controller hubungi
											$no=1;
											foreach($visit->result_array() as $row){
										?>
	                                        <tr class="">
	                                            <td><?php echo $no++;?></td>
	                                            <td><?php echo date('d-m-Y', strtotime($row['visited_at']));?></td>
	                                            <td><?php echo date('H:i:s', strtotime($row['visited_at']));?></td>
	                                            <td class="center"><?php echo $row['lokasi'];?></td>
	                                            <!-- <td>
	                                            	<a href="#" class="btn btn-danger" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_map/any');">View</a>
	                                            </td> -->
	                                            <td>
	                                            	<a href="<?php echo base_url();?>visit/show_map/<?php echo $row['lat'].'/'.$row['long'];?>" class="btn btn-danger" target="_blank">View</a>
	                                            </td>
	                                            <td><?php echo $row['company'];?></td>
	                                            <td><?php echo $row['keterangan'];?></td>
	                                            <td><?php echo $row['note'];?></td>
	                                        </tr>
	                                        <?php } ?>
                                    </tbody>
                                </table>

                                
                            </div>
                           
                        </div>
                        <!-- /.panel-body -->

                        <div class="well">
                        	<table class="table table-striped visible-phone" id="table2">
                                	<tr>
							          	<th>#</th>
							          	<th>Info</th>
							          	<th>Gmap</th>
							        </tr>
							        <?php
										$no=1;
										foreach($visit->result_array() as $row){
									?>
							        <tr>
							        	<td class="nomor"><?php echo $no++;?></td>
							        	<td>
							        		<span class="time">
							        			<?php echo date('d-m-Y', strtotime($row['visited_at']));?> <?php echo date('H:i:s', strtotime($row['visited_at']));?>
							        		</span><br/>
							        		<span class="alamat"><?php echo $row['lokasi'];?></span><br/>
							        		<span class="vendor"><?php echo $row['company'];?></span><br/>
							        		<span class="keterangan"><?php echo $row['keterangan'];?></span><br/>
							        		<span class="catatan"><?php echo $row['note'];?></span>
							        	</td>
							        	<td>
							        		<a href="<?php echo base_url();?>visit/show_map/<?php echo $row['lat'].'/'.$row['long'];?>" class="btn btn-danger btn-besar" target="_blank">View</a>
							        	</td>
							        </tr>
							        <?php } ?>
                                </table>
                        </div>

                    </div>
                    <!-- /.panel -->

		
	</div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
 -->
 <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>

<script type="text/javascript">
    function showAjaxModal(url)
    {
        // SHOWING AJAX loader-1 IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url();?>assets/img/loader-1.gif" /></div>');
        
        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
        
        //alert(url);
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {	
                jQuery('#modal_ajax .modal-body').html(response);
            },
            error: function() {
            	console.log('error ndak tau');
            }
        });
    }
</script>
<!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog" style="width: 50%;">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Any</h4>
                </div>
                
                <div class="modal-body" style="height:400px; overflow:auto;">
                
                    
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

 <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>
<script type="text/javascript">
$(document).ready(function () {

	$('.star').on('click', function () {
      $(this).toggleClass('star-checked');
    });

    $('.ckbox label').on('click', function () {
      $(this).parents('tr').toggleClass('selected');
    });

    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });

 });
</script>

</body>
</html>