@extends('admin.main')
@section('head')
    <style>
        .course-image {
            max-width: 100px;
        }
    </style>
@endsection
@section('contents')
    <section class="section">
        <div class="card">
            <div class="card-body">
                @php
                    \Carbon\Carbon::setLocale('vi');
                    $latestTime = null;
                @endphp

                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th style="width: 50px">STT</th>
                            <th>Chương trình</th>
                            <th>Hình thức</th>
                            <th>Mức giảm</th>
                            <th>Khóa học</th>
                            <th>Bắt đầu</th>
                            <th>Kết thúc</th>
                            <th style="width: 50px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($discounts as $discount)
                            <tr class="discounts">
                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ $discount->name }}
                                </td>
                                <td>{{ $discount->discount_types == 1 ? 'Giảm theo %' : 'Giảm theo số tiền' }}</td>
                                <td>
                                    {{ $discount->reduction_rate }}
                                </td>
                                <td>
                                    {{ $discount->course->title }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($discount->start_date)->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($discount->end_date)->format('d-m-Y') }}
                                </td>
                                <td>
                                    <a href="#" onclick="removeRow({{ $discount->id }},'/admin/discounts/destroy')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                {{ $discounts->links() }}
            </div>
        </div>
    </section>
@endsection
