<div id="sidebar" class="active">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="/admin/"><img src="{{ asset('template/assets/images/logo/logo.svg') }}" alt="Logo"
                            srcset=""></a>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                        height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item active">
                    <a href="/admin/" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Danh Mục</span>
                    </a>
                </li>
                {{-- COURSE --}}
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Khóa Học</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/admin/course/add">Thêm khóa học</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/course/list">Danh sách khóa học</a>
                        </li>
                    </ul>
                </li>

                {{-- COURSE CATEGORY --}}
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <span>Loại Khóa Học</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/admin/course-category/add">Thêm loại khóa học</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/course-category/list">Danh sách loại khóa học</a>
                        </li>
                    </ul>
                </li>

                {{-- TEST --}}
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <span>Bài Kiểm Tra</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/admin/tests/add">Thêm bài kiểm tra</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/tests/list">Danh sách bài kiểm tra</a>
                        </li>
                    </ul>
                </li>

                {{-- QUESTIONS --}}
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <span>Câu Hỏi</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/admin/questions/add">Thêm câu hỏi</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/questions/list">Danh sách câu hỏi</a>
                        </li>
                    </ul>
                </li>

                {{-- QUESTION TYPES --}}
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="nav-icon fas fa-address-book"></i>
                        <span>Lĩnh Vực Câu Hỏi</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/admin/question-types/add">Thêm lĩnh vực</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/question-types/list">Danh sách lĩnh vực</a>
                        </li>
                    </ul>
                </li>

                {{-- SETTING --}}
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-users-cog"></i>
                        <span>Cài Đặt</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/profile/edit/{{ Auth::user()->id }}">Cập nhật thông tin</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/pages/list">Cập nhật trang</a>
                        </li>
                        <li class="submenu-item">
                            {{-- <a href="/admin/accounts/admins/list">Đăng xuất</a> --}}
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                Đăng xuất
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 714px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 298px;"></div>
        </div>
    </div>
</div>
