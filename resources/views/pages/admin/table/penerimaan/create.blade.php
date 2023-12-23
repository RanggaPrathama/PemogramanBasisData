@extends('layouts.appAdmin')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Table Permintaan</h1>
            <nav>
                <ol class='breadcrumb'>
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Permintaan Table</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class='section'>
            <div class="row">
                <div class='col-lg-12'>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Penerimaan </h5>

                            <!-- Vertical Form -->
                            <form action="" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-6">

                                        <select class="form-select" name="id_pengadaan" id="id_pengadaan">
                                            <option value="" selected>Silahkan Memilih Pengadaan</option>
                                            @foreach ($pengadaans as $pengadaan)
                                                <option value="{{ $pengadaan->id_pengadaan }}">
                                                    {{ $pengadaan->id_pengadaan }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button id="pilihPengadaan" class="btn btn-success">Pilih</button>
                                    </div>
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
                            <h5 class="card-title">Detail Penerimaan</h5>
                            <table id="tableDetail" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">id detail</th>
                                        <th>Barang</th>
                                        <th>harga</th>
                                        <th>jumlah</th>
                                        <th>sub total</th>

                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table id="tableDetailModal" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">id detail</th>
                                        <th>Barang</th>
                                        <th>harga</th>
                                        <th>jumlah</th>
                                        <th>sub total</th>
                                        <th>action</th>
                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="displayDetail()" class="btn btn-primary">Save changes</button>
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
        let dataPenerimaan = [];
        $(document).ready(function() {
            $('#id_pengadaan').change(function() {
                let idPengadaan = parseInt($(this).val());
                console.log(idPengadaan);

                $.ajax({
                    type: "GET",
                    url: `/penerimaan/detailPengadaan/${idPengadaan}`,
                    dataType: "JSON",
                    success: function(data) {

                        if (data.length > 0) {
                            $('#tableDetailModal tbody').empty();
                            for (let i = 0; i < data.length; i++) {
                                let row = `<tr id="row-${data[i].iddetail_pengadaan}">
                                            <td>${data[i].iddetail_pengadaan}</td>
                                            <td>${data[i].nama_barang}</td>
                                            <td>${data[i].harga_satuan}</td>
                                            <td>${data[i].jumlah}</td>
                                            <td>${data[i].sub_total}</td>
                                            <td><button type="button" onclick='hapusData(${data[i].iddetail_pengadaan})' class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button></td>
                                        </tr>`;
                                $('#tableDetailModal tbody').append(row);

                            };
                            masukData(data);
                            $('#exampleModal').modal('show');
                        } else {
                            alert('Data tidak ditemukan');
                        }
                    }
                });
            });


        });

        function masukData(data) {

            for (let i = 0; i < data.length; i++) {
                dataPenerimaan.push({
                    iddetail_pengadaan:data[i].iddetail_pengadaan,
                    id_barang: data[i].id_barang,
                    nama_barang:data[i].nama_barang,
                    jumlah_terima: data[i].jumlah,
                    harga_satuan_terima: data[i].harga_satuan,
                    sub_total_terima: data[i].sub_total
                });
            }

            console.log(dataPenerimaan);

        };

        function hapusData(idDetail) {

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });

                    let index = dataPenerimaan.findIndex(item => item.iddetail_pengadaan === idDetail);
                    console.log(index);

                    if (index !== -1) {
                        dataPenerimaan.splice(index, 1);
                    }
                    $(`#row-${idDetail}`).remove();
                    console.log(dataPenerimaan);
                }
            });

        }

        function displayDetail() {
            dataPenerimaan.forEach((detail) => {
                let row = `<tr id="row-${detail.iddetail_pengadaan}">
                                            <td>${detail.iddetail_pengadaan}</td>
                                            <td>${detail.nama_barang}</td>
                                            <td>${detail.harga_satuan_terima}</td>
                                            <input type='hidden' id='harga-${detail.iddetail_pengadaan}' value=${detail.harga_satuan_terima} >
                                            <td><input type='number' id='jumlah-${detail.iddetail_pengadaan}' onchange='updateSubTotal(${detail.iddetail_pengadaan})' value=${detail.jumlah_terima}> </td>
                                            <td>${detail. sub_total_terima}</td>

                                        </tr>`;
                                $('#tableDetail tbody').append(row);
            });

            $('#exampleModal').modal('hide');
        }

        function updateSubTotal(){

        }
    </script>
@endsection
