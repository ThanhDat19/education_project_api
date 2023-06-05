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
                @endphp

                <table id="myTable" class="table">
                    {{-- <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên Khóa Học</th>
                            <th>Loại khóa học</th>
                            <th>Giá khóa học</th>
                            <th>Trạng thái</th>
                            <th>Ngày cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        <tr>
                            <td>HOME</td>
                            <td>
                                {{ $home->home_title }}
                            </td>
                            <td>{{ $home->home_subtitle }}</td>
                            <td>
                                {{-- {{ $home->home_title }} --}}
                            </td>
                            <td>
                                @if ($home->updated_at == null)
                                    <span class="text-danger">Chưa đặt thời gian</span>
                                @else
                                    {{ $home->updated_at->diffForHumans() }}
                                @endif
                            </td>

                            <td>
                                <a href="/admin/pages/home/edit/{{ $home->id }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>FOOTER</td>
                            <td>
                                {{ $footer->address }}
                            </td>
                            <td>{{ $footer->email }}</td>
                            <td>{{ $footer->phone }}</td>
                            <td>
                                @if ($footer->updated_at == null)
                                    <span class="text-danger">Chưa đặt thời gian</span>
                                @else
                                    {{ $footer->updated_at->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="/admin/pages/footer/edit/{{ $footer->id }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>INFORMATION</td>
                            <td>
                                {{-- {{ $footer->address }} --}}
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                @if ($information->updated_at == null)
                                    <span class="text-danger">Chưa đặt thời gian</span>
                                @else
                                    {{ $information->updated_at->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="/admin/pages/information/edit/{{ $information->id }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
