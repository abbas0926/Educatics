<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\QueryBuilder\QueryBuilder;
class Student extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'students';

    protected $appends = [
        'attachements',
        'photo',
    ];

    protected $dates = [
        'birthdate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'birthdate',
        'adresse',
        'study_level',
        'establishement',
        'matricule',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function studentInvoices()
    {
        return $this->hasMany(Invoice::class, 'student_id', 'id');
    }

    public function studentGroups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function studentPromotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function presenceStudentLessons()
    {
        return $this->belongsToMany(Lesson::class);
    }

    public function getAttachementsAttribute()
    {
        return $this->getMedia('attachements');
    }

    public function getBirthdateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFullNameAttribute(){
        return $this->first_name ." ". $this->last_name;
    }

    public function getPhotoUrlAttribute(){ 
        if($this->photo) return $this->photo->getUrl();
        else return global_asset('images/avatar.png');
    }

    public static function filter (){
        $students = QueryBuilder::for(Student::class )
        ->allowedFilters(['first_name','last_name','phone','email'])
        ->allowedSorts('created_at')        
        ->get();
        return $students;
    }
}
