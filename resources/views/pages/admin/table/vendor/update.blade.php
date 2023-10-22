@extends('layouts.appAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Table Role</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Vendor Table</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section'>
        <div class="row">
            <div class='col-lg-12'>

                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Update Data Vendor </h5>

                      <!-- Vertical Form -->
                      <form class="row g-3" action="{{ route('vendor.update',$vendors[0]->id_vendor) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                          <label for="inputNanme4" class="form-label">Nama Vendor</label>
                          <input type="text" class="form-control @error('nama_vendor') is-invalid @enderror"  name="nama_vendor" value="{{ old('nama_vendor',$vendors[0]->nama_vendor) }}">
                          @error('nama_vendor')
                            <div class='invalid-feedback'>{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Badan Hukum</label>
                            <input type="text" class="form-control @error('badan_hukum') is-invalid @enderror"  name="badan_hukum" value="{{ old('badan_hukum',$vendors[0]->badan_hukum) }}">
                            @error('badan_hukum')
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

        var inputNamaVendor= document.querySelector("input[name='nama_vendor']");

        var inputBadanHukum = document.querySelector("input[name='badan_hukum']");

        resetButton.addEventListener("click", function() {
            inputNamaVendor.value = "";
            inputBadanHukum.value="";
        });
    });
</script>


@endsection
