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
                                <h3 class="card-title">Trash Table Satuan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="{{ route('satuan.index') }}"><button class='btn btn-primary' style="margin-bottom: 5px"> <i class="bi bi-arrow-bar-left"></i> Data Satuan
                                </button></a>

                                @if(count($satuans))
                                <form action="{{ route('satuan.restoreall') }}"
                                method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" onclick="return confirm('Apakah anda ingin memulihkan data semua ?')"
                                class="btn btn-success">Pulihkan Semua <i class="bi bi-arrow-clockwise"></i></button>
                            </form>
                            @endif


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
                                                    @if($satuan->status == 0)
                                                    <h6>Tidak Aktif</h6>


                                                    @endif
                                                </td>
                                                <td>
                                                    @if($satuan->status == 0)


                                                                <form action="{{ route('satuan.restore',$satuan->id_satuan) }}"
                                                                    method="POST" style="display: inline-block;">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" onclick="return confirm('Apakah anda ingin memulihkan data ?')"
                                                                    class="btn btn-success"><i class="bi bi-arrow-clockwise"></i></button>
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
