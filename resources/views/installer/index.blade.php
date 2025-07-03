<x-app-layout>
    @pushOnce('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

        <style>
            /* Table container and text color */
            body.dark .dataTables_wrapper {
                color: #e2e8f0;
            }

            /* Table header */
            body.dark table.dataTable thead th {
                background-color: #f97316;
                /* orange-500 */
                color: #ffffff;
                border-color: #ea580c;
                text-align: center;
            }

            /* Table body rows */
            body.dark table.dataTable tbody td {
                background-color: #1f2937;
                /* gray-800 */
                color: #f3f4f6;
                /* gray-100 */
                vertical-align: middle;
                text-align: center;
            }

            /* Status badges */
            body.dark .badge {
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 0.75rem;
                font-weight: 600;
                display: inline-block;
            }

            body.dark .badge-pending {
                background-color: #f59e0b;
                /* amber-500 */
                color: #fff;
            }

            body.dark .badge-delivered {
                background-color: #16a34a;
                /* green-600 */
                color: #fff;
            }

            body.dark .badge-canceled {
                background-color: #991b1b;
                /* red-800 */
                color: #fff;
            }

            /* Pagination buttons */
            body.dark .dataTables_wrapper .dataTables_paginate .paginate_button {
                background-color: #f97316;
                /* orange-500 */
                color: #fff !important;
                border: 1px solid #ea580c;
                border-radius: 4px;
                padding: 5px 10px;
                margin: 0 2px;
            }

            body.dark .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                background-color: #ea580c;
                /* deeper orange */
                color: #fff !important;
            }

            /* Inputs and dropdowns */
            body.dark .dataTables_wrapper .dataTables_filter input,
            body.dark .dataTables_wrapper .dataTables_length select {
                background-color: #374151;
                /* gray-700 */
                color: #f3f4f6;
                border: 1px solid #4b5563;
                padding: 5px 8px;
                border-radius: 4px;
            }

            /* Info and labels */
            body.dark .dataTables_info,
            body.dark .dataTables_wrapper .dataTables_length label,
            body.dark .dataTables_wrapper .dataTables_filter label {
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
                    ajax: "{{ route('installer.index') }}",
                    columns: [{
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'mobile_no',
                            name: 'mobile_no'
                        },
                        // {
                        //     data: 'status',
                        //     name: 'status'
                        // }
                    ],
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50, 100],
                    responsive: true
                });
            });
        </script>
    @endPushOnce

    <div class="p-4">
        <div class="overflow-x-auto">
            <table id="myTable" class="min-w-full bg-white border border-gray-300 dark:text-white dark:bg-gray-900 ">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        {{-- <th>Status</th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</x-app-layout>
