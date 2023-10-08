<?php

namespace App\Actions\ProductActions;

use App\Models\Product;

class ShowOneProductAction
{
    public function execute(int $id)
    {
        return Product::find($id);
    }
}
