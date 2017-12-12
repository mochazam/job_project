<!DOCTYPE html>
<html lang="en" class="js no-touchevents" style="">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noodp,nodir,noydir">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">

    <title>E-visit</title>
   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/evisit/base.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/evisit/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sweetalert/sweetalert.css'); ?>">
    
    <style type="text/css">
    	.svg-icon {
		    width: 48px;
		    height: 53px;
		    display: inline-block;
		    position: relative;
		    -webkit-filter: drop-shadow(2px 1px 2px rgba(0,0,0,0.4));
			filter: drop-shadow(2px 1px 2px rgba(0,0,0,0.4));
			-webkit-filter: contrast(5);
			filter: contrast(5);
    	}
    	.category-icon img{
    		color: green;
    		fill: currentColor;
    	}
    </style>
    <style type="text/css">
    .gm-style .gm-style-cc span,
    .gm-style .gm-style-cc a,
    .gm-style .gm-style-mtc div {
        font-size: 10px
    }
    .gm-style .gm-style-mtc label,
    .gm-style .gm-style-mtc div {
        font-weight: 400
    }
    @media print {
        .gm-style .gmnoprint,
        .gmnoprint {
            display: none
        }
    }

    @media screen {
        .gm-style .gmnoscreen,
        .gmnoscreen {
            display: none
        }
    }
    .gm-style-pbc {
        transition: opacity ease-in-out;
        background-color: rgba(0, 0, 0, 0.45);
        text-align: center
    }

    .gm-style-pbt {
        font-size: 22px;
        color: white;
        font-family: Roboto, Arial, sans-serif;
        position: relative;
        margin: 0;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%)
    }
    #map-canvas {
        margin: 0;
        padding: 0;
        height: 100%;
    }

    #map-canvas {
        width: 100%;
        height: 270px;
    }
    .gm-style {
        font: 400 11px Roboto, Arial, sans-serif;
        text-decoration: none;
    }

    .gm-style img {
        max-width: none;
    }
    .modal {
        margin-top: 80px;
    }
    .modal-body {
        min-height: 250px !important;
    }
    h3.modal-title {
        text-align: center;
        margin: 0 auto;
        display: block;
        font-weight: bolder;
    }
    </style> 

</head>

<body>
    
    <div class="off-canvas-wrap" ui-off-canvas="">
        <div class="inner-wrap">

    <!-- header menu -->
            <header role="banner" class="header-navbar  __mod-2 ">
                <div class="container">
                	<!-- LOGO -->
                    <a href="#" class="logo">
				        <img src="<?php echo base_url();?>assets/evisit/maps_logo_google.png" alt="" width="106" data-preload="" style="width: 130px;">
				    </a>
				    <!-- END LOGO -->
				    
                    <a class="right-off-canvas-toggle menu-icon pull-right" aria-expanded="false" ui-off-canvas-toggle2=""><span></span></a>
                </div>
                <!-- END NAVBAR DESKTOP -->
                <!-- NAVBAR MOBILE -->
                <div class="hidden-md hidden-lg mobile-navbar">
                    <aside class="right-off-canvas-menu">
                        <header>
                            <a class="btn btn-primary" href="<?php echo base_url();?>login/logout">
					            LOGOUT
					        </a>
                            <div class="close pull-right">
                                <a class="exit-off-canvas" ui-off-canvas-hide="">×</a>
                            </div>
                        </header>
                        <nav role="navigation">
                            <ul class="list-unstyled font-gotham-medium">
                                <li><a href="<?php echo base_url();?>index">HOME EMATCH</a></li>
                                <li><a href="#">DOCUMENTATION</a></li>
                                
                            </ul>
                        </nav>
                       
                    </aside>
                </div>
                <!-- END NAVBAR MOBILE -->
            </header>

            <header role="banner" class="header-navbar hidden-xs hidden-sm  __mod-sticky  __sticky-header __active" ux-sticky-header-pivot=".btn-block-xs.btn-primary" ux-sticky-header="">
                <div class="container">
                	<!-- LOGO -->
                    <a href="#" class="logo">
			        	<img src="<?php echo base_url();?>assets/evisit/maps_logo_google.png" alt="Upwork" width="106" data-preload="" style="width: 160px;">
			      	</a>
			      	<!-- END LOGO -->
			      	<!-- NAVBAR DESKTOP -->
                    <div class="visible-md visible-lg desktop-navbar">
                        <nav class="nav font-gotham-medium">
                            <ul class="site-links list-inline pull-left">
                                <li><a href="<?php echo base_url();?>index" class="text-uppercase">HOME EMATCH</a></li>
                                <li><a href="#" class="text-uppercase">DOCUMENTATION</a></li>
                                
                            </ul>
                            <ul class="user-links list-inline pull-right">
                                <li>
                                	<a href="<?php echo base_url();?>login/logout" class="btn btn-primary header-cta-feh">Logout
          							</a>
          						</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="visible-md visible-lg desktop-navbar">
                        <nav class="nav font-gotham-medium">
                            
                        </nav>
                    </div>
                </div>
            </header>

<!-- end header menu -->

            <main role="main">

                <?php $this->load->view($content);?>

            </main> 

        </div>
    </div>
    


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>
    <script>
    	$('.right-off-canvas-toggle').on('click', function() {
    		$('.off-canvas-wrap').toggleClass('move-left');
    	});
		$('.exit-off-canvas').on('click', function() {
    		$('.off-canvas-wrap').toggleClass('move-left');
    	});
    </script>

    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>

<script type="text/javascript">
	$("#dept").change(function(){
		$("#imgLoad").html("<img src='<?php echo base_url();?>assets/img/loader-1.gif'>");
    	var dept_id = {dept_id:$("#dept").val()};
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Evisit/visit/get_name');?>",
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
			url: "<?php echo base_url('Evisit/visit/getRouteMap');?>",
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

<script>
$("#tombol").click(function() {
	if ( $("#info").is(":hidden")) {
	    $("#info" ).slideDown("slow");
	    $("#info").addClass('kasat')
	} else {
	    $( "#info" ).hide();
	}
  	// $( "#info" ).slideDown( "slow", function() {
   //  	// Animation complete.
  	// });
});
</script>

<script>
var save_method; //for save method string
var table;

function edit_book(id) {
    save_method = 'update';
    // $('#form')[0].reset(); // reset form on modals
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Evisit/Visit/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="note"]').val(data.note);
 
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function save() {
    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('Evisit/Visit/visits_update')?>",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
           //if success close modal and reload ajax table
           $('#modal_form').modal('hide');
          // location.reload();// for reload a page
            // alert('data berhasil di update');
            swal(
                'Success!', 
                'data berhasil di update!',
                'success'
            );
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            // alert('Error adding / update data');
            swal(
              'Oops...',
              'Something went wrong!',
              'error'
            )
        }
    });
}    
</script>

    <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/evisit/js"></script> -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRLyfpZFV4Un7iP3AaT45e2cIanre21Hs&callback=initialize"></script>
    <script type="text/javascript">
    var element = $(this);
    var map;

    function initialize(myCenter) {
        var marker = new google.maps.Marker({
            position: myCenter,
            // title: 'Uluru (Ayers Rock)'
        });

        var mapProp = {
            center: myCenter,
            zoom: 17,
            //draggable: false,
            //scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("map-canvas"), mapProp);
        marker.setMap(map);
    };


    $('#myMapModal').on('shown.bs.modal', function(e) {
        var element = $(e.relatedTarget);
        var data = element.data("lat").split(',')
        initialize(new google.maps.LatLng(data[0], data[1]));
        google.maps.event.trigger(map, 'resize');
    });
    </script>
<script type="text/javascript" src="<?php echo base_url();?>assets/evisit/jquery.easeScroll.js"></script>
<script>
    $("html").easeScroll();
</script>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Beri Catatan</h3>
            </div>
            <div class="modal-body form" style="height: 200px;">
                <form action="#" id="form" class="">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">Catatan</label>
                                <textarea name="note" class="form-control" style="height: 160px"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->



</body>
</html>