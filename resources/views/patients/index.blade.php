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

            <!-- Bootstrap JS (Ensure this is included for modal functionality) -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <div class="container p-4 mx-auto my-5 bg-white rounded-lg shadow-lg">
                <h1 class="mb-4 text-2xl font-semibold">Data Pasien (Patient Data)</h1>

                <!-- Button to Add New Patient -->
                <button class="px-4 py-2 mb-3 font-semibold text-white bg-blue-500 rounded-md shadow-md btn btn-primary hover:bg-blue-600" id="addPatientBtn" data-bs-toggle="modal" data-bs-target="#patientModal">
                    Add New Patient
                </button>

                <!-- Patient Table -->
                <table class="w-full bg-gray-100 rounded-md shadow-md table-auto">
                    <thead class="text-left bg-blue-200">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nama Pasien</th>
                            <th class="px-4 py-2">Alamat</th>
                            <th class="px-4 py-2">No Telepon</th>
                            <th class="px-4 py-2">Rumah Sakit</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="patientTable">
                        @foreach ($patients as $patient)
                            <tr data-id="{{ $patient->id }}" class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $patient->id }}</td>
                                <td class="px-4 py-2">{{ $patient->name }}</td>
                                <td class="px-4 py-2">{{ $patient->address }}</td>
                                <td class="px-4 py-2">{{ $patient->phone }}</td>
                                <td class="px-4 py-2">{{ $patient->hospital->name }}</td>
                                <td class="px-4 py-2">
                                    <button class="px-4 py-2 text-white bg-yellow-500 rounded-md btn btn-info editPatientBtn hover:bg-yellow-600" data-id="{{ $patient->id }}" data-bs-toggle="modal" data-bs-target="#patientModal">
                                        Edit
                                    </button>
                                    <button class="px-4 py-2 text-white bg-red-500 rounded-md btn btn-danger deletePatientBtn hover:bg-red-600" data-id="{{ $patient->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal to Add/Edit Patient -->
            <div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="text-white bg-blue-500 modal-header">
                            <h5 class="modal-title" id="patientModalLabel">Add/Edit Patient</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="patientForm">
                                <input type="hidden" id="patientId">
                                <div class="mb-4">
                                    <label for="patientName" class="block text-gray-700">Nama Pasien</label>
                                    <input type="text" class="w-full p-2 border border-gray-300 rounded-md form-input focus:outline-none focus:ring-2 focus:ring-blue-500" id="patientName" name="name" required>
                                </div>
                                <div class="mb-4">
                                    <label for="patientAddress" class="block text-gray-700">Alamat</label>
                                    <input type="text" class="w-full p-2 border border-gray-300 rounded-md form-input focus:outline-none focus:ring-2 focus:ring-blue-500" id="patientAddress" name="address" required>
                                </div>
                                <div class="mb-4">
                                    <label for="patientPhone" class="block text-gray-700">No Telepon</label>
                                    <input type="text" class="w-full p-2 border border-gray-300 rounded-md form-input focus:outline-none focus:ring-2 focus:ring-blue-500" id="patientPhone" name="phone" required>
                                </div>
                                <div class="mb-4">
                                    <label for="hospitalId" class="block text-gray-700">Rumah Sakit</label>
                                    <select class="w-full p-2 border border-gray-300 rounded-md form-select focus:outline-none focus:ring-2 focus:ring-blue-500" id="hospitalId" name="hospital_id" required>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="px-6 py-2 text-white bg-blue-500 rounded-md btn btn-primary hover:bg-blue-600">
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
            // Set up CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let isEdit = false;
            let editId = null;

            // Open the modal for adding a new patient
            $('#addPatientBtn').on('click', function() {
                isEdit = false;
                $('#patientModalLabel').text('Add New Patient');
                $('#patientForm')[0].reset();
                $('#patientId').val('');
            });

            // Open modal for editing an existing data
            $('.editPatientBtn').on('click', function() {
                isEdit = true;
                editId = $(this).data('id');
                $('#patientModalLabel').text('Edit Patient');

                const row = $(this).closest('tr');
                $('#patientId').val(editId);
                $('#patientName').val(row.find('td').eq(1).text());
                $('#patientAddress').val(row.find('td').eq(2).text());
                $('#patientPhone').val(row.find('td').eq(3).text());
                $('#hospitalId').val(row.find('td').eq(4).data('id'));

                $('#patientModal').modal('show');
            });

            // Handle form submission for add or edit
            $('#patientForm').on('submit', function(e) {
                e.preventDefault();

                const formData = {
                    name: $('#patientName').val(),
                    address: $('#patientAddress').val(),
                    phone: $('#patientPhone').val(),
                    hospital_id: $('#hospitalId').val(),
                };

                const url = isEdit ? `/patients/${editId}` : '/patients';
                const type = isEdit ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: type,
                    data: formData,
                    success: function(response) {
                        alert(isEdit ? 'Patient updated successfully!' : 'Patient added successfully!');
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.responseText);
                        alert('There was an error processing your request.');
                    }
                });
            });

            // Handle delete button click
            $(document).on('click', '.deletePatientBtn', function() {
                const patientId = $(this).data('id');
                if (confirm('Are you sure you want to delete this patient?')) {
                    const url = `/patients/${patientId}`;

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(response) {
                            alert('Patient deleted successfully!');
                            location.reload(); // Reload page to show updated data
                        },
                        error: function(xhr) {
                            console.error("Error:", xhr.responseText);
                            alert('There was an error processing your request.');
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
