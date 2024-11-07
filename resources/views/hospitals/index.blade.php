<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>Patient Data</title>

            <!-- Include jQuery first -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <div class="container p-4 mx-auto my-5 bg-white rounded-lg shadow-lg">
                <h1 class="mb-4 text-2xl font-semibold">Data Rumah Sakit (Hospital Data)</h1>

                <!-- Button to Add New Hospital -->
                <button class="px-4 py-2 mb-3 font-semibold text-white bg-green-500 rounded-md shadow-md btn btn-primary hover:bg-green-600" id="addHospitalBtn" data-bs-toggle="modal" data-bs-target="#hospitalModal">
                    Add New Hospital
                </button>

                <!-- Hospital Table -->
                <table class="w-full bg-gray-100 rounded-md shadow-md table-auto">
                    <thead class="text-left bg-green-200">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nama Rumah Sakit</th>
                            <th class="px-4 py-2">Alamat</th>
                            <th class="px-4 py-2">No Telepon</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="hospitalTable">
                        @foreach ($hospitals as $hospital)
                            <tr data-id="{{ $hospital->id }}" class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $hospital->id }}</td>
                                <td class="px-4 py-2">{{ $hospital->name }}</td>
                                <td class="px-4 py-2">{{ $hospital->address }}</td>
                                <td class="px-4 py-2">{{ $hospital->phone }}</td>
                                <td class="px-4 py-2">{{ $hospital->email }}</td>
                                <td class="px-4 py-2">
                                    <button class="px-4 py-2 text-white bg-yellow-500 rounded-md btn btn-info editHospitalBtn hover:bg-yellow-600" data-id="{{ $hospital->id }}" data-bs-toggle="modal" data-bs-target="#hospitalModal">
                                        Edit
                                    </button>
                                    <button class="px-4 py-2 text-white bg-red-500 rounded-md btn btn-danger deleteHospitalBtn hover:bg-red-600" data-id="{{ $hospital->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal to Add/Edit Hospital -->
            <div class="modal fade" id="hospitalModal" tabindex="-1" aria-labelledby="hospitalModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="text-white bg-green-500 modal-header">
                            <h5 class="modal-title" id="hospitalModalLabel">Add/Edit Hospital</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="hospitalForm">
                                <input type="hidden" id="hospitalId">
                                <div class="mb-4">
                                    <label for="hospitalName" class="block text-gray-700">Nama Rumah Sakit</label>
                                    <input type="text" class="w-full p-2 border border-gray-300 rounded-md form-input focus:outline-none focus:ring-2 focus:ring-green-500" id="hospitalName" required>
                                </div>
                                <div class="mb-4">
                                    <label for="hospitalAddress" class="block text-gray-700">Alamat</label>
                                    <input type="text" class="w-full p-2 border border-gray-300 rounded-md form-input focus:outline-none focus:ring-2 focus:ring-green-500" id="hospitalAddress" required>
                                </div>
                                <div class="mb-4">
                                    <label for="hospitalPhone" class="block text-gray-700">No Telepon</label>
                                    <input type="text" class="w-full p-2 border border-gray-300 rounded-md form-input focus:outline-none focus:ring-2 focus:ring-green-500" id="hospitalPhone" required>
                                </div>
                                <div class="mb-4">
                                    <label for="hospitalEmail" class="block text-gray-700">Email</label>
                                    <input type="email" class="w-full p-2 border border-gray-300 rounded-md form-input focus:outline-none focus:ring-2 focus:ring-green-500" id="hospitalEmail" required>
                                </div>
                                <button type="submit" class="px-6 py-2 text-white bg-green-500 rounded-md btn btn-primary hover:bg-green-600">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <script>
        $(document).ready(function() {
            // CSRF token setup for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let isHospitalEdit = false;
            let editHospitalId = null;

            // Open modal for adding new hospital
            $('#addHospitalBtn').on('click', function() {
                isHospitalEdit = false;
                $('#hospitalModalLabel').text('Add New Hospital');
                $('#hospitalForm')[0].reset();
                $('#hospitalId').val('');
            });

            // Open modal for editing an existing data
            $('.editHospitalBtn').on('click', function() {
                isHospitalEdit = true;
                editHospitalId = $(this).data('id');
                $('#hospitalModalLabel').text('Edit Hospital');

                const row = $(this).closest('tr');
                $('#hospitalId').val(editHospitalId);
                $('#hospitalName').val(row.find('td').eq(1).text());
                $('#hospitalAddress').val(row.find('td').eq(2).text());
                $('#hospitalPhone').val(row.find('td').eq(3).text());
                $('#hospitalEmail').val(row.find('td').eq(4).text());

                $('#hospitalModal').modal('show');
            });

            // Handle form submission for add/edit hospital
            $('#hospitalForm').on('submit', function(e) {
                e.preventDefault();

                const formData = {
                    name: $('#hospitalName').val(),
                    address: $('#hospitalAddress').val(),
                    phone: $('#hospitalPhone').val(),
                    email: $('#hospitalEmail').val()
                };

                const url = isHospitalEdit ? `/hospitals/${editHospitalId}` : '/hospitals';
                const type = isHospitalEdit ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: type,
                    data: formData,
                    success: function(response) {
                        alert(isHospitalEdit ? 'Hospital updated successfully!' : 'Hospital added successfully!');
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.responseText);
                        alert('Error occurred while processing your request.');
                    }
                });
            });

            // Handle delete button for hospital
            $(document).on('click', '.deleteHospitalBtn', function() {
                const hospitalId = $(this).data('id');
                if (confirm('Are you sure you want to delete this hospital?')) {
                    const url = `/hospitals/${hospitalId}`;

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(response) {
                            alert('Hospital deleted successfully!');
                            location.reload();
                        },
                        error: function(xhr) {
                            console.error("Error:", xhr.responseText);
                            alert('Error occurred while processing your request.');
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
