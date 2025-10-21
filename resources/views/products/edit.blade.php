@extends('layouts.app')
@section('title','Edit Product')
@section('content')
<div class="bg-white rounded p-6 shadow">
  <h2 class="text-xl font-semibold mb-4">Edit Product</h2>
  @include('products._form')
</div>
@endsection
