@extends('admin.layouts.adminLte')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><b>Seo</b> головної сторінки</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li class="breadcrumb-item active">Seo головної сторінки</li>
                        </ol>
                    </div>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-info">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 m-auto" >
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Meta дані</h3>
                            </div>


                            <form action="{{route('seo.update', ['meta'=>$data])}}" method="post">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="title">Назва головної сторінки</label>
                                        <input
                                            name="title"
                                            type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            id="title"
                                            placeholder="Назва продукту"
                                            value="{{$data->title}}"
                                        >
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="keywords">Ключові слова (додайте ключові слова через кому)</label>
                                        <input
                                            name="keywords"
                                            type="text"
                                            class="form-control @error('keywords') is-invalid @enderror"
                                            id="keywords"
                                            placeholder="Додайте ключові слова через кому"
                                            value="{{$data->keywords}}"
                                        >
                                        @error('keywords')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Опис</label>
                                        <input
                                            name="description"
                                            type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="description"
                                            placeholder="Опис сторінки"
                                            value="{{$data->description}}"
                                        >
                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Редагувати</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
@endsection
