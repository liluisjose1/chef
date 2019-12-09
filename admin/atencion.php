<?php include_once("./template/_header.php");?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12">
        <?php
						error_reporting(E_ALL ^ E_NOTICE);
						if ($_GET["error"] == "si") {
							echo "<div class='alert alert-primary alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Pedido relizado con exito";
							echo "</div>";
						} else if ($_GET["error"] == "no") {
							echo "<div class='alert alert-danger alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Error realizar el pedido por falta de insumos";
							echo "</div>";
						} 
						?>
        </div>
            
        <?php
			$cos = "SELECT id,tipo FROM mesas WHERE estado=0";
			$ejecutarcos = $conexion->query($cos);
            while ($reg2 = $ejecutarcos->fetch_assoc()) {?>
                <div class="col-md-2" style="padding-top:10px !important;">
                    <div class="card card-default">
                        <div class="card-header text-center header-sm" style="padding:0.25rem 0.25rem !important;">
                            <div class="d-flex align-items-center">
                                <div class="wrapper d-flex align-items-center">
                                    <h2 class="card-title ml-3">Mesa <?php echo $retVal = ($reg2["tipo"]==1) ? "Normal" : "VIP" ; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding:0.0 !important;">
                            <div class="text-center">
                            <a style="text-decoration:none;" href="./atencion_detalle.php?m=<?php echo $reg2["id"]; ?>">
                                <h1><?php echo $reg2["id"]; ?></h1>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php } ?>
        </div>
    </div>
<?php  include_once("./template/_footer.php") ?>