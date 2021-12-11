<?php


namespace Aboleon\Framework\Traits;


use Carbon\{
    Carbon,
    CarbonInterval,
    CarbonPeriod};
use Throwable;

trait DateManipulator
{
    use Responses;

    /**
     * @throws \Exception
     */

    public function makeDate(string|Carbon $date, string $format = 'd/m/Y H:i'): Carbon
    {
        try {
            if ($date instanceof Carbon) {
                return $date;
            }
            return Carbon::createFromFormat($format, $date);
        } catch (Throwable $e) {
            d(Carbon::createFromFormat($format, $date), 'HJH');
            d($date);
            d($e->getMessage());
            $this->responseWarning("La date " . $date . " est invalide.");
            $this->responseError($e->getMessage());
        }
    }


    public function ensureValidEndDate(Carbon $starts, Carbon $ends): bool
    {
        try {
            if($ends->lessThan($starts)) {
                $this->responseWarning("La date/temps de fin est supérieur à la date/temps du début.");
            }
            return true;
        } catch (Throwable $e) {
            $this->responseError($e->getMessage());
            return false;
        }
    }

    public function weekDaysBetween(Carbon $starts, Carbon $ends): array
    {
        $days = [];
        $period = CarbonPeriod::create($starts, $ends);
        foreach($period as $date) {
            $days[] = $date->dayOfWeek;
        }
        return $days;
    }

    /**
     * @throws \Exception
     */
    public function calculatePeriodsOverlap(CarbonPeriod $periodA, CarbonPeriod $periodB): CarbonInterval
    {
        if (!$periodA->overlaps($periodB)) {
            return new CarbonInterval(0);
        }

        $firstEndDate = min($periodA->calculateEnd(), $periodB->calculateEnd());
        $latestStartDate = max($periodA->getStartDate(), $periodB->getStartDate());

        return CarbonInterval::make($firstEndDate->diff($latestStartDate));
    }

}
