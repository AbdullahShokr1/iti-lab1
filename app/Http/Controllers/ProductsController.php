<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Actions\Orientate;

class ProductsController extends Controller
{
    public function home(){
        $products = Product::latest()->take(12)->get();
        $categories = Product::select('category')->distinct()->pluck('category');
        return view('welcome', compact('products','categories'));
    }
    public function index(Request $request)
    {
        $q = $request->query('q');
        $category = $request->query('category');
        $perPage = 12;

        $query = Product::query();

        if ($q) {
            $query->where('name', 'LIKE', "%{$q}%")
                  ->orWhere('description', 'LIKE', "%{$q}%");
        }

        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('products.index', compact('products','categories','q','category'));
    }

    public function create()
    {
        $categories = ['Electronics','Clothing','Books','Home','Toys','Sports'];
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'stock_quantity' => 'nullable|integer|min:0',
            'is_active' => 'sometimes|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:4096|dimensions:max_width=3000,max_height=3000',
        ]);

        if ($request->hasFile('image')) {
            if (isset($product) && $product->image && Storage::disk('public')->exists("products/{$product->image}")) {
                Storage::disk('public')->delete("products/{$product->image}");
            }

            $validated['image'] = $this->processImage($request->file('image'));
        }

        $validated['stock_quantity'] = $validated['stock_quantity'] ?? 0;
        $validated['is_active'] = $request->has('is_active') ? (bool) $request->is_active : true;

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ['Electronics','Clothing','Books','Home','Toys','Sports'];
        return view('products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'stock_quantity' => 'nullable|integer|min:0',
            'is_active' => 'sometimes|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:4096|dimensions:max_width=3000,max_height=3000',
        ]);

        if ($request->hasFile('image')) {
            if (isset($product) && $product->image && Storage::disk('public')->exists("products/{$product->image}")) {
                Storage::disk('public')->delete("products/{$product->image}");
            }

            $validated['image'] = $this->processImage($request->file('image'));
        }

        $validated['stock_quantity'] = $validated['stock_quantity'] ?? 0;
        $validated['is_active'] = $request->has('is_active') ? (bool)$request->is_active : $product->is_active;

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists('products/'.$product->image)) {
            Storage::disk('public')->delete('products/'.$product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success','Product removed.');
    }
    private function processImage($file)
    {
        $filename = Str::random(12) . '.webp';
        $path = "products/{$filename}";

        $manager = new ImageManager(new Driver());
        $img = $manager->read($file->getRealPath());

        if (function_exists('exif_read_data')) {
            $exif = @exif_read_data($file->getRealPath());
            if (!empty($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 3:
                        $img = $img->rotate(180);
                        break;
                    case 6:
                        $img = $img->rotate(90);
                        break;
                    case 8:
                        $img = $img->rotate(-90);
                        break;
                }
            }
        }

        $img = $img->scaleDown(1200, 1200)
                ->encodeByExtension('webp', quality: 85);

        Storage::disk('public')->put($path, (string) $img);

        return $filename;
    }
}
