<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
