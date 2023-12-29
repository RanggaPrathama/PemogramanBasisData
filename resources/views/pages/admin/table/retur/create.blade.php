@extends('layouts.appAdmin')

@section('content')

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

    <section class='section'>
        <div class="row">
            <div class='col-lg-12'>

                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"> Retur Barang </h5>

                      <!-- Vertical Form -->
                      <form  action="" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row g-3">
                        <div class="col-12">
                            <select class="form-select" name="id_penerimaan" id="id_penerimaan">
                                <option selected> Silahkan Memilih Penerimaan</option>
                                @foreach ($penerimaans as $penerimaan )
                                <option value="{{ $penerimaan->id_penerimaan }}">{{ $penerimaan->id_penerimaan }}</option>
                                @endforeach
                            </select>
                        </div>

                      </form><!-- Vertical Form -->
                    </div>

                    </div>
                  </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title"> Detil Retur</h5>

                        <table class="table" id="detilRetur">
                            <thead>
                                <tr>
                                    <th>ID DETIL</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Alasan</th>

                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="card-title">Pencarian Barang</p>
                    <div class="row">
                        <div class="col-5">
                            <input type="text" id="barang" class="form-control">
                        </div>
                        <div class="col-7">
                            <button class="btn btn-primary">Cari</button>
                        </div>
                    </div>



                  <table class="table mt-4" id="detilPermintaan">
                        <thead>
                            <tr>
                                <th>idDetail</th>
                                <th>idPenerimaan</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Sub total</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>

    </section>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    $(document).ready(function () {
        $('#id_penerimaan').change(function(){
            let id_penerimaan = $(this).val();
            console.log(id_penerimaan);
            // $('#exampleModal').modal('show');
            $.ajax({
                type: "GET",
                url: `detilPenerimaan/${id_penerimaan}`,
                dataType: "JSON",
                success: function (data) {
                   if(data.length > 1){
                        for(let i=0; i<data.length; i++){
                            let row = `<tr>
                                    <td>
                                        
                                        </td>


                                </tr>`
                        }
                   }
                   else{
                    alert('DATA TIDAK DITEMUKAN !');
                   }

                }
            });
        })
    });
</script>


@endsection
