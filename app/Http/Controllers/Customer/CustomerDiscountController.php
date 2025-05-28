<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;

class CustomerDiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::where('expiration_date', '>=', now())->latest()->paginate(12);
        return view('customer.discount.index', compact('discounts'));
    }
}
