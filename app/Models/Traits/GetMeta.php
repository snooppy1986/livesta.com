<?php


namespace App\Models\Traits;

use Butschster\Head\Facades\Meta;
use Butschster\Head\Hydrator\VueMetaHydrator;

trait GetMeta
{
    public function getMeta(VueMetaHydrator $hydrator, $page_name = null, $data = null)
    {
        if($page_name){
            $meta_data = \App\Models\Meta::where('page_name', $page_name)->first();

            $meta =  Meta::setTitle($meta_data ? $meta_data->title : 'LIVESTA')
                ->setFavicon(url('/images/favicon.webp'))
                ->setKeywords($meta_data ? $meta_data->keywords : '')
                ->setDescription($meta_data ? $meta_data->description : '');
        }

        if($data){
            $meta =  Meta::setTitle($data->title)
                ->setFavicon(url('/images/favicon.webp'))
                ->setKeywords($data->meta ? $data->meta->keywords : '')
                ->setDescription($data->meta ? $data->meta->description : '');
        }
        return $hydrator->hydrate($meta);
    }

}
