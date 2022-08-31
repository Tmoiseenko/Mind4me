<?php

namespace App\Services;

use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;

class DeliveryDateCalculationService
{
    private $holidays = ['01.01.*', '08.03.*', '09.05.*', '01.10.*'];

    public function calculate($date, $time, $city)
    {
        $initDay = Carbon::create($date . ' ' . $time);
        $period = CarbonPeriod::create($date . ' ' . $time, 21);

        $period->addFilter(function ($date) use ($initDay) {
            return !in_array($date->format('d.m.y'), [$initDay->format('d.m.y')]);
        });

        if (in_array(mb_convert_case($city, MB_CASE_TITLE), ['Город_1', 'Город_2'])) {
            $period->addFilter(function ($date) {
                return $date->isMonday() || $date->isWednesday() || $date->isFriday();
            });
            if($initDay->hour >= 16) {
                $period->addFilter(function ($date, $key) use ($initDay) {
                    return !in_array($date->format('d.m.y'), [$initDay->addDay()->format('d.m.y')])
                        && $date->isMonday() || $date->isWednesday() || $date->isFriday();
                });
            }
        }

        if (in_array(mb_convert_case($city, MB_CASE_TITLE), ['Город_3'])) {
            $period->addFilter(function ($date) {
                return $date->isTuesday() || $date->isThursday() || $date->isSaturday();
            });
            if($initDay->hour >= 22) {
                $period->addFilter(function ($date) use ($initDay) {
                    return !in_array($date->format('d.m.y'), [$initDay->addDay()->format('d.m.y')])
                        && ($date->isTuesday() || $date->isThursday() || $date->isSaturday());
                });
            }
        }

        $period->addFilter(function ($date) {
            return !in_array($date->format('d.m.*'), $this->holidays);
        });

        $response = [];

        foreach ($period as $date) {
            $response[] = [
                'date' => $date->format('d.m.Y'),
                'day' => $date->dayName,
                'title' => $date->format('j F'),
            ];
        }

        return $response;
    }
}
