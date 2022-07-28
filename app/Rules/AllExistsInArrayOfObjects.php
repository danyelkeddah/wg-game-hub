<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Database\Eloquent\Model;

class AllExistsInArrayOfObjects implements Rule
{
    public function __construct(
        public string $modelClass,
        public string $column,
        public string $objectAttribute,
    ) {
    }

    public function passes($attribute, $value): bool
    {
        return collect($value)->count() ===
            $this->modelClass
                ::query()
                ->whereIn(
                    $this->column,
                    collect($value)->pluck($this->objectAttribute),
                )
                ->count();
    }

    public function message(): string
    {
        return 'All or some of the :attribute are invalid.';
    }
}
