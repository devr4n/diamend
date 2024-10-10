<div class="container-fluid">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Customers</h6>
        </div>

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
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Customers Datatable');
        $(function () {
            $('#customers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('customers.data') !!}',
                    type: 'GET',
                    error: function (xhr, error, code) {
                        console.log('Error:', error);
                        console.log('Code:', code);
                    }
                },
                columns: [
                    {data: 'id', name: 'id', searchable: false, sortable: false, className: 'text-center'},
                    {data: 'name', name: 'name', className: 'text-center text-nowrap'},
                    {data: 'surname', name: 'surname', className: 'text-center text-nowrap'},
                    {
                        data: 'phone_1',
                        name: 'phone_1',
                        className: 'text-center text-nowrap',
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<a href="tel:' + data + '">' + data + '</a>';
                        }
                    },
                    {
                        data: 'phone_2',
                        name: 'phone_2',
                        className: 'text-center text-nowrap',
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<a href="tel:' + data + '">' + data + '</a>';
                        }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center text-nowrap'}
                ],
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'></i>",
                        next: "<i class='fas fa-angle-right'></i>"
                    },
                    search: "<span class='me-2'>Search:</span>",
                    searchPlaceholder: "Type to search..."
                },
                drawCallback: function() {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    });
</script>
