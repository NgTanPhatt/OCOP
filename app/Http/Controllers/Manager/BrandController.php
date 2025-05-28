<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index(Request $request)
    {
        // Tìm kiếm theo tên thương hiệu
        $query = Brand::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lấy các thương hiệu kèm theo số lượng sản phẩm nhập vào (tính tổng số lượng)
        $brands = $query->withSum('inventories', 'quantity') // Tính tổng số lượng sản phẩm nhập vào cho mỗi thương hiệu
                        ->paginate(10); // Phân trang

        // Đảm bảo nếu không có sản phẩm nhập vào thì sum = 0
        foreach ($brands as $brand) {
            if (is_null($brand->inventories_sum_quantity)) {
                $brand->inventories_sum_quantity = 0;
            }
        }
        
        return view('manager.brands.index', compact('brands'));
    }


    public function create()
    {
        return view('manager.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name', // Kiểm tra tên thương hiệu không trùng
        ], [
            'name.required' => 'Vui lòng nhập tên thương hiệu.',
            'name.unique' => 'Tên thương hiệu đã tồn tại.',
        ]);

        // Lưu thương hiệu mới
        Brand::create($validated);

        return redirect()->route('manager.brands.index')->with('success', 'Thương hiệu đã được tạo thành công.');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('manager.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $id, // Kiểm tra tên thương hiệu không trùng ngoại trừ bản ghi hiện tại
        ], [
            'name.required' => 'Vui lòng nhập tên thương hiệu.',
            'name.unique' => 'Tên thương hiệu đã tồn tại.',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update($validated);

        return redirect()->route('manager.brands.edit', $id)->with('success', 'Thương hiệu đã được cập nhật.');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('manager.brands.index')->with('success', 'Thương hiệu đã được xóa.');
    }
}
