<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductCreated
{
    use Dispatchable, SerializesModels;
    public $product, $vendor;

    public function __construct(Product $product, $vendor)
    {
        $this->product = $product;
        $this->vendor = $vendor;
    }
}
