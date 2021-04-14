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
        <table width="95%" border="1" cellspacing="1" cellpadding="3" align="right" style="background-color: #1b215a;color:white;">
            <tr>
                <!-- dummy -->
                <th>SENIN</th>
                <th>SELASA</th>
                <th>RABU</th>
                <th>KAMIS</th>
                <th>JUMAT</th>
                <th>SABTU</th>
                <th>MINGGU</th>
            </tr>
        </table>
        <br>
        <table width="95%" border="1" cellspacing="1" cellpadding="3" align="right" style="background-color: white;color:black;">
            <tr>
                <!-- dummy -->
                <th>14 Mar '21</th>
                <th>15 Mar '21</th>
                <th>16 Mar '21</th>
                <th>17 Mar '21</th>
                <th>18 Mar '21</th>
                <th>19 Mar '21</th>
                <th>20 Mar '21</th>
            </tr>
        </table>
        <br><br>
        <table width="5%" border="1" cellspacing="1" cellpadding="3" align="left" style="background-color: #1b215a;color:white;">
            <tr>
                <th>LINEAR</th>
            </tr>
        </table>
        @foreach($test2 as $t)
            <br>
            <br>
            <table width="5%" align="left" style="background-color:white;color:black;">
                <tr>
                    <th>
                        
                            <a>
                                <?php
                                if ($t->type_booth != 'Premiere'){
                                    echo "N";
                                }else{
                                    echo $t->type_booth;
                                }
                                ?>
                            </a>
                        
                    </th>
                </tr>
            </table>
            <br>
            <table width="100%" height="5%" border="1" cellspacing="1" cellpadding="3" align="left" style="background-color: white;color:#1b215a;">
                <tr>
                    <td rowspan="4"><center><a>{{$t->nama_booth}}</a></center></td>
                </tr>
                <tr>
                    <!-- dummy -->
                    <td><center><a>1</a></center></td>
                    <td><center><a>ADA SHOW</a></center></td>
                    <td><center><a>ADA SHOW</a></center></td>
                    <td><center><a>ADA SHOW</a></center></td>
                    <td><center><a>ADA SHOW</a></center></td>
                    <td><center><a>ADA SHOW</a></center></td>
                    <td><center><a>ADA SHOW</a></center></td>
                    <td><center><a></a></center></td>
                    
                </tr>
                <tr>
                    <td><center><a>2</a></center></td>
                    <td><center><a>LAMBETUJUH</a></center></td>
                    <td><center><a>LAMBETUJUH</a></center></td>
                    <td><center><a></a></center></td>
                    <td><center><a>LAMBETUJUH</a></center></td>
                    <td><center><a>LAMBETUJUH</a></center></td>
                    <td><center><a></a></center></td>
                    <td><center><a>LAMBETUJUH</a></center></td>
                </tr>
                <tr>
                    <td><center><a>3</a></center></td>
                    <td><center><a>MAKAN RECEH</a></center></td>
                    <td><center><a></a></center></td>
                    <td><center><a>MAKAN RECEH</a></center></td>
                    <td><center><a></a></center></td>
                    <td><center><a>MAKAN RECEH</a></center></td>
                    <td><center><a></a></center></td>
                    <td><center><a>MAKAN RECEH</a></center></td>
                </tr>
            </table>
            <br>
            <br>
        @endforeach
        

        <!-- <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-head text-center">
                    
                    </thead>
                    <tbody class="table-body text-center">
                    </tbody>
                </table>
                {{ csrf_field() }}
            </div>
        </div> -->
    </div>
</div>
</body>

</script>