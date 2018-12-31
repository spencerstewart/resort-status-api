<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    public function resort()
    {
        return $this->belongsTo('App\Resort');
    }

    /**
     * Returns array of of chair statuses for a particular resort
     * Takes input of the XML url and the re
     */
    public static function getSummitChairStatus($url = 'https://www.bigbearmountainresort.com/Feeds/Xml/Mtn/v2.ashx?Resort=SnowSummit', $resortId = 1)
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
                    'number' => $number,
                    'status' => $lift['status'],
                    'areaName' => $lift['areaName'],
                    'resort_id' => 1
                ];
            }
        }
        return $chairStatus;
    }
}
