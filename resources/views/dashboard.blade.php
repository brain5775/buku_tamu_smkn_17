@extends('components.sidebar')
@section('main-content')
    <main class="container" class="admin">
        <h1>Welcome, Admin</h1>
        <section id="main-table" class="mt-4">
            <table class="table table-striped table-dark" id="events-table">
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
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tamu as $tm)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $tm['name'] }}</td>
                            <td>{{ $tm['email'] }}</td>
                            <td>{{ $tm['institution'] }}</td>
                            <td>
                                <img src="{{ $tm['photo'] }}" />
                            </td>
                            <td>{{ $tm['date'] }}</td>
                            <td>{{ $tm->teacher['name'] }}</td>
                            <td>{{ $tm['status'] == 'sb' ? 'Sudah Bertemu' : 'Belum Bertemu' }}</td>
                            <td>{{ $tm['event_detail'] }}</td>
                            <td>
                                <div class="action">
                                    <img src="/img/icons/edit.svg" />
                                    <img src="/img/icons/delete.svg" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="mt-3">
                {{ $tamu->links() }}
            </div> --}}
        </section>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // Fetch the event data via AJAX
            let table = new DataTable('#events-table');
            // $.ajax({
            //     url: '/events-data',
            //     method: 'GET',
            //     success: function(data) {

            //         tableBody.empty(); // Clear the table body

            //         // Append each event as a row in the table
            //         data.forEach(function(event) {
            //             tableBody.append(`
        //                 <tr>
        //                     <td>${event.id}</td>
        //                     <td>${event.name}</td>
        //                     <td>${event.date}</td>
        //                     <td>${event.location}</td>
        //                 </tr>
        //             `);
            //         });
            //     },
            //     error: function(xhr, status, error) {
            //         console.error('Error loading event data:', error);
            //     }
            // });
        });
    </script>
@endsection
