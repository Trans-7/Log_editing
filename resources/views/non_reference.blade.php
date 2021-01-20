<link rel="icon" href="/img/logo.png">
<title>Log Editing - Non Reference</title>
@include ('head+nav')

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
                                        <input class="form-control dynamic" id="editing_date" name="editing_date" value="Editing Date" placeholder="Editing Date" required>
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
                                        Booking Editing ID
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <select name="bookingediting_id" id="bookingediting_id" class="form-control dynamic" data-dependent="bookingeditingdetail_line">
                                            <option value="" selected="false">--Select Booking Editing ID--</option>
                                            @foreach ($non_reference_R as $booking)
                                                <option value="{{$booking->bookingediting_id}}">{{$booking->bookingediting_id}}</option>
                                                @endforeach
                                        </select>
                                        <p style="color:grey;">*Ketik Booking Editing ID (JIKA ADA - TIDAK WAJIB DIISI)
                                    </div>
                                    
                                    <div class="col-md-2 col-form-label">
                                        Booking Editing Line
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <select name="bookingeditingdetail_line" id="bookingeditingdetail_line" class="form-control dynamic" onchange="autofill_NR()">
                                            <option value="" selected="false">--Select Booking Editing Line--</option>
                                        </select>
                                        <p style="color:grey;">*Pilih Booking Editing Line (JIKA ADA - TIDAK WAJIB DIISI)</p>
                                    </div>
                                    {{ csrf_field() }}
                                    <div class="col-md-2 col-form-label">
                                        Kode Eps
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="form-control dynamic" id="kode_eps" name="kode_eps" value="" placeholder="Episode Code" readonly/>
                                    </div>
                                    <br><br><br>
                                    <div class="col-md-12">
                                        <button type="submit" id="btnSubmit" class="btn btn-blue btn-lg btn-block">GENERATE CODE</button>
                                    </div>
                                    <br><br><br>
                                    <div class="col-md-12 col-form-label">
                                        <h4 style="color:#1b215a;">Your Code</h4>
                                        <div class="card shadow-sm mb-2" style="padding:60px;">
                                                <center>
                                                <H1 style="color:#1b215a;">
                                                    <?php 
                                                    if (($data_N->logediting_isreferenced != 1) && (($data_N->logediting_generatedby) == (session()->get('nik')))){
                                                        echo $data_N->logediting_code;
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
                    <div class="col-sm-12">
                        <br>
                        <h3 style="color:#1b215a;"> History</h3>
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
                           
                            @foreach($non_reference_N as $n)
                            <tbody class="table-body text-center">
                                @if (($n->logediting_generatedby) == (session()->get('nik')))
                                    <td>{{ $n->logediting_code }}</td>
                                    <td>{{ $n->logediting_reference_id }}</td>
                                    <td>{{ $n->logediting_reference_line }}</td>
                                    <td>{{ $n->logediting_reference_code }}</td>
                                    <td>{{ $n->logediting_useddate }}</td>
                                    <td>{{ $n->logediting_usedshift }}</td>
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
                    </div>
                </div>
            </div>
        </div>
</form>
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
                        url:"{{ route('non_reference.fetch_NR') }}",
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
        $('.dynamic').on('change', function(){
                if($(this).val() != ''){
                    var booking_line = $('#bookingeditingdetail_line').val();
                    var booking_id = $('#bookingediting_id').val();
                    var _token = $('input[name="_token"]').val();
                    console.log(booking_id, booking_line);
                    $.ajax({
                        url:"{{ route('non_reference.autofill_NR') }}",
                        method:"POST",
                        data:{_token:_token, booking_id:booking_id, booking_line:booking_line },
                        success:function(result){
                            result = JSON.parse(result);
                            console.log(result);
                            if($("#kode_eps").val() != $("#kode_eps").val(result[0].eps_code)){
                                $("#kode_eps").val(result[0].eps_code);
                            }
                            if($("#editing_shift").val() == 0){
                                $("#editing_shift").val(result[0].bookingeditingdetail_shift);
                            }else{
                                $("#editing_shift").val()
                            }
                            if($("#editing_date").val() == 0){
                                $("#editing_date").val(result[0].bookingeditingdetail_date);
                            }else{
                                $("#editing_date").val()
                            }
                        }
                    });
                }
            });
    }
    </script>