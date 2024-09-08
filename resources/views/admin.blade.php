@extends('layouts.main')

@section('content')
    <main class="py-4 flex flex-col bg-dark bg-gradient text-white overflow-hidden" id="login-form">
        <form id="main-form">
            <div class="form-control">
                <div class="logo">
                    <img src="../logo.png" />
                    <span>Buku Tamu</span>
                </div>
                <span>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="email" required>
                </span>
                <span>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="text" aria-describedby="password" required>
                </span>
                <button type="submit" class="btn btn-primary px-5 py-2">Login</button>
            </div>
        </form>
    @endsection
