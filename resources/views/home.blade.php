<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Starter</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/node_modules/admin-lte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/node_modules/admin-lte/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="/node_modules/admin-lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link {{ $list === 'Companies' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Companies</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('home.employees') }}" class="nav-link {{ $list === 'Employees' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Employees</p>
                                </a>
                            </li>
                        </ul>

                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $list }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('status2'))
                <div class="alert alert-danger">
                    {{ session('status2') }}
                </div>
            @endif

            <div class="container-fluid">

                <!-- Create Modal -->
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Create new {{ strtolower($singular) }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            @include('forms.company')

                        </div>
                    </div>
                </div>

                <!-- Create Modal -->
                <div class="modal fade" id="createEmpModal" tabindex="-1" role="dialog" aria-labelledby="createEmpModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createEmpModalLabel">Create new {{ strtolower($singular) }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            @include('forms.employee')

                        </div>
                    </div>
                </div>

                <table class="table">
                @if ($list === 'Companies')
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Logo</th>
                        <th>
                            <button title="add company" class="btn btn-default waves-effect" data-toggle="modal" data-target="#createModal">
                                <i class="fa fa-plus"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($companies as $key => $company)

                        <div style="display:none" class="edit-item" id="edit-item-{{ $company->name }}">
                            <h3>Edit company: {{ $company->name }}</h3>
                            <form method="POST" action="{{ route('companies.update', $company->name) }}" enctype="multipart/form-data">
                            {{--<form method="PUT" action="{{ route('companies.update', $company->name) }}" enctype="multipart/form-data">--}}
                                @csrf

                                {{--name--}}
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $company->name }}" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--email--}}
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $company->email }}" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--website--}}
                                <div class="form-group row">
                                    <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>

                                    <div class="col-md-6">
                                        <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $company->website }}" autofocus>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--logo--}}
                                <div class="form-group row">
                                    <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>

                                    <div class="col-md-6">
                                        <small>{{ $company->logo }}</small>
                                        <input id="logo" type="file" class="@error('logo') is-invalid @enderror" name="logo" autofocus>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button onclick="hideEdit('{{ $company->name }}')" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </form>


                        </div>

                        <tr>
                            <td id="comp-name-{{ $key }}">{{ $company->name }}</td>
                            <td id="comp-email-{{ $key }}">{{ $company->email }}</td>
                            <td id="comp-website-{{ $key }}">{{ $company->website }}</td>
                            <td><img height="50px" src="storage/{{ $company->logo }}"></td>
                            <td>
                                <button onclick="showEdit('{{ $company->name }}')" title="edit company" class="btn btn-default waves-effect"><i class="fa fa-pencil-alt"></i></button>
                                <a href="{{route('companies.destroy',$company->name)}}" class="btn btn-outline-danger waves-effect"><i class="fa fa-trash-alt"></i></a>

                            </td>
                        </tr>

                    @endforeach

                    {{ $companies->links() }}

                    </tbody>
                @endif
                @if ($list === 'Employees')
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>
                                <button title="add employee" class="btn btn-default waves-effect" data-toggle="modal" data-target="#createEmpModal">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($employees as $key => $employee)

                            @include('forms.employee')

                            <tr>
                                <td id="emp-first-name-{{ $key }}">{{ $employee->first_name }}</td>
                                <td id="emp-last-name-{{ $key }}">{{ $employee->last_name }}</td>
                                <td id="emp-company-{{ $key }}">{{ $employee->company }}</td>
                                <td id="emp-email={{ $key }}">{{ $employee->email }}"</td>
                                <td id="emp-phone={{ $key }}">{{ $employee->phone }}"</td>
                                <td>
                                    <button data-toggle="modal" data-target="#createEmpModal" title="edit employee" class="btn btn-default waves-effect"><i class="fa fa-pencil-alt"></i></button>
                                    <button title="delete employee" class="btn btn-outline-danger waves-effect"><i class="fa fa-trash-alt"></i></button>
                                </td>
                            </tr>

                        @endforeach

                        {{ $employees->links() }}

                        </tbody>
                @endif
                </table>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/node_modules/admin-lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/node_modules/admin-lte/dist/js/adminlte.min.js"></script>
<script src="/resources/js/custom.js"></script>
</body>
</html>
