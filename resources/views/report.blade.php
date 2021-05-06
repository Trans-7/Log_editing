<link rel="icon" href="/img/logo.png">
<title>TRANS 7 - Log Editing - Report</title>
@include ('head+nav')
<nav class="navbar navbar-expand-lg nav navbar-dark static-top">
    <div class="ks-logo-shadow navbar-brand">
        <img src="/img/logo_trans7.png">
    </div>
    <h4><a class="nav-link" href="/" style="color:white;">Log Editing </a></h4>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <h5><a class="nav-link text-white" href="/" style="margin-left:20px;">Reference</a></h5>
        </li>
        <li class="nav-item">
            <h5><a class="nav-link text-white" href="/non_reference" style="margin-left:20px;"><?php if ((session()->get('priviledge')) == 1 ){echo "Non Reference";}?></a></h5>
        </li>
        <li class="nav-item">
            <h5><a class="nav-link text-white" href="/historycal" style="margin-left:20px;">History Data</a></h5>
        </li>
        <!-- <li class="nav-item">
            <h5>
                <a class="nav-link" href="/report" style="margin-left:50px;">Report</a>
            </h5>
        </li> -->
        <li class="nav-item dropdown">
            <h5>
                <a class="nav-link dropdown-toggle text-white" style="margin-left:20px;" href="/report" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:20px;">
                Report
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/report">Report Jadwal Editor</a>
                    <!-- <a class="dropdown-item" href="/test">Report Booth</a> -->
                </div>
            </h5>
        </li>
        <li class="nav-item">
            <h5><a class="nav-link text-white" style="margin-left:20px;" href="/logout">Logout</a></h5>
        </li>
    </ul>
</nav>
<br />
<div class="container-fluid" style="margin-bottom:50px;">
    <h2 align="center" style="color:#1b215a;">Report Jadwal Editor </h2><br />
    <h5 align="center" style="color:#1b215a;padding-bottom: 1rem"> Hi, <?php echo session()->get('name_priviledge'); ?> - <?php echo session()->get('nik'); ?>! </h5><br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                </b></div>
                <center>
                <div class="col-md-6">
                    <div class="input-group lg-3">
                        
                        <div class="input-group-prepend">
                            <span class="input-group-text">Select Week</span>
                        </div>
                        <input type="text" id = "daterange" name="daterange" value="" class="form-control"/>
                        <div class="input-group-prepend"> 
                            <span class="col-sm"><center><button type="button" name="filter" id="filter" class="btn btn-blue btn-lg">SEARCH</button></center></span>
                        </div>
                    </div>
                   
                </div>
                </center>
            </div>
        </div>
        <br>
        <div class="panel-body">
            <div class="table-responsive">
                <br>
                
                <br>
                <table width="100%" border="1" cellspacing="1" cellpadding="3" align="left" style="background-color: white;color:black;margin-bottom:50px;">
                    
                    <thead  class=" thead2 table-head text-center">
                        <!-- <tr>
                            <th colspan="3" style="background-color: black;color:white;">JADWAL EDITING EDITOR TRANS 7 2021</th>
                            <?php 
                            
                                // $date = date("l",strtotime('monday this week'));
                                // $date1 = date("l",strtotime('tuesday this week'));
                                // $date2 = date("l",strtotime('wednesday this week'));
                                // $date3 = date("l",strtotime('thursday this week'));
                                // $date4 = date("l",strtotime('friday this week'));
                                // $date5 = date("l",strtotime('saturday this week'));
                                // $date6 = date("l",strtotime('sunday this week'));
                                
                                // // echo "<tr>";
                                // echo "<th>".$date."</th>";
                                // echo "<th>".$date1. "</th>";
                                // echo "<th>".$date2. "</th>";
                                // echo "<th>".$date3. "</th>";
                                // echo "<th>".$date4. "</th>";
                                // echo "<th>".$date5. "</th>";
                                // echo "<th>".$date6. "</th>";
                                // echo "</tr>";
                            ?> 
                        </tr> -->
                        <!-- <tr>
                            <td>Nama</td>
                            <td>NIK</td>
                            <td>Telp</td>
                            <td colspan="7" style="background-color: black;color:white;">TANGGAL-BULAN-TAHUN</td>
                            <?php 

                                // tanggal
                                // $datee = date("d-m-Y",strtotime('monday this week'));
                                // $datee1 = date("d-m-Y",strtotime('tuesday this week'));
                                // $datee2 = date("d-m-Y",strtotime('wednesday this week'));
                                // $datee3 = date("d-m-Y",strtotime('thursday this week'));
                                // $datee4 = date("d-m-Y",strtotime('friday this week'));
                                // $datee5 = date("d-m-Y",strtotime('saturday this week'));
                                // $datee6 = date("d-m-Y",strtotime('sunday this week'));
                                
                                // echo "<td>".$datee. "</td>";
                                // echo "<td>".$datee1. "</td>";
                                // echo "<td>".$datee2. "</td>";
                                // echo "<td>".$datee3. "</td>";
                                // echo "<td>".$datee4. "</td>";
                                // echo "<td>".$datee5. "</td>";
                                // echo "<td>".$datee6. "</td>";
                                // echo "<tr>";
                            ?> 
                        </tr> -->
                    </thead>
                    <!-- <thead  class="thead2 table-head text-center">
                        
                    </thead> -->
                    <tbody class="tbody2 table-body text-center">
                        
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
        $('input[name="daterange"]').daterangepicker({
            //default dari hari ini ke seminggu kedepan
            startDate: '<?= date('Y-m-d', strtotime( "0 day" ) );?>', 
            endDate: '<?= date('Y-m-d', strtotime( "+6 day" ) );?>',
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear'
            },
            autoclose: true
        });

        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        var _token = $('input[name="_token"]').val();
        var daterange = $('#daterange').val();
        var dates = daterange.split(" - ");
        var start = dates[0];
        var end = dates[1];

    
        fetch_data(start, end);

        function fetch_data(start = '', end = ''){
            $.ajax({
                url:"{{ route('report.fetch_data')}}",
                method: "GET",
                data:{start:start, end:end, _token:_token},
                dataType:"json",
                success:function(data){
                    var output2 = '';
                    var days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                    var start1 = new Date(start);
                    var start2 = new Date(start);
                    var start3 = new Date(start);
                    var start4 = new Date(start);
                    var start5 = new Date(start);
                    var start6 = new Date(start);
                    var start7 = new Date(start);
                    start1.setDate(start1.getDate());
                    start2.setDate(start2.getDate() + 1);
                    start3.setDate(start3.getDate() + 2);
                    start4.setDate(start4.getDate() + 3);
                    start5.setDate(start5.getDate() + 4);
                    start6.setDate(start6.getDate() + 5);
                    start7.setDate(start7.getDate() + 6);
                    output2 += '<tr>';
                    output2 += '<th colspan="3" style="background-color: black;color:white;">JADWAL EDITING EDITOR TRANS 7</th>';
                    output2 += '<th>'+ days[start1.getDay()] +'</th>';
                    output2 += '<th>'+ days[start2.getDay()] +'</th>';
                    output2 += '<th>'+ days[start3.getDay()] +'</th>';
                    output2 += '<th>'+ days[start4.getDay()] +'</th>';
                    output2 += '<th>'+ days[start5.getDay()] +'</th>';
                    output2 += '<th>'+ days[start6.getDay()] +'</th>';
                    output2 += '<th>'+ days[start7.getDay()] +'</th>';
                    output2 += '</tr>';
                    output2 += '<tr>';
                    output2 += '<td>Nama</td>';
                    output2 += '<td>NIK</td>';
                    output2 += '<td>No. Telp</td>';
                    output2 += '<td style="background-color: black;color:white;">' + moment(start1).format('YYYY-MM-DD') +'</td>';
                    output2 += '<td style="background-color: black;color:white;">' + moment(start2).format('YYYY-MM-DD') +'</td>';
                    output2 += '<td style="background-color: black;color:white;">' + moment(start3).format('YYYY-MM-DD') +'</td>';
                    output2 += '<td style="background-color: black;color:white;">' + moment(start4).format('YYYY-MM-DD') +'</td>';
                    output2 += '<td style="background-color: black;color:white;">' + moment(start5).format('YYYY-MM-DD') +'</td>';
                    output2 += '<td style="background-color: black;color:white;">' + moment(start6).format('YYYY-MM-DD') +'</td>';
                    output2 += '<td style="background-color: black;color:white;">' + moment(start7).format('YYYY-MM-DD') +'</td>';
                    output2 += '</tr>';
        
                    if(data != 'null'){
                        console.log(data);
                        var output = '';
                        for(var count=0; count<data.length;count++){
                            output += '<tr>'
                            //nama, nik, telp
                            if(data[count].logediting_editor_name == null && data[count].logediting_editor_nik == null && data[count].logediting_editor_phone == null){
                                output += '<td> - </td>';
                                output += '<td> - </td>';
                                output += '<td> - </td>';
                            }else if(data[count].logediting_editor_name == null){
                                output += '<td> - </td>';
                                output += '<td>' + data[count].logediting_editor_nik + '</td>';
                                output += '<td>' + data[count].logediting_editor_phone + '</td>';
                            }else if(data[count].logediting_editor_nik == null){
                                output += '<td>' + data[count].logediting_editor_name + '</td>';
                                output += '<td> - </td>';
                                output += '<td>' + data[count].logediting_editor_phone + '</td>';
                            }else if(data[count].logediting_editor_phone == null){
                                output += '<td>' + data[count].logediting_editor_name + '</td>';
                                output += '<td>' + data[count].logediting_editor_nik + '</td>';
                                output += '<td> - </td>';
                            }else{
                                output += '<td>' + data[count].logediting_editor_name + '</td>';
                                output += '<td>' + data[count].logediting_editor_nik + '</td>';
                                output += '<td>' + data[count].logediting_editor_phone + '</td>';
                            }
                            
                            //jadwal
                            if(moment(start1).format('YYYY-MM-DD') == moment(data[count].logediting_useddate).format('YYYY-MM-DD')){
                                if(data[count].logediting_program == null && data[count].logediting_usedshift == null){
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logeditingboot_id == null){
                                    output += '<th>' + 'non-reference' + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null){
                                    output += '<th>' + 'non-reference' + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null){
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logeditingboot_id == null){
                                    output += '<th>' + data[count].logediting_program + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else{
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }
                            }else if(moment(start2).format('YYYY-MM-DD') == moment(data[count].logediting_useddate).format('YYYY-MM-DD')){
                                if(data[count].logediting_program == null && data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else{
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }
                            }else if(moment(start3).format('YYYY-MM-DD') == moment(data[count].logediting_useddate).format('YYYY-MM-DD')){
                                if(data[count].logediting_program == null && data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else{
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }
                            }else if(moment(start4).format('YYYY-MM-DD') == moment(data[count].logediting_useddate).format('YYYY-MM-DD')){
                                if(data[count].logediting_program == null && data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else{
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }
                            }else if(moment(start5).format('YYYY-MM-DD') == moment(data[count].logediting_useddate).format('YYYY-MM-DD')){
                                if(data[count].logediting_program == null && data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }else{
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                }
                            }else if(moment(start6).format('YYYY-MM-DD') == moment(data[count].logediting_useddate).format('YYYY-MM-DD')){
                                if(data[count].logediting_program == null && data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null && data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_program == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                }else if(data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                    output += '<th>OFF</th>';
                                }else{
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                    output += '<th>OFF</th>';
                                }
                            }else if(moment(start7).format('YYYY-MM-DD') == moment(data[count].logediting_useddate).format('YYYY-MM-DD')){
                                if(data[count].logediting_program == null && data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                }else if(data[count].logediting_program == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                }else if(data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                }else if(data[count].logediting_program == null && data[count].logediting_usedshift == null && data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' + 'non-reference' + ' #' + 'non-reference' + '</th>';
                                }else if(data[count].logediting_program == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + 'non-reference' + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                }else if(data[count].logediting_usedshift == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + 'non-reference' + ' #' + data[count].nama_booth + '</th>';
                                }else if(data[count].logeditingboot_id == null){
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' + data[count].logediting_usedshift + ' #' + 'non-reference' + '</th>';
                                }else{
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>OFF</th>';
                                    output += '<th>' + data[count].logediting_program + ' ' +data[count].logediting_usedshift + ' #' + data[count].nama_booth + '</th>';
                                }
                            }else{
                                output += '<th>OFF</th>';
                                output += '<th>OFF</th>';
                                output += '<th>OFF</th>';
                                output += '<th>OFF</th>';
                                output += '<th>OFF</th>';
                                output += '<th>OFF</th>';
                                output += '<th>OFF</th>';
                            }
                            output += '</tr>'
                        }
                        $('tbody.tbody2').html(output);
                    }
                    $('thead.thead2').html(output2);

                }
            });
        }
        $('#filter').click(function(){
            var output = output;
            var daterange = $('#daterange').val();
            var dates = daterange.split(" - ");
            var start = dates[0];
            var end = dates[1];
            // var to_date = $('#to_date').val();
            
            if(start != '' && end != ''){
                fetch_data(start, end);
            }
            else{
                fetch_data(start, end);
            }
        });
    });

</script>
