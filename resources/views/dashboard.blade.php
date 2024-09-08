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
                        {{-- <th scope="col">Foto</th> --}}
                        <th scope="col">Tanggal</th>
                        <th scope="col">PIC</th>
                        <th scope="col">Status Kunjungan</th>
                        <th scope="col">Detail Kunjungan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tamu as $tm)
                        <tr data-id="{{ $tm['id'] }}">
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
                            <td>{{ $tm['event_detail'] }}</td>
                            <td>
                                <div class="action">
                                    <img src="/img/icons/edit.svg" />
                                    <img src="/img/icons/delete.svg" class="deleteButton" data-id="{{ $tm['id'] }}" />
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
            $('#events-table').on('click', '.deleteButton', function() {
                var userId = $(this).data('id'); // Get the ID of the user to delete
                var url = '{{ route('events.destroy', ':id') }}'; // Dynamic URL for deletion
                url = url.replace(':id', userId);

                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}', // Send CSRF token in Laravel
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message);
                                window.location
                            .reload(); // Reload the DataTable to reflect changes
                            } else {
                                alert('Error deleting user!');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
