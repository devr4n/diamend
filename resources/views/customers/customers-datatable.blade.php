<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="customers-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Phone 1</th>
                <th>Phone 2</th>
                <th>Address</th>
                <th>Created At</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            $('#customers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('customers.data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'phone_1', name: 'phone_1'},
                    {data: 'phone_2', name: 'phone_2'},
                    {data: 'address', name: 'address'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush
