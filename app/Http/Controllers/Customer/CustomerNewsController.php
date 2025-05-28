<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;


class CustomerNewsController extends Controller
{
    public function index(Request $request)
    {
        $news = News::with('branch')
            ->latest()
            ->paginate(8); // lấy 8 tin mới nhất mỗi trang
    
        return view('customer.news.index', compact('news'));
    }

    public function show($id)
    {
        $news = News::with('branch')->findOrFail($id);

        $newsList = News::with('branch')
            ->latest()
            ->paginate(4); // lấy 8 tin mới nhất mỗi trang

        // Implement the logic to fetch and display a single news article
        return view('customer.news.show', compact('news', 'newsList'));
    }   
}
