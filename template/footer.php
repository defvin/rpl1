<html lang="en">
<head>
    <!-- Your head content -->
    <style>
        .table-responsive {
            overflow-x: hidden;
        }

        #table_barang {
            width: 100%;
        }

        .dataTables_paginate{
            float: right;
        }
        .dataTables_filter {
           float: right;
        }
    </style>
</head>
<body>
<script src="assets/js/jquery.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
    $('#table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
$(document).ready(function() {
    $('#table_barang').DataTable( {
        autoWidth: false
    } );
} );
    </script>

</body>
</html>
