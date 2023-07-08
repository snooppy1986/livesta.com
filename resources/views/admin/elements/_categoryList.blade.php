<ul class="list-group list-group-flush cat-list">
    @foreach($categories as $category)
        <li class="list-group-item d-flex justify-content-between align-items-center ">
            {{$category->title}}
            <div class="card-tools">
                <a href="{{route('category.edit', ['category'=>$category->id])}}" class="btn"><i class="fas fa-edit"></i></a>
                <span class="btn remove-category" data-id="{{$category->id}}"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>

            @if(count($category->children))
                @include('admin/elements/_sub_category_children', ['sub_cat'=>$category->children, 'tabs'=>0])
            @endif

        </li>
    @endforeach
</ul>
<style>
    .cat-list > li{
        font-size: 21px;
    }
    .cat-list > li:hover{
        background: #007bff;
        color: #fff;
    }
    .cat-list >li .btn:hover{
        cursor:pointer;
        color: #fff !important;
    }

</style>
