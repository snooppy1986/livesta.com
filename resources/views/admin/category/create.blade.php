@extends('admin/layouts/adminLte')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Создать категорию</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('category.index')}}">Список категорий</a></li>
                            <li class="breadcrumb-item active">Создать категорию</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Создать</h3>
                            </div>
                            <form  method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="catName">Название категории</label>
                                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="catName"  placeholder="Название категории">
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Родительская категория</label>
                                        @include('admin/elements/_categorySelect', ['data_type'=>false])
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file">
                                        <div class="col-md-12 mb-3">
                                            <img
                                                id="prevImage"
                                                src=""
                                                alt=""
                                                width="180"
                                            >
                                        </div>
                                        <div class="col-md-12">
                                            <input
                                                name="thumbnail"
                                                type="file"
                                                class="custom-file-input"
                                                id="thumbnail"
                                                onchange="document.getElementById('prevImage').src = window.URL.createObjectURL(this.files[0])"
                                                value=""
                                            >
                                            <label class="custom-file-label" for="thumbnail">Оберіть зображення</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Создать</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </div>
@endsection



