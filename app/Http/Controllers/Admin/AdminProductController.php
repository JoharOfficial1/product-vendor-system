<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class AdminProductController extends Controller implements HasMiddleware
{
  protected $service;

  /**
   * Get the middleware that should be assigned to the controller.
   */
  public static function middleware(): array
  {
    return [
      new Middleware('role:admin',)
    ];
  }
  
  public function __construct(ProductService $service)
  {
    $this->middleware('role:admin');
    $this->service = $service;
  }

  public function index()
  {
    $products = $this->service->listAll();

    return view('admin.products.index', compact('products'));
  }

  public function approve(Product $product)
  {
    $this->service->approve($product);

    return back()->with('success', 'Product approved');
  }

  public function reject(Product $product)
  {
    $this->service->reject($product);
    
    return back()->with('success', 'Product rejected');
  }
}
