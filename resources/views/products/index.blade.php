<x-app-layout>
    @pushOnce('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

        <style>
            html.dark .dataTables_wrapper {
                color: #e2e8f0;
            }

            html.dark table.dataTable thead th {
                background-color: #1f2937;
                color: #ffffff;
                text-align: center;
            }

            html.dark table.dataTable tbody td {
                background-color: #1f2937;
                color: #f3f4f6;
            }

            html.dark table.dataTable tbody td,
            table.dataTable tbody td {
                vertical-align: middle;
                text-align: center;
            }

            html.dark .badge {
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 0.75rem;
                font-weight: 600;
                display: inline-block;
            }

            html.dark .badge-pending {
                background-color: #f59e0b;
                color: #fff;
            }

            html.dark .badge-delivered {
                background-color: #16a34a;
                color: #fff;
            }

            html.dark .badge-canceled {
                background-color: #991b1b;
                color: #fff;
            }


            html.dark .dataTables_wrapper .dataTables_paginate .paginate_button.current,
            .current {
                background-color: #ea580c !important;
                color: #fff !important;
            }

            html.dark .dataTables_wrapper .dataTables_paginate .paginate_button,
            html.dark .dataTables_wrapper .dataTables_paginate .ellipsis {
                /* background-color: #ffe9d9; */
                /* orange-500 */
                color: #fff !important;
                border: 1px solid #ea580c;
                border-radius: 4px;
                /* padding: 5px 10px; */
                /* margin: 0 2px; */
            }

            html.dark .dataTables_wrapper .dataTables_filter input,
            html.dark .dataTables_wrapper .dataTables_length select {
                background-color: #374151;
                color: #f3f4f6;
                border: 1px solid #4b5563;
                padding: 5px 8px;
                border-radius: 4px;
            }

            html.dark .dataTables_info,
            html.dark .dataTables_filter,
            html.dark .dataTables_wrapper .dataTables_length label,
            html.dark .dataTables_wrapper .dataTables_filter label {
                color: #cbd5e1;
            }

            .dataTables_length,
            .dataTables_paginate {
                margin-bottom: 10px;
            }
        </style>
    @endPushOnce

    @pushOnce('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('product.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'image_urls',
                            name: 'image_urls'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'is_active',
                            name: 'is_active'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50, 100],
                    responsive: true
                });

                $(document).on('click', '.delete_row', function(e) {
                    e.preventDefault();
                    const url = $(this).data('value');
                    swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover this record!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#EF5350",
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel pls!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                $.ajax({
                                    url: url,
                                    type: "Delete",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                    }
                                }).done(function(data) {
                                    swal({
                                        title: "Deleted!",
                                        text: "Record has been successfully deleted..",
                                        type: "success",
                                        showCancelButton: false,
                                        timer: 500
                                    });

                                    $('#myTable').DataTable().row($(this).parents('tr')).remove()
                                        .draw();
                                });

                            } else {
                                swal({
                                    title: "Cancelled",
                                    text: "Your record is safe!",
                                    confirmButtonColor: "#2196F3",
                                    type: "error"
                                });
                            }
                        });
                });
            });
        </script>
    @endPushOnce

    <x-head-label>
        {{ __('Products List') }}
    </x-head-label>

    <div class="py-4">
        <div class="overflow-x-auto bg-white dark:text-white dark:bg-gray-800 p-3">
            <table id="myTable" class="min-w-full">
                <thead>
                    <tr class="font-bold">
                        <th>#</th>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Is Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</x-app-layout>
