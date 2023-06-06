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
            table.columns(3).search(selectedType).draw();
        });

        // Lọc khóa học theo giá
        function filterByPrice() {
            table.draw();
        }

        // Áp dụng extension search cho việc lọc theo giá
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var minPrice = parseInt($('#min-price-input').val()) || 0;
            var maxPrice = parseInt($('#max-price-input').val()) || Infinity;
            var price = parseFloat(data[4]) || 0;

            return price >= minPrice && price <= maxPrice;
        });

        // Xử lý sự kiện khi giá tối thiểu hoặc tối đa thay đổi
        $('#min-price-input, #max-price-input').on('keyup change', function() {
            filterByPrice();
        });

        // Lọc khóa học mới nhất
        var lastTime = $('#last-time').val();
        console.log(lastTime); // Hiển thị giá trị thời gian gần nhất trong console

        $('#filter-new').click(function() {
            table.columns(6).search(lastTime).draw();
        });
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
