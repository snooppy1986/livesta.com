@extends('admin.layouts.adminLte')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Список слайдів</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li class="breadcrumb-item active">Список слайдів</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <a href="{{route('main-slider.create')}}" class="btn btn-success mb-3 ml-2">
                        <i class="fa fa-plus mr-2"></i> Створити новий слайд
                    </a>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <?php $count = 1?>
                                        @foreach($slides as $slide)

                                            <tr>
                                                <td>{{$count}}.</td>
                                                <td>{{$slide['title']}}</td>
                                                <td>
                                                    <img src="{{$slide['image_link']}}" alt="{{$slide['title']}}" width="100" height="100">
                                                </td>
                                                <td class="align-middle text-center">
                                                    <input
                                                        type="checkbox"
                                                        name="my-checkbox"
                                                        class="status_slide"
                                                        data-id = {{$slide['id']}}
                                                        {{$slide['status'] ? 'checked' : ''}}
                                                        data-bootstrap-switch
                                                        data-off-color="danger"
                                                        data-on-color="success"
                                                    >
                                                </td>
                                                <td class="project-actions text-right align-middle">
                                            <a class="btn btn-info btn-sm" href="{{route('main-slider.edit', ['id'=>$slide['id']])}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Редагувати
                                            </a>
                                            <a class="btn btn-danger btn-sm slide-destroy" href="#" data-id="{{$slide['id']}}">
                                                <i class="fas fa-trash">
                                                </i>
                                                Видалити
                                            </a>
                                        </td>
                                            </tr>
                                            <?php $count++?>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


