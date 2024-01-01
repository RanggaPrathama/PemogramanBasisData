@extends('layouts.appAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Table Barang</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Barang Table</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section'>
        <div class="row">
            <div class='col-lg-12'>

                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Tambah Data Barang </h5>

                      <!-- Vertical Form -->
                      <form class="row g-3" action="{{ route('barang.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-12">
                          <label for="inputNanme4" class="form-label">Nama Barang</label>
                          <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"  name="nama_barang">
                          @error('nama_barang')
                            <div class='invalid-feedback'>{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Pilih Satuan</label>
                           <select name="id_satuan" id="id_satuan" class="form-select @error('id_satuan') is-invalid @enderror">
                            <option selected>Silahkan Pilih Satuan</option>
                            @foreach ($satuans as $satuan )
                            <option value="{{$satuan->id_satuan }}">{{ $satuan->nama_satuan }}</option>
                            @endforeach
                           </select>
                            @error('id_satuan')
                              <div class='invalid-feedback'>{{ $message }}</div>
                            @enderror
                          </div>

                          <div class="col-12">
                            <label for="inputNanme4" class="form-label">Jenis Barang</label>
                            <input type="text" class="form-control @error('jenis') is-invalid @enderror"  name="jenis">
                            @error('jenis')
                              <div class='invalid-feedback'>{{ $message }}</div>
                            @enderror
                          </div>

                          <div class="col-12">
                            <label for="inputNanme4" class="form-label">Harga</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror"  name="harga">
                            @error('harga')
                              <div class='invalid-feedback'>{{ $message }}</div>
                            @enderror
                          </div>

                          <div class="col-12">
                            <label for="inputNanme4" class="form-label">Pilih Gambar</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"  name="gambar">
                            @error('gambar')
                              <div class='invalid-feedback'>{{ $message }}</div>
                            @enderror
                          </div>


                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>


                      </form><!-- Vertical Form -->

                    </div>
                  </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        var resetButton = document.querySelector("button[type='reset']");

        var inputNamaBarang= document.querySelector("input[name='nama_barang']");

        var selectIdSatuan = document.querySelector("select[name='id_satuan']");

        var inputJenisBarang = document.querySelector("input[name='jenis']");

        var inputHargaBarang = document.querySelector("input[name='harga']");



        resetButton.addEventListener("click", function() {
            inputNamaBarang.value = "";
            selectIdSatuan.value="";
            inputJenisBarang.value="";
            inputHargaBarang.value="";
        });
    });
</script>


@endsection
