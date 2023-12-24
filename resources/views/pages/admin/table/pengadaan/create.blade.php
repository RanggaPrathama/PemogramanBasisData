@extends('layouts.appAdmin')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Table Role</h1>

            <nav>
                <ol class='breadcrumb'>
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Pengadaan Table </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class='section'>
            <div class="row">
                <div class='col-md-8'>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pengadaan Barang </h5>

                            <!-- Vertical Form -->
                            <form id="formPengadaan" class="row g-3" action="" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <label for="inputNanme4" class="form-label">Pilih Vendor</label>
                                    </div>

                                    <div class="col-8">




                                        <select class="form-select" name="vendor" id="id_vendor">

                                            <option value=0 selected> Silahkan Pilih</option>
                                            @foreach ($vendors as $vendor)
                                                <option value={{ $vendor->id_vendor }}>
                                                    {{ $vendor->nama_vendor }}
                                                </option>
                                            @endforeach
                                        </select>


                                    </div>
                                </div>



                                @error('nama_role')
                                    <div class='invalid-feedback'>{{ $message }}</div>
                                @enderror



                                <div class="col-4">
                                    <label for="" class="form-label"> Barang</label>
                                    <input id="inputbarang" class="form-control" type="text" name="barang">
                                    <input type="hidden" id="id_barang">
                                    <span id="pesan"> </span>
                                </div>



                                <div class="col-3">
                                    <label for="" class="form-label ">Quantity</label>
                                    <input class="form-control" id="quantity" type="text" name="jumlah" value="0"
                                        readonly>
                                </div>

                                <div class="col-3">
                                    <label for="" class="form-label">Harga Barang</label>
                                    <input class="form-control" id="harga_barang" type="text" name="harga_satuan"
                                        readonly>
                                </div>

                                <div class="col-2">
                                    <label for="" class="form-label">Satuan</label>
                                    <input type="text" id="nama_satuan" class="form-control" readonly>
                                </div>
                                <div class="d-flex justify-content-start  ">
                                    <button class="btn btn-primary" id="cari_barang" onclick="caribarang2()" type="button"
                                        style="margin-right:10px">
                                        Cari Barang</button>
                                    <button type="button" onclick="tambahList()" class="btn btn-primary"
                                        style="margin-right: 10px;">Tambah
                                        List</button>
                                    <button type="button" onclick="resetBarang()" class="btn btn-secondary">Reset</button>
                                </div>

                            </form>
                            <!-- Vertical Form -->

                            <!--MODAL  -->


                            <!-- Modal -->
                            <div class="modal fade testmodal" id="exampleModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table" id="tableproduk">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">idbarang</th>
                                                        <th scope="col">idsatuan</th>
                                                        <th scope="col">nama_barang</th>
                                                        <th scope="col">Harga Satuan</th>
                                                        <th scope="col">aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                  </tr>
                                                  <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                  </tr>
                                                  <tr>
                                                    <th scope="row">3</th>
                                                    <td colspan="2">Larry the Bird</td>
                                                    <td>@twitter</td>
                                                  </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class='card'>
                        <div class="card-header">
                            <h5 class="card-title">TOTAL </h5>
                        </div>
                        <div class="card-body">


                            {{-- PPN --}}
                            <div class="row">
                                <div class="col-12 d-flex justify-content-between">
                                    <h4 class="card-title">PPN :</h4>
                                    <input type="hidden" value="0.11" id='ppn' name='ppn'>
                                    <h4 class="card-title" style="font-size: 25px"> 11 % </h4>

                                </div>
                                <div class="col-12 bg-primary text-white text-center">
                                    <input type="hidden" id="value_totalnilai" value=0 name="total_nilai">
                                    <h2 id="displayTotal" style="margin: 10px 20px; font-size:25px;">Rp. 0,00</h2>
                                    {{-- <input type="hidden" name="dataPengadaan"  id="dataPengadaan"> --}}

                                </div>
                            </div>

                            {{-- PPN --}}


                            {{-- TOTAL NILAI --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">LIST BARANG PENGADAAN </h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="tableList">
                                <thead>
                                    <tr>
                                        <th scope="col">id_Barang</th>
                                        <th scope="col">id_satuan</th>
                                        <th scope="col">nama_barang</th>
                                        <th scope="col">Harga Barang</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col"> Sub Total</th>
                                        <th scope="col">aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                  </tr> --}}
                                </tbody>

                            </table>
                            <form id="formPengadaan2" class="row g-3" action="{{ route('pengadaan.store') }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" name="dataPengadaan" id="dataPengadaan" value="">
                                <button type="button" id="simpan" class="btn btn-primary"> SUBMIT </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    {{-- <form id="form-hasil" action="">


    </form> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let barangPilih = [];


        // FUNCTION CARI BARANG ( INPUT BARANG )
        function caribarang2() {
            var inputBarang = document.getElementById('inputbarang');

            $.ajax({
                type: "POST",
                url: "/caribarang",
                data: {
                    _token: "{{ csrf_token() }}",
                    barang: inputBarang.value
                },
                success: function(data) {
                    // mydat = JSON.parse(data);
                    console.log(data);

                    $('#tableproduk tbody').empty();

                    if (data.length > 0) {

                        for (let i = 0; i < data.length; i++) {
                            let row = `<tr>
                            <td>${data[i].id_barang} </td>
                            <td>${data[i].id_satuan}</td>
                            <td> ${data[i].nama_barang} </td>
                            <td>${data[i].harga} </td>
                            <td>
                                <button type="button" onclick="pilihBarang(${data[i].id_barang},'${data[i].nama_barang}',${data[i].harga},'${data[i].nama_satuan}')"
                                class="btn btn-success" ${barangPilih.some(barang => barang.id_barang == data[i].id_barang) ? 'disabled' : ''}>

                                <i class="bi bi-check2-circle"></i>
                            </button>
                            </td>
                            </tr>`;

                            $('#tableproduk tbody').append(row);
                        };

                        // $('#quantity').prop('readonly', true).val('');


                        $('#exampleModal').modal('show');


                    } else {
                        alert('data tidak ada');
                    }

                },
                error: function() {
                    console.log('Error in AJAX request');
                }
            });
        };

        // TUTUP FUNCTION CARI BARANG


        // MEMILIH KATEGORI VENDOR
        $(document).ready(function() {
            $('#id_vendor').change(function() {
                let idVendor = parseInt($(this).val());

                console.log(`Vendor : ${idVendor}`);

            })

        });
        //TUTUP KATEGORI  VENDOR


        // FUNCTION PILIH BARANG ( memasukkan dulu barang yang dipilih kedalam input )
        function pilihBarang(idBarang, namaBarang, hargaBarang, namaSatuan) {


            $('#exampleModal').modal('hide');
            $('#id_barang').val(idBarang);
            $('#inputbarang').val(namaBarang);
            $('#nama_satuan').val(namaSatuan);
            $('#harga_barang').val(hargaBarang);
            // let idVendor =  $('#id_vendor').val('');
            $('#quantity').prop('readonly', false).select();



            //let Item = barangPilih.find(item => item.id_barang == idBarang);

            // if (Item) {
            //      alert('Barang Sudah Dipilih');
            //  } else {
            //      barangPilih.push({
            //          id_barang: idBarang,
            //          id_vendor:idVendor,
            //          nama_barang: namaBarang,
            //          harga: hargaBarang,
            //          quantity: 1, //DEFAULT BRO TAK KASIH 1
            //          subtotal: hargaBarang,
            //      });
            //    };


            // if (barangPilih.some(barang => barang.id_barang == idBarang)) {
            //     alert('Barang Sudah Dipilih');
            //     return;
            // }

            // barangPilih.push({
            //     id_barang: idBarang,
            //     nama_barang: namaBarang,
            //     harga: hargaBarang,
            // });



        };


        // FUNCTION RESET BARANG KEMUNGKINAN SALAH INPUT
        function resetBarang() {

            $('#inputbarang').val('');
            $('#id_barang').val('');
            $('#nama_satuan').val('');
            $('#harga_barang').val('');
            $('#quantity').val('');
            $('#quantity').prop('readonly', true).val('');


        };

        // UNTUK TAMBAH LIST BARANG YANG SUDAH DI LIST SUDAH TEKAN TOMBOL TAMBAH LIST ITU
        function tambahList() {
            let idBarang = parseInt($('#id_barang').val());
            let namaBarang = $('#inputbarang').val();
            let namaSatuan = $('#nama_satuan').val();
            let hargaBarang = parseInt($('#harga_barang').val());
            let quantity = parseInt($('#quantity').val());



            if (!idBarang || !namaBarang || !namaSatuan || !hargaBarang || isNaN(quantity) || quantity <= 0) {
                alert('Lengkapi semua data sebelum menambahkan ke daftar list.');
                return;
            } else {
                barangPilih.push({
                    id_barang: idBarang,
                    nama_barang: namaBarang,
                    harga: hargaBarang,
                    quantity: quantity,
                    subtotal: hargaBarang,
                });
            }

            let existingItem = barangPilih.find(item => item.id_barang === idBarang);

            if (existingItem) {
                // PERBARUI QUANTITY JIKA BARANG SUDAH MASUK KE ARRAY
                existingItem.quantity = parseInt(quantity);
                existingItem.subtotal = parseFloat(hargaBarang) * parseInt(quantity);
            }

            console.log(barangPilih);

            // Hitung subtotal
            let subtotal = parseFloat(hargaBarang) * parseInt(quantity);

            // TAMBAH BARIS KE TABEL HASIL MASSE
            let row = `<tr id="row-${idBarang}">
                 <td>${idBarang}</td>
                <td>${namaSatuan}</td>
                <td>${namaBarang}</td>
                <td>${hargaBarang}</td>
                 <input type="hidden" id="harga-${idBarang}" value=${hargaBarang}>
                <td><input type="number" id="quantity-${idBarang}" value="${quantity}" onchange="updateSubtotal(${idBarang})" style="width=5%;"></td>
                 <td id="subtotal-${idBarang}">${subtotal}</td>
                <td><button type="button" onclick="hapusBarang(${idBarang})" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button></td>
                </tr>`;

            $('#tableList tbody').append(row);

            totalNilai();

            resetBarang();

        };


        // UPDATE SUB TOTAL BERFUNGSI PADA PERUBAHAN INPUT QUANTITY BERSIFAT ONCHANGE
        function updateSubtotal(idBarang) {


            if ($(`#quantity-${idBarang}`).val() < 0) {
                alert('QUANTITY TIDAK BOLEH MINUS');
                $(`#quantity-${idBarang}`).val(0);
            }

            let quantityInput = $(`#quantity-${idBarang}`).val();
            let hargaBarang = $(`#harga-${idBarang}`).val();
            let index = barangPilih.findIndex(item => item.id_barang == idBarang);
            console.log(`index ke : ${index}`);
            barangPilih[index].quantity = parseInt(quantityInput);
            barangPilih[index].subtotal = parseFloat(hargaBarang) * parseInt(quantityInput);

            console.log(barangPilih);

            $(`#subtotal-${idBarang}`).text(barangPilih[index].subtotal);

            totalNilai()
        }

        function totalNilai() {
            let total = 0;
            for (let i = 0; i < barangPilih.length; i++) {
                total += barangPilih[i].subtotal;
            }


            let ppn = total * (11 / 100);

            let display = total + ppn;
            let total_nilai = total;



            $('#value_totalnilai').val(parseInt(total_nilai));

            $('#displayTotal').text(display.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }));
        };

        function hapusBarang(idBarang) {

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
                        text: "Your List has been deleted.",
                        icon: "success"
                    });
                };

                $(`#row-${idBarang}`).remove();

                let id_barang = parseInt(idBarang);

                console.log('ID :', id_barang);


                console.log("Array sebelum dihapus:", barangPilih);
                let index = barangPilih.findIndex(item => item.id_barang === id_barang);


                if (index !== -1) {
                    barangPilih.splice(index, 1);


                    console.log("Array setelah dihapus:", barangPilih);
                } else {
                    console.log("Elemen tidak ditemukan dalam array.");
                }

                totalNilai();

            });



        };


        $(document).ready(function() {

            $(document).on('click', '#simpan', function() {
                console.log('Tombol Simpan Diklik');


                let form = $("#formPengadaan2");
                let idVendor = parseInt($('#id_vendor').val());

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: {
                        id_vendor: idVendor,
                        // ppn: $('#ppn').val(),
                        subtotal: parseInt($('#value_totalnilai').val()),
                        barangPilih: JSON.stringify(barangPilih)
                    },


                    success: function(response) {
                        console.log(response);

                        if (response.message === 'success') {

                                Swal.fire({
                                    title: "SUCCESS!",
                                    text: "Data Berhasil Disimpan",
                                    icon: "success"
                                }).then((result)=>{
                                    if(result.isConfirmed){
                                        window.location.href='/pengadaan';
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







        //  $('#dataPengadaan').val(dataPilihBarang);
    </script>
@endsection
