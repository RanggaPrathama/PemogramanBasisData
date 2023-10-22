@extends('layouts.appAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Table User</h1>
        <nav>
            <ol class='breadcrumb'>
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">User Table</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class='section'>
        <div class="row">
            <div class='col-lg-12'>

                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Update Data User </h5>

                      <!-- Vertical Form -->
                      <form class="row g-3" action="{{ route('user.update',$users[0]->id_user) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                          <label for="inputNanme4" class="form-label">Username</label>
                          <input type="text" class="form-control @error('username') is-invalid @enderror"  name="username" value="{{ old('username',$users[0]->username) }}">
                          @error('username')
                            <div class='invalid-feedback'>{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"  name="email" value="{{ old('email',$users[0]->email) }}">
                            @error('email')
                              <div class='invalid-feedback'>{{ $message }}</div>
                            @enderror
                          </div>

                          <div class="col-12">
                            <label for="inputNanme4" class="form-label">Password</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"  name="password" value="{{ old('password',$users[0]->password) }}">
                            @error('password')
                              <div class='invalid-feedback'>{{ $message }}</div>
                            @enderror
                          </div>

                          <div class="col-12">
                            <label for="inputNanme4" class="form-label">Password Confirm</label>
                            <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror"  name="password_confirmation">
                            @error('password_confirmation')
                              <div class='invalid-feedback'>{{ $message }}</div>
                            @enderror
                          </div>

                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Pilih Role</label>
                            <?php
                            $oldrole = old('id_role',$users[0]->id_role);
                            ?>
                           <select name="id_role" id="id_role" class="form-select @error('id_role') is-invalid @enderror">
                            <option selected>Silahkan Pilih Role</option>
                            @foreach ($roles as $role )
                            <option value="{{$role->id_role  }}" {{ $oldrole == $role->id_role ? 'selected' : '' }}>{{ $role->nama_role }}</option>
                            @endforeach
                           </select>
                            @error('id_role')
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

        var inputUsername= document.querySelector("input[name='username']");

        var selectIdRole = document.querySelector("select[name='id_role']");

        var inputEmail = document.querySelector("input[name='email']");

        var inputPassword = document.querySelector("input[name='password']");



        resetButton.addEventListener("click", function() {
            inputUsername.value = "";
            selectIdRole.value="";
            inputEmail.value="";
            inputPassword.value="";
        });
    });
</script>


@endsection
