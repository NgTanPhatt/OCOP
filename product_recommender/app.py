from flask import Flask, request, jsonify
import pandas as pd
import numpy as np
from keras.models import load_model
import joblib

# ====== Khởi tạo Flask ======
app = Flask(__name__)

# ====== Tải mô hình và encoder ======
model = load_model('ncf_model.h5')
user_encoder = joblib.load('user_encoder.pkl')
product_encoder = joblib.load('product_encoder.pkl')

products_df = pd.read_csv('products.csv')  # cột bắt buộc: 'id'

# ====== Hàm gợi ý sản phẩm (ngẫu nhiên trước, sắp xếp sau) ======
def recommend_top_k_products(model, user_id_real, products_df, user_encoder, product_encoder, k=5):

    user_encoded = user_encoder.transform([user_id_real])[0]

    # Lấy danh sách product_id hợp lệ
    product_ids_all = products_df['id'].unique()
    valid_product_ids = [pid for pid in product_ids_all if pid in product_encoder.classes_]

    if len(valid_product_ids) == 0:
        raise ValueError("Không có sản phẩm hợp lệ để dự đoán.")

    # Chọn ngẫu nhiên N sản phẩm
    sample_size = min(10, len(valid_product_ids))  # chọn ngẫu nhiên tối đa 30 sản phẩm
    sampled_ids = np.random.choice(valid_product_ids, size=sample_size, replace=False)

    item_indices = product_encoder.transform(sampled_ids)
    user_input = np.full(len(item_indices), user_encoded)

    # Dự đoán điểm phù hợp
    predictions = model.predict([user_input, item_indices], verbose=0).flatten()

    result_df = pd.DataFrame({
        'product_id': sampled_ids,
        'score': predictions
    })

    # Ghép thông tin sản phẩm
    result_df = result_df.merge(products_df[['id', 'name', 'avatar']], how='left', left_on='product_id', right_on='id')
    result_df = result_df[['product_id', 'name', 'avatar', 'score']]

    # Sắp xếp theo điểm giảm dần và lấy top k
    result_df = result_df.sort_values('score', ascending=False).head(k).reset_index(drop=True)

    return result_df

# ====== API endpoint ======
@app.route('/recommend', methods=['GET'])
def recommend():
    user_id_real = request.args.get('user_id')

    if not user_id_real:
        return jsonify({'error': 'Thiếu tham số user_id'}), 400

    try:
        result_df = recommend_top_k_products(
            model, user_id_real, products_df, user_encoder, product_encoder, k=5
        )
        result = result_df.to_dict(orient='records')
        return jsonify(result)
    except Exception as e:
        return jsonify({'error': str(e)}), 500

# ====== Chạy server ======
if __name__ == '__main__':
    app.run(debug=True)
