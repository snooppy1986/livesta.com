<?php $tab .= '--' ?>
@foreach($children as $child)

    <option
        value="{{$child->id}}"
        {{isset($category) && $child->id == $category->parent_id ? 'selected' : ''}}
        {{isset($category_id) && $child->id==$category_id ?  'selected' : ''}}
        {{isset($ids) && in_array($child->id, $ids) ? 'selected' : ''}}
    >
        {{$tab}}{{$child->title}}
        @if(count($child->children))
            @include('admin/elements/_subCategorySelect', ['children'=>$child->children])
        @endif
    </option>
@endforeach
