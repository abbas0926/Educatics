<?php
namespace App\MediaLibrary;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class CustomMediaPathGenerator implements PathGenerator{

    public function getPath(Media $media): string
    {
       
        return $this->getBasePath($media).'/';
    }

    protected function getBasePath(Media $media): string
    {
        if(is_null(tenant())){
            return "central/".$media->getKey();
        }
        else {
            $tenant_id=tenant()->id;        
            return "{$tenant_id}/{$media->getKey()}";
        }

    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media).'/conversions/';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media).'/responsive-images/';
    }

    /*
     * Get a unique base path for the given media.
     */


}