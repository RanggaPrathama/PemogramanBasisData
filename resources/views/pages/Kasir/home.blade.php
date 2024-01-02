@extends('layouts.appKasir')

@section('content')
    <section id="kasir" style="margin-top: 60px; ">
        <div class="container-fluid">

            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show col-md-12 text-center" id="success-alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-6 d-flex flex-column"
                    style=" background-color: #EEF5FF;height:100vh; overflow-y:auto; max-height:100vh; ">
                    <div class="container">


                        <div class="row" style="margin-top: 10px">
                            @foreach ($barangs as $barang )
                            <div class="col-4">
                                <div class="card" style="width: 10rem; height:14rem; position: relative; overflow: hidden; cursor: pointer;" onclick="pilihBarang({{ $barang->id_barang }})">
                                    <img src="{{ url('storage/gambar_barang/' . $barang->gambar)}}" alt="" style="width: 100%; height:8rem;">
                                    <div class="card-body" >
                                        <p style="margin-top:-10px; margin-left:-6px; font-size:15px" class="card-title">
                                            {{ $barang->nama_barang }}
                                        </p>
                                        <p style="font-size: 15px; font-weight:700; color:#176B87" class="card-text text-end">
                                            {{ 'Rp'.number_format($barang->harga,0,',','.') }}
                                        </p>
                                    </div>
                                    <div class="date-container" style="position: absolute; top: 0; right: 0;">
                                        <span class="date-day">{{ $barang->stock }}</span>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>

                    </div>

                </div>
                <div class="col-6" style="margin-top:10px;">
                    <div class="card" style=" overflow-y:auto; max-height:400px">
                        <div class="card-body">
                            <h5 class="card-title text-center"> Detil Penjualan</h5>

                            <table class="table" id="detilPenjualan">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Sub Total</th>

                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <form id="formRetur" action="" method="POST" enctype="multipart/form-data">
                            @csrf

                        </form>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Invoice</h5>
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">PPN</h5>
                                <h5 class="card-title">100000</h5>
                            </div>

                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">Margin Penjualan</h5>
                                <h5 class="card-title">0.20</h5>
                            </div>

                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">Total</h5>
                                <h5 class="card-title">Rp.50.000</h5>
                            </div>

                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">Bayar</h5>
                                <input type="number" class="form-control" style="height:40px; width:30%; margin-top:10px">
                            </div>

                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">Uang Kembali</h5>
                                <input type="number" class="form-control" style="height:40px; width:30%; margin-top:10px"
                                    readonly>
                            </div>
                        </div>
                        <form id="formRetur" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="text-end">
                                <button type="button" id="buttonSimpan" class="btn btn-success">Proses
                                    Penjualan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


 <!-- JQUERY -->
 <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
 <!-- Bootstrap 4 -->
 <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

 <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
 crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    function pilihBarang(idBarang){
        console.log(idBarang);
    }
</script>

@endsection
