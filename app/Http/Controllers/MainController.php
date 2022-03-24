<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request) {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        $order = Order::find($orderId);
        $products = Product::all();
        $relatedProducts = Product::paginate(8);

        return view('home.index', compact('products', 'order', 'relatedProducts'));
    }

    public function shop(ProductsFilterRequest $request) {
        $categories = Category::all();
        $products_count = Product::all()->count();
        $products = Product::paginate($this->paginate);

        $orderId = session('orderId');

        if (is_null($request->category)) {
            session()->put('category_id', '0');
        }

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        $order = Order::find($orderId);

        $productsQuery = Product::with('category');

        // dd($request);
        if ($request->filled('search')) {
            $productsQuery->where('name', 'LIKE', "%$request->search%");
        }

        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }

        if (isset($request->sortBy)) {
            if ($request->sortBy == "price-asc") {
                $products = Product::orderBy('price', 'asc')->paginate($this->paginate);
                return view('shop.index', compact('products', 'categories', 'products_count', 'order'));
            }

            if ($request->sortBy == "price-desc") {
                $products = Product::orderBy('price', 'desc')->paginate($this->paginate);
                return view('shop.index', compact('products', 'categories', 'products_count', 'order'));
            }

            if ($request->sortBy == "title-asc") {
                $products = Product::orderBy('name', 'asc')->paginate($this->paginate);
                return view('shop.index', compact('products', 'categories', 'products_count', 'order'));
            }
        }

        $products = $productsQuery->paginate($this->paginate)->withPath("?".$request->getQueryString());
        return view('shop.index', compact('products', 'categories', 'products_count', 'order'));
    }


    /**
     * Список категорий в меню
     *
     * @param $category
     * @return void
     */
    public function category(Request $request, $category = null) {
        $categories = Category::all();
        $products_count = Product::all()->count();
        $categoryId = session()->get('category_id');

        if (is_null($categoryId)) {
            session()->put('category_id', '0');
            return redirect()->route('shop');
        }

        if (isset($request->sortBy)) {
            if ($request->sortBy == "price-asc") {
                if ($categoryId == "0") {
                    $products = Product::orderBy('price', 'asc')->paginate($this->paginate);
                } else {
                    $products = Product::where('category_id', $categoryId)->orderBy('price', 'asc')->paginate($this->paginate);
                }
                return view('shop.index', compact('products', 'categories', 'products_count'));
            }

            if ($request->sortBy == "price-desc") {
                if ($categoryId == "0") {
                    $products = Product::orderBy('price', 'desc')->paginate($this->paginate);
                } else {
                    $products = Product::where('category_id', $categoryId)->orderBy('price', 'desc')->paginate($this->paginate);
                }
                return view('shop.index', compact('products', 'categories', 'products_count'));
            }

            if ($request->sortBy == "title-asc") {
                if ($categoryId == "0") {
                    $products = Product::orderBy('name', 'asc')->paginate($this->paginate);
                } else {
                    $products = Product::where('category_id', $categoryId)->orderBy('name', 'asc')->paginate($this->paginate);
                }

                return view('shop.index', compact('products', 'categories', 'products_count'));
            }
        }

        $curCategory = Category::where('code', $category)->first();

        if (isset($curCategory)) {
            $products = Product::where('category_id', $curCategory->id)->paginate($this->paginate);
            session()->put('category_id', $curCategory->id);
            return view('shop.index', compact('products', 'categories', 'products_count'));
        } else {
            $products = Product::paginate($this->paginate);
            session()->put('category_id', '0');
            return view('shop.index', compact('products', 'categories', 'products_count'));
        }

        $products = Product::paginate($this->paginate);
        return view('shop.index', compact('products', 'categories', 'products_count'));
    }

    public function product($category = null, $product = null) {
        $product = Product::where('code', $product)->first();
        return view('product.show', compact('product'));
    }

    public function contact()
    {
        return view('contact.index');
    }

}
