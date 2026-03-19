<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Feedback;
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


public function storeFeedback(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string|max:1000',
    ]);

    $customer = \App\Models\Customer::where('user_id', auth()->id())->first();

    if (!$customer) {
        return back()->with('error', 'Customer record not found.');
    }

    \App\Models\Feedback::create([
        'Product_ID' => $id,
        'Customer_ID' => $customer->Customer_ID,
        'Rating' => $request->rating,
        'Comments' => $request->review,
    ]);

    return back()->with('success', 'Review added successfully!');
}

    



    /**
     * Display a specific product.
     */
    public function show($id) {
         // Load the product along with feedbacks and the user who wrote them, plus inventory
    $product = Product::with(['feedbacks.customer', 'inventory'])->findOrFail($id);
        
        return view('products.show', compact('product'));
    }

    /**
     * Search for products based on a query.
     */
    public function search(Request $request)
    {
        $query = trim($request->input('query'));
        $category = $request->input('category');

        // CASE 1: No search text AND no category → go to /products
        if ($query === '' && empty($category)) {
            return redirect()->route('products.index');
        }

        // CASE 2: Category only (no text)
        if ($query === '' && !empty($category)) {
            return redirect()->route('categories.show', $category);
        }

        // CASE 3: Search text exists → perform search
        $products = Product::query()
            ->when($query, function ($q) use ($query) {
                $q->where('Name', 'LIKE', "%{$query}%");
            })
            ->when($category, function ($q) use ($category) {
                $q->where('ProductCategory_ID', $category);
            })
            ->get();

        return view('products.search', compact('products', 'query'));
    }
}

