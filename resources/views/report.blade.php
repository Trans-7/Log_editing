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
<div class="table-responsive" style="padding-bottom:2rem">
    <div class="col-sm-12">
        <h2 style="color:#1b215a;padding-top:2rem"> Report <br><br><a href="/report/export_excel" class="btn btn-blue">Download Report</a></h2>
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
    </div>
<div>
