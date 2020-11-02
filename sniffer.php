<!DOCTYPE html>
<html lang="en">
  
<?php
	include 'connect.php';
	include 'jsonnode.php';
  include 'jsonline.php';
  $connectsql = mysqli_connect("localhost", "root", "root2020", "sniff");  
  $query ="SELECT * from pdhnec,mapping WHERE pdhnec.neint = mapping.interface AND pdhnec.nedev=mapping.device ORDER BY pdhnec.id"; 
  $result = mysqli_query($connectsql, $query);  
?>  

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>
  <link rel="stylesheet" href="zoomslider/src/L.Control.Zoomslider.css">
  <link rel="stylesheet" href="zoomslider/src/L.Control.Zoomslider.ie.css">
  <link rel="stylesheet" href="mouseCoordinate/src/leaflet.mouseCoordinate.css">
  <link rel="stylesheet" href="selector/src/leaflet-geojson-selector.css">
  <link rel="stylesheet" href="search/src/leaflet-search.css">
  <link rel="stylesheet" type="text/css" href="css/select2.css">
  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
   integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
   crossorigin=""></script>
   <script src="polyline/dist/leaflet.polylineDecorator.js"></script>
  <script src="zoomslider/src/L.Control.Zoomslider.js"></script>
  <script src="mouseCoordinate/src/leaflet.mouseCoordinate.js"></script>
  <script src="mouseCoordinate/src/nac.js"></script>
  <script src="mouseCoordinate/src/qth.js"></script>
  <script src="mouseCoordinate/src/utm.js"></script>
  <script src="mouseCoordinate/src/utmref.js"></script>
  <script src="selector/src/leaflet-geojson-selector.js"></script>
  <script src="search/src/leaflet-search.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <!--Leaflet Plugins-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SNIPER - Traffic Sniffer</title>

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
      <li class="nav-item">
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
      <li class="nav-item active">
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
            <h1 class="text-gray-900 mt-4 ml-4">TRAFFIC SNIFFER</h1>
          </div>                     
           
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Bar Chart IPMW Population -->
            <div class="row">
              <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-danger">PDH NEC Sniffer</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="sniffer.php">Reset Table</a>
                      </div>
                    </div>
                  </div>
                <!--  Card Body -->
                  <div class="card-body">
                    <div id="table-responsive">
                      <table id="pdh_data" class="display compact cell-border text-dark" style='font-size:75%'>
                        <thead>
                          <tr>
                            <th>Link ID</th>
                            <th>Description</th>
                            <th>BW(Mbps)</th>
                            <th>Max Usage(Mbps)</th>
                            <th>Max Occ(%)</th>
                            <th>NE Modem</th>
                            <th>NE Device</th>
                            <th>NE IP</th>
                          </tr>
                        </thead>
                        <?php
                          while($row = mysqli_fetch_array($result))
                          {
                            echo '
                            <tr>
                              <td>'.$row["linkid"].'</td>
                              <td>'.$row["remark"].'</td>
                              <td>'.$row["bw"].'</td>
                              <td>'.$row["maxusage"].'</td>
                            ';
                            if($row["maxocc"]>75){
                              echo '
                              <td>  <div class="my-1"></div>
                              <a href="/sniffchart/'.$row["neip"].'_'.$row["interfaceid"].'.html" target="_blank" class="btn btn-danger btn-sm btn-block data-toggle="tooltip" title="Click to view history">
                                <span class="text">'.$row["maxocc"].'</span>
                              </a><script>
                                $(document).ready(function(){
                                  $("["data-toggle="tooltip"]").tooltip(); 
                                });
                              </script></td>';
                            }elseif($row["maxocc"]<50){
                              echo '
                              <td>  <div class="my-1"></div>
                              <a href="/sniffchart/'.$row["neip"].'_'.$row["interfaceid"].'.html" target="_blank" class="btn btn-success btn-sm btn-block" data-toggle="tooltip" title="Click to view history">
                                <span class="text">'.$row["maxocc"].'</span>
                              </a><script>
                                  $(document).ready(function(){
                                    $("[data-toggle="tooltip"]").tooltip(); 
                                  });
                                </script></td>';
                            }else{
                              echo '
                              <td>  <div class="my-1"></div>
                              <a href="/sniffchart/'.$row["neip"].'_'.$row["interfaceid"].'.html" target="_blank" class="btn btn-warning btn-sm btn-block" data-toggle="tooltip" title="Click to view history">
                                <span class="text">'.$row["maxocc"].'</span>
                              </a><script>
                                $(document).ready(function(){
                                  $("[data-toggle="tooltip"]").tooltip(); 
                                });
                              </script></td>';
                            }
                              echo'
                              <td>'.$row["neint"].'</td>
                              <td>'.$row["nedev"].'</td>
                              <td><a href="http://'.$row["neip"].'" target="_blank">'.$row["neip"].'</a></td>
                            ';
                          }
                        ?>
                        <tfoot>
                          <tr>
                            <td>Link ID</td>
                            <td>Description</td>
                            <td>BW(Mbps)</td>
                            <td>Max Usage(Mbps)</td>
                            <td>Max Occ(%)</td>
                            <td>NE Modem</td>
                            <td>NE Device</td>
                            <td>NE IP</td>
                          </tr>
                        </tfoot>
                      </table>
                      <script> 
                        $(document).ready(function() {
                          // Setup - add a text input to each footer cell
                          $('#pdh_data tfoot td').each( function () {
                              var title = $(this).text();
                              $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                          } );
                          //Data table
                          var table = $('#pdh_data').DataTable({
                            "scrollX": true,
                            "searching": true
                          }); 
                          
                          //Applying the search features
                          table.columns().every( function () {
                            var that = this;
                    
                            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                                if ( that.search() !== this.value ) {
                                    that
                                        .search( this.value )
                                        .draw();
                                }
                              } );
                            } );
                        });  
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
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>                  

</body>

</html>
