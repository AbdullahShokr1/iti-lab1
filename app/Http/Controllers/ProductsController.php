<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductsController extends Controller implements  HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('product.limit', only: ['store']),
        ];
    }
    public function home()
    {
        $products = Product::with('category')->latest()->take(12)->get();
        $categories = Category::where('is_active', true)->get();

        return view('welcome', compact('products', 'categories'));
    }

    public function index(Request $request)
    {
        $q = $request->query('q');
        $categoryId = $request->query('category_id');
        $perPage = 12;

        $query = Product::with('category')->where('is_active', true);

        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('name', 'LIKE', "%{$q}%")
                    ->orWhere('description', 'LIKE', "%{$q}%");
            });
        }


        if (!empty($categoryId) && is_numeric($categoryId)) {
            $query->where('category_id', (int) $categoryId);
        }

        $products = $query->latest()->paginate($perPage)->withQueryString();

        $categories = Category::where('is_active', true)
            ->whereHas('products', fn($q) => $q->where('is_active', true))
            ->get();

        return view('products.index', compact('products', 'categories', 'q', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('products.create', compact('categories'));
    }

    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $this->processImage($request->file('image'));
        }

        $validated['stock_quantity'] = $validated['stock_quantity'] ?? 0;
        $validated['is_active'] = $request->has('is_active') ? (bool)$request->is_active : true;
        $validated['user_id'] = auth()->id();

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists("products/{$product->image}")) {
                Storage::disk('public')->delete("products/{$product->image}");
            }

            $validated['image'] = $this->processImage($request->file('image'));
        }

        $validated['is_active'] = $request->has('is_active') ? (bool)$request->is_active : $product->is_active;

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists("products/{$product->image}")) {
            Storage::disk('public')->delete("products/{$product->image}");
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح');
    }

    private function processImage($file)
    {
        $filename = Str::random(12) . '.webp';
        $path = "products/{$filename}";

        $manager = new ImageManager(new Driver());
        $img = $manager->read($file->getRealPath());

        // auto-orient
        if (function_exists('exif_read_data')) {
            $exif = @exif_read_data($file->getRealPath());
            if (!empty($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 3: $img = $img->rotate(180); break;
                    case 6: $img = $img->rotate(90); break;
                    case 8: $img = $img->rotate(-90); break;
                }
            }
        }

        $img = $img->scaleDown(1200, 1200)->encodeByExtension('webp', quality: 85);

        Storage::disk('public')->put($path, (string) $img);

        return $filename;
    }
}
