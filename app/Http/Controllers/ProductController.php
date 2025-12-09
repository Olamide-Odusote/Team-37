<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index(Request $request) {
        $query = Product::query();

        // Price filtering via query string: ?min=10&max=50
        $min = $request->query('min');
        $max = $request->query('max');
        if ($min !== null && $max !== null) {
            // ensure numeric
            if (is_numeric($min) && is_numeric($max)) {
                $query->whereBetween('Price', [(float)$min, (float)$max]);
            }
        } elseif ($min !== null) {
            if (is_numeric($min)) {
                $query->where('Price', '>=', (float)$min);
            }
        } elseif ($max !== null) {
            if (is_numeric($max)) {
                $query->where('Price', '<=', (float)$max);
            }
        }

        // Optional category filter via ?category=ID or multiple via ?category[]=1&category[]=2
        $categoryFilter = $request->query('category');
        if ($categoryFilter) {
            if (is_array($categoryFilter)) {
                // ensure numeric values
                $ids = array_filter($categoryFilter, function ($v) { return is_numeric($v); });
                if (!empty($ids)) {
                    $query->whereIn('ProductCategory_ID', $ids);
                }
            } elseif (is_numeric($categoryFilter)) {
                $query->where('ProductCategory_ID', $categoryFilter);
            }
        }

        // Paginate results and preserve query string so filters persist across pages
        $products = $query->paginate(12)->withQueryString();
        $categories = ProductCategory::all();

        return view('products.index', compact('products','categories'));
    }


    /**
     * Display a specific product.
     */
    public function show($id) {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Search for products based on a query.
     */
    public function search(Request $request) {
        $query = $request->input('query', '');
        $products = Product::query();

        // Search by name or description
        if (!empty($query)) {
            $products->where(function($q) use ($query) {
                $q->where('Name', 'LIKE', "%$query%")
                  ->orWhere('Description', 'LIKE', "%$query%");
            });
        }

        // Category filtering via query string: ?category=ID
        $categoryFilter = $request->query('category');
        if ($categoryFilter && is_numeric($categoryFilter)) {
            $products->where('ProductCategory_ID', (int)$categoryFilter);
        }

        // Price filtering via query string: ?min=10&max=50
        $min = $request->query('min');
        $max = $request->query('max');
        if ($min !== null && $max !== null) {
            if (is_numeric($min) && is_numeric($max)) {
                $products->whereBetween('Price', [(float)$min, (float)$max]);
            }
        } elseif ($min !== null) {
            if (is_numeric($min)) {
                $products->where('Price', '>=', (float)$min);
            }
        } elseif ($max !== null) {
            if (is_numeric($max)) {
                $products->where('Price', '<=', (float)$max);
            }
        }

        // Paginate results and preserve query string
        $products = $products->paginate(12)->withQueryString();

        return view('products.search', compact('products', 'query'));
    }
}
