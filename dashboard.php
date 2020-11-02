<!DOCTYPE html>
<html lang="en">
  
<?php
	include 'connect.php';
	include 'jsonnode.php';
	include 'jsonline.php';
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Leaflet Plugins-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <title>SNIPER - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <link rel="shortcut icon" href="img/tsel-icon.png"/>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion static-top" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand py-0 d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-crosshairs"></i>
        </div>
        <div class="sidebar-brand-text mx-2">SNIPER<sup>2.0</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pathfinder
      </div>

      <!-- Nav Item - Map Info Non Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="sniper.php">
          <i class="fas fa-fw fa-binoculars"></i>
          <span>Map Viewer</span>
        </a>
      </li>

      <!-- Nav Item - Link Route Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="utilities-color.html" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-route"></i>
          <span>Link Route</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">By NE:</h6>
            <a class="collapse-item" href="link2g.php">2G</a>
            <a class="collapse-item" href="#">3G - Under Dev</a>
            <a class="collapse-item" href="#">4G - Under Dev</a>
          </div>
        </div>
      </li>

       <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Transport Database - Under Dev
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Data Potensi</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Radio:</h6>
            <a class="collapse-item" href="#">PDH MW</a>
            <a class="collapse-item" href="#">SDH MW</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Fiber Optics:</h6>
            <a class="collapse-item" href="#">Metro-E</a>
            <a class="collapse-item" href="#">SDH/STM Optics</a>
            <a class="collapse-item" href="#">PTN</a>
            <a class="collapse-item" href="#">OTN</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
      <div class="sidebar-heading">
        Capacity Monitoring
      </div>

      <!-- Nav Item - Map Info Non Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="sniffer.php">
          <i class="fas fa-fw fas fa-dog"></i>
          <span>Traffic Sniffer</span>
        </a>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand p-0 navbar-light b topbar mb-1 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Dashboard Header -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="text-gray-900 mt-4 ml-4">TRANSPORT DASHBOARD</h1>
          </div>                     
           
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Bar Chart IPMW Population -->
            <div class="row">
              <div class="col-xl-7 col-lg-7">
                <div class="card shadow mb-4 border-left-danger">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-danger">IPMW Overview</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Show By:</div>
                        <a class="dropdown-item" href="#">Owner</a>
                        <a class="dropdown-item" href="#">Type</a>
                        <a class="dropdown-item" href="#">Frequencies</a>
                      </div>
                    </div>
                  </div>
                <!--  Card Body -->
                  <div class="card-body">
                    <div id="chart-container">
                      <iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                      <canvas id="graphCanvas" width="668" height="320" style="display: block; width: 1000px; height: 320px;"></canvas>
                    </div>
                    <script>
                      $(document).ready(function () {
                          showGraph();
                        });

                      function showGraph()
                      {
                          {
                              $.post("splitipmw.php",
                              function (data)
                              {
                                  console.log(data);
                                  var rtp = [];
                                  var tsel = [];
                                  var telkom = [];

                                  for (var i in data) {
                                      rtp.push(data[i].rtp);
                                      tsel.push(data[i].tsel);
                                      telkom.push(data[i].telkom);

                                  }

                                  var chartdata = {
                                      labels: rtp,
                                      datasets: [
                                          {
                                              label: 'IPMW TSEL',
                                              backgroundColor: '#E66A4E',
                                              hoverBackgroundColor: '#E66A4E',
                                              hoverBorderColor: '#66666',
                                              data: tsel
                                          },{
                                              label: 'IPMW TELKOM',
                                              backgroundColor: '#65A7C5',
                                              hoverBackgroundColor: '#65A7C5',
                                              hoverBorderColor: '#66666',
                                              data: telkom
                                          }
                                      ]
                                  };

                                  var graphTarget = $("#graphCanvas");

                                  var barGraph = new Chart(graphTarget, {
                                      type: 'bar',
                                      data: chartdata,
                                      options: {
                                        scales: {
                                          xAxes:[{
                                            ticks:{
                                              fontSize: 11,
                                              autoSkip: false,
                                              fontColor: 'black'
                                            },
                                            gridLines:{
                                              display: false,
                                            },
                                            stacked : true
                                          }],
                                          yAxes:[{
                                            ticks:{
                                              fontColor: 'black',
                                              suggestedMin: 0
                                            },
                                            gridLines:{
                                              borderDash: [5, 2],
                                            },
                                            stacked : true
                                          }]
                                        }
                                      }
                                  });
                              });
                          }
                      }
                    </script>
                  </div>
                </div>
              </div>
            </div>              
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; RAN & Transport Operation Sumbagsel 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <!--<script src="js/demo/chart-area-demo.js"></script>-->
  <!--<script src="js/demo/chart-pie-demo.js"></script>-->

</body>

</html>
