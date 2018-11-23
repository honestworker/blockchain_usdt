<?php
header ("Content-Type:text/css");
$color = "#2ECC71"; 

function checkhexcolor($color) {
	return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
	$color = "#".$_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
	$color = "#2ECC71";
}

?>

h1, h2, h3, h4, h5, h6{color: <?php echo $color;?>;}
th{color: <?php echo $color;?>;}
.card{border: 1px solid <?php echo $color;?>;}
a{color: <?php echo $color;?>;}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th{border: 1px solid <?php echo $color;?>;}
.table>tbody>tr>td{border: 1px solid <?php echo $color;?>;}
.card-primary, .card-success, .card-warning, .card-info, .card-default{ border-color: <?php echo $color;?>; } 
.card-success>.card-heading, .card-info>.card-heading, .card-primary>.card-heading, .card-warning>.card-heading{
  background: <?php echo $color;?>;
  color: #F4F4F6;
  border-color: <?php echo $color;?>;
}
.btn-primary, .btn-success, .btn-info, .btn-warning{border-color: <?php echo $color;?>;  background: <?php echo $color;?>; color:#fff;}
.btn-success:hover, .btn-primary:hover, .btn-info:hover, .btn-warning:hover{background: <?php echo $color;?>;border-color: <?php echo $color;?>;}
.btn-primary.focus, .btn-primary:focus, .btn-success.focus, .btn-success:focus, .btn-info.focus, .btn-info:focus, .btn-warning.focus, .btn-warning:focus{background: <?php echo $color;?>; color:#ddd;}

hr{border-top: 1px solid <?php echo $color;?>;}
.pagination>.active>a, .pagination>.active>a:focus, 
.pagination>.active>a:hover, .pagination>.active>span, 
.pagination>.active>span:focus, 
.pagination>.active>span:hover{background-color:<?php echo $color;?>;}
.navbar {
    border-bottom: 2px solid<?php echo $color;?>;
}
.modal-title{color:<?php echo $color;?> !important;}
.input-group-text{color:<?php echo $color;?>}

