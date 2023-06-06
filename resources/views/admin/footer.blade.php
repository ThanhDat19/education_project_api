<!-- jQuery -->
<script src="/template/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
{{-- <script src="/template/admin/dist/js/adminlte.min.js"></script>
<script src="/template/admin/js/main.js"></script> --}}
{{-- <script src="/template/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> --}}
<script src="/template/admin/js/main.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
{{-- <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- Admin --}}
<script src="{{ asset('template/assets/js/app.js') }}"></script>
<script src="{{ asset('template/admin/datepicker/js/bootstrap-datepicker.js') }}"></script>
<!-- Need: Apexcharts -->

<script>
    $(document).ready(function() {
        $("#content").summernote({
            tabsize: 2,
            height: 400
        });
        $('.dropdown-toggle').dropdown();
    });
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    $('.datepicker').datepicker()
</script>

<!-- File JavaScript để xử lý Ajax -->
<script>
    $(document).ready(function() {
        $('#course').change(function() {
            var course = $(this).val();

            $.ajax({
                url: '{{ route('get.lessons') }}',
                method: 'POST',
                data: {
                    course_id: course
                },
                success: function(response) {
                    $('#lesson').html(response);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Khởi tạo DataTables
        var table = $('#myTable').DataTable();

        // Lọc khóa học theo loại
        $('#course-type').change(function() {
            var selectedType = $(this).val();
            // console.log(selectedType)
            table.columns(3).search(selectedType).draw();
        });

        // Lọc khóa học theo giá
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var minPrice = parseInt($('#min-price-input').val());
                var maxPrice = parseInt($('#max-price-input').val());
                var price = parseFloat(data[4]) || 0;
                if ((minPrice == '' && maxPrice == '') ||
                    (minPrice == '' && price <= maxPrice) ||
                    (minPrice <= price && '' == maxPrice) ||
                    (minPrice <= price && price <= maxPrice)) {
                    return true;
                }
                return false;
            }
        )
        $('#filter-price').click(function() {
            table.draw();
        });
        // $('#filter-price').click(function() {

        //     // table.column(4).search((data, row) => {
        //     //     var price = parseInt(data.replace(/\D/g,
        //     //     console.log(true)
        //     //         '')); // Lấy giá từ chuỗi (loại bỏ ký tự không phải số)

        //     //     if ((isNaN(minPrice) || price >= minPrice) && (isNaN(maxPrice) || price <=
        //     //             maxPrice)) {
        //     //         console.log(true)
        //     //         return true;
        //     //     }
        //     //     console.log(false)

        //     //     return false;
        //     // }).draw();
        // });

        // Lọc khóa học theo khóa học mới tạo
        // $('#filter-new').click(function() {
        //     table.columns(6).search('Chưa đặt thời gian').draw();
        // });
    });
</script>

<script>
    $(document).ready(function() {
        loadData();

        function loadData() {
            $.ajax({
                url: '/admin/questions/filter-by-type', // Đường dẫn đến tuyến đường xử lý trong Laravel
                type: 'POST',
                data: {
                    questionTypeId: null,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#question-list').html(response);
                }
            });
        }
        $('#question-type-select').change(function() {
            var questionTypeId = $(this).val();

            $.ajax({
                url: '/admin/questions/filter-by-type', // Đường dẫn đến tuyến đường xử lý trong Laravel
                type: 'POST',
                data: {
                    questionTypeId: questionTypeId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#question-list').html(response);
                }
            });
        });


    });
</script>
{{-- <script src="{{ asset('template/assets/extensions/apexcharts/apexcharts.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/assets/js/pprices/dashboard.js') }}"></script> --}}
@yield('footer')
