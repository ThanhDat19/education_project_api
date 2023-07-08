@extends('admin.main')
@section('contents')
    <div class="row mt-2">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldStar"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">
                                Khóa Học
                            </h6>
                            <h6 class="font-extrabold mb-0"></h6>
                        </div>
                    </div>
                    <a href="/admin/course/list" class="small-box-footer">Xem chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldCategory"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">
                                Loại Khóa Học
                            </h6>
                            <h6 class="font-extrabold mb-0"></h6>
                        </div>
                    </div>
                    <a href="/admin/course-category/list" class="small-box-footer">Xem chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldInfo-Circle"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">
                                Bài Kiểm Tra
                            </h6>
                            <h6 class="font-extrabold mb-0"></h6>
                        </div>
                    </div>
                    <a href="/admin/tests/list" class="small-box-footer">Xem chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldTick-Square"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">
                                Câu Hỏi
                            </h6>
                            <h6 class="font-extrabold mb-0"></h6>
                        </div>
                    </div>
                    <a href="/admin/questions/list" class="small-box-footer">Xem chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="card">
            <div class="card-body" style="width: 100%; margin: auto">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: {!! json_encode($datasets) !!},
                },
            });
        </script>

    </div>
@endsection
