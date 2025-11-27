<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::orderBy('id', 'DESC')->paginate(10);
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'brands', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproductRequest $request)
    {

        $product = new product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->sku = $request->sku;
        $product->featured = $request->featured;
        $product->stock = $request->stock_status;
        $product->quantity = $request->quantity;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images/products', $imageName, 'public');
            $product->image = $path;
        }

        $product->save();

        if ($request->has('colors') && is_array($request->colors)) {
            foreach ($request->colors as $colorData) {
                if (isset($colorData['name']) && isset($colorData['code'])) {
                    $product->colors()->create([
                        'name' => $colorData['name'],
                        'code' => $colorData['code']
                    ]);
                }
            }
        }

        if ($request->has('sizes') && is_array($request->sizes)) {
            foreach ($request->sizes as $sizeData) {
                if (isset($sizeData['name'])) {
                    $product->sizes()->create([
                        'name' => $sizeData['name']
                    ]);
                }
            }
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $imageName = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('images/galleries', $imageName, 'public');

                $product->galleries()->create([
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->sku = $request->sku;
        $product->featured = $request->featured;
        $product->stock = $request->stock_status;
        $product->quantity = $request->quantity;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images/products', $imageName, 'public');
            $product->image = $path;
        }

        $product->save();

        // Update Colors
        $product->colors()->delete(); 
        if ($request->has('colors') && is_array($request->colors)) {
            foreach ($request->colors as $colorData) {
                if (isset($colorData['name']) && isset($colorData['code'])) {
                    $product->colors()->create([
                        'name' => $colorData['name'],
                        'code' => $colorData['code']
                    ]);
                }
            }
        }

        // Update Sizes
        $product->sizes()->delete(); 
        if ($request->has('sizes') && is_array($request->sizes)) {
            foreach ($request->sizes as $sizeData) {
                if (isset($sizeData['name'])) {
                    $product->sizes()->create([
                        'name' => $sizeData['name']
                    ]);
                }
            }
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $imageName = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('images/galleries', $imageName, 'public');

                $product->galleries()->create([
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = trim($request->input('search'));

        $products = Product::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('slug', 'LIKE', "%{$search}%");
        })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.products.index', compact('products'));
    }
}
