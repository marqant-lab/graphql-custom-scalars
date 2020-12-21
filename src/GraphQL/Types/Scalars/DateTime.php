<?php

namespace Marqant\GraphQLCustomScalars\GraphQL\Types\Scalars;

use Carbon\Carbon;
use Nuwave\Lighthouse\Schema\Types\Scalars\DateScalar;

/**
 * Class DateTime
 *
 * @package Marqant\GraphQL\Types\Scalars
 */
class DateTime extends DateScalar
{
    /**
     * @param Carbon $carbon
     *
     * @return string
     */
    protected function format(Carbon $carbon): string
    {
        return $carbon->toIso8601String();
    }

    /**
     * @param mixed $value
     *
     * @return Carbon
     */
    protected function parse($value): Carbon
    {
        // @phpstan-ignore-next-line We know the format to be good, so this can never return `false`
        return Carbon::parse($value);
    }
}
