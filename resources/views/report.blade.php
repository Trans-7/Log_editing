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
            <ul class="navbar-nav mr-auto" style="margin-left:150px;">
                <li class="nav-item">
                    <h5><a class="nav-link" href="/" style="margin-left:50px;">Reference</a></h5>
                </li>
                <li class="nav-item">
                    <h5><a class="nav-link" href="/non_reference" style="margin-left:50px;"><?php if ((session()->get('nik') == $priviledge_R->logeditingpriviledge_nik) && ($priviledge_R->logeditingpriviledge_level == 1)){echo "Non Reference";}?></a></h5>
                </li>
                <li class="nav-item">
                    <h5><a class="nav-link" href="/report" style="margin-left:50px;">Report</a></h5>
                </li>
            </ul>
        </div>
    </div>
    <ul class="navbar-nav mr-auto" style="margin-left:300px;">
                <li class="nav-item">
                    <h5><a class="nav-link" href="/logout">Logout ( <?php echo session()->get('nik'); ?> )</a></h5>
                </li>
    </ul>
</nav>
<br />
<div class="container box">
    <h3 align="center" style="color:#1b215a;">Report Log Editing</h3><br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5"> Report -  Total Records - <b><span id="total_records"></span>
                </b></div>
                <div class="col-md-5">
                    <div class="input-group">
                        <input type="text" name="from_date" id="from_date" class="form-control">
                        <div class="input-group-prepend">
                            <span class="input-group-text">to</span>
                        </div>
                        <input type="text" name="to_date" id="to_date" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" name="filter" id="filter" class="btn btn-blue">Filter Date</button>
                </div>
                <div class="col-md-2"><a class="btn btn-blue btn-md" href="/report/export_excel">Download Report</a></div>
            </div>
        </div>
        <br>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-head text-center">
                        <tr>
                            <th>ID</th>
                            <th>Editor_NIK</th>
                            <th>Editor_Name</th>
                            <th>Editor_Email</th>
                            <th>Program</th>
                            <th>Date</th>
                            <th>Shift</th>
                            <th>System_Kerja</th>
                            <th>Segment</th>
                            <th>Episode</th>
                            <th>User_Pendamping</th>
                            <th>Request_ID</th>
                            <th>Remark</th>
                            <th>Booth</th>
                            <th>Alasan_WFO</th>
                            <th>Alat_WFH</th>
                            <th>Provider_WFH</th>
                            <th>Download Speed_WFH</th>
                            <th>Quotausage_WFH</th>
                            <th>Screenshoot_WFH</th>
                            <th>Remark_WFH</th>
                            <th>Copy_Size</th>
                            <th>Copy_Segment</th>
                            <th>Copy_Date</th>
                            <th>Copy_Remark</th>
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
<!-- <div class="table-responsive" style="padding-bottom:2rem">
    <div class="col-sm-12">
        <h2 style="color:#1b215a;padding-top:2rem;padding-left:1rem;"> Report </h2>
            <br>
            <div class="col-md-5">
                <div class="input-group">
                    <input type="date" name="from_date" id="from_date" class="form-control">
                    <div class="input-group-prepend">
                        <span class="input-group-text">to</span>
                    </div>
                    <input type="date" name="to_date" id="to_date" class="form-control">
                    <div class="col-md-5">
                        <button type="button" name="filter" id="filter" class="btn btn-blue btn-md"> Filter Date </button>
                        <a class="btn btn-blue btn-md" href="/report/export_excel">Download Data</a>
                    </div>
                </div>
            </div>
            <br>
            <table class="table table-sm table-bordered" style="overflow-x:auto;">
                <thead class="table-head text-center">
                    <th>No.</th>
                    <th>Editor_NIK</th>
                    <th>Editor_Name</th>
                    <th>Editor_Email</th>
                    <th>Program</th>
                    <th>Date</th>
                    <th>Shift</th>
                    <th>System_Kerja</th>
                    <th>Segment</th>
                    <th>Episode</th>
                    <th>User_Pendamping</th>
                    <th>Request_ID</th>
                    <th>Remark</th>
                    <th>Booth</th>
                    <th>Alasan_WFO</th>
                    <th>Alat_WFH</th>
                    <th>Provider_WFH</th>
                    <th>Download Speed_WFH</th>
                    <th>Quotausage_WFH</th>
                    <th>Screenshoot_WFH</th>
                    <th>Remark_WFH</th>
                    <th>Copy_Size</th>
                    <th>Copy_Segment</th>
                    <th>Copy_Date</th>
                    <th>Copy_Remark</th>
                </thead>
                @php $i=1 @endphp
                @foreach($report as $rep)
                <tbody class="table-body text-center">
                    <td>{{$i++}}</td>
                    <td>{{$rep->logeditingreport_editor_nik}}</td>
                    <td>{{$rep->logeditingreport_editor_name}}</td>
                    <td>{{$rep->logeditingreport_editor_email}}</td>
                    <td>{{$rep->logeditingreport_program}}</td>
                    <td>{{$rep->logeditingreport_date}}</td>
                    <td>{{$rep->logeditingreport_shift}}</td>
                    <td>{{$rep->logeditingreport_systemkerja}}</td>
                    <td>{{$rep->logeditingreport_segment}}</td>
                    <td>{{$rep->logeditingreport_episode}}</td>
                    <td>{{$rep->logeditingreport_userpendamping}}</td>
                    <td>{{$rep->logeditingreport_requestid}}</td>
                    <td>{{$rep->logeditingreport_remark}}</td>
                    <td>{{$rep->logeditingreport_booth}}</td>
                    <td>{{$rep->logeditingreport_wfo_alasan}}</td>
                    <td>{{$rep->logeditingreport_wfh_alat}}</td>
                    <td>{{$rep->logeditingreport_wfh_provider}}</td>
                    <td>{{$rep->logeditingreport_wfh_downloadspeed}}</td>
                    <td>{{$rep->logeditingreport_wfh_quotausage}}</td>
                    <td>{{$rep->logeditingreport_wfh_screenshoot}}</td>
                    <td>{{$rep->logeditingreport_wfh_remark}}</td>
                    <td>{{$rep->logeditingreport_copy_size}}</td>
                    <td>{{$rep->logeditingreport_copy_segment}}</td>
                    <td>{{$rep->logeditingreport_copy_date}}</td>
                    <td>{{$rep->logeditingreport_copy_remark}}</td>
                </tbody>
                @endforeach
            </table>
            {{ csrf_field() }}
    </div>
<div> -->
</body>
<script>
    $(document).ready(function(){
        $("#from_date").datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
        $("#to_date").datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
        var _token = $('input[name="_token"]').val();

        fetch_data();

        function fetch_data(from_date = '', to_date=''){
            $.ajax({
                url:"{{ route('report.fetch_data')}}",
                method: "POST",
                data:{from_date:from_date, to_date:to_date, _token:_token},
                dataType:"json",
                success:function(data){
                    var output = '';
                    $('#total_records').text(data.length);
                    for(var count=0; count<data.length;count++){
                        output += '<tr>';
                        output += '<td>' + data[count].logeditingreport_id+ '</td>';
                        output += '<td>' + data[count].logeditingreport_editor_nik + '</td>';
                        output += '<td>' + data[count].logeditingreport_editor_name + '</td>';
                        output += '<td>' + data[count].logeditingreport_editor_email + '</td>';
                        output += '<td>' + data[count].logeditingreport_program + '</td>';
                        output += '<td>' + data[count].logeditingreport_date + '</td>';
                        output += '<td>' + data[count].logeditingreport_shift + '</td>';
                        output += '<td>' + data[count].logeditingreport_systemkerja + '</td>';
                        output += '<td>' + data[count].logeditingreport_segment + '</td>';
                        output += '<td>' + data[count].logeditingreport_episode + '</td>';
                        output += '<td>' + data[count].logeditingreport_userpendamping + '</td>';
                        output += '<td>' + data[count].logeditingreport_requestid + '</td>';
                        output += '<td>' + data[count].logeditingreport_remark + '</td>';
                        output += '<td>' + data[count].logeditingreport_booth + '</td>';
                        output += '<td>' + data[count].logeditingreport_wfo_alasan + '</td>';
                        output += '<td>' + data[count].logeditingreport_wfh_alat + '</td>';
                        output += '<td>' + data[count].logeditingreport_wfh_provider + '</td>';
                        output += '<td>' + data[count].logeditingreport_wfh_downloadspeed + '</td>';
                        output += '<td>' + data[count].logeditingreport_wfh_quotausage + '</td>';
                        output += '<td>' + data[count].logeditingreport_wfh_screenshoot + '</td>';
                        output += '<td>' + data[count].logeditingreport_wfh_remark + '</td>';
                        output += '<td>' + data[count].logeditingreport_copy_size + '</td>';
                        output += '<td>' + data[count].logeditingreport_copy_segment + '</td>';
                        output += '<td>' + data[count].logeditingreport_copy_date + '</td>';
                        output += '<td>' + data[count].logeditingreport_copy_remark + '</td></tr>';
                    }
                    $('tbody').html(output);
                }
            });
        }
        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' && to_date != ''){
                fetch_data(from_date, to_date)
            }
            else{
                alert('Both Date is required');
            }
        });
    });

</script>
