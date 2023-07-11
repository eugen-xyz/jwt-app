<?php

namespace App\Traits;

/**
 *
 */
trait DevExtremePagination
{
    /**
     * @return array|null
     */
    private function getSortData(): ?array
    {
        $sort =  $this->input('sort');

        if (!$sort) {
            return null;
        }

        $sortDecode = json_decode($sort)[0];
        return (array)$sortDecode;
    }

    /**
     * @return string|null
     */
    public function getSelector(): ?string
    {
        return $this->getSortData()['selector'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getOrderBy(): ?string
    {
        $isForSorting = $this->getSortData()['desc'] ?? null;

        if (!$isForSorting) {
            return null;
        }

        $isDescending = $this->getSortData()['desc'];

        $orderBy = 'asc';
        if ($isDescending) {
            $orderBy = 'desc';
        }

        return $orderBy;
    }

    /**
     * @return int
     */
    public function getSkip(): int
    {
        return (int)$this->input('skip') ?? 0;
    }

    /**
     * @return int
     */
    public function getTake(): int
    {
        return (int)$this->input('take') ?? 50;
    }

    /**
     * @return array
     */
    public function searchFilter(): array
    {
        $base = [];
        $filter = $this->input('filter');

        if (!$filter) {
            return $base;
        }

        $decodeFilters = json_decode($filter);


        $i = 0;
        $filterIndex = 0;
        foreach ($decodeFilters as $aFilter) {
            if (count((array)$aFilter) === 3) {
                /**
                 * We need this to filter only the need key to and value for filtering
                 */
                foreach ((array)$aFilter as $key => $value) {
                    if ($key === 0) {
                        $base[$i]['property'] = $value;
                    }
                    if ($key === 2) {
                        $base[$i]['value'] = $value;
                    }
                }
                $i++;
            } else {
                //no internal loop if single search only
                if ($filterIndex === 0) {
                    $base[$i]['property'] = $aFilter;
                }
                if ($filterIndex === 2) {
                    $base[$i]['value'] =  $aFilter;
                }

                $filterIndex++;
            }
        }

        return $base;
    }
}
