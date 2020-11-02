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
    <!--Leaflet Plugins-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SNIPER - Map Viewer</title>

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
      <li class="nav-item active">
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
            <a class="collapse-item" href="link2g.php">2G<a>
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
      <hr class="sidebar-divider">

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
           
          <!-- Topbar Form -->
            <form  action ="" method="post" class="form-inline ml-4">
              <div class="form-group mr-2">
                <select name="input_constraint" type="text" class="custom-select custom-select-sm">
                  <option value="All IPMW">All IPMW</option>
                </select>
              </div>
              <div class="form-group mr-5">
                <select multiple id="rtp" name="input_rtp[]" type="text" style="width:600px;">
                    <?php
                      $select_query="MATCH (s:site) WHERE s.rtp <> 'NULL' RETURN DISTINCT [s.rtp] AS list;";
                      $select_result=$client->run($select_query);
                      foreach ($select_result->records() as $select_record){
                        $select_response =$select_record->get('list');
                          foreach ($select_response as $row){	
                            ?><option value="<?php echo $row?>" ><?php echo $row?></option><?php
                          }
                      }
                    ?>
                </select>
                <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
                <script src="js/select2.min.js"></script>  
                <script> 
                  $("#rtp").select2({
                    allowClear:true,
                    placeholder: 'Input multiple entries',
                    maximumSelectionLength: 3
                  });       
                </script>
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-danger" name="sub" value="sub" data-toggle="tooltip" title="Draw on Map">
                      <i class="fas fa-search-location fa-sm"></i>
                    </button>
                    <script>
                      $(document).ready(function(){
                        $('[data-toggle="tooltip"]').tooltip();   
                      });
                      </script>
                  </div>
              </div>
            </form>
           
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
       
          <!-- Content Row -->

          <div class="row">

            <!-- Map View -->
            <div class="col-xl-12 mb-4 border-top red">
              <!-- Panel -->
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <a href="#" data-toggle="collapse" data-target="#collapse22" aria-expanded="true" class="" data-toggle="tooltip" title="Click to Minimize/Expand">
			              <i class="icon-action fa fa-chevron-down text-danger"></i>
			              <span class="m-0 font-weight-bold text-danger">Map Viewer</span>
                  </a>
                  <script>
                    $(document).ready(function(){
                        $('[data-toggle="tooltip"]').tooltip();   
                      });
                  </script>
                </div>
                <!-- Card Body -->
                <div class="collapse show" id="collapse22" style="">
                  <div class="card-body">
                    <div style="position:relative;top:380px;left:20px;z-index:9990;">
                      <img src="images/legend.PNG" width=240 height=90></img>
                    </div>
                    <?php
                      //POST METHOD//
                      $input_rtp=@$_POST['input_rtp'];
                      $input_constraint=@$_POST['input_constraint'];
                      $submit=@$_POST['sub'];
                      if ($submit){	//If submit button is pressed//
                        if ($input_rtp !=""){	//If there is RTP input on the form selection//
                          if ($input_constraint =='All IPMW'){ //If All IPMW is selected//
                            $colnode =createCollection(); //Create Node Function//
                            $colline =createCollectionL(); //Create Line Function//
                            foreach ($input_rtp as $inrtp){ //For each of the input on the selection dropdown box repeats ://
                              $query = "MATCH (a:site),(b:site),p=((a)-[r]->(b)) WHERE a.rtp='$inrtp' AND (NOT(a.siteid CONTAINS 'COB'))
                                  WITH p,
                                  EXTRACT (n in NODES(p) | [n.siteid,n.sitename,n.long,n.lat,n.ismetro,n.vlan2g,n.router2g,n.bsc,n.vlan3g,n.router3g,n.rnc,n.vlan4g,n.router4g]) as sites,
                                  EXTRACT (r in RELATIONSHIPS(p) | [r.linkown,r.bw,r.linkconf,r.linkdetail,r.hopid,r.rtaremark,r.category]) as links
                                  RETURN sites,links;";
                                  //Pathfinder query (shortest path to controller)//
                              $result = $client->run($query);
                              foreach ($result->records() as $record){ //For loops to assign each records as arrays//
                                $response= $record->get('links');
                                $response2= $record->get('sites');
                                $count = count($response2)-1; //Placeholder//
                                foreach ($response2 as $row){ //For each row, repeats ://
                                  $site = createFeature();
                                  $site->properties->index = $row[0].' '.$row[1];
                                  $site->properties->siteid = $row[0];
                                  $site->properties->sitename = $row[1];
                                  $site->properties->ismetro = $row[4];
                                  $site->properties->vlan2g = $row[5];
                                  $site->properties->router2g = $row[6];
                                  $site->properties->bsc = $row[7];
                                  $site->properties->vlan3g = $row[8];
                                  $site->properties->router3g = $row[9];
                                  $site->properties->rnc = $row[10];
                                  $site->properties->vlan4g = $row[11];
                                  $site->properties->router4g = $row[12];
                                  $site->geometry->coordinates[] = $row[2];
                                  $site->geometry->coordinates[] = $row[3];
                                  $colnode->features[] = $site; //Collect the created point to node collection//
                                }
                                for($c=0;$c<$count; $c++){ //For loops as long as the node is not the last node, repeats ://
                                  $d=$c+1;
                                  if ($input_constraint !=='Metro-E'){
                                    if (strpos($response[$c][4], '_') !== false){ //If the link is IPMW, then ://
                                      $link = createLine();
                                      $link->properties->owner = $response[$c][0];
                                      $link->properties->bandwidth = $response[$c][1];
                                      $link->properties->config = $response[$c][2];
                                      $link->properties->detail = $response[$c][3];
                                      $link->properties->hopid = $response[$c][4];
                                      $link->properties->rtaremark = $response[$c][5];
                                      $link->properties->category = $response[$c][6];
                                      $link->geometry->coordinates[] = [$response2[$c][2],$response2[$c][3]];
                                      $link->geometry->coordinates[] = [$response2[$d][2],$response2[$d][3]];
                                      $colline->features[] = $link; //Collect the created polyline to line collection//
                                    }
                                  }	
                                }
                              }
                            }
                            $node= json_encode($colnode);
                            $line = json_encode($colline);
                          }
                        }
                      }
                    ?>

                    <!--Load mapbox-->
                    <div id="mapid" style="top:-100px; width: 100%; height: 500px;"></div>

                    <!--/*///////////////////////////////////////////////////////////////////////
                                        Membuat base map dari mapbox (Javascript)
                    ///////////////////////////////////////////////////////////////////////*/-->
                    <script>
                      var map = L.map('mapid',{
                                maxBounds : [
                                [-6.117412, 99.12741],
                                [-0.63412, 109.014519]
                                ]
                              }).setView([-2.73664,104.657],7);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                            maxZoom: 18,
                          minZoom:7,
                            id: 'mapbox.streets'
                        }).addTo(map);
                        /////////////////////////////////////////////////////////////////////////

                        ///////////////////////////load mouse coordinate////////////////////////
                        L.control.mouseCoordinate({gpsLong:false,utm:false,utmref:false, position: 'bottomleft'}).addTo(map);
                        /////////////////////////////////////////////////////////////////////////

                        /*///////////////////////////////////////////////////////////////////////
                                    Membuat function untuk menampilkan popup pada marker
                        ///////////////////////////////////////////////////////////////////////*/
                        function onEachFeature(feature, layer) {
                            // does this feature have a property named popupContent?
                                layer.bindPopup("<b>Site ID</b>: "+feature.properties.siteid+"<br> <b>Site Name</b>: "+feature.properties.sitename+"<br> <b>VLAN 2G</b> :"+feature.properties.vlan2g+" - "+feature.properties.router2g+" - "+feature.properties.bsc
                            +"<br> <b>VLAN 3G</b> :"+feature.properties.vlan3g+" - "+feature.properties.router3g+" - "+feature.properties.rnc+"<br> <b>VLAN 4G</b> :"+feature.properties.vlan4g+" - "+feature.properties.router4g);
                                layer.bindTooltip(feature.properties.sitename,{permanent: false, direction:'bottom',opacity:0.7});
                        }
                        //////////////////////////////////////////////////////////////////////////

                        /*////////////////////////////////////////////////////////////////////////
                                              load data marker dari geoJSON
                        ////////////////////////////////////////////////////////////////////////*/
                        var geojsonFeature = <?php  echo $node; ?>
                        /////////////////////////////////////////////////////////////////////////

                        //////////////////////////////////////////////////////////////////////////
                        ///////////////////////load data line dari link.txt//////////////////////
                        var geoJsonLine = <?php  echo $line;?>
                        /////////////////////////////////////////////////////////////////////////

                        /////////////////////////////////////////////////////////////////////////
                        /////////////////////////// Menampilkan line pada peta /////////////////
                        var arrow = L.geoJSON(geoJsonLine, {
                          style : function (feature){
                            switch (feature.properties.owner){
                              case 'TELKOM' : return {color :"#FF0000"};
                              case 'TSEL' : return {color :"#800000"};
                              case 'TSEL & TELKOM' : return{color :"#FCBF00"};
                            }
                          },
                          onEachFeature: function(feature,layer){
                            layer.bindPopup("<b>Hop ID</b>: "+feature.properties.hopid+"<br><b>Link Owner</b>: "+feature.properties.owner+"<br><b>Bandwidth</b>: "+feature.properties.bandwidth+"<br><b>Configurations</b>: "+feature.properties.config+"<br><b>Link Detail</b>:  "+feature.properties.detail+"<br><b>RTA Config</b>:  "+feature.properties.rtaremark+"<br><b>Usage Category</b>:  "+feature.properties.category);
                            L.polylineDecorator(layer, {
                                patterns: [
                                    {offset: '50%', repeat: 0, symbol: L.Symbol.arrowHead({pixelSize: 10, pathOptions:{fillOpacity: 1, weight: 1, color:'#FF0000'}})}
                                ]
                            }).addTo(map);
                          }}).addTo(map);
                        
                        //////////////////////////////////////////////////////////////////////////

                        /*////////////////////////////////////////////////////////////////////////
                                                Menampilkan marker pada peta
                        ////////////////////////////////////////////////////////////////////////*/
                        var layerGroup = L.geoJSON(geojsonFeature, {

                                style: function (feature) {
                                    return feature.properties && feature.properties.style;
                                },
                                onEachFeature: onEachFeature,
                                pointToLayer: function (feature, latlng) {

                                      console.log(feature.properties.ismetro);
                                      return new L.marker(latlng,{
                                        icon: new L.icon({
                                        iconSize:[35,35],
                                        iconUrl: "icon/"+feature.properties.ismetro+"metro.png",
                                        iconAnchor:[15.5,14.5]
                                        })

                                      }).addTo(map); 
                                }
                        }).addTo(map);

                        /////////////////////////////////////////////////////////////////////////

                        map.addLayer(layerGroup);
                        
                        var searchControl = new L.Control.Search({
                            layer: layerGroup,
                            initial: false,
                            propertyName: 'index',
                            circleLocation: false,
                            textPlaceholder: 'Site ID or Site Name',
                            moveToLocation: function(latlng, title, map) {
                              //map.fitBounds( latlng.layer.getBounds() );
                              /*var zoom = map.getBoundsZoom(lnglat.layer.getBounds());
                                map.setView(lnglat, zoom); // access the zoom */
                                console.log(latlng);
                                map.setView(latlng, 18);
                            }
                          });

                          searchControl.on('search:locationfound', function(e) {
                            
                            console.log('search:locationfound', );

                            //map.removeLayer(this._markerSearch)
                            e.layer.setStyle({fillColor: '#3f0', color: '#0f0'});
                            if(e.layer._popup)
                              e.layer.openPopup();

                          }).on('search:collapsed', function(e) {

                              layerGroup.eachLayer(function(layer) { //restore feature color
                              layerGroup.resetStyle(layer);
                            }); 
                          });
                          
                          map.addControl( searchControl );

                        /////////////////////////Menampilkan zoomSlider/////////////////////////
                        var zoom = L.TileJSON.createMap('mapid', map,{mapConfig: {
                          zoomsliderControl: false, position: 'topright'}});
                        setTimeout(function(){
                          map.addControl(new L.Control.Zoomslider());
                        }, 2000);
                        /////////////////////////Menampilkan zoomSlider/////////////////////////
                        L.TileJSON.createMap('mapid', map);
                        ///////////////////////////////////////////////////////////////////////
                    </script>

                  </div>
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
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
