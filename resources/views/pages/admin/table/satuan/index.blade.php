@extends('layouts.appAdmin')

@section('content')

    <body>
        <!-- TABLE MAIN  -->
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Table Satuan</h1>

                <nav>
                    <ol class='breadcrumb'>
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Tables</li>
                        <li class="breadcrumb-item active">Satuan Table</li>
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
                                <h3 class="card-title">CRUD Table Satuan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="{{ route('satuan.create') }}"><button class='btn btn-primary' style="margin-bottom: 5px"> + Tambah Data
                                </button></a>

                                <a href="{{ route('satuan.trash') }}"><button class='btn btn-success' style="margin-bottom: 5px"> Trash <i class="bi bi-trash3"></i>
                                </button></a>

                                <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                        <tr>
                                            <th scope="col">id Satuan</th>
                                            <th scope="col">Nama Satuan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($satuans as $satuan)
                                            <tr>
                                                <th scope="row">{{ $satuan->id_satuan }}</th>
                                                <td>{{ $satuan->nama_satuan}}</td>

                                                <td>
                                                    @if($satuan->status == 1)

                                                    <h6>Aktif</h6>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($satuan->status == 1)
                                                    <a href="{{ route('satuan.edit',$satuan->id_satuan) }}"> <button class="btn btn-success"><i
                                                                class="bi bi-pencil-square"></i></button></a>

                                                                <form action="{{ route('satuan.destroy', $satuan->id_satuan) }}"
                                                                    method="POST" style="display: inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ?')"
                                                                    class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button>


                                                                </form>


                                                                @endif

                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                </div>
            </section>

        </main><!-- End #main -->

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
