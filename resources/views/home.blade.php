@extends('layouts.main')
@section('content')
    <main class="bg-dark bg-gradient py-4">
        <div class="container flex flex-col text-white overflow-hidden">
            <section id="main-form">
                <h1 class="text-center mb-4">Buku Tamu SMKN 17</h1>
                <form action="/" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row row-cols-1 row-cols-sm-2 row-gap-3">
                        <div class="col">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="col">
                            <label for="institution">Institution</label>
                            <input type="text" name="institution" id="institution" class="form-control"
                                value="{{ old('institution') }}" required>
                        </div>
                        <div class="col">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control">
                        </div>
                        <div class="col">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control"
                                value="{{ old('date') }}" required>
                        </div>
                        <div class="col">
                            <label for="teacher_id">Teacher</label>
                            <select name="teacher_id" id="teacher_id" class="form-control">
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="details">Details</label>
                            <textarea name="details" id="details" class="form-control" required>{{ old('details') }}</textarea>
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
                            <th scope="col">Foto</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Status Kunjungan</th>
                            <th scope="col">Detail Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->email }}</td>
                                <td>{{ $event->institution }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $event->photo) }}" />
                                </td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->teacher->name }}</td>
                                <td>{{ $event->status == 'sb' ? 'Sudah Bertemu' : 'Belum Bertemu' }}</td>
                                <td>{{ $event['details'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </main>
@endsection
