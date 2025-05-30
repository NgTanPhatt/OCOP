@extends('customer.layouts.app')
@section('title', 'Thông Tin')
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Thông Tin
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row text-center justify-content-center gy-4 content-info-1">
            <div class="col-6 col-md-4 col-lg-2">
                <i class="fas fa-check-circle fa-2x mb-2"></i>
                <h6 class="fw-bold">Hàng chất lượng</h6>
                <p class="text-muted small">Chúng tôi chỉ cung cấp các sản phẩm được chọn lọc kỹ càng, đảm bảo chất lượng và an toàn cho người dùng.</p>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <i class="fas fa-shield-alt fa-2x mb-2"></i>
                <h6 class="fw-bold">100% hàng thật</h6>
                <p class="text-muted small">Cam kết sản phẩm chính hãng, có nguồn gốc rõ ràng từ nhà sản xuất và nhà phân phối uy tín.</p>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <i class="fas fa-exchange-alt fa-2x mb-2"></i>
                <h6 class="fw-bold">30 ngày đổi trả</h6>
                <p class="text-muted small">Bạn hoàn toàn yên tâm mua sắm với chính sách đổi trả lên đến 30 ngày, linh hoạt và dễ dàng.</p>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <i class="fas fa-shipping-fast fa-2x mb-2"></i>
                <h6 class="fw-bold">Giao nhanh</h6>
                <p class="text-muted small">Dịch vụ giao hàng nhanh chóng, chuyên nghiệp giúp bạn nhận sản phẩm chỉ trong vài giờ tại các khu vực hỗ trợ.</p>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <i class="fas fa-tags fa-2x mb-2"></i>
                <h6 class="fw-bold">Giá siêu rẻ</h6>
                <p class="text-muted small">Luôn mang đến mức giá cạnh tranh, ưu đãi lớn và nhiều chương trình khuyến mãi hấp dẫn.</p>
            </div>
        </div>
    </div>
    <div class="container my-4 content-info content-info">
        <h2>1. Hàng chất lượng – Cam kết sản phẩm OCOP chuẩn đặc sản địa phương</h2>
        <p>
            Các sản phẩm OCOP của chúng tôi được lựa chọn kỹ càng từ các làng nghề truyền thống, hợp tác với các hộ sản xuất, cơ sở làng nghề đã được chứng nhận theo tiêu chuẩn OCOP của địa phương. Mỗi sản phẩm không chỉ là hàng hóa mà còn là tinh hoa văn hóa, đặc sản nổi tiếng mang giá trị bền vững, chất lượng cao.
        </p>
        <ul>
            <li>Đảm bảo sản phẩm được làm hoàn toàn thủ công hoặc theo quy trình truyền thống, giữ nguyên vị thơm ngon, hương vị đặc trưng.</li>
            <li>Sản phẩm được kiểm định nghiêm ngặt, đạt chuẩn an toàn vệ sinh thực phẩm và các tiêu chuẩn OCOP cấp tỉnh/thành.</li>
            <li>Bảo quản kỹ lưỡng, đóng gói chuyên nghiệp giúp giữ trọn chất lượng từ khâu sản xuất đến tay người tiêu dùng.</li>
        </ul>
        <p>Chúng tôi tự hào mang đến cho bạn những sản phẩm OCOP uy tín, chất lượng, vừa đảm bảo sức khỏe vừa góp phần phát triển kinh tế địa phương.</p>

        <h2>2. Hàng thật 100% – Sản phẩm OCOP chính hiệu, có nguồn gốc rõ ràng</h2>
        <p>
            Tất cả sản phẩm OCOP bán trên sàn của chúng tôi đều có nguồn gốc xuất xứ minh bạch, được chứng nhận bởi các cấp chính quyền địa phương. Bạn hoàn toàn yên tâm về tính xác thực và chất lượng sản phẩm với:
        </p>
        <ul>
            <li>Giấy chứng nhận OCOP và các giấy tờ liên quan đi kèm theo từng sản phẩm.</li>
            <li>Cam kết không kinh doanh hàng giả, hàng nhái hay hàng kém chất lượng.</li>
            <li>Cung cấp thông tin chi tiết về vùng nguyên liệu, quy trình sản xuất và các đặc trưng nổi bật của sản phẩm.</li>
            <li>Hỗ trợ kiểm tra hàng thật khi nhận để đảm bảo quyền lợi khách hàng.</li>
        </ul>
        <p>Mua hàng OCOP là bạn đang góp phần bảo tồn và phát huy giá trị truyền thống, đồng thời thúc đẩy phát triển kinh tế địa phương bền vững.</p>

        <h2>3. Đổi trả 30 ngày – An tâm mua sắm sản phẩm OCOP</h2>
        <p>
            Chúng tôi hiểu rằng mua sản phẩm đặc sản vùng miền đôi khi có thể gặp những khác biệt về sở thích hoặc yêu cầu riêng biệt. Vì vậy, chính sách đổi trả trong 30 ngày sẽ giúp bạn an tâm hơn khi đặt mua các sản phẩm OCOP tại cửa hàng chúng tôi.
        </p>
        <ul>
            <li>Nếu sản phẩm bị lỗi do khâu sản xuất hoặc vận chuyển, bạn có thể đổi hoặc trả trong vòng 30 ngày.</li>
            <li>Sản phẩm không đúng mô tả hoặc có vấn đề về chất lượng cũng được hỗ trợ đổi trả nhanh chóng.</li>
            <li>Thủ tục đổi trả đơn giản, nhân viên hỗ trợ tận tình giúp bạn giải quyết mọi vướng mắc.</li>
        </ul>
        <p>Chính sách này đảm bảo quyền lợi tối đa cho khách hàng, đồng thời thể hiện sự cam kết của chúng tôi về chất lượng và dịch vụ.</p>

        <h2>4. Giao nhanh – Đưa đặc sản OCOP đến tận tay bạn nhanh nhất</h2>
        <p>
            Chúng tôi hiểu rằng đặc sản vùng miền luôn cần được giao nhanh, đảm bảo giữ nguyên hương vị và chất lượng khi đến tay khách hàng. Vì vậy, dịch vụ giao hàng của chúng tôi được tối ưu hóa với:
        </p>
        <ul>
            <li>Thời gian giao hàng nhanh chóng, chỉ từ 1-3 ngày làm việc trên phạm vi toàn quốc.</li>
            <li>Hệ thống đóng gói chuyên nghiệp, bảo quản nhiệt độ phù hợp, chống va đập và giữ sản phẩm tươi mới.</li>
            <li>Hỗ trợ theo dõi đơn hàng trực tuyến giúp bạn dễ dàng nắm bắt thời gian nhận hàng.</li>
            <li>Đội ngũ giao nhận tận tâm, đảm bảo sản phẩm đến đúng nơi, đúng thời gian.</li>
        </ul>
        <p>Chúng tôi luôn nỗ lực mang những sản phẩm OCOP đặc sắc nhất đến tận tay bạn một cách nhanh chóng và an toàn nhất.</p>

        <h2>5. Giá siêu rẻ – Giá trị tuyệt vời từ sản phẩm OCOP chính hiệu</h2>
        <p>
            Ngoài yếu tố chất lượng và dịch vụ, giá cả luôn là một trong những mối quan tâm hàng đầu của người tiêu dùng. Chúng tôi cam kết mang đến mức giá cạnh tranh nhất trên thị trường, giúp bạn có thể sở hữu các sản phẩm chất lượng cao với chi phí hợp lý nhất.
        </p>
        <ul>
            <li>Chính sách ưu đãi thường xuyên: Các chương trình khuyến mãi, giảm giá theo mùa, quà tặng kèm hấp dẫn luôn được cập nhật liên tục.</li>
            <li>Mối quan hệ đối tác trực tiếp: Nhờ hợp tác lâu dài với nhà sản xuất và các đại lý lớn, chúng tôi nhận được mức giá tốt nhất, không qua trung gian.</li>
            <li>Cắt giảm chi phí tối ưu: Tận dụng công nghệ, logistics hiệu quả và quản lý chi phí vận hành thông minh để giảm thiểu chi phí không cần thiết.</li>
            <li>Giá cả minh bạch: Không phát sinh phí ẩn, rõ ràng ngay từ đầu giúp khách hàng yên tâm mua sắm.</li>
            <li>Tư vấn phù hợp nhu cầu: Đội ngũ nhân viên hỗ trợ giúp bạn lựa chọn sản phẩm tốt nhất với mức giá phù hợp nhất, tránh lãng phí.</li>
        </ul>
        <p>Mua hàng OCOP không chỉ là lựa chọn kinh tế mà còn là sự đầu tư vào giá trị truyền thống và phát triển bền vững cộng đồng.</p>
    </div>
    <style>
        .content-info h2{
            font-size: 24px;
            color: #3BB77E;
        }

        .content-info p{
            line-height: 45px;
        }

        .content-info{
            line-height: 45px;
        }

        .content-info ul{
            line-height: 45px;
            list-style: square;
            font-size: 16px;
            margin-left: 50px;
        }
        .content-info-1 p{
            line-height: 25px;
            margin-top: 10px;
            font-size: 14px;
        }
        .content-info-1 h6{
            margin-top: 10px;
            color: #3BB77E;
        }
        .content-info-1 i{
            color: #3BB77E;
        }
    </style>
@endsection
