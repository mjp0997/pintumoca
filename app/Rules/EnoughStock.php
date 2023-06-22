<?php

namespace App\Rules;

use App\Models\Stock;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class EnoughStock implements DataAwareRule, ValidationRule
{
    protected $data = [];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exploded = explode('.', $attribute);
        $position = $exploded[1];
        
        $products_row = $this->data['products'][$position];

        if (!isset($products_row['product_id'])) {
            $fail('El id del producto es obligatorio');
        }

        if (!isset($this->data['from_office_id'])) {
            $fail('La sucursal de origen es obligatoria');
        }

        $stock = Stock::where('product_id', $products_row['product_id'])->where('office_id', $this->data['from_office_id'])->first();

        if (!isset($stock)) {
            $fail('No existe stock relacionado a este producto');
        }

        if ($stock->stock < $value) {
            $fail('No hay stock suficiente para esta transacción');
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }
}
