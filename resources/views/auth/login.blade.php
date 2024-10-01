@extends('layouts.login.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Tambahkan Font Awesome -->
@endsection

@section('login')
    <div class="background">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-8 login-form-container d-flex flex-column align-items-center">
                    <!-- Tombol Kembali dengan Ikon Panah Kiri di Dalam Frame Login -->
                    <a href="{{ url('/') }}" class="btn-icon-back">
                        <i class="fas fa-arrow-left"></i> <!-- Ikon panah ke kiri -->
                    </a>

                    <div id="forTitle" class="text-center">
                        <p id="title">Welcome to KMI!</p>
                        <p id="subtitle">Please sign-in to your account</p>
                    </div>
                    <div id="forForm">
                        <form method="post" action="{{ route('postLogin') }}">
                            @csrf
                            @error('username')
                                <div class="errormessage text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="username" class="emailLabel">Email</label>
                                <input type="email" class="emailInput" placeholder="Masukkan Email Kantor Anda" name="username" id="username" required value="{{ old('username') }}">
                            </div>
                            <div class="form-group">
                                <label for="password" class="emailLabel">Password</label>
                                <input type="password" class="emailInput" placeholder="Masukkan Password Email Kantor Anda" name="password" id="password" required>
                            </div>
                            <div class="submitButtonLogin text-center">
                                <button type="submit" class="btn btn-outline-light">Login</button>
                            </div>
                        </form>
                    </div>
                    <!-- Menambahkan teks copyright di sini -->
                    <div class="text-center text-white mt-4 fs-6">
                        Copyright 2023 All rights reserved. PT. Semen Indonesia (Persero) Tbk.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
