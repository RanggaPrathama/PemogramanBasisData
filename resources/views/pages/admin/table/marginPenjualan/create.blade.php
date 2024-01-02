@extends('layouts.appAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Table Role</h1>

        <nav>
            <ol class='breadcrumb'>
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Margin Penjualan Table</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section'>
        <div class="row">
            <div class='col-lg-12'>

                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Tambah Data Margin Penjualan </h5>

                      <!-- Vertical Form -->
                      <form class="row g-3" action="{{ route('marginPenjualan.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-12">
                          <label for="inputNanme4" class="form-label">Persen</label>
                          <input type="number" id="persen" class="form-control" name="persen" step="0.01" placeholder="0.00" min="0.00" max="1.00" />
                          @error('nama_role')
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

        var inputNamaRole = document.querySelector("input[name='nama_role']");

        resetButton.addEventListener("click", function() {
            inputNamaRole.value = "";
        });
    });
</script>


@endsection
