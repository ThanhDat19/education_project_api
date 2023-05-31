@extends('admin.main')


@section('contents')
    <div class="container rounded bg-white">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5 ">
                    <img class="rounded mt-2" src="{{ Auth::user()->avatar }}" height="200px"
                        style="width:200px; height: 200px; object-fit: cover;"><span
                        class="font-weight-bold">{{ Auth::user()->name }}</span><span
                        class="text-black-50">{{ Auth::user()->email }}</span><span>
                    </span>
                </div>
                <form action="avatar/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Ảnh đại diện</label>
                        <input type="file" name="image_validate" class="form-control" id="upload">
                        <div id="image_show">
                            <a href="{{ Auth::user()->avatar }}" target="_blank">
                                <img src="{{ Auth::user()->avatar }}" class="mt-2" alt="" width="150px">
                            </a>
                        </div>
                        <input type="hidden" name="avatar" id="image" value="{{ Auth::user()->avatar }}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary profile-button" type="button">Lưu thay
                            đổi</button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Thông tin cá nhân</h4>
                    </div>
                    <form action="" method="post">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Họ và Tên:</label><input type="text"
                                    name="name" value="{{ Auth::user()->name }}" class="form-control"
                                    placeholder="Họ tên"></div>
                            <div class="col-md-12"><label class="labels">Số điện thoại:</label><input type="text"
                                    name="phone" value="{{ Auth::user()->phone }}" class="form-control"
                                    placeholder="Số điện thoại"></div>
                            <div class="col-md-12">
                                <label for="user">Email</label>
                                <p class="form-control">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button type="submit" class="btn btn-primary profile-button" type="button">Lưu thay
                                đổi</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>Chức năng</span>
                    </div><br>
                    <div class="col-md-12 mt-2">
                        {{-- <a href="#" class="btn btn-primary">Đổi mật khẩu</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
