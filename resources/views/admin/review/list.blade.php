@extends('admin.main')
@section('head')
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
                            <th style="width: 50px">ID</th>
                            <th>Họ tên</th>
                            <th>Tên Khóa Học</th>
                            <th>Nội dung</th>
                            <th>Thô tục</th>
                            <th>Số sao</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ $review->user->name }}
                                </td>
                                <td>{{ $review->course->title }}</td>
                                <td>{{ $review->content }}</td>
                                <td>
                                    @if ($review->impolite == 1)
                                        <span class="btn btn-danger btn-xs">YES</span>
                                    @else
                                        <span class="btn btn-success btn-xs">NO</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $review->star_count }}<i class="mx-1 fas fa-star text-warning"></i>
                                </td>
                                <td>
                                    <a href="#" onclick="removeRow({{ $review->id }},'/admin/reviews/destroy')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $reviews->links() }}
            </div>
        </div>
    </section>
@endsection
