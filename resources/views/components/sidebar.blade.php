@extends('layouts.main')

@section('content')
    <main class="admin-layout">
        <aside>
            <nav>
                <div class="logo">
                    <img src="../logo.png" />
                    <span>Buku Tamu</span>
                </div>
                <ul>
                    <li>
                        <img src="../img/icons/home.svg" />
                        <a href="#">Dashboard</a>
                    </li>
                    <li>
                        <img src="../img/icons/logout.svg" />
                        <a href="#">Logout</a>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="content">
            @yield('main-content')
        </div>
    </main>
@endsection
