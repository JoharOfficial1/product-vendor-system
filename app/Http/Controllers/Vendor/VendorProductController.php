<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\ProductCreated;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class VendorProductController extends Controller
{
  protected $service;

  public function __construct(ProductService $service)
  {
    $this->service = $service;
  }

  public function index()
  {
    $products = $this->service->listForVendor(auth()->id());

    return view('vendor.products.index', compact('products'));
  }

  public function create()
  {
    return view('vendor.products.create');
  }

  public function store(ProductRequest $request)
  {
    $product = $this->service->create($request->all());

    if ($product) {
      $product = $this->service->storeImage($product, $request);

      event(new ProductCreated($product, auth()->user()));

      return redirect()->route('products.index')->with('success', 'Product submitted for approval');
    } else {
      return redirect()->route('products.index')->with('error', 'Something went wrong while storing product.');
    }
  }
  
  public function edit(Product $product)
  {
    return view('vendor.products.edit', compact('product'));
  }

  public function update(Product $product, ProductRequest $request)
  {
    $product = $this->service->update($product, $request->all());

    if ($product) {
      $product = $this->service->storeImage($product, $request);

      return redirect()->route('products.index')->with('success', 'Product is updated successfully.');
    } else {
      return redirect()->route('products.index')->with('error', 'Something went wrong while updating product.');
    }
  }

  public function destroy(Product $product)
  {
    $product = $this->service->delete($product);

    return redirect()->route('products.index')->with('success', 'Product updated successfully');
  }
}
