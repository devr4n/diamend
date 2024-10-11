<div class="container-fluid">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center" id="customers-table">
                    <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Phone 1</th>
                        <th>Phone 2</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('customers.data') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'surname', name: 'surname' },
                { data: 'phone_1', name: 'phone_1' },
                { data: 'phone_2', name: 'phone_2' },
                { data: 'address', name: 'address' },
                { data: 'created_at', name: 'created_at', render: function(data) {
                        return moment(data).format('DD-MM-YYYY');
                    }},
                { data: null, orderable: false, searchable: false, render: function(data) {
                        return `
                <button type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-pen"></i></button>
                <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
            `;
                    }}
            ]
        });
    });
</script>
