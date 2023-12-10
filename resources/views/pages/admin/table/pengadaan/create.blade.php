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
                            <form class="row g-3" action="" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <label for="inputNanme4" class="form-label">Pilih Vendor</label>
                                    </div>

                                    <div class="col-8">




                                        <select class="form-select" name="vendor" id="id_vendor">
                                            @foreach ($vendors as $vendor)
                                                <option value="0" selected> Silahkan Pilih</option>
                                                <option value="{{ $vendor->id_vendor }}">
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
                                    <input class="form-control" id="quantity" type="text" name="jumlah" value="0" readonly>
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


                            </form><!-- Vertical Form -->

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
                                            <button type="button" class="btn btn-primary">Save changes</button>
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
                            <h5 class="card-title">Invoice </h5>
                        </div>
                        <div class="card-body">

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
                            <h5 class="card-title">Hasil </h5>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

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
                                class="btn btn-success">

                                <i class="bi bi-check2-circle"></i>
                            </button>
                            </td>
                            </tr>`;
                            // ${barangPilih.some(barang => barang.id_barang == data[i].id_barang) ? 'disabled' : ''}
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
                let idVendor = $(this).val();

            })

        });
        //TUTUP KATEGORI  VENDOR


        // FUNCTION PILIH BARANG
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
            let idBarangHapus = barangPilih[barangPilih.length - 1].id_barang;

            // HAPUS BARANG SESUAI ID
            barangPilih = barangPilih.filter(barang => barang.id_barang !== idBarangHapus);




            $('#inputbarang').val('');
            $('#id_barang').val('');
            $('#nama_satuan').val('');
            $('#harga_barang').val('');
            $('#quantity').val('');
            $('#id_vendor').val('');
            $('#quantity').prop('readonly', true).val('');

            console.log(barangPilih);
        };

        function tambahList() {
            let idBarang = $('#id_barang').val();
            let namaBarang = $('#inputbarang').val();
            let namaSatuan = $('#nama_satuan').val();
            let hargaBarang = $('#harga_barang').val();
            let idVendor = $('#id_vendor').val();
            let quantity = $('#quantity').val();

            console.log(idBarang);
            console.log(namaBarang);
            console.log(namaSatuan);
            console.log(hargaBarang);
            console.log(idVendor);
            console.log(quantity);
           // hitungSubtotal()

            if (!idBarang || !namaBarang || !namaSatuan || !hargaBarang || !idVendor || isNaN(quantity) || quantity <= 0) {
                alert('Lengkapi semua data sebelum menambahkan ke daftar list.');
                return;
            }
            else{
                barangPilih.push({
                 id_barang: idBarang,
                 id_vendor:idVendor,
                   nama_barang: namaBarang,
                   harga: hargaBarang,
                    quantity: quantity,
                    subtotal: hargaBarang,
                });
            }

            let existingItem = barangPilih.find(item => item.id_barang === idBarang);

            if (existingItem) {
                // Perbarui quantity dan subtotal JIKA BARANG SUDAH MASUK KE ARRAY 
                existingItem.quantity = parseInt(quantity);
                existingItem.subtotal = parseFloat(hargaBarang) * parseInt(quantity);
            }

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
                <td><button type="button" onclick="hapusBarang(${idBarang})" class="btn btn-danger">Hapus</button></td>
                </tr>`;

            $('#tableList tbody').append(row);

        };

        function updateSubtotal(idBarang){
            let quantityInput = $(`#quantity-${idBarang}`).val();
            let hargaBarang = $(`#harga-${idBarang}`).val();
          let index =   barangPilih.findIndex(item=>item.id_barang == idBarang);
          console.log(`index ke : ${index}`);
          barangPilih[index].quantity = parseInt(quantityInput);
            barangPilih[index].subtotal = parseFloat(hargaBarang) * parseInt(quantityInput);

            $(`#subtotal-${idBarang}`).text(barangPilih[index].subtotal);
        }

        function hitungSubtotal() {

        }
    </script>
@endsection
