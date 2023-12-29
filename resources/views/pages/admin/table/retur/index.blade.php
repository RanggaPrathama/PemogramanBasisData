@extends('layouts.appAdmin')

@section('content')

    <body>
        <!-- TABLE MAIN  -->
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Table Retur</h1>

                <nav>
                    <ol class='breadcrumb'>
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Tables</li>
                        <li class="breadcrumb-item active">Retur Table</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show col-md-12" id="success-alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        @endif
        @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show col-md-12" id="success-alert">
            {{ session('errors') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Table Retur</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="{{ route('retur.create') }}"><button class='btn btn-primary' style="margin-bottom: 5px"> + Retur
                                </button></a>
                                {{-- <a href="{{ route('barang.trash') }}"><button class='btn btn-success' style="margin-bottom: 5px"> Trash <i class="bi bi-trash3"></i>
                                </button></a> --}}
                                <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                        <tr>
                                            <th scope="col">Id Retur</th>
                                            <th scope="col">Id Penerimaan</th>
                                            <th scope="col"> ID User</th>
                                            <th scope="col">Created_at</th>

                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($penerimaans as $penerimaan )
                                        <tr>
                                            <td>{{ $penerimaan->id_penerimaan }}</td>
                                            <td>{{ $penerimaan->id_pengadaan }}</td>
                                            <td>{{ $penerimaan->username }}</td>
                                            <td>{{ $penerimaan->created_at }}</td>
                                            <td>
                                            @if ($penerimaan->status == 1)
                                                <p class="text-success"> SUCCESS</p>

                                                 @endif

                                            </td>

                                            <td>
                                                <button class="btn btn-primary" onclick="detail({{ $penerimaan->id_penerimaan}})"> DETAIL </button>
                                            </td>
                                        </tr>

                                        @endforeach --}}


                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- MODAL -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Penerimaan</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <table  id="tableDetail" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Iddetail_penerimaan</th>
                                            <th scope="col">Id Penerimaan</th>
                                            <th scope="col">Id Barang</th>
                                            <th scope="col">Harga Satuan</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody >

                                    </tbody>
                                  </table>
                                </div>
                                {{-- <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary">Save changes</button>
                                </div> --}}
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </section>

        </main><!-- End #main -->

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <script>
            function detail(id){

                $.ajax({
                    type: "GET",
                    url: `/penerimaan/detail/${id}`,
                    dataType: "JSON",
                    success: function (data) {
                        console.log(data);


                        $('#tableDetail tbody').empty();
                        if(data.length>0){
                        for(let i=0; i<data.length; i++){
                            let row = `
                                        <tr>
                                            <td>${data[i].iddetail_penerimaan}</td>
                                            <td>${data[i].id_penerimaan}</td>
                                            <td>${data[i].id_barang}</td>
                                            <td>${data[i].harga_satuan_terima}</td>
                                            <td>${data[i].jumlah_terima}</td>
                                            <td>${data[i].sub_total_terima}</td>
                                            </tr>`;

                                            $('#tableDetail tbody').append(row);
                        };


                        $('#exampleModal').modal('show');

                    }
                    else{
                        alert('DATA TIDAK DITEMUKAN !');
                    }

                    }
                });


            }
        </script>



               <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
  $("#example1").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "buttons": [
      {
        extend: 'copy',
        text: 'Copy',
        className: 'btn-sm'
      },
      {
        extend: 'csv',
        text: 'CSV',
        className: 'btn-sm'
      },
      {
        extend: 'excel',
        text: 'Excel',
        className: 'btn-sm'
      },
      {
        extend: 'pdf',
        text: 'PDF',
        className: 'btn-sm'
      },
      {
        extend: 'print',
        text: 'Print',
        className: 'btn-sm'
      },
      'colvis'
    ]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

  </script>


    </body>
@endsection
