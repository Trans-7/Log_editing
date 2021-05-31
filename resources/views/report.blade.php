<link rel="icon" href="/img/logo.png">
<title>TRANS 7 - Log Editing - Report (Editor)</title>
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
                    <a class="dropdown-item" href="/report">Jadwal Editor</a>
                    <a class="dropdown-item" href="/booth">Jadwal Booth</a>
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
                            <span class="input-group-text">Select 7-Days</span>
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
                <p>*default = data per-7 hari</p>
                <table width="100%" border="1" cellspacing="1" cellpadding="3" align="left" >
                    <thead  class="thead2 table-head text-center" style="background-color:black; color:white;">
                    </thead>
                    <tbody class="tbody2 table-body text-center" >
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


                    pertama = moment(start1).format('YYYY-MM-DD');
                    kedua = moment(start2).format('YYYY-MM-DD');
                    ketiga = moment(start3).format('YYYY-MM-DD');
                    keempat = moment(start4).format('YYYY-MM-DD');
                    kelima = moment(start5).format('YYYY-MM-DD');
                    keenam = moment(start6).format('YYYY-MM-DD');
                    ketujuh = moment(start7).format('YYYY-MM-DD');


                    output = [pertama, kedua, ketiga, keempat, kelima, keenam, ketujuh]; //array tanggal
                    console.log(output);

                    output2 = ''
                    // output2 += '<table border="1"><tr>';
                    output2 += '<tr><th colspan="3" style="width:30%;background-color: white;color:black;">JADWAL EDITING EDITOR TRANS 7</th>';
                    if (days[start1.getDay()] == "Minggu"){
                        output2 += '<th style="width:10%; background-color: red;color:white;">'+ days[start1.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start2.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start3.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start4.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start5.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start6.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start7.getDay()] +'</th></tr>';
                    }else if (days[start2.getDay()] == "Minggu") {
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start1.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: red;color:white;">'+ days[start2.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start3.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start4.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start5.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start6.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start7.getDay()] +'</th></tr>';
                    }else if (days[start3.getDay()] == "Minggu"){
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start1.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start2.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: red;color:white;">'+ days[start3.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start4.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start5.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start6.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start7.getDay()] +'</th></tr>';
                    }else if (days[start4.getDay()] == "Minggu"){
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start1.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start2.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start3.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: red;color:white;">'+ days[start4.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start5.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start6.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start7.getDay()] +'</th></tr>';
                    }else if (days[start5.getDay()] == "Minggu"){
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start1.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start2.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start3.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start4.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: red;color:white;">'+ days[start5.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start6.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start7.getDay()] +'</th></tr>';
                    }else if (days[start6.getDay()] == "Minggu"){
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start1.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start2.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start3.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start4.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start5.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: red;color:white;">'+ days[start6.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start7.getDay()] +'</th></tr>';
                    }else{
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start1.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start2.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start3.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start4.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start5.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: grey;color:black;">'+ days[start6.getDay()] +'</th>';
                        output2 += '<th style="width:10%; background-color: red;color:white;">'+ days[start7.getDay()] +'</th></tr>';
                    }
                    output2 += '<tr><td>Nama</td><td>NIK</td><td>No. HP</td>';
                    output.forEach(function(x) {
                        console.log(x);
                    });
                    output2 += '<td>';
                    output2 += output[0];
                    output2 += '</td>';
                    output2 += '<td>';
                    output2 += output[1];
                    output2 += '</td>';
                    output2 += '<td>';
                    output2 += output[2];
                    output2 += '</td>';
                    output2 += '<td>';
                    output2 += output[3];
                    output2 += '</td>';
                    output2 += '<td>';
                    output2 += output[4];
                    output2 += '</td>';
                    output2 += '<td>';
                    output2 += output[5];
                    output2 += '</td>';
                    output2 += '<td>';
                    output2 += output[6];
                    output2 += '</td>';
                    output2 += '</tr>' ;
                    $('thead.thead2').html(output2);

                    content = ''; 
                    flag_name = '';
                    content_td = '';
                    data.forEach(function(obj) {
                        if(obj != null && flag_name != obj.Nama){
                            if(obj.Nama != null){
                                content += '<td style="background-color:white; color:black; font-weight: bold; ">'+obj.Nama+'</td>';
                            }else{
                                content += '<td style="background-color:white; color:black; font-weight: bold;"> - </td>';
                            }
                            if(obj.NIK != null){
                                content += '<td style="background-color:white; color:black; font-weight: bold; ">'+obj.NIK+'</td>';
                            }else{
                                content += '<td style="background-color:white; color:black; font-weight: bold;"> - </td>';
                            }
                            if(obj.Telp != null){
                                content += '<td style="background-color:white; color:black; font-weight: bold; ">'+obj.Telp+'</td>';
                            }else{
                                content += '<td style="background-color:white; color:black; font-weight: bold;"> - </td>';
                            }
                            
                            output.forEach(function(otp) {
                                // content += '<td>'; 
                                flag_off=0;
                                data.forEach(function(obj2) {
                                    if(otp == obj2.Tanggal && obj2.Nama == obj.Nama && obj2.NIK == obj.NIK && obj2.Telp == obj.Telp){
                                        if(obj2.Program == null && obj2.Shift == null){
                                            content += '<td style="font-weight: bold;"> non-reference' + ' ' + 'non-reference' + ' #' + obj2.Booth + '</td></br>';
                                        }else if(obj2.Program == null && obj2.Booth == null){
                                            content += '<td style="font-weight: bold;"> non-reference' + ' ' + obj2.Shift + ' #' + 'non-reference' + '</td></br>';
                                        }else if(obj2.Shift == null && obj2.Booth == null){
                                            content += '<td style="font-weight: bold;">' +obj2.Program + ' ' + 'non-reference' + ' #' + 'non-reference' + '</td></br>';
                                        }else if(obj2.Program == null){
                                            content += '<td style="font-weight: bold;"> non-reference' + ' ' + obj2.Shift + ' #' + obj2.Booth + '</td></br>';
                                        }else if(obj2.Shift == null){
                                            content += '<td style="font-weight: bold;">' + obj2.Program + ' ' + 'non-reference' + ' #' + obj2.Booth + '</td></br>';
                                        }else if(obj2.Booth == null){
                                            content += '<td style="font-weight: bold;">' + obj2.Program + ' ' + obj2.Shift + ' #' + 'non-reference' + '</td></br>';
                                        }else{
                                            content += '<td style="font-weight: bold;">' + obj2.Program + ' ' + obj2.Shift + ' #' + obj2.Booth + '</td></br>';
                                        }
                                        flag_off = flag_off + 1;
                                    }else if(otp != obj2.Tanggal && obj2.Nama == obj.Nama && obj2.NIK == obj.NIK && obj2.Telp == obj.Telp){
                                        content += '';
                                    }
                                });
                                if(flag_off==0){
                                    content += '<td style="background-color:grey; color:black; font-weight: bold;">OFF</td>';
                                }
                                // content += '</td>';
                            });

                            content_td += '<tr>'+content+'</tr>';
                            content = '';
                        }else{
                            content = '';
                        }
                        flag_name = obj.Nama;
                    });
                    $('tbody.tbody2').html(content_td);
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
