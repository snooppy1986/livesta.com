@extends('admin/layouts/adminLte')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать категорию</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('category.index')}}">Список категорий</a></li>
                            <li class="breadcrumb-item active">Редактировать категорию</li>
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
                                <h3 class="card-title">Редактировать</h3>
                            </div>
                            <form  method="post" action="{{route('category.update', ['category'=>$category])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="catName">Название категории</label>
                                        <input name="title" type="text" class="form-control" id="catName" value="{{$category->title}}" placeholder="Название категории">
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Родительская категория</label>
                                        @include('admin/elements/_categorySelect', ['data_type'=>false])
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <div class="col-md-12 mb-3">
                                                <img
                                                    id="prevImage"
                                                    src="{{$category->thumbnail}}"
                                                    alt="{{$category->title}}"
                                                    width="70"
                                                    height="80"
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
                                                @error('thumbnail')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input name="id" type="hidden" value="{{$category->id}}">
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Изменить</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </div>
@endsection


