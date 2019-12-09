<?php
ob_start();
session_start();
if (!$_SESSION["autentificado"]) {
    header("Location: operations/salir.php");
}
include_once("config/conexion.php");

$sql = "SELECT * from settings";
$ejecutar = $conexion->query($sql);
$data = $ejecutar->fetch_row();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $data[1]; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/select2-bootstrap4.min.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo $data[6]; ?>" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="dashboard.php"><img src="assets/images/logo-2.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="<?php echo $data[6]; ?>" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo $_SESSION["nombre"]; ?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="./operations/salir.php">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Cerrar Sesión </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="<?php echo $data[6]; ?>" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $_SESSION["nombre"]; ?></span>
                  <span class="text-secondary text-small"><?php echo $_SESSION["usuario"]; ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item sidebar-actions" style="margin-top: 0rem !important;">
              <a  href="dashboard.php" class="btn btn-block btn-lg btn-gradient-primary mt-4">Dashboard</a>
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3"><b>Módulos</b></h6>
                </div>
              </span>
            </li>
            <?php if ($_SESSION["tipo"]==1) { ?>
            <li class="nav-item">
              <a class="nav-link" href="users.php">
                <span class="menu-title">Usuarios</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="clients.php">
                <span class="menu-title">Clientes</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if ($_SESSION["tipo"]==1 || $_SESSION["tipo"]==2 ) { ?>
            <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" href="#page-layouts-mesas" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Cocina</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-food-variant menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts-mesas" style="">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="./supplies.php">Insumos</a></li>
                  <li class="nav-item"> <a class="nav-link" href="./compras.php">Compras</a></li>
                  <li class="nav-item"> <a class="nav-link" href="./prescription.php">Recetas</a></li>
                </ul>
              </div>
            </li>
            <?php } ?>
            <?php if ($_SESSION["tipo"]==1 || $_SESSION["tipo"]==3 ) { ?>
            <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Restaurante</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-store menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts" style="">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="./mesas.php">Mesas</a></li>
                  <li class="nav-item"> <a class="nav-link" href="./atencion.php">Atender</a></li>
                </ul>
              </div>
            </li>
            <?php } ?>
            <?php if ($_SESSION["tipo"]==1 || $_SESSION["tipo"]==4 ) { ?>
            <li class="nav-item">
              <a class="nav-link" href="caja.php">
                <span class="menu-title">Caja</span>
                <i class="mdi mdi-monitor menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            
            <?php if ($_SESSION["tipo"]==1) { ?>
            <li class="nav-item">
              <a class="nav-link" href="providers.php">
                <span class="menu-title">Proveedores</span>
                <i class="mdi mdi-car menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if ($_SESSION["tipo"]==1 || $_SESSION["tipo"]==4 ) { ?>
              <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" href="#page-layouts-reservaciones" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Reservaciones</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-library menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts-reservaciones" style="">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="./reservaciones.php">Reservaciones local</a></li>
                  <li class="nav-item"> <a class="nav-link" href="./reservaciones_online.php">Reservaciones online</a></li>
                </ul>
              </div>
            </li>
            <?php } ?>
            <?php if ($_SESSION["tipo"]==1) { ?>
            <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" href="#page-layouts-reports" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Reportes</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-book-open menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts-reports" style="">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="./r_ingresos.php">Ingresos</a></li>
                  <li class="nav-item"> <a class="nav-link" href="./r_egresos.php">Egresos</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="settings.php">
                <span class="menu-title">Configuración</span>
                <i class="mdi mdi-settings menu-icon"></i>
              </a>
            </li>
            <?php } ?>

          </ul>
        </nav>