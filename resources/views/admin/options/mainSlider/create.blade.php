@extends('admin.layouts.adminLte')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Створити слайд</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('option.main-slider')}}">Список слайдів</a></li>
                            <li class="breadcrumb-item active">Створити слайд</li>
                        </ol>
                    </div>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-danger">
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
                                <h3 class="card-title">Створити слайд</h3>
                            </div>
                            <form action="{{route('main-slider.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
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
                                                    name="image"
                                                    type="file"
                                                    class="custom-file-input"
                                                    id="sliderImage"
                                                    onchange="document.getElementById('prevImage').src = window.URL.createObjectURL(this.files[0])"
                                                    value=""
                                                >
                                                <label class="custom-file-label" for="sliderImage">Оберіть зображення</label>
                                            </div>
                                            @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Заголовок слайду</label>
                                        <input
                                            name="title"
                                            type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            id="title"
                                            placeholder="Назва слайду"
                                            value="{{old('title')}}"
                                        >
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Опис слайду</label>
                                        <textarea
                                            name="content"
                                            class="form-control editor @error('content') is-invalid @enderror"
                                            rows="3"
                                            placeholder="Про слайд ..."
                                            value=""
                                        >{{old('content')}}</textarea>
                                        @error('content')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Обрати товар для слайду</label>
                                        <select
                                            name="product_link"
                                            id="slider_product"
                                            class="form-control"

                                        >
                                            <option value=""></option>
                                            @foreach($products as $prod)
                                                @if(isset($product) && count($product->related)>0)
                                                    @foreach($product->related as $item)
                                                        @if($prod->id == $item->related_id)
                                                            <option class="btn btn-primary" value="{{$prod->id}}" selected>{{$prod->title}}</option>
                                                            @continue(2);
                                                        @endif
                                                    @endforeach
                                                    <option class="btn btn-primary" value="{{$prod->id}}">{{$prod->title}}</option>
                                                @else
                                                    <option class="btn btn-primary" value="{{$prod->id}}">{{$prod->title}}</option>
                                                @endif

                                            @endforeach

                                        </select>
                                        @error('slider_product')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Створити</button>
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

@push('bootstrap-select')
    <script>
        $('#slider_product').select2({
            placeholder: "Оберіть пов'язані товари.",
            language: 'ua',
            closeOnSelect: true,
            scrollAfterSelect: false,
            tags: true,
        });
    </script>
@endpush
