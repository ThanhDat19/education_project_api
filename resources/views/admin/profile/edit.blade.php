@extends('admin.main')

@section('head')
    <style>
        .image_custome_style {
            border-radius: 100%;
            max-width: 300px;
            max-height: 300px;
            min-width: 300px;
            min-height: 300px;
        }
    </style>
@endsection
@section('contents')
    <div class="container rounded bg-white ">
        <div class="col-sm-8" style="margin-left:18%">
            <form action="1" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group">
                        <label for="profile">Ảnh đại diện</label>
                        <input type="file" name="image_validate" class="form-control" id="upload">
                        <div id="image_show" class="mt-4">
                            @if (Auth::user()->avarta)
                                <a href="{{ Auth::user()->avarta }}" target="_blank">
                                    <img class="image_custome_style" src="{{ Auth::user()->avarta }}" alt=""
                                        width="400px">
                                </a>
                            @else
                                <a href="">
                                    <img class="image_custome_style" src="/storage/images/avatar/default-avatar.png"
                                        class="mt-2" alt="" width="150px"
                                        style="maxwidth:200px; minwidth:200px; maxheight:200px; minheight:200px; display:block; margin-left:auto; margin-right:auto ; ">
                                </a>
                            @endif

                        </div>
                        <input type="hidden" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label for="profile">Họ và Tên:</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control"
                            placeholder="Họ tên">
                    </div>
                    <div class="form-group">
                        <label for="profile">Email:</label>
                        <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control"
                            placeholder="Email">
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button type="submit" class="btn btn-primary profile-button" type="button">Lưu thay
                        đổi</button>
                </div>

        </div>
        </form>
    </div>
    </div>
    </div>
    </div>
@endsection

