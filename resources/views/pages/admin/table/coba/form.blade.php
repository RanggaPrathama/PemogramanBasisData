@extends('layouts.appAdmin')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Table Role</h1>

            <nav>
                <ol class='breadcrumb'>
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Role Table</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class='section'>
            <div class="row">
                <div class='col-lg-12'>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Data Role </h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{ route('role.store') }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Nama Role</label>
                                    <input type="text" class="form-control @error('nama_role') is-invalid @enderror"
                                        name="nama_role">
                                    @error('nama_role')
                                        <div class='invalid-feedback'>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <label for="" class="form-control"> Barang</label>
                                    <input id="inputbarang" class="form-control" type="text" name="barang">
                                    <span id="pesan"> </span>
                                </div>
                                    
                                <div class="col-4">
                                    <label for="" class="form-control">harga satuan</label>
                                    <input class="form-control" type="text" name="harga_satuan" readonly>
                                </div>

                                <div class="col-4">
                                    <label for="" class="form-control">Stok</label>
                                    <input type="text" class="form-control" name="stok_satuan" readonly>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" id="cari_barang" onclick="caribarang2()" type="button">
                                        Cari Barang</button>
                                    <button type="submit" class="btn btn-primary"
                                        style="margin-right: 10px;">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
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
                                            <table class="table"  id="tableproduk">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">idbarang</th>
                                                    <th scope="col">idsatuan</th>
                                                    <th scope="col">nama_barang</th>
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
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script>
        function caribarang2() {
            var el = document.getElementById('inputbarang');

            $.ajax({
                type: "POST",
                url: "/caribarang",
                data: {
                    _token: "{{ csrf_token() }}",
                    barang: el.value
                },
                success: function(data) {
                    // mydat = JSON.parse(data);
                    console.log(data);

                    if(data.length > 0){

                    for(let i=0; i<data.length; i++){
                      let row = `<tr>

                            <td>
                                ${data[i].id_barang}
                                    </td>
                            <td>
                                ${data[i].id_satuan}
                                </td>

                            <td>
                                ${data[i].nama_barang}
                                </td>


                            </tr>`;

                        $('#tableproduk tbody').append(row);
                    };





                    $('#exampleModal').modal('show');
                }


                else{
                    alert('data tidak ada');
                }


                },
                error: function() {
                    console.log('Error in AJAX request');
                }
            });
        }
    </script>

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
