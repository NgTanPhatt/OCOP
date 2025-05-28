<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with('branch');

        // Nếu là manager, lọc theo branch_id
        if (Auth::user()->role === 'manager') {
            $branchId = Branch::where('user_id', Auth::id())->value('id');
            $query->where('branch_id', $branchId);
        }

        // Nếu có tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%');
        }

        $newsList = $query->latest()->paginate(10);

        return view('manager.news.index', compact('newsList'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('manager.news.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $isManager = $user->role === 'manager';
    
        $rules = [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
        ];
    
        if (!$isManager) {
            $rules['branch_id'] = 'nullable|exists:branches,id';
        }
    
        $messages = [
            'name.required' => 'Vui lòng nhập tiêu đề.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'avatar.required' => 'Vui lòng chọn ảnh đại diện.',
            'avatar.image' => 'Ảnh đại diện phải là tệp hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpeg, png, jpg hoặc gif.',
            'branch_id.exists' => 'Chi nhánh không hợp lệ.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $avatarPath = $request->file('avatar')->store('news', 'public');
    
        $branchId = $isManager
            ? optional($user->branch)->id
            : $request->branch_id;
    
        News::create([
            'name' => $request->name,
            'content' => $request->content,
            'avatar' => $avatarPath,
            'branch_id' => $branchId,
        ]);
    
        return redirect()->route('manager.news.index')->with('success', 'Tạo tin tức thành công.');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $branches = Branch::all();
        return view('manager.news.edit', compact('news', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $user = Auth::user();
        $isManager = $user->role === 'manager';

        $rules = [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if (!$isManager) {
            $rules['branch_id'] = 'nullable|exists:branches,id';
        }

        $messages = [
            'name.required' => 'Vui lòng nhập tiêu đề.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'avatar.image' => 'Ảnh đại diện phải là tệp hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpeg, png, jpg hoặc gif.',
            'branch_id.exists' => 'Chi nhánh không hợp lệ.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'content' => $request->content,
            'branch_id' => $isManager
                ? optional($user->branch)->id
                : $request->branch_id,
        ];

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('manager.news.edit', $id)->with('success', 'Cập nhật tin tức thành công.');
    }


    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('manager.news.index')->with('success', 'Xóa tin tức thành công.');
    }
}
