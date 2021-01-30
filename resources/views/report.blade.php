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
    <h2 align="center" style="color:#1b215a;">Report Log Editing</h2><br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5" style="color:#1b215a;"> Report - Total Records - <b><span style="color:#1b215a;" id="total_records"></span>
                </b></div>
                <div class="col-md-5">
                    <div class="input-group">
                        <input type="text" name="from_date" id="from_date" placeholder="start date" class="form-control">
                        <div class="input-group-prepend">
                            <span class="input-group-text">to</span>
                        </div>
                        <input type="text" name="to_date" id="to_date" placeholder="end date" class="form-control">
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
                            <th>Editor NIK</th>
                            <th>Editor Name</th>
                            <th>Editor Email</th>
                            <th>System Kerja</th>
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Program</th>
                            <th>Episode</th>
                            <th>Segment</th>
                            <th>Detail Report</th>
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
                        output += '<td>' + data[count].logeditingreport_editor_nik + '</td>';
                        output += '<td>' + data[count].logeditingreport_editor_name + '</td>';
                        output += '<td>' + data[count].logeditingreport_editor_email + '</td>';
                        output += '<td>' + data[count].logeditingreport_systemkerja + '</td>';
                        output += '<td>' + moment(data[count].logeditingreport_date).format('YYYY-MM-DD');+ '</td>';
                        output += '<td>' + data[count].logeditingreport_shift + '</td>';
                        output += '<td>' + data[count].logeditingreport_program + '</td>';
                        output += '<td>' + data[count].logeditingreport_episode + '</td>';
                        output += '<td>' + data[count].logeditingreport_segment + '</td>';
                        output += '<td>' + 
                        '<button type="button" class="btn btn-blue btn-sm" data-toggle="modal" data-target="#modalDetail-' + data[count].logeditingreport_id + '"> View Detail </button>' 
                        + '<div class="modal fade bd-example-modal-lg" id="modalDetail-' + data[count].logeditingreport_id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
                        + '<div class="modal-dialog modal-lg" role="document">'
                        + '<div class="modal-content">'
                        + '<div class="modal-header">'
                        + '<h3 class="modal-title" id="exampleModalLabel" style="color:#1b215a;">Detail Report</h3>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                        + '</div>'
                        + '<div class="modal-body">'
                        + '<div class="panel-body">' 
                        + '<div class="table-responsive">'
                        + '<table class="table table-striped table-bordered">'
                        + '<thead class="table-head text-center">'
                        + '<tr><th>Code</th><th>User Pendamping</th><th>Request ID</th><th>Remark</th><th>Booth</th><th>Alasan (WFO)</th><th>Alat (WFH)</th><th>Provider (WFH)</th><th>Downloadspeed (WFH)</th><th>Quotausage (WFH)</th><th>Screenshoot (WFH)</th><th>Remark (WFH)</th><th>Copy Size</th><th>Copy Segment</th><th>Copy Date</th><th>Copy Remark</th>'
                        + '<tr></thead>'
                        + '<tbody class="table-body text-center"><td>' + data[count].logediting_code + '</td>'
                        + '<td>' + data[count].logeditingreport_userpendamping + '</td>'
                        + '<td>' + data[count].logeditingreport_requestid + '</td>'
                        + '<td>' + data[count].logeditingreport_remark + '</td>'
                        + '<td>' + data[count].logeditingreport_booth + '</td>'
                        + '<td>' + data[count].logeditingreport_wfo_alasan + '</td>'
                        + '<td>' + data[count].logeditingreport_wfh_alat + '</td>'
                        + '<td>' + data[count].logeditingreport_wfh_provider + '</td>'
                        + '<td>' + data[count].logeditingreport_wfh_downloadspeed + '</td>'
                        + '<td>' + data[count].logeditingreport_wfh_quotausage + '</td>'
                        + '<td>' + data[count].logeditingreport_wfh_screenshoot + '</td>'
                        + '<td>' + data[count].logeditingreport_wfh_remark + '</td>'
                        + '<td>' + data[count].logeditingreport_copy_size + '</td>'
                        + '<td>' + data[count].logeditingreport_copy_segment + '</td>'
                        + '<td>' + data[count].logeditingreport_copy_date+ '</td>'
                        + '<td>' + data[count].logeditingreport_copy_remark + '</td>'
                        + '</tbody>'
                        + '</table>'
                        + '</div>' 
                        + '</div>'
                        + '<div class="modal-footer"><button type="button" class="btn btn-blue btn-md" data-dismiss="modal">Close</button></div>'
                        + '</div>'
                        + '</div>'
                        + '</div>'
                        + '</div>'
                        + '</td>';
                        output += '</tr>';
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
