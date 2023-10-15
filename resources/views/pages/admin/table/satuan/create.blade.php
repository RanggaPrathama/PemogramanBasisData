@extends('layouts.appAdmin')

@section('content')

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

    <section class='section'>
        <div class="row">
            <div class='col-lg-12'>

                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Tambah Data Satuan </h5>

                      <!-- Vertical Form -->
                      <form class="row g-3" action="{{ route('satuan.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-12">
                          <label for="inputNanme4" class="form-label">Nama Satuan</label>
                          <input type="text" class="form-control @error('nama_role') is-invalid @enderror"  name="nama_satuan">
                          @error('nama_satuan')
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

        var inputNamaSatuan = document.querySelector("input[name='nama_satuan']");

        resetButton.addEventListener("click", function() {
            inputNamaSatuan.value = "";
        });
    });
</script>


@endsection
