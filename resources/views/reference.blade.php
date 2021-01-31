<link rel="icon" href="/img/logo.png">
<title>Log Editing - Reference</title>
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

<form action="/reference/store_R" method="GET">
        <div class="col-md-12">
            <div class="col-sm-12">
                <div class="row m-5" style="padding-bottom: 2rem">
                    <div class="col-md-12">
                        <div class="card shadow-sm mb-2">
                            <div class="card-body">   
                                <h2 class="card-title" style="color:#1b215a;">Reference</h2>
                                <div class = "row m-1">
                                        <div class="col-md-2 col-form-label">
                                            Booking Editing ID
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="bookingediting_id" id="bookingediting_id" class="form-control dynamic" data-dependent="bookingeditingdetail_line" required>
                                                    <option value="" selected="false">--Select Booking Editing ID--</option>
                                                    @foreach ($reference_R as $booking)
                                                    <option value="{{$booking->bookingediting_id}}">{{$booking->bookingediting_id}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:grey;">*Ketik Booking Editing ID</p>
                                        </div>
                                        
                                        <div class="col-md-2 col-form-label">
                                            Booking Editing Line
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="bookingeditingdetail_line" id="bookingeditingdetail_line" class="form-control dynamic" onchange="autofill()"  required>
                                                    <option value="" selected="false">--Select Booking Editing Line--</option>
                                                    
                                                </select>
                                                <p style="color:grey;">*Pilih Booking Editing Line</p>
                                        </div>
                                        {{ csrf_field() }}
                                        
                                        <div class="col-md-2 col-form-label">
                                            Kode Eps
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                            <input type="text" class="form-control dynamic" id="kode_eps" name="kode_eps" value="" placeholder="Episode Code" readonly/>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Editing Date
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                            <input type="text" class="form-control dynamic" id="editing_date" name="editing_date" value="" placeholder="Editing Date" readonly/>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Editing Shift
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                            <input type="text" class="form-control dynamic" id="editing_shift" name="editing_shift" value="" placeholder="Editing Shift" readonly/>
                                        </div><br><br><br>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-blue btn-lg btn-block">GENERATE CODE</button>
                                        </div>
                                        <br><br><br>
                                        <div class="col-md-12 col-form-label">
                                            <h4 style="color:#1b215a;">Your Code</h4>
                                            <div class="card shadow-sm mb-2" style="padding:60px;"> 
                                                <center>
                                                <H1 style="color:#1b215a;">
                                                <?php 
                                                if (is_array($data_R)) {
                                                    foreach ($data_R as $t) 
                                                    {
                                                        if(($t->logediting_isreferenced == NULL || $t->logediting_generatedby == NULL) || ($t->logediting_isreferenced == NULL && $t->logediting_generatedby == NULL)){
                                                            echo $t->logediting_code;
                                                        }else if($t->logediting_isreferenced == 1 && ($t->logediting_generatedby == (session()->get('nik')))){
                                                            echo $t->logediting_code;
                                                        }
                                                    }
                                                }
                                                ?>
                                                </H1>
                                                </center>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
</form>
                    <div class="row m-5" style="padding-bottom:2rem">
                        <div class="col-sm-12">
                            <h2 style="color:#1b215a;padding-bottom:0rem"> History</h2>
                            <br>
                            <table class="table table-sm-9 table-bordered">
                                <thead class="table-head text-center">
                                    <th>Code</th>
                                    <th>Booking Editing ID</th>
                                    <th>Booking Editing Line</th>
                                    <th>Kode Eps</th>
                                    <th>Editing Date</th>
                                    <th>Editing Shift</th>
                                    <th>Generated By</th>
                                    <th>Generated Datetime</th>
                                    <th>Login Detail Status</th>
                                </thead>
                                @foreach($reference_N as $r)
                                <tbody class="table-body text-center">
                                    @if (($r->logediting_generatedby) == (session()->get('nik')))
                                        <td><p id="textToCopy-{{$r->id}}">{{ $r->logediting_code }}</p><button class="klik btn-blue btn-sm" data-clipboard-target="#textToCopy-{{$r->id}}">Copy Code</button></td>
                                        <td>{{ $r->logediting_reference_id }}</td>
                                        <td>{{ $r->logediting_reference_line }}</td>
                                        <td>{{ $r->logediting_reference_code }}</td>
                                        <td>{{ $r->logediting_useddate }}</td>
                                        <td>{{ $r->logediting_usedshift }}</td>
                                        <td>{{ $r->logediting_generatedby }}</td>
                                        <td>{{ $r->logediting_generateddate }}</td>
                                        <td>
                                            <button type="button" class="btn btn-blue btn-sm" data-toggle="modal" data-target="#modalDetail-{{$r->id}}">View Detail
                                            </button>
                                            <div class="modal fade" id="modalDetail-{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="exampleModalLabel" style="color:#1b215a;">Detail Login Status</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row m-1">
                                                                <div class="col-sm-4 col-form-label">
                                                                    <p style="font-size:17px;">Code</p>
                                                                </div>
                                                                <div class="col-sm-8 col-form-label">
                                                                    <p style="font-size:17px;">{{ $r->logediting_code }}</p>
                                                                </div>
                                                                <div class="col-sm-4 col-form-label">
                                                                    <p style="font-size:17px;">Status Login</p>
                                                                </div>
                                                                <div class="col-sm-8 col-form-label">
                                                                    <p style="font-size:17px;">
                                                                        <?php 
                                                                            if ($r->logediting_logindate != NULL){
                                                                                echo "Sudah Login";
                                                                            }else{
                                                                                echo "Belum Login";
                                                                            }
                                                                        ?>
                                                                    
                                                                    </p>
                                                                </div>
                                                                <div class="col-sm-4 col-form-label">
                                                                    <p style="font-size:17px;">Login By</p>
                                                                </div>
                                                                <div class="col-sm-8 col-form-label">
                                                                    <p style="font-size:17px;">
                                                                    <?php 
                                                                    if (($r->logediting_loginnik != NULL) && ($r->logediting_loginname != NULL)){
                                                                        echo $r->logediting_loginnik."/".$r->logediting_loginname;
                                                                    }else{
                                                                        echo "- -";
                                                                    }
                                                                    ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-sm-4 col-form-label">
                                                                    <p style="font-size:17px;">Login Time</p>
                                                                </div>
                                                                <div class="col-sm-8 col-form-label">
                                                                    <p style="font-size:17px;">
                                                                    <?php 
                                                                    if ($r->logediting_logindate != NULL){
                                                                        echo date('d M Y', strtotime($r->logediting_logindate));
                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                    ?> 
                                                                    <?php 
                                                                    if ($r->logediting_logintime != NULL){
                                                                        echo $r->logediting_logintime;
                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                    ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-sm-4 col-form-label">
                                                                    <p style="font-size:17px;">Status Logout</p>
                                                                </div>
                                                                <div class="col-sm-8 col-form-label">
                                                                    <p style="font-size:17px;">
                                                                        <?php 
                                                                            if ($r->logediting_logoutdate != NULL){
                                                                                echo "Sudah Logout";
                                                                            }else{
                                                                                echo "Belum Logout";
                                                                            }
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-sm-4 col-form-label">
                                                                    <p style="font-size:17px;">Logout Time</p>
                                                                </div>
                                                                <div class="col-sm-8 col-form-label">
                                                                    <p style="font-size:17px;">
                                                                    <?php 
                                                                    if ($r->logediting_logoutdate != NULL){
                                                                        echo date('d M Y', strtotime($r->logediting_logoutdate));
                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                    ?> 
                                                                    <?php 
                                                                    if ($r->logediting_logouttime != NULL){
                                                                        echo $r->logediting_logouttime;
                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                    ?></p>
                                                                </div>
                                                                <div class="col-sm-4 col-form-label">
                                                                    <p style="font-size:17px;">Remark Logout</p>
                                                                </div>
                                                                <div class="col-sm-8 col-form-label">
                                                                    <p style="font-size:17px;">
                                                                    <?php 
                                                                    if ($r->logediting_remark != NULL){
                                                                        echo $r->logediting_remark;
                                                                    }else{
                                                                        echo "- -";
                                                                    }
                                                                    ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-blue btn-md" data-dismiss="modal">OK</button>
                                                    </div>
                                                </div>    
                                            </div>
                                        </td>
                                    @endif
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
</body>
    <script>
    window.onload=function(){
        setTimeout( function(){
            document.querySelectorAll('h1')[0].innerHTML='';
        },3000);
    }
    </script>
    <script type="text/javascript">    
        $(document).ready(function(){
            $('.dynamic').on('change', function(){
                if($(this).val() != ''){
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();
                    console.log(select, value, dependent);
                    $.ajax({
                        url:"{{ route('reference.fetch') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result){
                            $('#'+dependent).html(result);
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
    function autofill(){
        $('.dynamic').on('change', function(){
                if($(this).val() != ''){
                    var booking_line = $('#bookingeditingdetail_line').val();
                    var booking_id = $('#bookingediting_id').val();
                    var _token = $('input[name="_token"]').val();
                    console.log(booking_id, booking_line);
                    $.ajax({
                        url:"{{ route('reference.autofill') }}",
                        method:"POST",
                        data:{_token:_token, booking_id:booking_id, booking_line:booking_line},
                        success:function(result){
                            result = JSON.parse(result);
                            console.log(result);
                            $("#kode_eps").val(result[0].eps_code);
                            $("#editing_date").val(result[0].bookingeditingdetail_date);
                            $("#editing_shift").val(result[0].bookingeditingdetail_shift);
                        }
                    });
                }
        });
    }
    </script>
    <script type="text/javascript">  
    var clipboard = new Clipboard('.klik');
    clipboard.on('success', function(e) {
        console.log(e);
    });
    clipboard.on('error', function(e) {
        console.log(e);
    });
    </script>
    