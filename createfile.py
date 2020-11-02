import os
from datetime import datetime, timedelta, date

def createphp(devip,devint):
    yesterday = date.today() - timedelta(days=1)
    d2 = yesterday.strftime("%Y%m%d")
    fname = devip+'_'+devint+'.php'
    dir = os.path.join('/home','rto_sbs','sniffchart',fname)
    if not os.path.exists(dir):
        f =  f = open(dir,'w')
        message = """
                <?php
                    header('Content-Type: application/json');
                    $start_week = strtotime("-7 day");
                    $end_week = strtotime("today");
                    $start_week = date("Y-m-d",$start_week);
                    $end_week = date("Y-m-d",$end_week);
                    $connectsql = mysqli_connect("localhost", "user", "pass", "db");  
                    $query ="SELECT DISTINCT * FROM rmon, pdhnec, mapping 
                    WHERE rmon.neip=pdhnec.neip AND rmon.neint=mapping.interfaceid 
                    AND mapping.interface=pdhnec.neint AND mapping.device=pdhnec.nedev 
                    AND rmon.neip ='{devip}' AND rmon.neint='{devint}' 
                    AND rmon.stamp BETWEEN '$start_week' AND '$end_week' ORDER BY stamp ASC";  
                    $result = mysqli_query($connectsql, $query);
                    $data =array();
                    foreach ($result as $row){{
                        $data[]=$row;
                    }}
                    mysqli_close($connectsql);
                    echo json_encode($data); 
                ?>
                 """
        f.write(message.format(devip=devip,devint=devint))
        f.close()
    else:
        print 'The file already exist!'

def createhtml(devip,devint):
    yesterday = date.today() - timedelta(days=1)
    d2 = yesterday.strftime("%Y%m%d")
    fname = devip+'_'+devint+'.html'
    fphp = '"'+devip+'_'+devint+'.php"'
    dir = os.path.join('/home','rto_sbs','sniffchart',fname)
    if not os.path.exists(dir):
        f = open(dir,'w')
        message ="""
                <!DOCTYPE html>
                <html>
                <head>
                    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
                    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
                    <script src="/vendor/chart.js/Chart.min.js"></script>
                    <title>SNIPER - Traffic Monitoring</title>
                </head>
                <body>
                    <div id="chart-container"></div>
                        <canvas id="graphCanvas" height="130"></canvas>
                    </div>
                    <script>
                        $(document).ready(function () {{
                            showGraph();
                        }});
                        function showGraph()
                        {{
                            {{
                                $.post({name},
                                function (data)
                                {{
                                    console.log(data);
                                    var stamp= [];
                                    var tx = [];
                                    var rx =[];

                                    for (var i in data) {{
                                        stamp.push(data[i].stamp);
                                        tx.push(data[i].tx);
                                        rx.push(data[i].rx);
                                    }}

                                    var bw = data[0].bw;
                                    var maxocc = data[0].maxocc;
                                    var remark = data[0].remark;

                                    var chartdata = {{
                                        labels: stamp,
                                        datasets: [
                                            {{
                                                label: 'Transmit (Mbps)',
                                                backgroundColor: '#0061f2',
                                                borderColor: '#043e94',
                                                hoverBackgroundColor: '#CCCCCC',
                                                hoverBorderColor: '#666666',
                                                data: tx
                                            }},
                                            {{
                                                label: 'Receive (Mbps)',
                                                backgroundColor: '#ffa200',
                                                borderColor: '#ba7804',
                                                hoverBackgroundColor: '#CCCCCC',
                                                hoverBorderColor: '#666666',
                                                data: rx
                                            }}
                                        ]
                                    }};

                                    var graphTarget = $("#graphCanvas");

                                    var barGraph = new Chart(graphTarget, {{
                                        type: 'line',
                                        data: chartdata,
                                        options:{{
                                            tooltips:{{
                                                mode : 'index',
                                                intersect : true
                                            }},
                                            title:{{
                                                display: true,
                                                text: remark+' | Bandwitdh '+bw+'Mbps with Max Occ(%): '+maxocc
                                            }}
                                        }}                   
                                    }});
                                }});
                            }}
                        }}
                    </script>
                </body>
                </html>
                """
        f.write(message.format(name=fphp))
        f.close()
    else:
        print "The file already exist!"
