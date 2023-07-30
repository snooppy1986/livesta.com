@extends('admin/layouts/adminLte')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редагувати продукт</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('product.index')}}">Список продуктів</a></li>
                            <li class="breadcrumb-item active">Редагувати продукт</li>
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
                                <h3 class="card-title">Продукт</h3>
                            </div>


                            <form action="{{route('product.edit.action', ['product'=>$product])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <div class="col-md-12 mb-3">
                                                <img
                                                    id="prevImage"
                                                    src="{{asset("storage/images/$product->image")}}"
                                                    alt=""
                                                    width="180"
                                                >
                                            </div>
                                            <div class="col-md-12">
                                                <input
                                                    name="productImage"
                                                    type="file"
                                                    class="custom-file-input"
                                                    id="productImage"
                                                    onchange="document.getElementById('prevImage').src = window.URL.createObjectURL(this.files[0])"
                                                >
                                                <label class="custom-file-label" for="productImage">Оберіть зображення</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Назва продукту</label>
                                        <input
                                            name="title"
                                            type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            id="title"
                                            placeholder="Назва продукту"
                                            value="{{$product->title}}"
                                        >
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Опис</label>
                                        <textarea
                                            name="about"
                                            class="form-control editor @error('content') is-invalid @enderror"
                                            rows="3"
                                            placeholder="Про товар ..."
                                            value=""
                                        >{{$product->content}}</textarea>
                                        @error('content')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Категорія товару</label>
                                        @include('admin/elements/_categorySelect', ['category_id'=>$product->category, 'data_type'=>true, 'ids'=>$product->cat_ids()->toArray()])
                                    </div>

                                    <div class="form-group">
                                        <label for="code">Код продукту</label>
                                        <input
                                            name="code"
                                            type="text"
                                            class="form-control @error('code') is-invalid @enderror"
                                            id="code"
                                            placeholder="Код продукту"
                                            value="{{$product->code}}"
                                        >
                                        @error('code')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price_balls">Кількість балів за продукт</label>
                                        <input
                                            name="price_balls"
                                            type="number"
                                            class="form-control"
                                            id="price_balls"
                                            placeholder="Кількість балів за продукт"
                                            value="{{$product->price_balls}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label for="price_discount">Ціна при реєстрації</label>
                                        <input
                                            name="price_discount"
                                            type="number"
                                            class="form-control"
                                            id="price_discount"
                                            placeholder="Ціна при реєстрації"
                                            value="{{$product->price_discount}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label for="price_special">Діюча ціна</label>
                                        <input
                                            name="price_special"
                                            type="number"
                                            class="form-control @error('price_special') is-invalid @enderror"
                                            id="price_special"
                                            placeholder="Діюча ціна"
                                            value="{{$product->price_special}}"
                                        >
                                        @error('price_special')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price_through">Стара ціна</label>
                                        <input
                                            name="price_through"
                                            type="number"
                                            class="form-control @error('price_through') is-invalid @enderror"
                                            id="price_through"
                                            placeholder="Стара ціна"
                                            value="{{$product->price_through}}"
                                        >
                                        @error('price_through')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Рейтинг</label>
                                        <select name="rating" class="form-control">
                                            <option value="1" {{$product->rating==1 ? 'selected' : ''}}>1 зірка</option>
                                            <option value="2" {{$product->rating==2 ? 'selected' : ''}}>2 зірки</option>
                                            <option value="3" {{$product->rating==3 ? 'selected' : ''}}>3 зірки</option>
                                            <option value="4" {{$product->rating==4 ? 'selected' : ''}}>4 зірки</option>
                                            <option value="5" {{$product->rating==5 ? 'selected' : ''}}>5 зірок</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Застосування</label>
                                        <textarea
                                            name="application"
                                            class="form-control editor @error('application') is-invalid @enderror"
                                            rows="3"
                                            placeholder="Застосування ..."
                                            value=""
                                        >{{$product->attributes->application}}</textarea>
                                        @error('aplication')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="brand">Бренд</label>
                                        <input
                                            name="brand"
                                            type="text"
                                            class="form-control @error('brand') is-invalid @enderror"
                                            id="brand"
                                            placeholder="Бренд"
                                            value="{{$product->attributes->brand}}"
                                        >
                                        @error('brand')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="country">Країна виробництва</label>
                                        <input
                                            name="country"
                                            type="text"
                                            class="form-control @error('country') is-invalid @enderror"
                                            id="country"
                                            placeholder="Країна виробництва"
                                            value="{{$product->attributes->country}}"
                                        >
                                        @error('country')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Склад продукту</label>
                                        <textarea
                                            name="composition"
                                            class="form-control editor @error('composition') is-invalid @enderror"
                                            rows="3"
                                            placeholder="Склад продукту ..."
                                            value=""
                                        >{{$product->attributes->composition}}</textarea>
                                        @error('composition')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Стать</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="Жінкам">Жінкам</option>
                                            <option value="Чоловікам">Чоловікам</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="catalog_id">Номер в каталозі</label>
                                        <input
                                            name="catalog_id"
                                            type="text"
                                            class="form-control"
                                            id="catalog_id"
                                            placeholder="Номер в каталозі"
                                            value="{{$product->attributes->catalog_id}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label>Застереження до продукту</label>
                                        <textarea
                                            name="warning"
                                            class="form-control editor"
                                            rows="3"
                                            placeholder="Застереження до продукту ..."
                                            value=""
                                        >{{$product->attributes->warning}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="weight">Вага продукту</label>
                                        <input
                                            name="weight"
                                            type="text"
                                            class="form-control @error('weight') is-invalid @enderror"
                                            id="weight"
                                            placeholder="Вага продукту"
                                            value="{{$product->attributes->weight}}"
                                        >
                                        @error('weight')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Пов'язані товари</label>
                                        <?php $related_ids =$product->related_ids()->toArray() ?>
                                        <select
                                            name="related_product[]"
                                            id="related_product"
                                            class="form-control"
                                            multiple="multiple"
                                        >
                                            @foreach($products as $prod)
                                                <option
                                                    class="btn btn-primary"
                                                    value="{{$prod->id}}"
                                                    {{isset($related_ids) && in_array($prod->id, $related_ids) ? 'selected' : ''}}
                                                >
                                                    {{$prod->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <h5>Мета дані товару</h5>

                                    <div class="form-group">
                                        <label for="keywords">Ключові слова</label>
                                        <input
                                            name="keywords"
                                            type="text"
                                            class="form-control @error('keywords') is-invalid @enderror"
                                            id="keywords"
                                            placeholder="Ключові слова (додайте ключові слова через кому)"
                                            value="{{$product->meta->keywords}}"
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
                                            placeholder="Короткий опис товару"
                                            value="{{$product->meta->description}}"
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

@push('bootstrap-select')
    <script>
        $('#related_product').select2({
            placeholder: "Оберіть пов'язані товари.",
            language: 'ua',
            closeOnSelect: false,
            scrollAfterSelect: false,
            tags: true,
        });

        $('#selectCategory').select2({
            placeholder: "Оберіть категорії товарів.",
            language: 'ua',
            closeOnSelect: false,
            scrollAfterSelect: false,
            tags: true,
        });
    </script>

    <script>
      $('.editor').summernote();
    </script>
@endpush

