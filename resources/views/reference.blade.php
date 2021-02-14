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
                    <h5><a class="nav-link" href="/non_reference" style="margin-left:50px;"><?php if ((session()->get('priviledge')) == 1 ){echo "Non Reference";}?></a></h5>
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
                                            Program Name
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="show_name" id="show_name" class="form-control dynamic" data-dependent="request_id" onfocus="this.value=''" required>
                                                    <option value="" selected="false">--Select Program Name--</option>
                                                    @foreach ($reference_R2 as $booking2)
                                                    <option value="{{$booking2->show_name}}">{{$booking2->show_name}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:grey;">*Pilih Nama Program</p>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Request ID
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="request_id" id="request_id" class="form-control dynamic" data-dependent="bookingediting_ref_id" onfocus="this.value=''" required>
                                                    <option value="" selected="false">--Select Request ID--</option>
                                                </select>
                                                <p style="color:grey;">*Pilih Request ID</p>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Prabudget ID
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="bookingediting_ref_id" id="bookingediting_ref_id" class="form-control dynamics" data-dependent="bookingeditingdetail_line" onfocus="this.value=''" required>
                                                    <option value="" selected="false">--Select Prabudget ID--</option>
                                                </select>
                                                <p style="color:grey;">*Pilih Prabudget ID</p>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Booking Editing Line (Date & Shift)
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="bookingeditingdetail_line" id="bookingeditingdetail_line" class="form-control dynamics" onchange="autofill()" onfocus="this.value=''" required>
                                                    <option value="" selected="false">--Select Booking Editing Line--</option>
                                                    
                                                </select>
                                                <p style="color:grey;">*Pilih Booking Editing Line</p>
                                        </div>
                                        {{ csrf_field() }}
                                        <div class="col-md-2 col-form-label">
                                            Booking Editing ID (auto-isi)
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                            <input type="text" class="form-control dynamics" id="bookingediting_id" name="bookingediting_id" value="" placeholder="Booking Editing ID" readonly/>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Kode Eps (auto-isi)
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                            <input type="text" class="form-control dynamics" id="kode_eps" name="kode_eps" value="" placeholder="Episode Code" readonly/>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Editing Date (auto-isi)
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                            <input type="text" class="form-control dynamics" id="editing_date" name="editing_date" value="" placeholder="Editing Date" readonly/>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Editing Shift (auto-isi)
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                            <input type="text" class="form-control dynamics" id="editing_shift" name="editing_shift" value="" placeholder="Editing Shift" readonly/>
                                        </div><br><br><br>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-blue btn-lg btn-block">GENERATE CODE</button>
                                        </div>
                                        <br><br><br>
                                        <div class="col-md-12 col-form-label">
                                            <h3 style="color:#1b215a;">Your Code</h3>
                                            <div class="card shadow-sm mb-2" style="padding:60px;"> 
                                                <center>
                                                <H1 style="color:#1b215a;">
                                                <?php 
                                                if (is_object($data_R)) {
                                                    if ((($data_R->logediting_isreferenced == 1 || $data_R->logediting_isreferenced == NULL || $data_R->logediting_generatedby == NULL ) && ($data_R->logediting_generatedby == session()->get('nik')))){
                                                         echo $data_R->logediting_code;
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
                            <table class="table table-bordered data-table">
                                <thead class="thead_d">
                                    <tr>
                                        <th>Code</th>
                                        <th>Editing Date</th>
                                        <th>Editing Shift</th>
                                        <th>Program Name</th>
                                        <th>Request ID</th>
                                        <th>Prabudget ID</th>
                                        <th>Booking Editing ID</th>
                                        <th>Booking Editing Line</th>
                                        <th>Kode Eps</th>
                                        <th>Generated Datetime</th>
                                        <th width="100px">Login Detail Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
</body>
    <script>
    window.onload=function(){
        setTimeout( function(){
            document.querySelectorAll('h1')[0].innerHTML='';
        },10000);
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

            $('.dynamics').on('change', function(){
                if($(this).val() != ''){
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();
                    console.log(select, value, dependent);
                    $.ajax({
                        url:"{{ route('reference.fetchs') }}",
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
        $('.dynamics').on('change', function(){
                if($(this).val() != ''){
                    var booking_line = $('#bookingeditingdetail_line').val();
                    var show_name = $('#show_name').val();
                    var request_id = $('#request_id').val();
                    var bookingediting_ref_id = $('#bookingediting_ref_id').val();
                    var _token = $('input[name="_token"]').val();
                    console.log(show_name, booking_line, bookingediting_ref_id, request_id );
                    $.ajax({
                        url:"{{ route('reference.autofill') }}",
                        method:"POST",
                        data:{_token:_token, show_name:show_name, booking_line:booking_line, request_id:request_id,bookingediting_ref_id:bookingediting_ref_id},
                        success:function(result){
                            result = JSON.parse(result);
                            console.log(result);
                            $("#bookingediting_id").val(result.slice(-1)[0].bookingediting_id);
                            $("#kode_eps").val(result.slice(-1)[0].eps_code);
                            $("#editing_date").val(result.slice(-1)[0].bookingeditingdetail_date);
                            $("#editing_shift").val(result.slice(-1)[0].bookingeditingdetail_shift);
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
    <script type="text/javascript">
        $(function () {
            
            var table = $('.data-table').DataTable({
                order: [],
                aaSorting: [],
                processing: true,
                serverSide: true,
                ajax: "{{ route('reference.search') }}",
                columns: [
                    {data: 'logediting_code', name: 'logediting_code',
                        render: function ( data, type, row ) {
                            return '<center><p id="textToCopy-'+ row.id + '">'+ row.logediting_code +'</p><button class="klik btn-blue btn-sm" data-clipboard-target="#textToCopy-'+ row.id + '">Copy Code</button></center>';
                        }
                    },
                    {data: 'logediting_useddate', name: 'logediting_useddate'},
                    {data: 'logediting_usedshift', name: 'logediting_usedshift'},
                    {data: 'logediting_program', name: 'logediting_program'},
                    {data: 'logediting_requestid', name: 'logediting_requestid'},
                    {data: 'logediting_prabudgetid', name: 'logediting_prabudgetid'},
                    {data: 'logediting_reference_id', name: 'logediting_reference_id'},
                    {data: 'logediting_reference_line', name: 'logediting_reference_line'},
                    {data: 'logediting_reference_code', name: 'logediting_reference_code'},
                    {data: 'logediting_generateddate', name: 'logediting_generateddate'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
            });
        });
    </script>
    