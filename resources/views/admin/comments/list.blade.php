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
                            <th style="width: 50px">ID</th>
                            <th>Họ tên</th>
                            <th>Nội dung</th>
                            <th>Thô tục</th>
                            <th>Ngày cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($comments as $comment)
                            <tr class="course-item">
                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ $comment->user->name }}
                                </td>
                                <td>{{ $comment->comment_body }}</td>
                                <td>
                                    @if ($comment->impolite == 1)
                                        <button class="btn btn-danger">Tiêu cực</button>
                                    @else
                                        <button class="btn btn-success">Tích cực</button>
                                    @endif
                                </td>
                                <td>
                                    @if ($comment->updated_at == null)
                                        <span class="text-danger">Chưa đặt thời gian</span>
                                    @else
                                        {{ $comment->updated_at->diffForHumans() }}

                                        <?php
                                        $latestTime = $latestTime === null || $comment->updated_at > $latestTime ? $comment->updated_at : $latestTime;
                                        ?>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" onclick="removeRow({{ $comment->id }},'/admin/comment/destroy')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if ($latestTime !== null)
                        <input type="hidden" id="last-time" name="last_time" value="{{ $latestTime->diffForHumans() }}">
                    @endif


                </table>

                {{ $comments->links() }}
            </div>
        </div>
    </section>
@endsection
