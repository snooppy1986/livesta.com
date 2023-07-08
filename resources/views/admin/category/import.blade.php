@extends('admin/layouts/adminLte')

@section('content')
    <div class="content-wrapper" style="min-height: 1345.31px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Импорт категорий</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li class="breadcrumb-item active">Импорт категорий</li>
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
                                <h3 class="card-title">Импорт</h3>
                            </div>
                            <form id="importForm" method="POST" action="{{route('category.import.action')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="importFile">Файл</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input  name="importFile" type="file" class="custom-file-input form-control" id="importFile" accept=".xlsx" required>
                                                <label class="custom-file-label" for="importFile">Выберите файл</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Импорт</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Импорт</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </div>
@endsection
