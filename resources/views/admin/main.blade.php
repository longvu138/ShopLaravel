<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            {{--  --}}

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Xin Chào: {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/logout">Đăng Xuất</a>
                    </div>
                </div>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        @include('admin.sidebar')

        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @include('admin.alert')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- jquery validation -->
                            <div class="card card-primary mt-3">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $title }}</h3>
                                </div>
                                {{-- giao diện các trang con load vào đây --}}
                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>


    </div>
    <!-- ./wrapper -->
    @include('admin.footer')
</body>

</html>
