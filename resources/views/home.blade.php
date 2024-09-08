@extends('layouts.main')
@section('content')
    <main class="bg-dark bg-gradient py-4">
        <div class="container flex flex-col text-white overflow-hidden">
            <section id="main-form">
                <h1 class="text-center mb-4">Buku Tamu SMKN 17</h1>
                <form action="/" method="POST">
                    @csrf
                    <div class="row row-cols-1 row-cols-sm-2 row-gap-3">
                        <div class="col">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="name" required>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col">
                            <label for="institution" class="form-label">Asal Institusi</label>
                            <input type="institution" class="form-control" id="text" name="institution" required>
                        </div>
                        {{-- <div class="col">
                            <label for="photo" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*"
                                required>
                        </div> --}}
                        <div class="col">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="col">
                            <label for="pic" class="form-label">PIC</label>
                            <select class="form-select" aria-label="Default select example" id="pic" name="pic">
                                <option selected>Open this select menu</option>
                                @foreach ($guru as $gr)
                                    <option value="{{ $gr['id'] }}">{{ $gr['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="detailKunjungan" class="form-label">Detail Kunjungan</label>
                            <input type="text" class="form-control" id="detailKunjungan" name="detailKunjungan"
                                aria-describedby="detail-kunjungann" required>
                        </div>
                    </div>
                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </section>
            <section id="main-table">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-left">
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Asal Institusi</th>
                            {{-- <th scope="col">Foto</th> --}}
                            <th scope="col">Tanggal</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Status Kunjungan</th>
                            <th scope="col">Detail Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tamu as $tm)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td>{{ $tm['name'] }}</td>
                                <td>{{ $tm['email'] }}</td>
                                <td>{{ $tm['institution'] }}</td>
                                {{-- <td>
                                    <img src="{{ $tm['photo'] }}" />
                                </td> --}}
                                <td>{{ $tm['date'] }}</td>
                                <td>{{ $tm->teacher['name'] }}</td>
                                <td>{{ $tm['status'] == 'sb' ? 'Sudah Bertemu' : 'Belum Bertemu' }}</td>
                                <td>{{ $tm['details'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </main>
@endsection
