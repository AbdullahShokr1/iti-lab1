<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'content' => 'required|string|max:2000',
        ]);

        $product = Product::findOrFail($request->product_id);

        $comment = new Comment([
            'content' => $request->content,
            'author_name' => Auth::check() ? Auth::user()->name : 'زائر',
            'author_email' => Auth::check() ? Auth::user()->email : 'guest@example.com',
        ]);

        $product->comments()->save($comment);

        return redirect()->back()->with('success', 'تم إضافة تعليقك بنجاح ');
    }
}
