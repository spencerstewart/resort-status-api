<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trail extends Model
{
    protected $fillable = ['name', 'slug', 'status', 'groomed', 'difficulty', 'resort_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function resort()
    {
        return $this->belongsTo('App\Resort');
    }

    public static function saveTrailStatus($url = 'https://www.bigbearmountainresort.com/Feeds/Xml/Mtn/v2.ashx?Resort=SnowSummit', $resortId = 1)
    {
        $trailStatuses = self::getTrailStatus($url, $resortId);
        foreach($trailStatuses as $trailStatus) {
            $trail = Trail::updateOrCreate(
                ['resort_id' => $trailStatus['resort_id'], 'name' => $trailStatus['name']],
                ['status' => $trailStatus['status'], 'slug' => $trailStatus['slug'], 'groomed' => $trailStatus['groomed'], 'difficulty' => $trailStatus['difficulty']]
            );
        }
    }

    /**
     * Returns array of of chair statuses for a particular resort
     * Takes input of the XML url and the resort ID
     */
    public static function getTrailStatus($url, $resortId)
    {
        $trailStatus = [];
        $resortStatus = new \SimpleXMLElement(file_get_contents($url));
        $trails = $resortStatus->facilities->facility[1]->trails->trail;
        foreach ($trails as $trail) {
            $trailStatus[] = [
                'name' => $trail['name'],
                'slug' => urlencode($trail['name']),
                'status' => $trail['status'],
                'groomed' => $trail['groomed'],
                'difficulty' => $trail['difficulty'],
                'resort_id' => 1
            ];
        }
        return $trailStatus;
    }
}
