<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    protected $fillable = ['name', 'number', 'status', 'resort_id'];

    public function resort()
    {
        return $this->belongsTo('App\Resort');
    }

    public static function saveChairStatus($url = 'https://www.bigbearmountainresort.com/Feeds/Xml/Mtn/v2.ashx?Resort=SnowSummit', $resortId = 1)
    {
        $chairStatuses = self::getChairStatus($url, $resortId);
        foreach($chairStatuses as $chairStatus) {
            $chair = Chair::updateOrCreate(
                ['resort_id' => $chairStatus['resort_id'], 'number' => $chairStatus['number']],
                ['status' => $chairStatus['status'], 'name' => $chairStatus['name']]
            );
        }
    }

    /**
     * Returns array of of chair statuses for a particular resort
     * Takes input of the XML url and the resort ID
     */
    public static function getChairStatus($url, $resortId)
    {
        $chairStatus = [];
        $resortStatus = new \SimpleXMLElement(file_get_contents($url));
        $lifts = $resortStatus->facilities->facility[1]->lifts->lift;
        foreach ($lifts as $lift) {
            // Filter out Magic Carpets and only get Chair status
            if (!preg_match('/Chair/', $lift['name'])) {
                continue;
            } else {
                preg_match('/[0-9]+/', $lift['name'], $number); // Get the Chair number
                $chairStatus[] = [
                    'name' => $lift['name'],
                    'number' => $number[0],
                    'status' => $lift['status'],
                    'areaName' => $lift['areaName'],
                    'resort_id' => 1
                ];
            }
        }
        return $chairStatus;
    }
}
