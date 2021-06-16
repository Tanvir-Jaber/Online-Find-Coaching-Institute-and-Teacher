</div>
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../../dist/js/bappi.js"></script>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="../../dist/js/demo.js"></script>
    <script src="../../assets/js/wow.min.js"></script>
    <script>
        new WOW().init();
        $("#toast-container").fadeOut(3000)

        $(function () {
            $("#example1").DataTable({
                "ordering": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": true,
                "info": true,
                buttons: [
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0,1,2,3,4]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0,1,2,3,4]
                        }

                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0,1,2,3,4]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0,1,2,3,4]
                        }
                    }
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        $("#UpdatePass").validate({
            rules:{
                password:{
                    required: true,
                    minlength:6
                },
                repass:{
                    required: true,
                    minlength:6,
                    equalTo:"#password"
                }
            },

            messages:{
                password:{
                    required: "Please provide a strong password",
                    minlength:" Password should be above 5 characters "
                },
                repass:{
                    required: "Please provide a confirm password",
                    minlength:"Password should be above 5 characters ",
                    equalTo:"Confirm Password Should be same to Password"
                }
            }
        });
    </script>
    </body>
    </html>


