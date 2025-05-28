<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class CustomerChatgptController extends Controller
{
    public function ask(Request $request)
    {
        $question = $request->input('question');

        if (!$question) {
            return response()->json(['error' => 'Question is required'], 400);
        }

        // Lấy các sản phẩm để đưa vào prompt
        $products = Product::with([
            'category:id,name',
            'branch:id,name' // load thêm branch
        ])
        ->select('id', 'name', 'description', 'number_of_purchases', 'star', 'price', 'category_id', 'branch_id') 
        ->get();

        $productInfo = "Chỉ trả lời số thứ tự. tên sản phẩm, giá, chuyên mục, cửa hàng nhé (Nếu hỏi ko liên quan trả lời: Không có thông tin!) Danh sách sản phẩm:";
        foreach ($products as $product) {
            $productInfo .= "{$product->name}: (Giá: {$product->price} VND) ({$product->category->name}) ({$product->branch->name}),";
        }

        $prompt = $productInfo . "\n\nHỏi: " . $question;

        // Gọi OpenRouter API
        $apiKey = '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'; 
        $endpoint = 'https://openrouter.ai/api/v1/chat/completions';

        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
            'Content-Type' => 'application/json',
            'HTTP-Referer' => 'https://yourdomain.com/', // Cần thiết cho OpenRouter
            'X-Title' => 'My AI Chatbot'                 // Tuỳ chọn
        ])->post($endpoint, [
            'model' => 'openai/gpt-4.1-mini', // hoặc gpt-3.5-turbo, meta-llama, mistral...
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
            'max_tokens' => 1000,
        ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Không thể kết nối tới OpenRouter',
                'detail' => $response->body()
            ], 500);
        }

        $data = $response->json();
        $answer = $data['choices'][0]['message']['content'] ?? 'Xin lỗi, tôi không hiểu câu hỏi của bạn.';

        return response()->json(['answer' => $answer]);
    }
}
