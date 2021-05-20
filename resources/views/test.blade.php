<link rel="icon" href="/img/logo.png">
<title>Log Editing - Report</title>
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
    <h2 align="center" style="color:#1b215a;">Report Jadwal Booth </h2><br />
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
                <table width="100%" border="1" cellspacing="1" cellpadding="3" align="left">
                    <thead  class="thead2 table-head text-center">
                    </thead>
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
                url:"{{ route('test.fetch_data_test')}}",
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
                    output2 += '<tr><th colspan="3" style="background-color: black;color:white;">JADWAL EDITING BOOTH TRANS 7</th>';
                    output2 += '<th>'+ days[start1.getDay()] +'</th>';
                    output2 += '<th>'+ days[start2.getDay()] +'</th>';
                    output2 += '<th>'+ days[start3.getDay()] +'</th>';
                    output2 += '<th>'+ days[start4.getDay()] +'</th>';
                    output2 += '<th>'+ days[start5.getDay()] +'</th>';
                    output2 += '<th>'+ days[start6.getDay()] +'</th>';
                    output2 += '<th>'+ days[start7.getDay()] +'</th></tr>';
                    output2 += '<tr><td colspan="2">Nama Booth</td><td>Shift</td>';
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

                    booth = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q1", "Q2", "R", "S", "T", "U", "V", "W",
                            "X", "1", "2", "3", "4", "LT1", "10A", "10B", "10C", "10D", "LIVE1", "LIVE2", "DLK"]; //array Booth
                    shift = [1, 2, 3];

                    content = ''; 
                    flag_name = '';
                    flag_s = '';
                    content_td = '';
                    
                    // data.forEach(function(obj) {
                    booth.forEach(function(obj) {
                        shift.forEach(function(s){
                            if(obj != null && s != null && flag_name != obj && flag_s != s){
                                if(obj != null && obj==obj && s==1){
                                    flag = 0;
                                    content += '<td rowspan ="3" colspan="2" style="background-color:#B0E0E6; color:black; ">'+ obj +'</td>';
                                    flag = flag + 1;
                                }
                                // else{
                                //     content += '<td colspan="2"> - </td>';
                                // }
                                if(s != null ){
                                    content += '<td style="background-color:#AFEEEE; color:black; ">'+ s +'</td>';
                                }else{
                                    content += '<td > - </td>';
                                }
                                
                                output.forEach(function(otp) {
                                    content += '<td>'; flag_off=0;
                                    data.forEach(function(obj2) {
                                        if(otp == obj2.Tanggal && obj2.Booth == obj && obj2.Shift == s ){
                                            if(obj2.Program == null){
                                                content += 'non-reference </br>';
                                            }else{
                                                content += obj2.Program + ' (' + obj2.Type_booth + ')</br>';
                                            }
                                            flag_off = flag_off + 1;
                                        }else if(otp != obj2.Tanggal && obj2.Booth == obj && obj2.Shift == s){
                                            content += '';
                                        }
                                    });
                                    if(flag_off==0){
                                        content += '<h6>OFF</h6>';    
                                    }
                                    content += '</td>';
                                });

                                content_td += '<tr>'+content+'</tr>';
                                content = '';
                            }else{
                                content = '';
                            }

                            flag_name = obj.Booth;
                            flag_s = obj.Shift;
                        });
                        
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