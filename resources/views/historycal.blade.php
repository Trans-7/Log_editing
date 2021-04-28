<link rel="icon" href="/img/logo.png">
<title>Log Editing - Historycal</title>
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
                    <h5><a class="nav-link" href="/historycal" style="margin-left:50px;">History Data</a></h5>
                </li>
                <li class="nav-item dropdown">
                    <h5>
                        <a class="nav-link dropdown-toggle" href="/report" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:50px;">
                        Report
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/report">Report Editor</a>
                            <!-- <a class="dropdown-item" href="/test">Report Booth</a> -->
                        </div>
                    </h5>
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
<body>
                    <div class="row m-5" style="padding-bottom:2rem">
                        <div class="col-sm-12">
                            <h2 style="color:#1b215a;padding-bottom:0rem"> Historycal Editor</h2>
                            <br>
                            <table class="table table-bordered data-table2">
                                <thead class="thead_d">
                                    <tr>
                                        <th>Code</th>
                                        <th>Program</th>
                                        <th>Editor NIK</th>
                                        <th>Editor Name</th>
                                        <th>Editor Phone</th>
                                        <th>Booth</th>
                                        <th>Editing Date</th>
                                        <th>Editing Shift</th>
                                        <th>Kode Eps</th>
                                        <th>Generated Datetime</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal modal-warning fade" id="modal_edit">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" style="color:#1b215a;">Edit Booth</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="edit_form">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" id="item_id" value="0" />

                                            <label for="editor_nik">Editor NIK :</label><br>
                                            <select name="editor_nik" id="editor_nik" class="form-control dinamik" required></select><br>

                                            <label for="editor_name">Editor Name :</label>
                                            <input name="editor_name" id="editor_name" type="text" value="" class="form-control dinamik" placeholder="Editor Name" readonly>

                                            <label for="editor_phone">Editor Phone :</label>
                                            <input name="editor_phone" id="editor_phone" type="text" value="" class="form-control dinamik" placeholder="Editor Phone" readonly>

                                            <label for="editing_date">Editing Date :</label>
                                            <input  name="editing_date" id="editing_date" type="text" value="" class="form-control " placeholder="Editing Date" readonly>

                                            <label for="editing_shift">Editing Shift :</label>
                                            <input  name="editing_shift" id="editing_shift" type="text" value="" class="form-control " placeholder="Editing Shift" readonly>

                                            <label for="nama_booth">Booth :</label>
                                            <select name="nama_booth" id="nama_booth" class="form-control " required>
                                                    <option value="" selected="false">--Selectdf Booth--</option>
                                                    <!-- @foreach($booth_H as $h)
                                                        <option selected="false" value="{{$h->id}}">{{$h->nama_booth}}</option>
                                                    @endforeach -->

                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-blue btn-md pull-left" data-dismiss="modal">Cancel</button>
                                        <button id="edit_action" type="submit" class="btn btn-blue btn-md">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
</body>

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
        var YajraDataTable;
        function edit_action(this_el, item_id){
            $('#item_id').val(item_id);
            var tr_el = this_el.closest('tr');
            var row = YajraDataTable.row(tr_el);
            var row_data = row.data();
            $('#editor_nik').val(row_data.logediting_editor_nik);
            $('#editor_name').val(row_data.logediting_editor_name);
            $('#editor_phone').val(row_data.logediting_editor_phone);
            $('#editing_date').val(row_data.logediting_useddate);
            $('#editing_shift').val(row_data.logediting_usedshift);
            $('#nama_booth').val(row_data.logeditingboot_id);

            var editing_date = $('#editing_date').val();
            var editing_shift = $('#editing_shift').val();
            var _token = $('input[name="_token"]').val();
            console.log(editing_date, editing_shift);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('historycal.booth') }}",
                method:"POST",
                data:{_token:_token, editing_date:editing_date, editing_shift:editing_shift, booth_id: row_data.logeditingboot_id, booth_name : row_data.nama_booth},
                success:function(result){
                    // console.log(result);
                    $("#nama_booth").html(result);
                }
            });
            
        }
        function data_table2(){
            YajraDataTable = $('.data-table2').DataTable({
                order: [],
                aaSorting: [],
                processing: true,
                serverSide: true,
                ajax: "{{ route('historycal.index') }}",
                columns: [
                    {data: 'logediting_code', name: 'logediting_code',
                        render: function ( data, type, row, meta ) {
                            return '<center><p id="textToCopy-'+ row.id + '">'+ row.logediting_code +'</p><button class="klik btn-blue btn-sm" data-clipboard-target="#textToCopy-'+ row.id + '">Copy Code</button></center>';
                        }
                    },
                    {data: 'logediting_program', name: 'logediting_program'},
                    {data: 'logediting_editor_nik', name: 'logediting_editor_nik'},
                    {data: 'logediting_editor_name', name: 'logediting_editor_name'},
                    {data: 'logediting_editor_phone', name: 'logediting_editor_phone'},
                    {data: 'nama_booth', name: 'nama_booth'},
                    {data: 'logediting_useddate', name: 'logediting_useddate'},
                    {data: 'logediting_usedshift', name: 'logediting_usedshift'},
                    {data: 'logediting_reference_code', name: 'logediting_reference_code'},
                    {data: 'logediting_generateddate', name: 'logediting_generateddate'},
                    {data: 'action', name: 'action', orderable: false, searchable: false,
                        render: function ( data, type, row ) {
                            return '<div style="display:block">' +'<center><button onclick="' + row.action + '</button></center>'+
                            '<center><button onclick="edit_action(this, ' + row.id + ')" type="button" class="edit_action btn btn-blue btn-sm" data-toggle="modal" data-target="#modal_edit" style="margin:3px">Edit Booth</button></center>' +
                            '</div>';
                        }
                    },
                ],
            });
            return YajraDataTable;
        }
        $(document).ready(function() {
            var YajraDataTable = data_table2();

            $('#edit_form').on('submit', function(event){
                event.preventDefault();
            
                $.ajax({
                    url: "{{ route('historycal.update') }}",
                    type: "POST",
                    data: {
                        id: $('#item_id').val(),
                        logediting_editor_nik: $('#editor_nik').val(),
                        logediting_editor_name: $('#editor_name').val(),
                        logediting_editor_phone: $('#editor_phone').val(),
                        logediting_useddate: $('#editing_date').val(),
                        logediting_usedshift: $('#editing_shift').val(),
                        nama_booth: $('#nama_booth').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        $('#modal_edit').modal('hide');
                        YajraDataTable.ajax.reload(null, false);
                        // console.log(data.message);
                    }
                })
            });

            $('#modal_edit').on('hidden.bs.modal', function () {
                $('#item_id').val(0);
                $('#editor_nik').val("");
                $('#editor_name').val("");
                $('#editor_phone').val("");
                $('#editing_date').val("");
                $('#editing_shift').val("");
                $('#nama_booth').val("");
            });
            $('.dinamik').on('change', function(){
                if($(this).val() != ''){
                    var editor_nik = $('#editor_nik').val();
                    var _token = $('input[name="_token"]').val();
                    console.log(editor_nik);
                    $.ajax({
                        url:"{{ route('historycal.autofill_editor') }}",
                        method:"POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
            $('#editor_nik').select2({
                placeholder: '-------------------------Select Editor NIK-------------------------',
                ajax: {
                    url: "{{ route('reference.autocomplete') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.NIK + ' - ' + item.Nama,
                                    id: item.NIK
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            
        });
        
    </script>
    <script>
    
            // $('#nama_booth').on('click', function(){
            //     console.log('onchange');
            //     // $('#nama_booth').val("");
            //     if($('#nama_booth').val() == ''){
            //         var editing_date = $('#editing_date').val();
            //         var editing_shift = $('#editing_shift').val();
            //         var _token = $('input[name="_token"]').val();
            //         console.log(editing_date, editing_shift);
            //         $.ajax({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             url:"{{ route('historycal.booth') }}",
            //             method:"POST",
            //             data:{_token:_token, editing_date:editing_date, editing_shift:editing_shift},
            //             success:function(result){
            //                 console.log(result);
            //                 $("#nama_booth").html(result);
            //             }
            //         });
            //     }
            // });
        
    
    </script>