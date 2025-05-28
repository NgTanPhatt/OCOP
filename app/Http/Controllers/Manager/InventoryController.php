<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::with(['product', 'brand']);

        // Nếu là manager, chỉ lấy tồn kho của sản phẩm thuộc chi nhánh của họ
        if (auth()->user()->role === 'manager') {
            $branchId = \App\Models\Branch::where('user_id', auth()->id())->value('id');

            $query->whereHas('product', function ($q) use ($branchId) {
                $q->where('branch_id', $branchId);
            });
        }

        // Tìm kiếm theo tên sản phẩm
        if ($request->has('search') && $request->search) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $inventories = $query->latest()->paginate(10);

        return view('Manager.Inventories.index', compact('inventories'));
    }


    public function create()
    {
        $branchId = \App\Models\Branch::where('user_id', auth()->id())->value('id');
        $products = Product::where('branch_id', $branchId)->get();
        $brands = Brand::all();
        return view('Manager.Inventories.create', compact('products', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'brand_id' => 'nullable|exists:brands,id',
        ], [
            'product_id.required' => 'Vui lòng chọn sản phẩm.',
            'product_id.exists' => 'Sản phẩm không hợp lệ.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'brand_id.exists' => 'Thương hiệu không hợp lệ.',
        ]);

        $inventory = Inventory::create($validated);

        // Cộng vào số lượng sản phẩm
        $inventory->product->increment('stock', $validated['quantity']);

        return redirect()->route('manager.inventories.index')->with('success', 'Tạo tồn kho thành công.');
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);

        $branchId = \App\Models\Branch::where('user_id', auth()->id())->value('id');
        $products = Product::where('branch_id', $branchId)->get();
        $brands = Brand::all();

        return view('Manager.Inventories.edit', compact('inventory', 'products', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'brand_id' => 'nullable|exists:brands,id',
        ], [
            'product_id.required' => 'Vui lòng chọn sản phẩm.',
            'product_id.exists' => 'Sản phẩm không hợp lệ.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'brand_id.exists' => 'Thương hiệu không hợp lệ.',
        ]);

        // Giảm stock cũ
        $inventory->product->decrement('stock', $inventory->quantity);

        // Nếu đổi sang sản phẩm khác
        if ($inventory->product_id != $validated['product_id']) {
            // Cộng stock lại cho sản phẩm cũ đã trừ
            // (đã làm ở trên), sau đó cộng vào sản phẩm mới
            Product::find($validated['product_id'])->increment('stock', $validated['quantity']);
        } else {
            // Cùng sản phẩm → chỉ cộng lại số mới
            $inventory->product->increment('stock', $validated['quantity']);
        }

        $inventory->update($validated);

        return redirect()->route('manager.inventories.edit', $id)->with('success', 'Cập nhật tồn kho thành công.');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);

        // Trừ số lượng khỏi sản phẩm
        $inventory->product->decrement('stock', $inventory->quantity);

        $inventory->delete();

        return redirect()->route('manager.inventories.index')->with('success', 'Xóa tồn kho thành công.');
    }
}
