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

class Tenant extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'tenants';

    protected $appends = [
        'store_logo',
    ];

    protected $dates = [
        'valid_until',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'store_name',
        'phone_number',
        'email',
        'is_active',
        'valid_until',
        'store_location',
        'package_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function tenantDomains()
    {
        return $this->hasMany(Domain::class, 'tenant_id', 'id');
    }

    public function tenantPayments()
    {
        return $this->hasMany(Payment::class, 'tenant_id', 'id');
    }

    public function tenantThemes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function getStoreLogoAttribute()
    {
        $file = $this->getMedia('store_logo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getValidUntilAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setValidUntilAttribute($value)
    {
        $this->attributes['valid_until'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
