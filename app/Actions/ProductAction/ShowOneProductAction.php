<?php

namespace App\Actions\ProductAction;

use App\Models\Product;

class ShowOneProductAction
{
    public function execute(int $id)
    {
        return Product::find($id);
    }
}
