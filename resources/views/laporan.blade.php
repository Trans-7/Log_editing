<link rel="icon" href="/img/logo.png">
<title>TRANS 7 - Log Editing - Laporan</title>
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
                    <a class="dropdown-item" href="/laporan">Log Harian</a>
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
    <h2 align="center" style="color:#1b215a;">Log Harian Editor </h2><br />
    <h5 align="center" style="color:#1b215a;padding-bottom: 1rem"> Hi, <?php echo session()->get('name_priviledge'); ?> - <?php echo session()->get('nik'); ?>! </h5><br />
    <div class="panel panel-default">
    <div class="panel-heading">
            <div class="row">
                </b></div>
                <center>
                <div class="col-md-12">
                    <div class="input-group lg-3">
                        
                        <div class="input-group-prepend">
                            <span class="input-group-text">Select Date</span>
                        </div>
                        <input type="text" id = "daterange" name="daterange" value=""  class="form-control"/>
                        <div style="margin-left:15px;"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Editor NIK</span>
                        </div>
                        <input type="text" name="nik" id="nik" class="form-control">
                        <div style="margin-left:15px;"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Editor Name</span>
                        </div>
                        <input type="text" name="name" id="name"  class="form-control">
                        <div style="margin-left:15px;"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Program</span>
                        </div>
                        <input type="text" name="program" id="program"  class="form-control">
                        <div style="margin-left:15px;"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">System Kerja</span>
                        </div>
                        <input type="text" name="kerja" id="kerja"  class="form-control">
                        
                        <div class="input-group-prepend"> 
                            <span class="col-sm"><center><button type="button" name="filter" id="filter" class="btn btn-blue btn-lg">SEARCH</button></center></span>
                            <!-- <hr> -->
                            
                            <!-- <span class="col-sm"><center><button type="button" href="/report/export" class="btn btn-blue btn-lg">Download Report</button></center></span> -->
                            
                        </div>
                        
                        
                    </div>
                   
                </div>
                </center>
            </div>
        </div>
        <br>
        <hr>
        <!-- <span style="display:flex; float: left;"><a class="btn btn-blue btn-md" href="/report/export">Export Report</a></span> -->
        <br>
        <div class="panel-body">
            <div class="table-responsive">
                <table width="100%" border="1" cellspacing="1" cellpadding="3">
                    <!-- <thead  class="thead2 table-head text-center">
                    </thead> -->
                    <thead class="table-head text-center">
                        <tr>
                            <th style="width:10%;">Editor NIK</th>
                            <th style="width:10%;">Editor Name</th>
                            <th style="width:10%;">Editor Email</th>
                            <th style="width:10%;">System Kerja</th>
                            <th style="width:10%;">Date</th>
                            <th style="width:10%;">Shift</th>
                            <th style="width:10%;">Program</th>
                            <th style="width:10%;">Episode</th>
                            <th style="width:10%;">Segment</th>
                            <th style="width:10%;">Detail Report</th>
                        </tr>
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
        var nik = $('#nik').val();
        var name = $('#name').val();
        var program = $('#program').val();
        var kerja = $('#kerja').val();

    
        fetch_data();

        function fetch_data(start = '', end = '', nik='', name='', program='', kerja=''){
            $.ajax({
                url:"{{ route('laporan.fetch_data_laporan')}}",
                method: "GET",
                data:{start:start, end:end, nik:nik, name:name, program:program, kerja:kerja, _token:_token},
                dataType:"json",
                success:function(data){
                    if(data != 'NULL'){
                        var output = '';
                        // $('#total_records').text(data.length);
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
                            + '<div class="modal-dialog modal-dialog-centered modal-lg" role="document">'
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
                            + '<tr><th>Code</th><th>User Pendamping</th><th>Request ID</th><th>Remark</th><th>Booth</th><th>Alasan (WFO)</th><th>Alat (WFH)</th><th>Provider (WFH)</th><th>Downloadspeed (WFH)</th><th>Quotausage (WFH)</th><th>Screenshoot (WFH)</th><th>Remark (WFH)</th><th>Copy Size</th><th>Copy Segment</th><th>Copy Date</th><th>Copy Remark</th><th>Prabudget ID</th><th>Report Susulan</th><th>Alasan Susulan</th>'
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
                            + '<td>' + data[count].logeditingreport_copy_date + '</td>'
                            + '<td>' + data[count].logeditingreport_copy_remark + '</td>'
                            + '<td>' + data[count].logeditingreport_prabudgetid + '</td>'
                            + '<td>' + data[count].logediting_is_reportsusulan + '</td>'
                            + '<td>' + data[count].logediting_alasan_susulan + '</td>'
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
                    }
                    $('tbody.tbody2').html(output);
                }
            });
        }
        $('#filter').click(function(){
            var output = output;
            var daterange = $('#daterange').val();
            var dates = daterange.split(" - ");
            var start = dates[0];
            var end = dates[1];
            var nik = $('#nik').val();
            var name = $('#name').val();
            var program = $('#program').val();
            var kerja = $('#kerja').val();
            // var to_date = $('#to_date').val();
            
            if(start != '' && end != '' || nik != '' || name != '' || program != '' || kerja != ''){
                fetch_data(start, end, nik, name, program, kerja);
            }
            else{
                fetch_data(start, end, nik, name, program, kerja);
            }
        });
    });
</script>