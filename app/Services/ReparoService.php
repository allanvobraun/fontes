<?php


namespace App\Services;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReparoService
{
    public static function sumReparosByYear(array $years): Collection
    {
        $years = $years ?? now()->year;
        $selectQuery = ReparoService::selectByYearQuery();
        $bindings = self::arrayToBindings($years);
        $queryResult = DB::table('reparos')
            ->selectRaw($selectQuery)
            ->groupBy('mes', 'ano')
            ->havingRaw("ano in ($bindings)", $years)
            ->get();

        return ReparoService::formatData($queryResult);
    }

    private static function formatData(Collection $unformated): Collection
    {
        $scaffold = collect(range(0, 11))->mapWithKeys(fn($value) => [$value => 0]);

        $groupedByYear = $unformated->groupBy('ano');
        $formated = collect([]);

        foreach ($groupedByYear as $year => $yearCollection) {
            $monthValueCollection = $yearCollection->mapWithKeys(fn($item) => [$item->mes -1 => $item->valor]);
            $finalMonthValueCollection = $monthValueCollection->union($scaffold)->sortKeys();
            $formated = $formated->union([$year => $finalMonthValueCollection]);
        }

        return $formated;
    }

    private static function selectByYearQuery(): string
    {
        if (app()->runningUnitTests()) {
            return "round(sum(`valor`), 2) as valor, strftime('%m', created_at) as mes, strftime('%y', created_at) as ano";
        }
        return "round(sum(`valor`), 2) as valor, month(created_at) as mes, year(created_at) as ano";
    }

    private static function arrayToBindings(array $arr): string
    {
        return implode(",", array_fill(0, count($arr), '?'));
    }
}
