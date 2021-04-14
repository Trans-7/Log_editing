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
                                        <th>Editing Reason</th>
                                        <th>Booking Editing ID</th>
                                        <th>Booking Editing Line</th>
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
        $(function () {
            
            $('.data-table2').DataTable({
                order: [],
                aaSorting: [],
                processing: true,
                serverSide: true,
                ajax: "{{ route('historycal.index') }}",
                columns: [
                    {data: 'logediting_code', name: 'logediting_code',
                        render: function ( data, type, row ) {
                            return '<center><p id="textToCopy-'+ row.id + '">'+ row.logediting_code +'</p><button class="klik btn-blue btn-sm" data-clipboard-target="#textToCopy-'+ row.id + '">Copy Code</button></center>';
                        }
                    },
                    {data: 'logediting_program', name: 'logediting_program'},
                    {data: 'logediting_editor_nik', name: 'logediting_editor_nik'},
                    {data: 'logediting_editor_name', name: 'logediting_editor_name'},
                    {data: 'logediting_editor_phone', name: 'logediting_editor_phone'},
                    {data: 'nama_booth', name: 'nama_booth'},
                    {data: 'logediting_reason', name: 'logediting_reason'},
                    {data: 'logediting_reference_id', name: 'logediting_reference_id'},
                    {data: 'logediting_reference_line', name: 'logediting_reference_line'},
                    {data: 'logediting_reference_code', name: 'logediting_reference_code'},
                    {data: 'logediting_generateddate', name: 'logediting_generateddate'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
            $('.data-table2').on('click', '.editCustomer', function () {
                var id = $(this).data('id');
                $.get("" +'/' + id +'/edit', function (data) {
                    $('#action_button').val("edit-user");
                    $('#edit').modal('show');
                    $('#hidden_id').val(data.id);
                    $('#editor_nik').val(data.logediting_editor_nik);
                    $('#editor_name').val(data.logediting_editor_name);
                    $('#editor_phone').val(data.logediting_editor_phone);
                    $('#booth').val(data.nama_booth);
                })
            });
            $('#action_button').click(function (e) {
                    e.preventDefault();
                    $(this).html('Sending..');

                    $.ajax({
                    data: $('#sample_form').serialize(),
                    url: "",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {

                        $('#sample_form').trigger("reset");
                        $('#edit').modal('hide');
                        table.draw();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#action_button').html('Save Changes');
                    }
                });
            });
        });
        
    </script>