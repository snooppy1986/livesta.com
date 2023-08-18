<select
    name="{{$data_type ? 'parent_id[]' : 'parent_id'}}"
    class="custom-select"
    id="selectCategory"
    {{$data_type ? 'multiple' : ''}}
>

    <option value="0">Выберите категорию</option>
    @foreach($categories as $cat)
        <option
            class="bg-info"
            value="{{$cat->id}}"
            {{isset($category) && $cat->id == $category->parent_id ? 'selected' : ''}}
            {{isset($category_id) && $cat->id==$category_id ?  'selected' : ''}}
            {{isset($ids) && in_array($cat->id, $ids) ? 'selected' : ''}}
        >{{$cat->title}}
            @if(count($cat->children))
                @include('admin/elements/_subCategorySelect', ['children'=>$cat->children, 'tab'=>''])
            @endif
        </option>
    @endforeach
</select>

