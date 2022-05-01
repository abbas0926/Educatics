<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\Sluggify;
use Spatie\QueryBuilder\QueryBuilder;
class Formation extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;
    use Sluggify;

    public const STATUS_SELECT = [
        'draft'     => 'Draft',
        'published' => 'published',
        'hidden'    => 'hidden',
    ];

    public const DURATION_SELECT = [
        'hour'=>'Hour',
        'session'=>'Session',
        'day'=>'Day',
        'week'=>'Week',
        'month'=>'Month',
    ];
    public const PAYMENT_TYPE=[
        'one_time'=>'One time',
        'per_hour'=>'Per Hour',
        'per_session'=>'Per Session',
        'per_day'=>'Per Day',
        'per_week'=>'Per Week',
        'per_month'=>'Per Month',
        'per_year'=>'Per Year',
    ];

    public $table = 'formations';

    protected $appends = [
        'featured_image',
        'syllabus',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'price',
        'duration',
        'status',
        'slug',
        'duration_type',
        'payment_frequency',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public  static function filter(){ 
        $formations= QueryBuilder::for(Formation::class)
                        ->allowedFilters('title','price','payment_frequency')
                        ->allowedSorts('created_at','updated_at')
                        ->orderBy('created_at','desc')
                        ->get();
        return $formations;
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class, 'formation_id', 'id');
    }
    public function groups(){
        return $this->hasManyThrough(Group::class,Promotion::class);
    }

    public function getFeaturedImageAttribute()
    {
        $file = $this->getMedia('featured_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
    public function getFrequencyTitleAttribute() { 
        return Formation::PAYMENT_TYPE[$this->payment_frequency];
    }
    public function getPriceFormattedAttribute(){
        return "{$this->price} DZD/ {$this->frequency_title}";
    }
    public function getFeaturedImageUrlAttribute(){
        if($this->getFeaturedImageAttribute()){
            return $this->getFeaturedImageAttribute()->getUrl();
        }
        else{
            return $this->getPlaceholder();
        }
    }
    public function getDurationFormattedAttribute(){ 
        return "{$this->duration } {$this->duration_type} ";
    }
    public function getPlaceholder(){
        return "https://via.placeholder.com/1920x1080?text={$this->title}";
    }

    public function getSyllabusAttribute()
    {
        return $this->getMedia('syllabus');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
