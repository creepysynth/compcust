<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use stdClass;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Creates metadata for columns including links and classes
     * that make possible to sort data by specific column
     *
     * @param mixed $items
     * @param string $defaultSort
     * @param string $defaultOrder
     * @return stdClass|boolean
     */
    public function tableHeadersAttributes($items)
    {
        if (!isset($items[0])) {
            return null;
        }

        $fields = get_object_vars($items[0]);
        $sort = (string) request()->query('sort');
        $columns = new stdClass();

        // clear URL from sort, order and page parameters to set new parameters for every table header
        if (request()->except(['sort', 'order', 'page'])) {
            $preparedURL = request()->url().'?'.http_build_query(request()->except(['sort', 'order', 'page']));
        } else {
            $preparedURL = request()->url();
        }

        // set the default sort order as ascending
        $order = (string) request()->query('order');
        if ($order !== 'asc' && $order !== 'desc') {
            $order = 'asc';
        }

        foreach ($fields as $field => $v) {
            $column = new stdClass();

            if ($field == $sort) {
                if ($order === 'asc') {
                    $query = http_build_query(['sort' => $sort, 'order' => 'desc']);
                } else {
                    $query = http_build_query(['sort' => $sort, 'order' => 'asc']);
                }

                $column->class = 'sorting sorting_' . $order;
                $column->link = $preparedURL
                                    .(Str::contains($preparedURL, '?') ? '&' : '?')
                                    .$query;
            } else {
                $column->class = 'sorting';
                $column->link = $preparedURL
                                    .(Str::contains($preparedURL, '?') ? '&' : '?')
                                    .http_build_query(['sort' => $field, 'order' => 'asc']);
            }

            $columns->{$field} = $column;
        }

        return $columns;
    }
}
