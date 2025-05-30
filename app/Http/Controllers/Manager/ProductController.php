<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category', 'branch');

        // Nếu là manager, chỉ hiển thị sản phẩm thuộc chi nhánh của họ
        if (Auth::user()->role === 'manager') {
            $branchId = Branch::where('user_id', Auth::id())->value('id');
            $query->where('branch_id', $branchId);
        }

        // Tìm theo tên
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Tìm theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Tìm theo chi nhánh (chỉ admin dùng được)
        if ($request->filled('branch_id') && Auth::user()->role === 'admin') {
            $query->where('branch_id', $request->branch_id);
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::all();

        // Nếu là admin, lấy tất cả chi nhánh; nếu là manager thì lấy chi nhánh của họ
        if (Auth::user()->role === 'admin') {
            $branches = Branch::all();
        } else {
            $branches = Branch::where('user_id', Auth::id())->get();
        }

        return view('manager.products.index', compact('products', 'categories', 'branches'));
    }

    public function create()
    {
        $categories = Category::all();
        $branches = Branch::all();
        return view('manager.products.create', compact('categories', 'branches'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'manager') {
            $branchId = Branch::where('user_id', Auth::id())->value('id');
            $request->merge(['branch_id' => $branchId]);
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'avatar' => 'required|image',
            'images' => 'required',
            'images.*' => 'image',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'branch_id' => 'required|exists:branches,id',
        ], [
            'name.required' => 'Tên sản phẩm không được bỏ trống.',
            'avatar.required' => 'Ảnh đại diện là bắt buộc.',
            'avatar.image' => 'Tệp ảnh đại diện phải là hình ảnh.',
            'images.required' => 'Ảnh chi tiết là bắt buộc.',
            'images.*.image' => 'Tất cả ảnh chi tiết phải là hình ảnh.',
            'price.required' => 'Giá sản phẩm không được để trống.',
            'price.integer' => 'Giá sản phẩm phải là số.',
            'stock.integer' => 'Tồn kho phải là số.',
            'description.required' => 'Mô tả là bắt buộc.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'branch_id.required' => 'Vui lòng chọn chi nhánh.',
        ]);

        // Xử lý avatar
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('products', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Xử lý ảnh chi tiết
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = implode('#', $imagePaths);
        }

        Product::create($validated);

        return redirect()->route('manager.products.index')->with('success', 'Thêm sản phẩm thành công.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $branches = Branch::all();

        return view('manager.products.edit', compact('product', 'categories', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if (Auth::user()->role === 'manager') {
            $branchId = Branch::where('user_id', Auth::id())->value('id');
            $request->merge(['branch_id' => $branchId]);
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'avatar' => 'nullable|image',
            'images' => 'nullable',
            'images.*' => 'image',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'branch_id' => 'required|exists:branches,id',
        ], [
            'name.required' => 'Tên sản phẩm không được bỏ trống.',
            'avatar.image' => 'Tệp ảnh đại diện phải là hình ảnh.',
            'images.*.image' => 'Tất cả ảnh chi tiết phải là hình ảnh.',
            'price.required' => 'Giá sản phẩm không được để trống.',
            'price.integer' => 'Giá sản phẩm phải là số.',
            'stock.integer' => 'Tồn kho phải là số.',
            'description.required' => 'Mô tả là bắt buộc.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'branch_id.required' => 'Vui lòng chọn chi nhánh.',
        ]);

        // Xử lý avatar mới (nếu có)
        if ($request->hasFile('avatar')) {
            if ($product->avatar && Storage::disk('public')->exists($product->avatar)) {
                Storage::disk('public')->delete($product->avatar);
            }
            $avatarPath = $request->file('avatar')->store('products', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Xử lý ảnh chi tiết mới (nếu có)
        if ($request->hasFile('images')) {
            // Xóa ảnh cũ
            if ($product->images) {
                $oldImages = explode('#', $product->images);
                foreach ($oldImages as $img) {
                    if ($img && Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }

            // Lưu ảnh mới
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = implode('#', $imagePaths);
        }

        $product->update($validated);

        return redirect()->route('manager.products.edit', $id)->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('manager.products.index')->with('success', 'Xoá sản phẩm thành công.');
    }
}

