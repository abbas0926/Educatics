<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'cold'          => 'Cold',
        'intrested'     => 'Intrested',
        'qualified'     => 'Qualified',
        'converted'     => 'Converted',
        'not-qualified' => 'Not qualified',
    ];

    public const SOURCE_SELECT = [
        'website'        => 'Website',
        'facebook'       => 'Facebook',
        'instagram'      => 'Instagram',
        'linkedin'       => 'Linkedin',
        'Event'          => 'Event',
        'recommendation' => 'Recommendation',
        'visit'          => 'Visit',
        'others'         => 'Others',
    ];

    public $table = 'leads';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'status',
        'source',
        'notes',
        'marketing_campaign_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function leadLeadInteractions()
    {
        return $this->hasMany(LeadInteraction::class, 'lead_id', 'id');
    }
    public function recentInteractions(){

        return $this->hasMany(LeadInteraction::class)
                    ->orderBy('created_at','desc');
    }

    public function leadMarketingCampaigns()
    {
        return $this->belongsToMany(MarketingCampaign::class);
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function marketing_campaign()
    {
        return $this->belongsTo(MarketingCampaign::class, 'marketing_campaign_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
