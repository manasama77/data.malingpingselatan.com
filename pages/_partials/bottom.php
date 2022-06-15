        </div> <!-- ./col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main -->
        </div>
        </div>

        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../../assets/js/jquery.js"></script>
        <script src="../../assets/js/jquery.min.js"></script>
        <script>
          window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
        </script>
        <script src="../../assets/js/bootstrap.min.js"></script>

        <!-- Datatable -->
        <script src="../../assets/js/jquery.dataTables.min.js" charset="utf-8"></script>
        <script src="../../assets/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable').DataTable({
              "language": {
                "lengthMenu": "Menampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada Data !",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Data tidak tersedia !",
                "search": "Pencarian :",
                "next": "Selanjutnya",
                "previous": "Sebelumnya",
              },
              ordering: false,
            });
          });
        </script>

        <!-- Date Range Picker -->
        <script type="text/javascript" src="../../assets/js/moment.min.js"></script>
        <script type="text/javascript" src="../../assets/js/daterangepicker.js"></script>
        <script type="text/javascript">
          $(function() {
            $('.datepicker').daterangepicker({
              singleDatePicker: true,
              showDropdowns: true,
              locale: {
                format: 'YYYY-MM-DD',
                monthNames: [
                  "Januari",
                  "Februari",
                  "Maret",
                  "April",
                  "Mei",
                  "Juni",
                  "Juli",
                  "Agustus",
                  "September",
                  "Oktober",
                  "November",
                  "Desember"
                ],
                "daysOfWeek": [
                  "Mg",
                  "Sn",
                  "Sl",
                  "Rb",
                  "Km",
                  "Jm",
                  "Sb"
                ]
              }
            });
          });
        </script>

        <!-- Bootstrap Select -->
        <script src="../../assets/js/bootstrap-select.min.js"></script>
        <script type="text/javascript">
          $('.selectlive').selectpicker({
            liveSearch: true,
            size: 6
          });
          $('.selectpicker').selectpicker();
        </script>

        <!-- Lightbox -->
        <script src="../../assets/lib/lightbox/js/lightbox.min.js"></script>

        <!-- select2 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
          $('.select2').select2()
        </script>
        </body>

        </html>