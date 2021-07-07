<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Fonte;

class ExistRelation implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $fonte = Fonte::where('cod_interno', $value);
        return $fonte->reparos()->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Essa fonte não possui nenhum reparo cadastrado';
    }
}
