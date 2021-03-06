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
        $chairs = self::getChairStatus($url, $resortId);
        foreach($chairs as $chair) {
            Chair::updateOrCreate(
                ['resort_id' => $chair['resort_id'], 'number' => $chair['number']],
                ['status' => $chair['status'], 'name' => $chair['name']]
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
            if (preg_match('/Moving Carpet/', $lift['name'])) {
                continue;
            
            // Filter out Gondolas
            } else if (preg_match('/Panorama | Gondola/', $lift['name'])) {
                continue;
                
            } else {
                preg_match('/[0-9]+/', $lift['name'], $number); // Get the Chair number
                $number = $number[0];

                // Filter out number from chairs with real names "eg Broadway Express 1"
                if (!preg_match('/Chair/', $lift['name'])) {

                    // Need special code for this stupid chair with a number in the middle
                    if ($lift['name'] == "High 5 Express") {
                        $name = "High Five Express";
                    } else {
                        preg_match('/[a-zA-Z ]+/', $lift['name'], $name); // Get the Chair name
                        $name = substr($name[0], 0, -1); // removes space from end of chair name
                    }
                } else {
                    $name = $lift['name'];
                }
                
                $chairStatus[] = [
                    'name' => $name,
                    'number' => $number,
                    'status' => $lift['status'],
                    'areaName' => $lift['areaName'],
                    'resort_id' => $resortId
                ];
            }
        }
        return $chairStatus;
    }
}
