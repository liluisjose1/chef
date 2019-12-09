<?php include_once("./template/_header.php");?>
<!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Ventas diarias <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <?php  
                    $sql = "SELECT SUM(total) total FROM ventas WHERE fecha BETWEEN CONCAT(CURRENT_DATE(),' ','00:00:00') AND CONCAT(CURRENT_DATE(),' ','11:59:59')";
										$ejecutar = $conexion->query($sql);
										$dt = $ejecutar->fetch_row();
                     
                     echo "<h2 class='mb-5'>$ $dt[0]</h2>";
                     ?>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Egresos Diarios<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <?php  
                    $sql = "SELECT SUM(total) total FROM resumen_compra WHERE fecha BETWEEN CONCAT(CURRENT_DATE(),' ','00:00:00') AND CONCAT(CURRENT_DATE(),' ','23:59:59')";
										$ejecutar = $conexion->query($sql);
										$dt = $ejecutar->fetch_row();
                     
                     echo "<h2 class='mb-5'>$ $dt[0]</h2>";
                     ?>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Recetas Creadas <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <?php  
                    $sql = "SELECT SUM(id) total FROM recetas";
										$ejecutar = $conexion->query($sql);
										$dt = $ejecutar->fetch_row();
                     
                     echo "<h2 class='mb-5'>$dt[0]</h2>";
                     ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Actualmente en atencion</h4>
                    <div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>Mesa</th>
											<th>Cliente</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT c.mesa,c.cliente FROM `cuentas` c,mesas m WHERE c.mesa=m.id AND m.estado=1 AND c.fecha=CURRENT_DATE() GROUP BY c.cliente";
										$ejecutar = $conexion->query($sql);
										while ($reg = $ejecutar->fetch_assoc()) {
											echo "<tr>";
											echo "<th scope='row'>" . ($reg["mesa"])  . "</th>";
											echo "<td>" . ($reg["cliente"]) . "</td>";
                                            ?>
                                        </tr>
										<?php  }
										?>
									</tbody>
								</table>
							</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Proveedores</h4>
                    <div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>Nombre</th>
											<th>Tel1</th>
											<th>Correo</th>
											<th>Dirección</th>
											<th>Crédito</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM proveedores";
										$ejecutar = $conexion->query($sql);
										while ($reg = $ejecutar->fetch_assoc()) {
											echo "<tr>";
											echo "<th scope='row'>" . ($reg["id"])  . "</th>";
											echo "<td>" . ($reg["nombre"]) . "</td>";
											echo "<td>" . ($reg["tel1"]) . "</td>";
											echo "<td><a href='mailto:$reg[email]'>" . ($reg["email"]) . "</a></td>";
											echo "<td>" . ($reg["direccion"]) . "</td>";
											echo "<td>$ " . ($reg["credito"]) . "</td>";
                      ?>
                      </tr>
										<?php  }
										?>
									</tbody>
								</table>
							</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php  include_once("./template/_footer.php") ?>