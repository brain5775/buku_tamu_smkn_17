@extends('components.sidebar')
@section('main-content')
    <main class="container-fluid py-4" class="admin">
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
                    @foreach ($events as $event)
                        <tr data-id="{{ $event['id'] }}">
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $event['name'] }}</td>
                            <td>{{ $event['email'] }}</td>
                            <td>{{ $event['institution'] }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $event->photo) }}" />
                            </td>
                            <td>{{ $event['date'] }}</td>
                            <td>{{ $event->teacher['name'] }}</td>
                            <td>{{ $event['status'] == 'sb' ? 'Sudah Bertemu' : 'Belum Bertemu' }}</td>
                            <td>{{ $event['details'] }}</td>
                            <td>
                                <div class="action">
                                    <a href="javascript:void(2)" data-id="{{ $event->id }}">
                                        <img src="/img/icons/edit.svg" data-toggle="modal" data-target="#updateModal"
                                            data-id="{{ $event['id'] }}" data-name="{{ $event['name'] }}"
                                            data-email="{{ $event['email'] }}" data-photo="{{ $event['photo'] }}"
                                            data-institution="{{ $event['institution'] }}"
                                            data-teacher-id="{{ $event['teacher_id'] }}" data-date="{{ $event['date'] }}"
                                            data-details="{{ $event['details'] }}" data-status="{{ $event['status'] }}" />
                                    </a>
                                    <img src="/img/icons/delete.svg" class="deleteButton" data-id="{{ $event['id'] }}" />

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to Update Data -->
                    <form id="updateForm" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="record_id"> <!-- Hidden field for the record ID -->

                        <div class="form-group">
                            <label for="edit_teacher_id">Teacher</label>
                            <select name="teacher_id" id="edit_teacher_id" class="form-control" required>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_name">Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_photo">Photo</label>
                            <input type="file" name="photo" id="edit_photo" class="form-control">
                            <img id="current_photo" src="" alt="Current Photo" width="50" class="mt-2">
                        </div>

                        <div class="form-group">
                            <label for="edit_institution">Institution</label>
                            <input type="text" name="institution" id="edit_institution" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_date">Date</label>
                            <input type="date" name="date" id="edit_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_details">Details</label>
                            <textarea name="details" id="edit_details" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_status">Status</label>
                            <select name="status" id="edit_status" class="form-control" required>
                                <option value="bb">Belum Bertemu</option>
                                <option value="sb">Sudah Bertemu</option>
                            </select>
                        </div>

                        <button type="submit" id="updateForm" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
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
            $('#updateModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id'); // Extract info from data-* attributes
                var name = button.data('name');
                var teacherId = button.data('teacher-id');
                var email = button.data('email');
                var photo = button.data('photo');
                var institution = button.data('institution');
                var date = button.data('date');
                var details = button.data('details');
                var status = button.data('status');

                var modal = $(this);

                // Set the form field values
                modal.find('#updateForm').attr('action', '/events/' + id)
                modal.find('#record_id').val(id);
                modal.find('#edit_name').val(name);
                modal.find('#edit_email').val(email);
                modal.find('#edit_teacher_id').val(teacherId);
                modal.find('#edit_institution').val(institution);
                modal.find('#edit_date').val(date);
                modal.find('#edit_details').val(details);
                modal.find('#edit_status').val(status);

                // Set current photo preview if available
                if (photo) {
                    modal.find('#current_photo').attr('src', '/storage/' + photo).show();
                } else {
                    modal.find('#current_photo').hide();
                }

            });
            // $('#updateForm').submit(function(e) {
            //     e.preventDefault(); // Prevent the default form submission

            //     var formData = new FormData(this); // Create a FormData object from the form
            //     // console.log($(this).attr('action'))
            //     if (confirm('Are you sure you want to update this user?')) {
            //         $.ajax({
            //             url: $(this).attr('action'),
            //             type: 'PUT', // Use PUT method
            //             data: formData,
            //             processData: false, // Prevent jQuery from automatically transforming the data into a query string
            //             contentType: false, // Prevent jQuery from setting contentType
            //             success: function(response) {
            //                 // Handle success (e.g., show a success message or update the UI)
            //                 alert('Record updated successfully!');
            //                 $('#updateModal').modal('hide');
            //                 // Optionally refresh data or update the UI
            //             },
            //             error: function(xhr) {
            //                 // Handle errors (e.g., show an error message)
            //                 alert('An error occurred: ' + xhr.responseText);
            //             }
            //         });
            //     }
            // });
        });
    </script>
@endsection
