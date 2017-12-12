<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>History Visitor</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>

    <?php echo isset($map['js']) ? $map['js'] : '';?>
  </head>
  <body>

  	<?php $this->load->view('visit/nav_visit'); ?>
    
  <div class="container">
    <div id="wrapper">

        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        	<?php echo form_open(base_url() . 'visit/history' , array('class' => 'form-horizontal form-groups-bordered validate'));?>

	  		            	<div class="form-horizontal">
	  		            		<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Departement</label>
			                        
									<div class="col-sm-4">
										<select class="form-control" name="kd_dept" id="dept">
											<option>-- PILIH DEPARTEMENT --</option>

											<?php 
											foreach($list_dept->result_array() as $dept ): ?>
												<option value="<?php echo $dept['id_dept'];?>"><?php echo $dept['nama_dept'];?> </option>		
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Nama</label>
			                        
									<div class="col-sm-4">
										<select class="form-control" name="nama_karyawan" id="name">
											<option>-- PILIH NAMA --</option>

										</select>
									</div>
									<div id="imgLoad"></div>
								</div>

								<div class="form-group">
                            		<label for="id-date-picker-1" class="col-sm-3 control-label">From</label>
									<div class="col-sm-2">
										<input class="form-control datepicker" id="start" name="mulai" type="text" data-date-format="yyyy-mm-dd" />
										<span class="add-on">
											<i class="icon-calendar"></i>
										</span>
									</div>

									<label for="id-date-picker-1" class="col-sm-1 control-label">To</label>
									<div class="col-sm-2">
										<input class="form-control datepicker" id="akhir" name="selesai" type="text" data-date-format="yyyy-mm-dd" />
										<span class="add-on">
											<i class="icon-calendar"></i>
										</span>
									</div>
								</div>	

								<div class="form-group">
        		                        <div class="col-sm-offset-3 col-sm-5">
        		                            <input type="submit" id="tombol" class="btn btn-primary" name="submit" value="Tampil">
                                        </div>
        		                    </div>

		  		            	<?php echo form_close();?>

		  		            	<hr>
		  		            	<div>
		  		            		<div class="form-horizontal">
										<div class="form-group">
											<label for="username" class="col-sm-3 control-label" style="">Visitor :</label>
											<div class="col-sm-4">
												<label for="" class="control-label"><?php echo isset($visitor) ? $visitor : ''; ?></label>
												
											</div>
										</div>
										<div class="form-group">
											<label for="jabatan" class="col-sm-3 control-label">Jabatan :</label>
											<div class="col-sm-4">
												<label for="" class="control-label"><?php echo isset($jabatan) ? $jabatan : ''; ?></label>
												
											</div>
										</div>
										<div class="form-group">
											<label for="departement" class="col-sm-3 control-label">Departemen :</label>
											<div class="col-sm-4">
												<label for="" class="control-label"><?php echo isset($departemen) ? seperate($departemen) : ''; ?></label>
												
											</div>
										</div>
										<div class="form-group">
	        		                        <div class="col-sm-offset-3 col-sm-5">
	        		                        	<button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal">
												  View Map
												</button>
												<?php echo form_open('visit/getRouteMap', 'class="email" id="myform"'); ?>
													<input type="hidden" name="id" id="id" value="<?php echo isset($id_name) ? $id_name : ''; ?>">
													<input type="hidden" name="tgl_awal" id="tgl_awal" value="<?php echo isset($tgl_awal) ? $tgl_awal : ''; ?>">
													<input type="hidden" name="tgl_akhir" id="tgl_akhir" value="<?php echo isset($tgl_akhir) ? $tgl_akhir : ''; ?>">
		        		                            <button type="submit" class="btn btn-warning btn-lg" id="btnRoute2">Get Route Map</button>
		        		                        <?php echo form_close();?>    
	                                        </div>
	        		                    </div>
									</div>
		  		            	</div>

	  		            	</div>

  		              
  		              	<div class="table-responsive col-lg-12">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
				              	<tbody id="">

				              		<?php
										//untuk menampilkan data dari table, diambil dari variable table yg ada di controller hubungi
										$no=1;
										if (isset($history_visit)) {
											foreach($history_visit->result_array() as $row){
												echo "<tr data-id='$row[id]'>
									                    <td>";
									            echo        $no++;
									            echo 	"</td>
									                    <td>";
									            echo    	date('d-m-Y', strtotime($row['visited_at']));
									            echo 	"</td>
									                    <td>";
									            echo        date('H:i:s', strtotime($row['visited_at']));
									            echo 	"</td>
									                    <td>$row[lokasi]</td>
									                    <td>";
	                                            echo "<a href=\"".base_url()."/visit/show_map/".$row['lat']."/".$row['long']."\"
	                                            class='btn btn-danger' target='_blank'>View</a>";
	                                            echo "</td>
									                    <td>$row[company]</td>
									                    <td>$row[keterangan]</td>
									                    <td><span class='span-note caption' data-toggle='tooltip' data-placement='top' title='Click me to edit!' data-id='$row[id]'>$row[note]</span> <input type='text' class='field-note form-control editor' value='$row[note]' data-id='$row[id]' /></td>
							                		</tr>";
							                }
							            } else {    

							            	echo "<tr>
                                        			<td colspan='8'>No Data</td>
                                        		</tr>";	
                                        }		
									?>
                                       
				              	</tbody>
				            </table>
						</div>  
  		            
  		            </div>
  		        </div>
		    </div>
          
		    <div id="loadMap"></div>

		    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>
 -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <?php echo isset($map['html']) ? $map['html'] : ''; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


    	</div>
  </div>
    
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>

<script type="text/javascript">
	$("#dept").change(function(){
		$("#imgLoad").html("<img src='<?php echo base_url();?>assets/img/loader-1.gif'>");
    	var dept_id = {dept_id:$("#dept").val()};
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('visit/get_name');?>",
			data: dept_id, 
			success: function(resp){
        		//alert($("#negara").val());
        		$("#imgLoad").html("");
        		$('#name').html(resp);

			},
	      	error: function(){
	        	alert("Error");
	      	}
		});
	});	
</script> 

<script type="text/javascript">
	$('#btnRoute').click(function() {
		var data = {id:$('#name').val(), tgl_awal:$('#tgl_awal').val(), tgl_akhir:$('#tgl_akhir').val()};
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('visit/getRouteMap');?>",
			data: data,
			error: function() {
				alert('error');
			}
		});	
	});
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
 	$('.datepicker').datepicker({
        autoclose: 1,
    })
    
</script>

<script type="text/javascript">
    $(document).ready(function() {
    	var inputSubmit = $('input[type="submit"]#tombol'),
    		selectedDate = $('#tanggal').val();
    	
    	inputSubmit.attr('disabled', 'true');            
    	$('#akhir').focus(function() {
    		// inputSubmit.removeClass('disabled');
    		inputSubmit.removeAttr('disabled');
    	});

    	if ($('#akhir').val().length > 0) 
    	{
    		
    	};	            


    	// $('#name').change(function() {        
    	// 	// alert($('#tgl_akhir').val().length);		
     //    	alert($('#tgl_awal').val());
	    // 	alert($('#tgl_akhir').val());
     //    })
    });      	
</script>





  </body>
</html>

