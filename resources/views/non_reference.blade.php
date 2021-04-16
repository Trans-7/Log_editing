<link rel="icon" href="/img/logo.png">
<title>Log Editing - Non Reference</title>
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

<form action="/non_reference/store_NR" method="GET">
        <div class="col-md-12">
            <div class="col-sm-12">
                <div class="row m-5" style="padding-bottom: 2rem">
                    <div class="col-md-12">
                        <h5 style="color:#1b215a;padding-bottom: 1rem"> Hi, <?php echo session()->get('name_priviledge'); ?> - <?php echo session()->get('nik'); ?>! </h5>
                        <div class="card shadow-sm mb-2">
                            <div class="card-body">   
                            <h2 class="card-title" style="color:#1b215a;">Non Reference</h2>
                                <div class = "row m-1">
                                        
                                    <div class="col-md-2 col-form-label">
                                        Editing Date
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input class="form-control dynamic" id="editing_date" name="editing_date" value="YYYY - MM - DD" placeholder="Editing Date" required>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Editing Shift
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="form-control dynamic" id="editing_shift" name="editing_shift" value="" placeholder="Input Editing Shift (1, 2, or 3)" required>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Editing Reason
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="form-control dynamic" name="editing_reason" value="" placeholder="Input Editing Reason" required>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Program Name
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <select name="show_name" id="show_name" class="form-control dynamic" data-dependent="request_id" onfocus="this.value=''">
                                            <option value="" selected="false">--Select Program Name--</option>
                                            @foreach ($non_reference_R2 as $booking2)
                                            <option value="{{$booking2->show_name}}">{{$booking2->show_name}}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:grey;">*Pilih Nama Program (JIKA ADA - TIDAK WAJIB ISI)</p>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                            Request ID
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="request_id" id="request_id" class="form-control dynamic" data-dependent="bookingediting_ref_id" onfocus="this.value=''">
                                                    <option value="" selected="false">--Select Request ID--</option>
                                                </select>
                                                <p style="color:grey;">*Pilih Request ID (JIKA ADA - TIDAK WAJIB ISI)</p>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Prabudget ID
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="bookingediting_ref_id" id="bookingediting_ref_id" class="form-control dynamics" data-dependent="bookingeditingdetail_line" onfocus="this.value=''">
                                                    <option value="" selected="false">--Select Prabudget ID--</option>
                                                </select>
                                                <p style="color:grey;">*Pilih Prabudget ID (JIKA ADA - TIDAK WAJIB ISI)</p>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Booking Editing Line (Date & Shift)
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="bookingeditingdetail_line" id="bookingeditingdetail_line" class="form-control dynamics" onchange="autofill_NR()" onfocus="this.value=''">
                                                    <option value="" selected="false">--Select Booking Editing Line--</option>
                                                    
                                                </select>
                                                <p style="color:grey;">*Pilih Booking Editing Line (JIKA ADA - TIDAK WAJIB ISI)</p>
                                        </div>
                                    
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
                                        Editor NIK
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <select name="editor_nik" id="editor_nik" class="form-control dinamik" onfocus="this.value=''" required>
                                            <option value="" selected="false">--Select Editor NIK--</option>
                                            @foreach ($user_NR as $unr_nik)
                                                <option value="{{$unr_nik->NIK}}">{{$unr_nik->NIK}} - {{$unr_nik->Nama}}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:grey;">*Pilih NIK Editor</p>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Editor Name (auto-isi)
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="form-control " id="editor_name" name="editor_name" value="" placeholder="Editor Name" readonly/>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Editor Phone (auto-isi)
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="form-control " id="editor_phone" name="editor_phone" value="" placeholder="Editor Phone" readonly/>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Booth
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <select name="booth" id="booth" class="form-control" onfocus="this.value=''" required>
                                            <option value="" selected="false">--Select Booth--</option>
                                            @foreach ($booth_NR as $bn)
                                                <option value="{{$bn->id}}">{{$bn->nama_booth}}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:grey;">*Pilih Booth</p>
                                    </div>
                                    <br><br><br>
                                    <div class="col-md-12">
                                        <button type="submit" id="btnSubmit" class="btn btn-blue btn-lg btn-block">GENERATE CODE</button>
                                    </div>
                                    {{ csrf_field() }}
                                    <br><br><br>
                                    <div class="col-md-12 col-form-label">
                                        <h3 style="color:#1b215a;">Your Code</h3>
                                        <div class="card shadow-sm mb-2" style="padding:60px;">
                                                <center>
                                                <H1 style="color:#1b215a;">
                                                    <?php 
                                                    if (is_object($data_N)) {
                                                        if ((($data_N->logediting_isreferenced == 0 || $data_N->logediting_isreferenced == NULL || $data_N->logediting_generatedby == NULL ) && ($data_N->logediting_generatedby == session()->get('nik')))){
                                                             echo $data_N->logediting_code;
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
                    <div class="row m-5" style="padding-bottom:2rem;">
                        <div class="col-sm-12">
                            <h2 style="color:#1b215a;"> History</h2>
                            <br>
                            <table class="table table-bordered data-tablee">
                                <thead class="thead_d">
                                    <tr>
                                        <th>Code</th>
                                        <th>Editor NIK</th>
                                        <th>Editor Name</th>
                                        <th>Booth</th>
                                        <th>Editing Date</th>
                                        <th>Editing Shift</th>
                                        <th>Editing Reason</th>
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
    <script type="text/javascript">
        $(function(){
            $("#editing_date").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>
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
                        url:"{{ route('non_reference.fetch_NR') }}",
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
                        url:"{{ route('non_reference.fetchs_NR') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result){
                            $('#'+dependent).html(result);
                        }
                    });
                }
            });
            $('.dinamik').on('change', function(){
                if($(this).val() != ''){
                    var editor_nik = $('#editor_nik').val();
                    var _token = $('input[name="_token"]').val();
                    console.log(editor_nik);
                    $.ajax({
                        url:"{{ route('non_reference.autofill_editorNR') }}",
                        method:"POST",
                        data:{_token:_token, editor_nik:editor_nik},
                        success:function(result){
                            result = JSON.parse(result);
                            console.log(result);
                            $("#editor_name").val(result[0].Nama);
                            $("#editor_phone").val(result[0].NomorHP);
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
    function autofill_NR(){
        $('.dynamics').on('change', function(){
                if($(this).val() != ''){
                    var booking_line = $('#bookingeditingdetail_line').val();
                    var show_name = $('#show_name').val();
                    var request_id = $('#request_id').val();
                    var bookingediting_ref_id = $('#bookingediting_ref_id').val();
                    var _token = $('input[name="_token"]').val();
                    console.log(show_name, booking_line);
                    $.ajax({
                        url:"{{ route('non_reference.autofill_NR') }}",
                        method:"POST",
                        data:{_token:_token, show_name:show_name, booking_line:booking_line, request_id:request_id,bookingediting_ref_id:bookingediting_ref_id},
                        success:function(result){
                            result = JSON.parse(result);
                            console.log(result);
                            if($("#bookingediting_id").val() != $("#bookingediting_id").val(result.slice(-1)[0].bookingediting_id)){
                                $("#bookingediting_id").val(result.slice(-1)[0].bookingediting_id);
                            }
                            if($("#kode_eps").val() != $("#kode_eps").val(result.slice(-1)[0].eps_code)){
                                $("#kode_eps").val(result.slice(-1)[0].eps_code);
                            }
                            if($("#editing_shift").val() == 0){
                                $("#editing_shift").val(result.slice(-1)[0].bookingeditingdetail_shift);
                            }else{
                                $("#editing_shift").val()
                            }
                            if($("#editing_date").val() == 0){
                                $("#editing_date").val(result.slice(-1)[0].bookingeditingdetail_date);
                            }else{
                                $("#editing_date").val()
                            }
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
            
            var table = $('.data-tablee').DataTable({
                order: [],
                aaSorting: [],
                processing: true,
                serverSide: true,
                ajax: "{{ route('non_reference.search_N') }}",
                columns: [
                    {data: 'logediting_code', name: 'logediting_code',
                        render: function ( data, type, row ) {
                            return '<center><p id="textToCopy-'+ row.id + '">'+ row.logediting_code +'</p><button class="klik btn-blue btn-sm" data-clipboard-target="#textToCopy-'+ row.id + '">Copy Code</button></center>';
                        }
                    },
                    {data: 'logediting_editor_nik', name: 'logediting_editor_nik'},
                    {data: 'logediting_editor_name', name: 'logediting_editor_name'},
                    {data: 'nama_booth', name: 'nama_booth'},
                    {data: 'logediting_useddate', name: 'logediting_useddate'},
                    {data: 'logediting_usedshift', name: 'logediting_usedshift'},
                    {data: 'logediting_reason', name: 'logediting_reason'},
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