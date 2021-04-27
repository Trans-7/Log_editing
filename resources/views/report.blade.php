<link rel="icon" href="/img/logo.png">
<title>Log Editing - Report</title>
@include ('head+nav')
<nav class="navbar navbar-expand-lg nav navbar-dark static-top">
    <div class="container">
        <div class="ks-logo-shadow navbar-brand">
            <img src="/img/logo_trans7.png">
        </div>
        <div class="navbar-brand md-auto"><h4><a class="nav-link" href="/" style="color:white;">Log Editing </a></h4></div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="margin-left:15px;">
                <li class="nav-item">
                    <h5><a class="nav-link" href="/" style="margin-left:50px;">Reference</a></h5>
                </li>
                <li class="nav-item">
                    <h5><a class="nav-link" href="/non_reference" style="margin-left:50px;"><?php if ((session()->get('priviledge')) == 1 ){echo "Non Reference";}?></a></h5>
                </li>
                <li class="nav-item">
                    <h5><a class="nav-link" href="/historycal" style="margin-left:50px;">Historycal</a></h5>
                </li>
                <!-- <li class="nav-item">
                    <h5>
                        <a class="nav-link" href="/report" style="margin-left:50px;">Report</a>
                    </h5>
                </li> -->
                <li class="nav-item dropdown">
                    <h5>
                        <a class="nav-link dropdown-toggle" href="/report" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:50px;">
                        Report
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/report">Report Editor</a>
                            <!-- <a class="dropdown-item" href="/test">Report Booth</a> -->
                        </div>
                    </h5>
                </li>
            </ul>
        </div>
    </div>
    <ul class="navbar-nav mr-auto" style="margin-left:300px;">
                <li class="nav-item">
                    <h5><a class="nav-link" href="/logout">Logout</a></h5>
                </li>
    </ul>
</nav>
<br />
<div class="container-fluid">
    <h2 align="center" style="color:#1b215a;">Report Log Editing (Editor) </h2><br />
    <h5 align="center" style="color:#1b215a;padding-bottom: 1rem"> Hi, <?php echo session()->get('name_priviledge'); ?> - <?php echo session()->get('nik'); ?>! </h5><br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <!-- <div class="col-md-5" style="color:#1b215a;padding-bottom:1rem"> Report - Total Records - <b><span style="color:#1b215a;" id="total_records"></span> -->
                </b></div>
                <div class="col-md-12">
                    <div class="input-group lg-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Start Date</span>
                        </div>
                        <input type="text" name="from_date" id="from_date" value="THIS WEEK DATE" class="form-control">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="margin-left:10px;">End Date</span>
                        </div>
                        <input type="text" name="to_date" id="to_date" value="THIS WEEK DATE" class="form-control">
                    </div>
                    <div style="padding-top:1rem">
                        <span class="col-mb-3"><center><button type="button" name="filter" id="filter" class="btn btn-blue btn-lg">EXECUTE</button></center></span>
                    </div>
                    
                </div>
            </div>
        </div>
        <br>
        <div class="panel-body">
            <div class="table-responsive">
                <br>
                
                <br>
                <table width="100%" border="1" cellspacing="1" cellpadding="3" align="left" style="background-color: white;color:black;">
                    
                    <thead  class="table-head text-center">
                        <tr>
                            <th colspan="3" style="background-color: black;color:white;">JADWAL EDITING EDITOR TRANS 7 2021</th>
                            <!-- <th></th>
                            <th></th> -->
                            <?php 
                            
                                $date = date("l",strtotime('monday this week'));
                                $date1 = date("l",strtotime('tuesday this week'));
                                $date2 = date("l",strtotime('wednesday this week'));
                                $date3 = date("l",strtotime('thursday this week'));
                                $date4 = date("l",strtotime('friday this week'));
                                $date5 = date("l",strtotime('saturday this week'));
                                $date6 = date("l",strtotime('sunday this week'));
                                
                                // echo "<tr>";
                                echo "<th>".$date."</th>";
                                echo "<th>".$date1. "</th>";
                                echo "<th>".$date2. "</th>";
                                echo "<th>".$date3. "</th>";
                                echo "<th>".$date4. "</th>";
                                echo "<th>".$date5. "</th>";
                                echo "<th>".$date6. "</th>";
                                // echo "</tr>";
                            ?> 
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>NIK</td>
                            <td>Telp</td>
                            <?php 

                                //tanggal
                                $datee = date("d-m-Y",strtotime('monday this week'));
                                $datee1 = date("d-m-Y",strtotime('tuesday this week'));
                                $datee2 = date("d-m-Y",strtotime('wednesday this week'));
                                $datee3 = date("d-m-Y",strtotime('thursday this week'));
                                $datee4 = date("d-m-Y",strtotime('friday this week'));
                                $datee5 = date("d-m-Y",strtotime('saturday this week'));
                                $datee6 = date("d-m-Y",strtotime('sunday this week'));
                                
                                echo "<td>".$datee. "</td>";
                                echo "<td>".$datee1. "</td>";
                                echo "<td>".$datee2. "</td>";
                                echo "<td>".$datee3. "</td>";
                                echo "<td>".$datee4. "</td>";
                                echo "<td>".$datee5. "</td>";
                                echo "<td>".$datee6. "</td>";
                                // echo "<tr>";
                            ?> 
                        </tr>
                    </thead>
                    <tbody class="tableee table-body text-center">
                    </tbody>
                </table>
                {{ csrf_field() }}
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function(){
        $("#from_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            locale: 'en'
        });
        $("#to_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            locale: 'en'
        });
        var _token = $('input[name="_token"]').val();
        
    
        fetch_data();

        function fetch_data(from_date = '', to_date=''){
            $.ajax({
                url:"{{ route('report.fetch_data')}}",
                method: "GET",
                data:{from_date:from_date, to_date:to_date, _token:_token},
                dataType:"json",
                success:function(data){
                    if(data != 'null'){
                        var output = '';
                        for(var count=0; count<data.length;count++){
                            
                                output += '<tr>';
                                output += '<td>' + data[count].logediting_editor_name + '</td>';
                                output += '<td>' + data[count].logediting_editor_nik + '</td>';
                                output += '<td>' + data[count].logediting_editor_phone + '</td>';
                                
                                // output += '<td>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' ' + data[count].nama_booth + '</td>';
                                if('<?= $datee = date("d-m-Y",strtotime('monday this week')); ?>' == moment(data[count].logediting_useddate).format('DD-MM-YYYY')){
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' ' + data[count].nama_booth + '</th>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                }else if('<?= $datee = date("d-m-Y",strtotime('tuesday this week')); ?>' == moment(data[count].logediting_useddate).format('DD-MM-YYYY')){
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' ' + data[count].nama_booth + '</th>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                }else if('<?= $datee = date("d-m-Y",strtotime('wednesday this week')); ?>' == moment(data[count].logediting_useddate).format('DD-MM-YYYY')){
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' ' + data[count].nama_booth + '</th>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                }else if('<?= $datee = date("d-m-Y",strtotime('thursday this week')); ?>' == moment(data[count].logediting_useddate).format('DD-MM-YYYY')){
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' ' + data[count].nama_booth + '</th>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                }else if('<?= $datee = date("d-m-Y",strtotime('friday this week')); ?>' == moment(data[count].logediting_useddate).format('DD-MM-YYYY')){
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' ' + data[count].nama_booth + '</th>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                }else if('<?= $datee = date("d-m-Y",strtotime('saturday this week')); ?>' == moment(data[count].logediting_useddate).format('DD-MM-YYYY')){
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' ' + data[count].nama_booth + '</th>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                }else if('<?= $datee = date("d-m-Y",strtotime('sunday this week')); ?>' == moment(data[count].logediting_useddate).format('DD-MM-YYYY')){
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' ' + data[count].nama_booth + '</th>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                }else{
                                    // output += '<td style="background-color:black;color:white;">OFF</td>';
                                    // output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' ' + data[count].nama_booth + '</th>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                    output += '<td style="background-color:black;color:white;">OFF</td>';
                                }
                                output += '</tr>';
                                


                            
                        }
                    }
                    $('tbody.tableee').html(output);

                }
            });
        }
        $('#filter').click(function(){
            var output = output;
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            
            if(from_date != '' && to_date != ''){
                fetch_data(from_date, to_date);
            }
            else{
                fetch_data(from_date, to_date);
            }
        });
    });

</script>