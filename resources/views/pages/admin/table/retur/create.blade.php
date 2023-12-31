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
                            <form action="" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <select class="form-select" name="id_penerimaan" id="id_penerimaan">
                                            <option selected> Silahkan Memilih Penerimaan</option>
                                            @foreach ($penerimaans as $penerimaan)
                                                <option value="{{ $penerimaan->id_penerimaan }}">
                                                    {{ $penerimaan->id_penerimaan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" id="id_penerimaanData" value=0>

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
                                        <th>ID Detail</th>
                                        <th>Id Penerimaan</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Alasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <form id="formRetur" action="{{ route('retur.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="text-end mt-5">
                                <button type="button" id="buttonSimpan" class="btn btn-success">Proses
                                    Retur</button>
                            </div>
                        </form>
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
                            {{-- <p class="card-title">Pencarian Barang</p>
                    <div class="row">
                        <div class="col-5">
                            <input type="text" id="barang" class="form-control">
                        </div>
                        <div class="col-7">
                            <button class="btn btn-primary">Cari</button>
                        </div>
                    </div> --}}

                            <table class="table mt-4" id="detilPermintaan">
                                <thead>
                                    <tr>
                                        <th>idDetail</th>
                                        <th>idPenerimaan</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Sub total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeModal()"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="SaveChanges()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let dataRetur = [];

        $(document).ready(function() {
            $('#id_penerimaan').change(function() {
                let id_penerimaan = $(this).val();
                let tes = $('#id_penerimaanData').val(parseInt(id_penerimaan));
                console.log($('#id_penerimaanData').val());
                // $('#exampleModal').modal('show');

                dataRetur = [];
                $('#detilRetur tbody').empty();

                $.ajax({
                    type: "GET",
                    url: `detilPenerimaan/${id_penerimaan}`,
                    dataType: "JSON",
                    success: function(data) {
                        $('#detilPermintaan tbody').empty();
                        if (data.length > 0) {
                            let count = 0;
                            for (let i = 0; i < data.length; i++) {
                                let row = `<tr id=id_penerimaan-${data[i].iddetail_penerimaan}>
                                    <td> ${data[i].iddetail_penerimaan} </td>
                                    <td> ${data[i].id_penerimaan}</td>
                                    <td> ${data[i].nama_barang}</td>
                                    <td> ${data[i].jumlah_terima}</td>
                                    <td> ${data[i].harga_satuan_terima}</td>
                                    <td> ${data[i].sub_total_terima}</td>
                                    ${count = data.length}
                                    ${console.log(count)}
                                    <td><button onclick="pilihRetur(${data[i].iddetail_penerimaan},'${data[i].nama_barang}',${data[i].jumlah_terima},${count},${data[i].id_penerimaan})" class="btn btn-success" type='button' ${dataRetur.some(item=>item.iddetail_penerimaan == data[i].iddetail_penerimaan) ? 'disabled' : '' }>
                                        <i class="bi bi-check2-circle"></i> </button></td>
                                </tr>`;
                                $('#detilPermintaan tbody').append(row);
                            };

                            $('#detilPermintaan').DataTable();
                            $('#exampleModal').modal('show');

                        } else {
                            alert('DATA TIDAK DITEMUKAN !');
                        };



                    }
                });
            });
        });

        //INI UNTUK MEMILIH RETUR DAN AKAN MEMASUKKAN KE ARRAY
        function pilihRetur(idDetil, nama_barang, jumlah, count, idPenerimaan) {

            let row = `<tr id="row-${idDetil}">
                <td>${idDetil}</td>
                <td>${idPenerimaan}</td>
                <td>${nama_barang}</td>
                <td><input class="form-control" type="number" value="${jumlah}" id="jumlah-${idDetil}" min=0 max=${jumlah} name="jumlah-${idDetil}" onchange="jumlahRetur(${idDetil})"> </td>
                <td><textarea class="form-control" id="alasan-${idDetil}" oninput="updateAlasan(${idDetil})"> </textarea></td>
                <td><button class="btn btn-danger" onclick="hapusData(${idDetil})"><i class="bi bi-trash3-fill"></i></button></td>
                </tr>`;

            $('#detilRetur tbody').append(row);


            masukData(idDetil, jumlah)

            $(`#detilPermintaan tbody #id_penerimaan-${idDetil} button`).prop('disabled', true);

            if (count == dataRetur.length) {
                $('#exampleModal').modal('hide');
                $('#id_penerimaan').val('');
            };

        };

        // UNTUK MEMASUKKAN KE ARRAY
        function masukData(idDetil, jumlah) {
            let idDetilPenerimaan = parseInt(idDetil);
            let jumlah_retur = parseInt(jumlah);
            dataRetur.push({
                iddetail_penerimaan: idDetil,
                jumlah: jumlah,
                alasan: '',

            });
            console.log(dataRetur);
        };

        //UNTUK SETIAP UPDATE JUMLAH DENGAN ONCHANGE
        function jumlahRetur(idDetil) {
            let jumlahretur = $(`#jumlah-${idDetil}`).val();
            console.log(jumlahretur);

            let index = dataRetur.findIndex(item => item.iddetail_penerimaan === idDetil);
            dataRetur[index].jumlah = parseInt(jumlahretur);

            console.log(dataRetur);
        };

        //UNTUK SETIAP UPDATE ALASAN DENGAN ONINPUT
        function updateAlasan(idDetil) {
            let updatealasan = $(`#alasan-${idDetil}`).val();
            console.log(updatealasan);

            let index = dataRetur.findIndex(item => item.iddetail_penerimaan === idDetil);
            dataRetur[index].alasan = updatealasan;
            console.log(dataRetur);
        };


        // save changes pada modal
        function SaveChanges() {
            if (dataRetur.length > 0) {
                $('#exampleModal').modal('hide');
                $('#id_penerimaan').val('');
            } else {
                alert('Silahkan Memilih Data Retur yang ingin dipilih  ! ');
            };
        };

        //UNTUK MENGHAPUS ROW DAN DATA ARRAY DARI RETUR YANG DIPILIH

        function hapusData(idDetil) {
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
                        text: "Your list has been deleted.",
                        icon: "success"
                    });

                };
                $(`#row-${idDetil}`).remove();
                let index = dataRetur.findIndex(item => item.iddetail_penerimaan === idDetil);

                if (index !== -1) {
                    dataRetur.splice(index, 1);
                };

                $(`#detilPermintaan tbody #id_penerimaan-${idDetil} button`).prop('disabled', false);
            });

        };

        // UNTUK TOMBOL RESET MODAL
        function closeModal() {

            $('#exampleModal').modal('hide');
            $('#id_penerimaan').val('').prop('disabled', false);
        };


        //SIMPAN DATA
        $(document).ready(function() {
            $(document).on('click', '#buttonSimpan', function() {
                let form = $('#formRetur');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: {
                        id_penerimaan: parseInt($('#id_penerimaanData').val()),
                        dataRetur: JSON.stringify(dataRetur),
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        if (response.message == 'success') {
                            Swal.fire({
                                title: "Berhasil !",
                                text: "Data tersimpan !",
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "/retur";
                                }
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            })
        });
    </script>
@endsection
