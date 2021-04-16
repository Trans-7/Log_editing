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
                <li class="nav-item">
                    <h5><a class="nav-link" href="/report" style="margin-left:50px;">Report</a></h5>
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
    <h2 align="center" style="color:#1b215a;">Report Log Editing</h2><br />
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
                        <input type="text" name="from_date" id="from_date" value="YYYY - MM - DD" class="form-control">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="margin-left:10px;">End Date</span>
                        </div>
                        <input type="text" name="to_date" id="to_date" value="YYYY - MM - DD" class="form-control">
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
                <table class="table table-striped table-bordered">
                    <thead class="table-head text-center">
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Telp</th>
                            <th>Tanggal</th>
                            <th>Program</th>
                            <th>Booth</th>
                            <th>Shift</th> 
                        </tr>
                    </thead>
                    <tbody class="table-body text-center">
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
                                // output += '<th>Nama</th>';
                                // output += '<th>NIK</th>';
                                // output += '<th>Telp</th>';
                                // output += '<th>' + moment(data[count].logediting_useddate).format('YYYY-MM-DD');+ '</th>';
                                output += '<td>' + data[count].logediting_editor_name + '</td>';
                                output += '<td>' + data[count].logediting_editor_nik + '</td>';
                                output += '<td>' + data[count].logediting_editor_phone + '</td>';
                                output += '<td>' + moment(data[count].logediting_useddate).format('YYYY-MM-DD');+ '</td>';
                                output += '<td>' + data[count].logediting_program + '</td>';
                                output += '<td>' + data[count].nama_booth + '</td>';
                                output += '<td>' + data[count].logediting_usedshift + '</td>';
                                output += '</tr>';
                            
                        }
                    }
                    $('tbody').html(output);
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