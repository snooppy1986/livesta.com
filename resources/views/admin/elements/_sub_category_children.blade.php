<?php $tabs += 30 ?>
@foreach($sub_cat as $children)
    <li class="list-group-item d-flex justify-content-between align-items-center" style="padding-left: {{$tabs}}px">
        {{$children->title}}
        <div class="card-tools">
            <a href="{{route('category.edit', ['category'=>$children->id])}}" class="btn"><i class="fas fa-edit"></i></a>
            <span class="btn remove-category" data-id="{{$children->id}}"><i class="fa fa-trash" aria-hidden="true"></i></span>
        </div>
        @if(count($children->children)>0)
            @include('admin/elements/_sub_category_children', ['sub_cat'=>$children->children])
        @endif
    </li>
@endforeach

