<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
  public function create(array $data)
  {
    $data['code'] = generateProductCode();
    $data['user_id'] = auth()->id();

    return Product::create($data);
  }

  public function update(Product $product, array $data)
  {
    $product->update($data);
    
    return $product;
  }

  public function delete(Product $product)
  {
    return $product->delete();
  }

  public function listForVendor($vendorId)
  {
    return Product::where('user_id', $vendorId)->get();
  }

  public function listAll()
  {
    return Product::all();
  }

  public function approve(Product $product)
  {
    return $product->update(['status' => 'approved']);
  }

  public function reject(Product $product)
  {
    return $product->update(['status' => 'rejected']);
  }

  public function storeImage($product, $request)
  {
    if ($request->hasFile('cover_image')) {
      if ($product->cover_image) {
        Storage::disk('public')->delete($product->cover_image);
      }

      $coverImage = $request->file('cover_image')->store('product-images', 'public');

      $product->cover_image = $coverImage;
      $product->save();
    }

    return $product;
  }
}
