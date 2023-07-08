<script src="/template/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/template/js/vendor/jquery.min.js" type="text/javascript"></script>
<script src="/template/js/vendor/popper.min.js" type="text/javascript"></script>
<script src="/template/js/vendor/bootstrap.min.js" type="text/javascript"></script>
<script src="/template/js/vendor/functions.js" type="text/javascript"></script>

<!-- JS -->
<script src="/template/front/js/jquery.js"></script>
<script src="/template/front/js/jquery.migrate.js"></script>
<script src="/template/front/scripts/bootstrap/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
{{-- <script>
    var $target_end = $(".best-of-the-week");
</script> --}}
{{-- <script src="/template/front/scripts/jquery-number/jquery.number.min.js"></script> --}}
{{-- <script src="/template/front/scripts/owlcarousel/dist/owl.carousel.min.js"></script> --}}
{{-- <script src="/template/front/scripts/magnific-popup/dist/jquery.magnific-popup.min.js"></script> --}}
{{-- <script src="/template/front/scripts/easescroll/jquery.easeScroll.js"></script> --}}
<script src="/template/front/scripts/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/template/front/scripts/icheck/icheck.min.js"></script>
<script src="/template/front/scripts/toast/jquery.toast.min.js"></script>
<script src="/template/front/js/demo.js"></script>
{{-- <script src="/template/front/js/e-magz.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="/template/admin/js/main.js"></script>
<script>
    $(document).ready(function() {
        $("#content").summernote({
            tabsize: 2,
            height: 200
        });
        $('.dropdown-toggle').dropdown();
    });

    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
<script>
    $("input").iCheck({
        checkboxClass: 'icheckbox_square-red',
        radioClass: 'iradio_square-red',
        cursor: true
    });
</script>
<script>
    $(function() {
        var availableTags = [];
        $.ajax({
            type: "GET",
            url: "/post-list",
            success: function(response) {
                startAutoComplete(response)
            }
        });

        function startAutoComplete(availableTags) {
            $("#search").autocomplete({
                source: availableTags
            });
        }

    });
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'Amount');

        // Thêm dữ liệu vào DataTable
        for (var i = 0; i < <?= count($dates) ?>; i++) {
            data.addRow([<?= json_encode($dates[$i]) ?>, <?= $amounts[$i] ?>]);
        }

        var options = {
            title: 'Revenue Chart',
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

@yield('footer')
