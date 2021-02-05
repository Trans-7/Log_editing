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

<form action="/non_reference/store_NR" method="GET">
        <div class="col-md-12">
            <div class="col-sm-12">
                <div class="row m-5" style="padding-bottom: 2rem">
                    <div class="col-md-12">
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
                                        <select name="show_name" id="show_name" class="form-control dynamic" data-dependent="request_id">
                                            <option value="" selected="false">--Select Program Name--</option>
                                            @foreach ($non_reference_R2 as $booking2)
                                            <option value="{{$booking2->show_name}}">{{$booking2->show_name}}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:grey;">*Pilih Nama Program</p>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                            Request ID
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="request_id" id="request_id" class="form-control dynamic" data-dependent="bookingediting_ref_id" required>
                                                    <option value="" selected="false">--Select Request ID--</option>
                                                </select>
                                                <p style="color:grey;">*Pilih Request ID</p>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Prabudget ID
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="bookingediting_ref_id" id="bookingediting_ref_id" class="form-control dynamics" data-dependent="bookingeditingdetail_line" required>
                                                    <option value="" selected="false">--Select Prabudget ID--</option>
                                                </select>
                                                <p style="color:grey;">*Pilih Prabudget ID</p>
                                        </div>
                                        <div class="col-md-2 col-form-label">
                                            Booking Editing Line (Date & Shift)
                                        </div>
                                        <div class="col-md-10 col-form-label">
                                                <select name="bookingeditingdetail_line" id="bookingeditingdetail_line" class="form-control dynamics" onchange="autofill_NR()" required>
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
                                    <br><br><br>
                                    <div class="col-md-12">
                                        <button type="submit" id="btnSubmit" class="btn btn-blue btn-lg btn-block">GENERATE CODE</button>
                                    </div>
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
                    <div class="row m-5" style="padding-bottom:2rem">
                        <div class="col-sm-12">
                            <h3 style="color:#1b215a;"> History</h3>
                            <br>
                            
                            <input type="search" placeholder="Search Data..." class="form-control search-input" data-table="logediting-list" style="width: 500px;margin-right: auto;float: left; margin-bottom:20px;">

                            <table class="table table-sm-9 table-bordered logediting-list">
                                <thead class="table-head text-center">
                                    <th>Code</th>
                                    <th>Program Name</th>
                                    <th>Request ID</th>
                                    <th>Prabudget ID</th>
                                    <th>Booking Editing ID</th>
                                    <th>Booking Editing Line</th>
                                    <th>Kode Eps</th>
                                    <th>Editing Date</th>
                                    <th>Editing Shift</th>
                                    <th>Editing Reason</th>
                                    <th>Generated By</th>
                                    <th>Generated Datetime</th>
                                    <th>Login Detail Status</th>
                                </thead>
                            
                                @foreach($non_reference_N as $n)
                                <tbody class="table-body text-center">
                                    @if (($n->logediting_generatedby) == (session()->get('nik')))
                                        <td><p id="textToCopy-{{$n->id}}">{{ $n->logediting_code }}</p><button class="klik btn-blue btn-sm" data-clipboard-target="#textToCopy-{{$n->id}}">Copy Code</button></td>
                                        <td>{{ $n->logediting_program }}</td>
                                        <td>{{ $n->logediting_requestid }}</td>
                                        <td>{{ $n->logediting_prabudgetid }}</td>
                                        <td>{{ $n->logediting_reference_id }}</td>
                                        <td>{{ $n->logediting_reference_line }}</td>
                                        <td>{{ $n->logediting_reference_code }}</td>
                                        <td>{{ $n->logediting_useddate }}</td>
                                        <td>{{ $n->logediting_usedshift }}</td>
                                        <td>{{ $n->logediting_reason }}</td>
                                        <td>{{ $n->logediting_generatedby }}</td>
                                        <td>{{ $n->logediting_generateddate }}</td>
                                        <td>
                                        <button type="button" class="btn btn-blue btn-sm" data-toggle="modal" data-target="#modalDetail-{{$n->id}}">View Detail
                                            </button>

                                            <div class="modal fade" id="modalDetail-{{$n->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <p style="font-size:17px;">{{ $n->logediting_code }}</p>
                                                            </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                    <p style="font-size:17px;">Program Name</p>
                                                                </div>
                                                                <div class="col-sm-8 col-form-label">
                                                                    <p style="font-size:17px;">
                                                                    <?php 
                                                                    if ($n->logediting_program != NULL){
                                                                        echo $n->logediting_program;
                                                                    }else{
                                                                        echo "- -";
                                                                    }
                                                                    ?>
                                                                    </p>
                                                                </div>
                                                            <div class="col-sm-4 col-form-label">
                                                                <p style="font-size:17px;">Status Login</p>
                                                            </div>
                                                            <div class="col-sm-8 col-form-label">
                                                                <p style="font-size:17px;">
                                                                    <?php 
                                                                        if ($n->logediting_logindate != NULL){
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
                                                                if (($n->logediting_loginnik != NULL) && ($n->logediting_loginname != NULL)){
                                                                    echo $n->logediting_loginnik."/".$n->logediting_loginname;
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
                                                                if ($n->logediting_logindate != NULL){
                                                                    echo date('d M Y', strtotime($n->logediting_logindate));
                                                                }else{
                                                                    echo "-";
                                                                }
                                                                ?> 
                                                                <?php 
                                                                if ($n->logediting_logintime != NULL){
                                                                    echo $n->logediting_logintime;
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
                                                                        if ($n->logediting_logoutdate != NULL){
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
                                                                if ($n->logediting_logoutdate != NULL){
                                                                    echo date('d M Y', strtotime($n->logediting_logoutdate));
                                                                }else{
                                                                    echo "-";
                                                                }
                                                                ?> 
                                                                <?php 
                                                                if ($n->logediting_logouttime != NULL){
                                                                    echo $n->logediting_logouttime;
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
                                                                if ($n->logediting_remark != NULL){
                                                                    echo $n->logediting_remark;
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
                            Halaman : {{ $non_reference_N->currentPage() }} <br/>
                            Jumlah Data : {{ $non_reference_N->total() }} <br/>
                            Data Per Halaman : {{ $non_reference_N->perPage() }} <br/><br/>
                        
                            {{ $non_reference_N->links() }}
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
    <script>
        (function(document) {
            'use strict';

            var TableFilter = (function(myArray) {
                var search_input;

                function _onInputSearch(e) {
                    search_input = e.target;
                    var tables = document.getElementsByClassName(search_input.getAttribute('data-table'));
                    myArray.forEach.call(tables, function(table) {
                        myArray.forEach.call(table.tBodies, function(tbody) {
                            myArray.forEach.call(tbody.rows, function(row) {
                                var text_content = row.textContent.toLowerCase();
                                var search_val = search_input.value.toLowerCase();
                                row.style.display = text_content.indexOf(search_val) > -1 ? '' : 'none';
                            });
                        });
                    });
                }

                return {
                    init: function() {
                        var inputs = document.getElementsByClassName('search-input');
                        myArray.forEach.call(inputs, function(input) {
                            input.oninput = _onInputSearch;
                        });
                    }
                };
            })(Array.prototype);

            document.addEventListener('readystatechange', function() {
                if (document.readyState === 'complete') {
                    TableFilter.init();
                }
            });

        })(document);
    </script>