<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

class QueryValidator
{
    /**
     * Validate sort field value from a request and check if it is allowed
     * (because you should never allow user input to dictate the column
     * names referenced by your queries)
     *
     * @param array $allowed
     * @return string|null
     */
    public function sort(array $allowed)
    {
        if (request()->has('sort')) {
            $sort = (string) request()->query('sort');

            if (in_array($sort, $allowed)) {
                return $sort;
            }
        }

        return null;
    }

    /**
     * Validate sort order value from a request.
     *
     * @param string $default
     * @return string
     */
    public function order(string $default='asc')
    {
        $order = (string) request()->query('order', $default);

        if ($order !== 'asc' && $order !== 'desc') {
            return $default;
        }

        return $order;
    }

    /**
     * Validate limit value from a request.
     *
     * @param string $default
     * @param string $max
     * @return int
     */
    public function limit($default=50, $max=300)
    {
        $validator = Validator::make(request()->all(), [
            'limit' => 'required|integer|min:1|max:' . $max
        ]);

        if ($validator->fails()) {
            return $default;
        }

        $validated = $validator->validated();

        return (int) $validated['limit'];
    }

    /**
     * Validate offset value from a request.
     *
     * @param string $default
     * @return int
     */
    public function offset($default=0)
    {
        $validator = Validator::make(request()->all(), [
            'offset' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return $default;
        }

        $validated = $validator->validated();

        return (int) $validated['offset'];
    }
}
