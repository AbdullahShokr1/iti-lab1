<?php

namespace App\Http\Controllers;


class ProductsController extends Controller
{
    private $products = [
        ['id' => 1, 'name' => 'Wireless Mouse', 'price' => 25.99, 'category' => 'Electronics', 'image' => 'mouse.jpg'],
        ['id' => 2, 'name' => 'Mechanical Keyboard', 'price' => 79.99, 'category' => 'Electronics', 'image' => 'keyboard.jpg'],
        ['id' => 3, 'name' => 'Office Chair', 'price' => 129.99, 'category' => 'Furniture', 'image' => 'chair.jpg'],
        ['id' => 4, 'name' => 'Running Shoes', 'price' => 59.99, 'category' => 'Sportswear', 'image' => 'shoes.jpg'],
        ['id' => 5, 'name' => 'Backpack', 'price' => 45.00, 'category' => 'Accessories', 'image' => 'backpack.jpg'],
        ['id' => 6, 'name' => 'Bluetooth Speaker', 'price' => 39.99, 'category' => 'Electronics', 'image' => 'speaker.jpg'],
        ['id' => 7, 'name' => 'Coffee Maker', 'price' => 89.99, 'category' => 'Appliances', 'image' => 'coffeemaker.jpg'],
        ['id' => 8, 'name' => 'Desk Lamp', 'price' => 22.50, 'category' => 'Home Decor', 'image' => 'lamp.jpg'],
    ];
    public function index()
    {
        $products = $this->products;
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);
        abort_unless($product, 404);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }
}
