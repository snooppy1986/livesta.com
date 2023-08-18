@extends('admin/layouts/adminLte')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Продукти</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li class="breadcrumb-item active">Продукти</li>
                        </ol>
                    </div>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <a href="{{route('product.create')}}" class="btn btn-success mb-3 ml-2">
                <i class="fa fa-plus mr-2"></i> Новий продукт
            </a>
            <div class="container-fluid">
                {{ $dataTable->table() }}
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
