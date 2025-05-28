-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 01:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocop`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` text DEFAULT 'store.png',
  `address` text NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `avatar`, `address`, `phone`, `email`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Cửa Hàng Số 1', 'branches/lOdEwukKRIEJm2UFFDHurOB3ULQYoi6dEMwNYTlo.jpg', 'Đà Nẵng', '0123456789', 'cuahangso1@gmail.com', 2, '2025-04-20 13:16:24', '2025-05-11 20:29:04'),
(3, 'Cửa Hàng Số 2', 'branches/nZ3LVOBIW8BUi8xwqe04AnNlW5AOKp89WJT3nuuz.jpg', 'Đà Nẵng', '0123456798', 'cuahangso2@gmail.com', 3, '2025-04-20 10:56:49', '2025-05-13 19:34:22'),
(4, 'Cửa Hàng Số 3', 'store.png', 'Quảng Nam', '0999888999', 'cuahangso3@gmail.com', 5, '2025-05-11 16:41:56', '2025-05-11 20:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sản Phẩm OCOP', '2025-04-20 07:38:13', '2025-05-11 20:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'Sản Phẩm OCOP', 'categories/Ctel09OreDQiEM0nx9qLHIJ3uRRk3sVrjNMSIRMI.png', '2025-04-20 07:18:42', '2025-05-11 19:42:39'),
(3, 'Thương hiệu quốc gia', 'categories/S2ro3WMYANwcIJ7uJLChBAli1pE0BrkirD009a9Z.png', '2025-04-20 07:26:53', '2025-05-11 19:43:19'),
(4, 'Đặc sản vùng miền', 'categories/nAA1mRjiK33mRwCu6bfNzcjS28Xm3Awhf9eT8IL9.png', '2025-04-20 07:28:02', '2025-05-11 19:43:45'),
(6, 'Ngư nghiệp - Thủy hải sản', 'categories/nWcwu5rpgvRlenZXPSV66tPhmLYIKtH2vwbkGf3G.png', '2025-05-11 19:52:35', '2025-05-11 19:52:35'),
(7, 'Thủ công mỹ nghệ', 'categories/dgWrBSsLi6O6j3QG2GERZN2yA4sWb8yK96hlgZ59.png', '2025-05-11 19:53:23', '2025-05-11 19:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `percent` int(11) NOT NULL DEFAULT 1,
  `expiration_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `branch_id`, `code`, `percent`, `expiration_date`, `created_at`, `updated_at`) VALUES
(2, 1, 'AHXGSG', 10, '2025-04-25', '2025-04-20 10:41:50', '2025-04-20 10:41:50'),
(3, 1, 'AHXGSG1', 25, '2025-05-29', '2025-05-06 21:13:24', '2025-05-06 21:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `product_id`, `quantity`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2025-05-06 21:34:22', '2025-05-06 21:40:19'),
(2, 4, 2, 1, '2025-05-11 05:43:51', '2025-05-11 05:43:51'),
(3, 21, 10, 1, '2025-05-14 02:58:27', '2025-05-14 02:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `item_orders`
--

CREATE TABLE `item_orders` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_orders`
--

INSERT INTO `item_orders` (`id`, `order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, '2025-05-07 09:25:09', '2025-05-07 09:25:09'),
(2, 2, 3, 1, '2025-05-07 10:13:05', '2025-05-07 10:13:05'),
(9, 7, 4, 2, '2025-05-11 06:38:49', '2025-05-11 06:38:49'),
(10, 8, 3, 2, '2025-05-11 06:38:49', '2025-05-11 06:38:49'),
(11, 9, 4, 3, '2025-05-11 07:01:32', '2025-05-11 07:01:32'),
(12, 10, 3, 1, '2025-05-11 07:01:32', '2025-05-11 07:01:32'),
(13, 11, 3, 1, '2025-05-11 07:03:41', '2025-05-11 07:03:41'),
(14, 12, 4, 1, '2025-05-11 07:03:41', '2025-05-11 07:03:41'),
(15, 13, 3, 1, '2025-05-11 07:06:30', '2025-05-11 07:06:30'),
(16, 14, 4, 1, '2025-05-11 07:06:30', '2025-05-11 07:06:30'),
(17, 15, 4, 1, '2025-05-11 18:27:57', '2025-05-11 18:27:57'),
(18, 16, 8, 1, '2025-05-11 21:29:57', '2025-05-11 21:29:57'),
(19, 17, 10, 1, '2025-05-11 21:30:38', '2025-05-11 21:30:38'),
(20, 18, 1, 1, '2025-05-13 19:53:26', '2025-05-13 19:53:26'),
(21, 18, 21, 1, '2025-05-13 19:53:26', '2025-05-13 19:53:26'),
(22, 19, 17, 1, '2025-05-13 19:53:26', '2025-05-13 19:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `avatar` text NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `name`, `content`, `avatar`, `branch_id`, `created_at`, `updated_at`) VALUES
(2, 'Bản đồ gia vị Việt Nam', '<p>Kết thúc cuộc đua cuộc thi Chiếc thìa vàng, vị giám khảo chuyên môn được xem là “vua” món ăn dân gian Chiêm Thành Long khoe: “Đã tổng hợp được sơ nét cái bản đồ gia vị của Việt Nam rồi”.</p><p>“Chưa gì đã nghe hương thơm thoảng qua rồi…”.</p><p>“Nhà thuốc dài mấy ngàn cây số”</p><p>Đó là cách mà bác sĩ Lương Lễ Hoàng nói về kho tàng ẩm thực Việt Nam mà dù ở núi cao hay biển khơi, lúc nào cũng tồn tại những “món ăn bài thuốc” dân gian nhưng lại rất hiệu nghiệm. Có lẽ kinh nghiệm ngàn năm truyền lại của ông bà mình đã chắt chiu ra những vốn quý, mà cũng lâu lắm rồi ít được dịp nhìn ngắm lại.</p><p>Ông Chiêm Thành Long bảo gia vị Việt Nam hầu như món nào cũng đều có công dụng đối với việc bảo vệ sức khỏe của con người, đặc biệt là khả năng làm cân bằng tính âm dương – hàn nhiệt của món ăn thì có lẽ người Việt mình là giỏi nhất.</p><p>“Nước mình có thể nói mỗi góc vườn nhà đã là một kho tàng gia vị, nói gì đến những vùng núi cao, vực sâu đã có dấu chân con người tìm đến. Điều thú vị là ở những làng quê mà chúng tôi có dịp đi qua, người ta cứ xoay người xung quanh nhà là có đủ gia vị để dùng.</p><p>Nhớ tính thêm vô những gia vị mà các dân tộc anh em của mình sở hữu, giờ cũng thành những tuyệt chiêu của đầu bếp Việt Nam” – chuyên gia ẩm thực Bùi Thị Sương nhận xét.</p><p>Không những tự thân giàu có, mà “nhà thuốc gia vị Việt Nam” còn được tăng cường bởi các vị thuốc ngoại nhập. Trong sự phát triển văn hóa về ẩm thực và đáp ứng thị hiếu của khách hàng các vùng miền, các nước trên thế giới, từ đó người đầu bếp phải dùng các gia vị du nhập, kết hợp với các gia vị địa phương tạo ra phong cách mới.</p><figure class=\"image\"><img src=\"https://tintuc.postmart.vn/wp-content/uploads/2019/05/gia-vi-viet-nam-1-300x184.jpg\" alt=\"\"></figure><p>“Đây cũng là điều tất yếu, nhưng dù sao món ăn truyền thống phải giữ được gốc và phải tiếp cận với cái mới để đưa ẩm thực Việt lên tầm cao mới. Bây giờ, chúng ta ăn bơ sữa phô mai kiểu Pháp hay ăn cà ri kiểu Ấn Độ hay làm thịt xá xíu ướp ngũ vị hương kiểu Hoa cũng là một phần của nền ẩm thực giao thoa này” – ông Long chia sẻ.</p><p>Ông Chiêm Thành Long có thể ngồi kể hoài không hết những loài rau gia vị như ngò gai, quế, ngổ, tía tô… Nhưng ông bảo rau gia vị ở nước ta chủ yếu là dùng tươi và có nhiều trong thiên nhiên, dễ tìm, tiện dụng nhưng không tồn trữ lâu được. Còn nước ngoài thường dùng loại khô và có xử lý trước nên để lâu được và tiện dụng mang đi xa.</p><p>Sau rau thì hỗn hợp gia vị của mỗi vùng miền, mỗi đầu bếp cũng là một khám phá thú vị. Đầu bếp Việt Nam thường thích phối trộn gia vị theo phong cách riêng của họ, nhiều khi cả sự ngẫu hứng để cho ra hương vị mới và cũng là nét rất riêng. Đặc biệt với những đầu bếp có cơ hội tiếp xúc và làm việc ở nhiều vùng miền khác nhau.</p><p>“Hiện nay với việc tiếp cận các nền ẩm thực của các nước trên thế giới họ đã sáng tạo ra sự pha trộn gia vị rất độc đáo là dùng từ nguyên liệu trong nước là trái cây vùng nhiệt đới tạo hương vị rất riêng. Cứ mỗi lần dự Chiếc thìa vàng, tôi lại thấy xuất hiện một sự phối trộn mới rất lạ: nước xốt chanh dây, nước chấm ngò gai…” – ông Long vừa khoe chai nước mắm hàu Côn Đảo vừa kể.</p><p>Cho tới giờ, cuộc tranh luận về việc món ăn Việt Nam có quá nhiều loại nước chấm là lợi thế hay yếu thế trên con đường hội nhập toàn cầu vẫn chưa ngã ngũ. Nhưng rõ ràng cái sự “bà con” giữa gia vị và nước chấm là không thể tranh cãi.</p><p>Gia vị vốn là các nguyên liệu được tẩm ướp vào món ăn để tăng hương vị cho món ăn và xác định tính chất của món ăn đó. Còn nước chấm là sự phối hợp một số gia vị và làm tăng hương vị món ăn khi chấm (có khi dùng hoặc không dùng).</p><p>Riêng ở Việt Nam, nước chấm còn là sự điều vị làm tăng thêm hương vị cho món ăn, đôi lúc làm cho món ăn đậm hơn hay nhạt bớt, vì vậy nước chấm đi kèm món ăn phải đúng mới làm món ăn ngon hơn, nhiều hương vị hơn.</p><p>Nhưng dù muốn hay không, món ăn Việt Nam hầu như đều cần đến nước chấm, mỗi món phải có nước chấm phù hợp thì món ăn sẽ ngon hơn, ngược lại món ăn đó sẽ giảm đi 50% vị ngon.</p><p>&nbsp;</p><figure class=\"image image-style-side\"><img src=\"https://tintuc.postmart.vn/wp-content/uploads/2019/05/gJzGnNKK.jpg\"></figure><figure class=\"image\"><img src=\"https://tintuc.postmart.vn/wp-content/uploads/2019/05/gJzGnNKK.jpg\" alt=\"\" srcset=\"https://tintuc.buudien.vn/wp-content/uploads/2019/05/gJzGnNKK.jpg 335w, https://tintuc.buudien.vn/wp-content/uploads/2019/05/gJzGnNKK-149x300.jpg 149w\" sizes=\"100vw\" width=\"335\"></figure><p>Sơ thảo bản đồ gia vị ông Chiêm Thành Long đã bỏ công tìm tòi:</p><p>+ Vùng Tây Bắc (Lào Cai, Điện Biên…): mắc khén, thảo quả, quế, rau mùi, ớt, tiêu.</p><p>+ Vùng Đông Bắc: hạt dổi, mát mật, sả, ớt, riềng, nghệ, gừng…</p><p>+ Hà Nội: thì là, lá xương sông, ngải cứu, riềng, nghệ, quả sấu, tai chua, tiêu, tỏi, ớt, sả, lá chanh…</p><p>+ Đồng bằng sông Hồng: lá lốt, quả mác cọp, quả chay, riềng, sả, ớt, tiêu…</p><p>+ Vùng biển phía Bắc: tiêu, sả, ớt, riềng, mẻ, mắm tôm, thì là, lá chanh, ngải cứu…</p><p>+ Tây nguyên: lá é, sả, gừng, muối, ớt…</p><p>+ Bắc Trung bộ (Nghệ An, Hà Tĩnh…): tiêu, tỏi, mắm, muối, ớt, tương…</p><p>+ Nam Trung bộ (Huế, Đà Nẵng…): tỏi, gừng, riềng, tiêu…</p><p>+ Tây nguyên: tiêu rừng, tiêu lốt, gừng, nghệ…</p><p>+ Đông Nam bộ: tỏi, tiêu, gừng, sả, ớt, lá chúc, mắm, muối…</p><p>+ Tây Nam bộ: tỏi,&nbsp;tiêu, gừng, mắm, muối, nước mắm, chanh, ớt…</p>', 'news/kNKebnXiiiUUFSZCEvuoHE6WPpellHgpLWFR5SjB.jpg', 3, '2025-04-20 11:28:49', '2025-05-12 20:38:36'),
(3, 'Không phải thay đổi giấy tờ đất đai vì thay đổi tên đơn vị hành chính', '<h2><strong>Không phải thay đổi giấy tờ đất đai vì thay đổi tên đơn vị hành chính</strong></h2><p>Bộ trưởng <a href=\"https://nongnghiepmoitruong.vn/bo-nong-nghiep-va-moi-truong-tag193403/\">Bộ Nông nghiệp và Môi trường</a> thông tin, ngày 10/4/2025, Bộ trưởng Đỗ Đức Duy đã ký văn bản số 911 gửi các địa phương để hướng dẫn việc chỉnh lý hồ sơ địa chính, <a href=\"https://nongnghiepmoitruong.vn/co-so-du-lieu-dat-dai-tag158258/\">cơ sở dữ liệu đất đai</a> và tập hợp số liệu diện tích tự nhiên trong quá trình sắp xếp tổ chức bộ máy chính quyền địa phương từ ba cấp thành hai cấp.</p><p>Trong văn bản này, đã quy định rõ nguyên tắc chỉnh lý, cách thức thực hiện, việc bảo quản và bàn giao hồ sơ địa chính từ cấp huyện về cấp xã, cấp tỉnh. “Việc chỉnh lý hồ sơ địa chính, cơ sở dữ liệu đất đai do sắp xếp đơn vị hành chính phải được thực hiện đồng thời với việc giải quyết các thủ tục hành chính về đất đai, tài sản gắn liền với đất, đảm bảo thông suốt, không gây ách tắc cho người dân và doanh nghiệp”, <a href=\"https://nongnghiepmoitruong.vn/bo-truong-do-duc-duy-tag185771/\">Bộ trưởng Đỗ Đức Duy</a> nhấn mạnh.</p><figure class=\"image\"><img src=\"https://i.ex-cdn.com/nongnghiepmoitruong.vn/files/content/2025/04/20/so-do-1723436328883393480490-0-0-1080-1728-crop-1723436332171104865463-175807_909-183032.jpeg\" alt=\"Bộ trưởng Đỗ Đức Duy thông tin về những quy định mới của Luật Đất đai giúp người dân yên tâm sau khi sắp xếp đơn vị hành chính, trừ trường hợp có nhu cầu. Ảnh: Khương Trung.\"></figure><p>Bộ trưởng Đỗ Đức Duy thông tin về những quy định mới của Luật Đất đai giúp người dân yên tâm sau khi sắp xếp đơn vị hành chính, trừ trường hợp có nhu cầu. Ảnh: <i>Khương Trung</i>.</p><p>Bộ trưởng cho biết, sau khi sắp xếp đơn vị hành chính, không bắt buộc phải chỉnh lý đồng loạt các giấy chứng nhận đã cấp, trừ trường hợp người sử dụng đất có nhu cầu hoặc khi thực hiện các thủ tục hành chính liên quan đến đất đai.</p><p>Ví dụ, nếu trước đây giấy chứng nhận đất được cấp bởi thành phố, địa danh trong đó ghi là xã Minh Bảo (xã Minh Bảo, thành phố Yên Bái – PV), nay không còn xã Minh Bảo thì người dân vẫn không cần điều chỉnh gì.</p><p>Các giấy tờ vẫn có giá trị pháp lý đầy đủ và không cần thay đổi, trừ khi người dân thực hiện thủ tục như chia tách, <a href=\"https://nongnghiepmoitruong.vn/chuyen-nhuong-tag62836/\">chuyển nhượng</a>... Khi đó, cơ quan nhà nước sẽ vừa thực hiện thủ tục hành chính, vừa chỉnh lý theo ranh giới hành chính mới, cập nhật số liệu, tờ thửa mới.&nbsp;“Người dân hoàn toàn yên tâm, không phải mang <a href=\"https://nongnghiepmoitruong.vn/so-do-tag29100/\">sổ đỏ</a>/sổ hồng đi điều chỉnh chỉ vì thay đổi tên đơn vị hành chính”, Bộ trưởng Đỗ Đức Duy thông tin.</p>', 'news/OQagvXi19wEZggwQXDOszJUMCUCUBKa58gPX4FIQ.jpg', 3, '2025-04-20 11:32:39', '2025-05-12 20:36:47'),
(4, 'Tháng khuyến mại Hải Phòng năm 2024 – Kích cầu tiêu dùng trong thời kỳ kinh tế số', '<h4><strong>Sáng 3/12, tại sân Trung tâm thương mại Cát Bi Plaza, Sở Công Thương Hải Phòng tổ chức Lễ phát động “Tháng khuyến mại Hải Phòng năm 2024” trên địa bàn thành phố.</strong></h4><p>&nbsp;</p><p>&nbsp;</p><p><i>Hưởng ứng Tháng Khuyến mại Hải Phòng năm 2024</i></p><p>&nbsp;</p><p>Tham dự chương trình có các đại biểu: Lê Hoàng Tài – Phó Cục trưởng Cục Xúc tiến thương mại, Bộ Công Thương; Bùi Văn Bắc – Phó Chủ tịch Ủy ban MTTQ Việt Nam thành phố Hải Phòng; Nguyễn Văn Thành – Giám đốc Sở Công thương; đại diện lãnh đạo các đơn vị, địa phương và các doanh nghiệp liên quan.</p><p>&nbsp;</p><p><img src=\"https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-2-1024x682.png\" alt=\"\" srcset=\"https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-2-1024x682.png 1024w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-2-300x200.png 300w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-2-768x511.png 768w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-2-1536x1023.png 1536w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-2.png 1562w\" sizes=\"100vw\" width=\"1024\"></p><p><i>Các đại biểu thực hiện nghi thức cắt băng khai mạc Tháng khuyến mại Hải Phòng năm 2024</i></p><p>&nbsp;</p><p>Phát biểu chào mừng, Phó Giám đốc Sở Công thương Lê Minh Sơn nhấn mạnh, “Tháng khuyến mại Hải Phòng năm 2024” được tổ chức nhằm kích cầu tiêu dùng nội địa, đẩy mạnh tiêu thụ sản phẩm hàng hóa, tăng tổng mức bán lẻ hàng hóa và doanh thu dịch vụ tiêu dùng. Qua đó thúc đẩy, phục hồi hoạt động sản xuất kinh doanh của doanh nghiệp trên địa bàn thành phố, góp phần hoàn thành mục tiêu phát triển kinh tế – xã hội, kiềm chế lạm phát, bình ổn thị trường và đảm bảo an sinh xã hội.</p><p>&nbsp;</p><p><img src=\"https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-4-1024x682.png\" alt=\"\" srcset=\"https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-4-1024x682.png 1024w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-4-300x200.png 300w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-4-768x511.png 768w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-4-1536x1023.png 1536w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-4.png 1562w\" sizes=\"100vw\" width=\"1024\"></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i> Phó Giám đốc Sở Công thương Lê Minh Sơn phát biểu chào mừng tại buổi lễ</i></p><p>&nbsp;</p><p>“Tháng khuyến mại Hải Phòng năm 2024” diễn ra từ ngày 02/12/2024 đến ngày 31/12/2024, là một sự kiện điểm nhấn trong hoạt động xúc tiến thương mại của ngành Công Thương nhằm hưởng ứng Cuộc vận động “Người Việt Nam ưu tiên dùng hàng Việt Nam”, kích cầu thị trường tiêu dùng, thúc đẩy sản xuất kinh doanh, tiêu dùng hàng Việt Nam trên địa bàn thành phố, góp phần bình ổn thị trường hàng hóa, đặc biệt là các tháng cuối năm 2024.</p><p>&nbsp;</p><p><img src=\"https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-6-1024x682.png\" alt=\"\" srcset=\"https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-6-1024x682.png 1024w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-6-300x200.png 300w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-6-768x511.png 768w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-6-1536x1023.png 1536w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-6.png 1562w\" sizes=\"100vw\" width=\"1024\"></p><p><i>Đại diện doanh nghiệp phát biểu hưởng ứng chương trình</i></p><p>&nbsp;</p><p>Đây cũng là dịp để đẩy mạnh việc khuyến khích mua sắm của người tiêu dùng thành phố theo phương thức mua sắm online qua các sàn, trang thương mại điện tử và thanh toán không dùng tiền mặt, tạo ra khác biệt so với các chương trình khuyến mại do các doanh nghiệp đăng ký tổ chức thực hiện. Từ đó góp phần thúc đẩy hoạt động sản xuất, nâng cao năng lực cạnh tranh của doanh nghiệp; tích hợp các ứng dụng hiện đại của cuộc cách mạng công nghiệp 4.0 nhằm đưa ra các loại hình kinh doanh đa dạng, thông minh phù hợp với sự phát triển mạnh mẽ của thương mại điện tử, hướng đến một thị trường tiêu dùng thông minh và kết nối nhanh hơn giữa doanh nghiệp và người tiêu dùng.</p><p>&nbsp;</p><p><img src=\"https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-9-1024x682.png\" alt=\"\" srcset=\"https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-9-1024x682.png 1024w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-9-300x200.png 300w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-9-768x511.png 768w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-9-1536x1023.png 1536w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-9.png 1562w\" sizes=\"100vw\" width=\"1024\"></p><p><i>Giám đốc Sở Công thương Nguyễn Văn Thành cùng các đại biểu tham quan gian hàng tại siêu thị Co.opmart</i></p><p>&nbsp;</p><p>Bên cạnh đó, chương trình góp phần tăng cường vai trò của các cơ quan quản lý nhà nước trong việc bình ổn thị trường, kiềm chế lạm phát, đảm bảo an sinh xã hội, thực hiện mục tiêu phát triển kinh tế – xã hội của thành phố; nâng cao nhận thức của người tiêu dùng về mua sắm hàng hóa, dịch vụ, về đảm bảo quyền và lợi ích của người tiêu dùng, gắn với trách nhiệm của các doanh nghiệp cung ứng hàng hóa, dịch vụ.</p><p>Với chủ đề “Tháng khuyến mại Hải Phòng năm 2024 – Kích cầu tiêu dùng trong thời kỳ kinh tế số”, Chương trình đã thu hút trên 1.000 doanh nghiệp thuộc mọi thành phần kinh tế trong và ngoài thành phố tham gia với trên 22.000 mặt hàng đăng ký khuyến mại, bao gồm nhiều chương trình, hoạt động chính như: Điểm vàng khuyến mại, Điểm mua sắm và thanh toán không dùng tiền mặt, 60 giờ Ngày mua sắm trực tuyến – Online Friday 2024, Tuần lễ vàng – Rộn ràng quà tặng.</p><p>&nbsp;</p><p><img src=\"https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-10-1024x682.png\" alt=\"\" srcset=\"https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-10-1024x682.png 1024w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-10-300x200.png 300w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-10-768x511.png 768w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-10-1536x1023.png 1536w, https://tintuc.buudien.vn/wp-content/uploads/2024/12/image-10.png 1562w\" sizes=\"100vw\" width=\"1024\"></p><p><i>Giám đốc Sở Công thương Nguyễn Văn Thành cùng các đại biểu tham quan gian hàng tại siêu thị Co.opmart</i></p><p>&nbsp;</p><p>Tháng Khuyến mại Hải Phòng năm 2024 triển khai cũng nhằm hưởng ứng chương trình Tháng khuyến mại tập trung quốc gia năm 2024, “Tuần lễ thương mại điện tử quốc gia và Ngày mua sắm trực tuyến Việt Nam – Online Friday”. Điểm nổi bật của Tháng khuyến mại năm nay là các chương trình ngày mua sắm trực tuyến thành phố Hải Phòng, Chương trình ứng dụng thanh toán số và thương mại điện tử tại các chợ truyền thống trên địa bàn thành phố; hình thành ngày hội khuyến mại tập trung dành cho các doanh nghiệp sản xuất kinh doanh trên địa bàn, từ đó giúp người tiêu dùng có cơ hội tiếp cận nhiều hơn với các chương trình khuyến mại của các doanh nghiệp và mua sắm những sản phẩm phù hợp với nhu cầu dịp cuối năm<i>.</i></p><p>Theo số liệu thống kê đến hết tháng 11 năm 2024, tổng mức bán lẻ hàng hóa và doanh thu dịch vụ của thành phố ước đạt 205.593,6 tỷ đồng, tăng 13,61% so với cùng kỳ, đạt 92,4% kế hoạch. Trong đó, doanh thu bán lẻ hàng hóa ước đạt 170.959,2 tỷ đồng, tăng 14,24% so với cùng kỳ.</p><p>“Tháng khuyến mại Hải Phòng năm 2024” được kỳ vọng là cú hích cho thị trường bán lẻ các tháng cuối năm dương lịch và dịp đến Nguyên đán 2025, tạo đà cho việc hoàn thành và hoàn thành vượt mức chỉ tiêu tổng mức bán lẻ hàng hóa và doanh thu dịch vụ tiêu dùng trên địa bàn thành phố các năm 2024 – 2025.</p>', 'news/jIkSV3L8DA0KyWJuqJJ8R9q4zo6JpDQBUBmVBzMV.jpg', 1, '2025-05-06 21:14:25', '2025-05-12 20:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `payment` enum('bank','cod') NOT NULL,
  `status` enum('pending','confirmed','preparing','shipping','delivered','completed','cancelled','refunded') NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `phone`, `address`, `user_id`, `amount`, `discount_id`, `payment`, `status`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, '0999888999', 'ABCDE', 4, 150000, 2, 'bank', 'pending', 1, '2025-05-07 09:05:48', '2025-05-07 02:46:15'),
(2, '0999888999', 'ABCDE', 4, 150000, 2, 'bank', 'confirmed', 1, '2025-05-07 10:12:38', '2025-05-07 03:13:25'),
(7, '0999888999', 'Hưng Yên, 8638, 238, 25', 4, 300000, NULL, 'cod', 'pending', 3, '2025-05-11 06:38:49', '2025-05-11 06:38:49'),
(8, '0999888999', 'Hưng Yên, 8638, 238, 25', 4, 375000, 3, 'cod', 'pending', 1, '2025-05-11 06:38:49', '2025-05-11 06:38:49'),
(9, '0999888999', 'Hưng Yên 123, 9238, 258, 27', 4, 450000, NULL, 'cod', 'pending', 3, '2025-05-11 07:01:32', '2025-05-11 07:01:32'),
(10, '0999888999', 'Hưng Yên 123, 9238, 258, 27', 4, 250000, NULL, 'cod', 'pending', 1, '2025-05-11 07:01:32', '2025-05-11 07:01:32'),
(11, '0999888999', 'Hưng Yên2222, Xã Đồng Cốc, Huyện Lục Ngạn, Tỉnh Bắc Giang', 4, 250000, NULL, 'bank', 'cancelled', 1, '2025-05-11 07:03:41', '2025-05-11 21:26:35'),
(12, '0999888999', 'Hưng Yên2222, Xã Đồng Cốc, Huyện Lục Ngạn, Tỉnh Bắc Giang', 4, 150000, NULL, 'cod', 'pending', 3, '2025-05-11 07:03:41', '2025-05-11 07:03:41'),
(13, '0999888999', 'Hưng Yên, Xã Hùng Long, Huyện Đoan Hùng, Tỉnh Phú Thọ', 4, 250000, NULL, 'cod', 'completed', 1, '2025-05-11 07:06:30', '2025-05-11 21:14:37'),
(14, '0999888999', 'Hưng Yên, Xã Hùng Long, Huyện Đoan Hùng, Tỉnh Phú Thọ', 4, 150000, NULL, 'cod', 'pending', 3, '2025-05-11 07:06:30', '2025-05-11 07:06:30'),
(15, '0555666777', 'abcde, Xã Đạp Thanh, Huyện Ba Chẽ, Tỉnh Quảng Ninh', 4, 150000, NULL, 'cod', 'pending', 3, '2025-05-11 18:27:57', '2025-05-11 18:27:57'),
(16, '0999699699', 'No. 36 Aguiyi Ironsi Street, Xã Cây Thị, Huyện Đồng Hỷ, Tỉnh Thái Nguyên', 4, 155000, NULL, 'cod', 'pending', 3, '2025-05-11 21:29:57', '2025-05-11 21:29:57'),
(17, '0389532626', 'abcde, Xã Cao Xá, Huyện Lâm Thao, Tỉnh Phú Thọ', 4, 85000, NULL, 'cod', 'pending', 3, '2025-05-11 21:30:38', '2025-05-11 21:30:38'),
(18, '0999699699', 'abc, Phường Hòa Khánh Bắc, Quận Liên Chiểu, Thành phố Đà Nẵng', 4, 150000, NULL, 'cod', 'pending', 1, '2025-05-13 19:53:26', '2025-05-13 19:53:26'),
(19, '0999699699', 'abc, Phường Hòa Khánh Bắc, Quận Liên Chiểu, Thành phố Đà Nẵng', 4, 125000, NULL, 'cod', 'pending', 4, '2025-05-13 19:53:26', '2025-05-13 19:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `images` text NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `number_of_purchases` int(11) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `star` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `avatar`, `images`, `price`, `stock`, `number_of_purchases`, `description`, `star`, `category_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Đông trùng hạ thảo khô – Sấy thăng hoa Dr Trung', 'products/PVeLpmsxjLqfMpIH7Ii7Nud6fGbrJx6VFoeNRWkf.webp', 'products/VPZbfxFzWYBJIAhymRo8TpSptqPonDbIxFea83hd.webp', 50000, 7, 5, '<p><i>Đông trùng hạ thảo khô sấy thăng hoa Dr. Trung với hệ thống máy sấy thăng hoa hiện đại (sấy ở -400C) nên hàm lượng dinh dưỡng trong sản phẩm sau sấy giữ được trên 95% so với ban đầu…</i></p>', 5, 1, 1, '2025-04-21 02:25:38', '2025-05-13 19:53:26'),
(2, 'Chả Cá Thác Lác Tươi', 'products/xBNQKliAN5oUHvJqkIwPEvWpw3fSBVrpULeh1ceY.jpg', 'products/R4Z8zGB79tMoYob2uSUtHGQQLUdQxJgDbBtji0aw.jpg', 200000, 5, 2, '<p>Cá thát lát có thể để nguyên con chế biến, nhưng nạo ra, ta có món chả ngon tuyệt vời. Với giá trị dinh dưỡng cao, có nhiều công dụng chữa bệnh, cá thát lát là lựa chọn thông minh trong việc chế biến món ngon bổ dưỡng.</p><p>Hầu hết các loại chả đều phải làm từ thịt thật tươi, giã thật kỹ, quết thật nhuyễn, kể cả các loại chả cá. Nhưng có một món chả đặc biệt, phải để cá cho hơi mềm mình bớt tươi thì mới nạo được thịt, và chỉ cần miết thìa vài lần đã có món chả dai giòn, đó là chả làm từ cá thát lát.<br><br>Cá thát lát có tên khoa học là Notopterus, thuộc họ Notopteridae. Thịt cá thát lát dẻo, chắc. Có lẽ cũng chỉ có người Việt mới nghĩ ra cách để cá hơi \"ươn mình\" cho thịt cá mềm ra, rồi lạng hai bên lườn, dùng thìa nạo cá ra làm thành món chả ngon tuyệt vời như thế.<br>Cá thát lát được biết đến không chỉ như một món ăn ngon mà còn là bài thuốc hiệu quả trong việc phòng chữa một số bệnh. Theo Đông y, cá thát lát có vị ngọt, tính bình, không độc, tác dụng bổ khí huyết, bổ thận, tráng dương, trừ phong thấp, giảm đau...</p><p>Cá thát lát khi kết hợp với một số loại rau, củ quả khác nhau thì cho những công dụng chữa bệnh khác nhau. Ví như, kết hợp với mè trắng, cá thát lát có tác dụng giảm suy nhược cơ thể, bổ sung dưỡng chất cho những thai phụ kén ăn và hay mệt mỏi trong thời gian thai nghén. Đem hầm cùng khổ qua lại có lợi đối với những người bị cao huyết áp, tiểu đường, mỡ trong máu. Ngoài ra, cá thát lát nấu với cải bẹ xanh rất tốt cho người suy nhược cơ thể, đau nhức gân cơ, ho hen, đầm suyễn.<br>Với giá trị dinh dưỡng cao, có nhiều công dụng chữa bệnh, cá thát lát là lựa chọn thông mình trong việc chế biến món ngon bổ dưỡng. Xin giới thiệu cùng bạn món Chả cá lá chanh, Cá thát lát cuộn trứng và Canh cá lá giang.</p>', 2, 1, 1, '2025-05-06 20:43:43', '2025-05-11 20:15:17'),
(3, 'Chả lụa Peco Food', 'products/RAZyYqwkbNJtL3ISBLM3zc68KWXD24boebiBWm6G.png', 'products/X4NQbkMhGZM9p439XAb8MWDescl2niwRlOW2eNvv.jpg', 125000, 0, 1, '<p><strong>Chả Lụa Peco Food</strong> được sản xuất từ nguồn thịt thảo mộc Pig Eco, theo quy trình khép kín, đảm bảo VSATTP. Đặc biệt sản phẩm nói không với chất bảo quản, chất tạo màu, tạo mùi, hàn the. Sử dụng hoàn toàn 100% các nguyên liệu tự nhiên từ khâu đóng gói mang đến hương vị tuyệt hảo nhất cho món ăn, đảm bảo an toàn cho sứ khỏe của quý khách.</p>', 0, 1, 1, '2025-05-06 21:03:30', '2025-05-11 20:08:39'),
(4, 'Mực 3 nắng Hạng Huệ', 'products/ldH0h1Ure6TxFyxus3ZBMwTJooRwXQu5y8XlC6zd.webp', 'products/Vs2sFaiRcTeKJv0HWmqXNbFrKKxJhkAUHlOqFZen.webp#products/oiA2VzjkRCumpweOi0xqW4GsKDgIMhNqhLbsG0tH.webp', 150000, 4, 2, '<p>Mực 3 nắng Hạng Huệ luôn là lựa chọn hàng đầu của khách du lịch khi đến với vùng biển Thanh Khê nói riêng và Đà Nẵng nói chung.&nbsp;Mực 3 nắng chứa nhiều chất dinh dưỡng giúp tăng cường hệ miễn dịch, sức đề kháng. Ngoài ra, mực còn chứa magie, một loại khoáng chất có tác dụng thư giãn thần kinh và cơ bắp. Sản phẩm đạt chứng nhận OCOP 3 sao của thành phố Đà Nẵng.</p>', 0, 1, 3, '2025-05-11 04:46:24', '2025-05-11 20:01:42'),
(5, 'Cá Bò gai khô Bắc Đẩu', 'products/buwvrQ9h2uZPmpsB9nlDeQdklCZGaDyqg31u0M8d.webp', 'products/teAEDqKAoQNCa2hunkKukWIMkrm3Jl9mFZ1r8VuS.webp', 280000, 0, 0, '<p>Đối với những người sành ăn thì không thể không biết tới món khô cá bò. Cá bò khô có độ dai, vị ngọt, càng ăn càng ngon ngọt. Từ cá bò khô, ta có thể chế biến được nhiều món ngon cực hấp dẫn như cá bò khô nướng, cá bò khô tẩm mè, gỏi (nộm) cá bò khô … Các món từ cá bò rất phù hợp để nhâm nhi với chút bia hoặc làm các món ăn chơi cũng rất tuyệt.</p><p>quy cách: gói 500gr</p><p>Nguyên liệu để làm cá bò khô chính là cá bò tươi. Cá bò là loài cá sống chủ yếu ở các vùng biển miền Trung hoặc miền Nam nước ta. Thân cá có hình oval dài và dẹp 2 bên với miệng nhọn, dài, mặt nghiêng. Miệng của con lớn lồi lên phía trên, phía dưới lõm. Mang mở một khe nhỏ ở bên của bệ ngực. Khi lột da, nhìn bề ngoài thịt cá khô bóng, có màu trắng trong, ngọt và dai như thịt gà. Đặc biệt xương cá là loại xương sụn, mềm, phù hợp cho những người cần bổ sung canxi cho cơ thể.</p><p>&nbsp;</p><p>Quy cách đóng gói: đóng gói trong túi nhựa.</p><p>Bảo quản: Bảo quản tốt nhất trong ngăn đá tủ lạnh, ngoài ra cũng có thể sử dụng ngăn mát để bảo quản.</p><p>Thời gian sử dụng tốt nhất: Dưới 3 tháng.</p>', 0, 1, 1, '2025-05-11 20:32:49', '2025-05-11 20:32:49'),
(6, 'Chả cá Cây Sang', 'products/0s2HLL2Llua09Ni3EIHDB2GsEgejfpf0LyxttEPz.jpg', 'products/725vwASuI170JEaZM4pnAvkm5yZ8IwOLWcsRC34w.png', 100000, 6, 0, '<p>Chả cá Cây Sang được chế biến từ các loại cá tươi ngon, làm sạch, lấy hết xương, da và thêm gia vị, đưa vào máy xay lên cho đến khi đạt độ dai nhất định. Sau khi chả cá đã đạt độ dai ngon nhất định sẽ được lấy ra khỏi máy xay, định hình thành đủ hình dạng: miếng tấm, viên tròn, dẹp đồng xu rồi đem đi chiên hoặc hấp chín, đặc biệt không sử dụng hàn the, được sản xuất hàng ngày, đảm bảo tươi ngon, an toàn vệ sinh thực phẩm. Chả cá có 3 loại: Chả cá chiên, chả cá hấp và chả cá sống.</p>', 0, 1, 1, '2025-05-11 20:36:49', '2025-05-11 20:36:49'),
(7, 'Bánh tráng Thi Chung', 'products/da3yc09dqMwVhA1SfCIi0GiPgYaQwSFoBcjJ80sX.webp', 'products/1J21uZ9bRV3sYTNpfwXLlD8WRAmHDzgaKFtnjbX1.webp#products/nVN9Vddji1uBuletrBgfAyK1suk8RBGEap1iILcw.webp', 80000, 10, 0, '<p>Bánh tráng Thi Chung có mè phủ kín hai mặt bánh, khi ăn có hương vị thơm, bùi thật riêng… Miếng bánh đa quê hóa ký ức nặng tình thương của biết bao thế hệ. Sản phẩm đạt chứng nhận OCOP 3 sao của thành phố Đà Nẵng.</p>', 0, 1, 3, '2025-05-11 20:50:52', '2025-05-11 20:50:52'),
(8, 'Chè Dây Hòa Bắc', 'products/Q4T0xhsfgI8ti3EkWY42Yee7EJYp7DRdMHHuDFnU.jpg', 'products/OMGmL4wAyeFWhi9lsdDKeTJSciBt6v8th6yPHjNX.jpg#products/f2iJnNRQxtE8o2Z6WyU1hKOyoaILuYFwdqp2w44w.webp', 155000, 19, 1, '<p>Chè Dây Hòa Bắc Loại 1 gói 250gam .</p><p>*Công dụng : Thanh nhiệt cơ thể, viêm tiêu giải độc , kích thích tiêu hóa, dễ ngủ, .Có khả năng điều trị đau dạ dày , tá tràng, đầy hơi, ăn uống khó tiêu.</p><p>*Khối lượng : 250 Gam/gói.</p><p>*Sản phẩm : OCOP Đà Nẵng</p><p>*Nơi sản xuất : Thôn Nam Yên Hòa Bắc Hòa Vang Đà Nẵng.</p><p>*Địa điểm bán hàng : Vũ Đình Long, Thọ Quang Sơn Trà Đà Nẵng</p><p>* Hạn sử dụng :12 tháng kể từ ngày sản xuất</p><p>* Bảo quản : nơi khô ráo thoáng mát</p>', 0, 1, 3, '2025-05-11 20:55:27', '2025-05-11 21:29:57'),
(9, 'Cá đét khô tẩm gia vị', 'products/S3OA84qwizCotVWSVeaK1LRCTpGCbpoM7lModx5o.jpg', 'products/U3rY2XWb4MWhxCoMY6xYoFIV22CgZXwybfsk2FnC.jpg#products/aB0zutnhIDcObfAlA44Mi04g4xzANn3Vyq6oHTum.jpg', 150000, 9, 0, '<p><strong>Cá đét tẩm gia vị</strong> vừa giòn, vừa bùi béo, hòa lẫn vị mằn mặn, the the của muối ớt quả thật không thua bất kỳ món sơn hào hải vị nào… Ngồi nơi quán cóc ven đường cùng bạn bè vào ban đêm, cạnh bên bờ sông Hàn lộng gió để thưởng thức món khô cá đét thật thú vị.</p>', 0, 1, 3, '2025-05-11 20:58:55', '2025-05-11 20:58:55'),
(10, 'Tương ớt rim Y Phụng', 'products/Y3OUX8FVwzC51BkYKqks2RwUjgRSAwtEm2rjuckQ.webp', 'products/Xx6KiRlEFYOrdpOeka9VPqEKlWnfIibJvDqxiqLT.webp', 85000, 14, 1, '<p>Tương ớt rim Y Phụng rất ngon, có chút vị mặn mặn nhưng chủ đạo vẫn là vị ngọt, rất hợp với các món thuần Việt. Tương ớt rim này còn có vị cay vừa, thích hợp với mực nướng, cá nướng, trộn tré và làm nước chấm, được người tiêu dùng ưa chuộng nhờ hương vị đặc trưng, đậm đà. Sản phẩm đạt chứng nhận OCOP 3 sao của thành phố Đà Nẵng.</p>', 0, 1, 3, '2025-05-11 21:01:07', '2025-05-11 21:30:38'),
(11, 'Tiêu Tiên Phước', 'products/Aozkbp1igCilo2syxePG02ZHNzRGPg74LgsoqFn4.jpg', 'products/SsJkxZGGcFVwbwIhgC0F1nBXh6ql55Z3jo3LSmcx.jpg', 280000, 5, 0, '<p>Thành phần: 100% Tiêu đen hữu cơ nguyên hạt (đặc sản vùng núi Tiên Phước) Khối lượng tịnh: 500g Hạn sử dụng: 24 tháng kể từ Ngày sản xuất Gợi ý sử dụng: Dùng cho các món ăn hằng ngày Hướng dẫn bảo quản: Bảo quản nơi khô ráo, thoáng mát Xuất xứ: vùng miền núi huyện Tiên Phước - Quảng Nam</p>', 0, 1, 4, '2025-05-12 20:06:35', '2025-05-12 20:06:35'),
(12, 'Bánh tráng Đại Lộc', 'products/NtxkJMS7x5LSzWYXDy1QVN5eFdBsNYbvX2jqwFaR.jpg', 'products/cuFiYJNrV3SyyZodulhi6OoImVzmrb9Q5ThY5dbm.jpg', 35000, 10, 0, '<p>Nói về đặc sản đại lộc, mọi người nghĩ ngay đến bánh tráng Đại Lộc. Hợp tác xã Ái Nghĩa chuyên cung cấp bánh tráng Đại Lộc, Bánh tráng được chế biến từ \" Gạo an toàn Ái Nghĩa\" sản xuất trên dây chuyền công nghệ tiên tiến khép kín, đảm bảo hợp vệ sinh, không sử dụng hàn the, quá trình đóng gói không sử dụng chất bảo quản.</p>', 0, 1, 4, '2025-05-12 20:11:05', '2025-05-12 20:11:05'),
(13, 'Trà sen thảo mộc', 'products/AkftPldlDmxzlGKjlFTsuYCS67TiyzrhTPnNEBoG.jpg', 'products/zjBSQxFGGz3Ni5VOCShclPSr32gJP5xBw1RNRhpw.jpg', 145000, 10, 0, '<p>Được sản xuất từ giống sen trắng cổ có nguồn gốc từ Hoàng cung Huế với quy trình canh tác tự nhiên, không sử dụng các chất hóa học, chất bảo quản, chất tạo mùi giúp tạo ra một sản phẩm có giá trị và an toàn cho người sử dụng. Trà Sen Thảo Mộc sử dụng nguyên liệu là các bộ phận từ cây sen, được biết đến như những vị thuốc đông y giúp cải thiện giấc ngủ và nhiều lợi ích khác.</p>', 0, 1, 4, '2025-05-12 20:13:54', '2025-05-12 20:13:54'),
(14, 'Gạo Phong Thử', 'products/DhxBjM7prCwEvZ4S2rNeUPdJxfpXFB2OOSlKDTfh.jpg', 'products/3fjqQysEAiViLXyxyfqvcHKzBN0p0sr4RVOvcuXm.jpg', 175000, 10, 0, '<p>Gạo Phong Thử</p>', 0, 1, 4, '2025-05-12 20:15:43', '2025-05-12 20:15:43'),
(15, 'Tương ớt mè Daichi', 'products/k3ECmHyzTbGc707nKJhpnZnMjKhD7jyDUHquyITN.jpg', 'products/1HxOdcT1NzyuVGWAyANzk0dxg05EJRBawDPoCmZL.jpg', 55000, 10, 0, '<p>Đặc sản truyền thống Hội An - Quảng Nam<br>Vị cay nồng đặc sản của tương ớt phố Hội<br>Hương thơm của hạt mè hoà quyện với vị béo của dầu đậu nành<br>Màu đỏ thắm của ớt sừng tươi tự nhiên, không màu nhân tạo<br>Không chất bảo quản, không hương liệu nhân tạo, không bột ngọt</p>', 0, 1, 4, '2025-05-12 20:23:27', '2025-05-12 20:23:27'),
(16, 'Óc Chó Mẹ Tép', 'products/9zLea2IKnlGmxVY5HYo08jZDNTxvZ6AIC7pE3ddU.jpg', 'products/jM39oL42CSQ7LpMVfII1oiqZRe4ddQFfxWdO94LU.jpg', 140000, 10, 0, '<p>Nhân Hạt Óc Chó – Walnuts 300gram</p><p>Óc chó, còn được biết đến với tên gọi là “walnuts” trong tiếng Anh, là một loại hạt giàu chất dinh dưỡng. Dưới đây là một số thành phần dinh dưỡng chính của óc chó:</p><p>Chất béo:&nbsp;Hạt óc chó chứa khoảng 60% chất béo, trong đó phần lớn là axit béo không bão hòa đơn và đa không bão hòa như oleic, linoleic, linolenic.</p><p>Protein:&nbsp;Khoảng 25% trọng lượng hạt óc chó là protein chất lượng cao.</p><p>Carbohydrate:&nbsp;Chứa khoảng 13% carbohydrate, chủ yếu là chất xơ.</p><p>Vitamin E:&nbsp;Hạt óc chó rất giàu vitamin E.</p><p>Khoáng chất:&nbsp;Chứa nhiều khoáng chất như magiê, photpho, kẽm, đồng, sắt, mangan,..</p><p>Chất xơ:&nbsp;Cung cấp khoảng 10% lượng chất xơ cần thiết mỗi ngày.</p><p>Các hợp chất thực vật:&nbsp;Chứa nhiều hợp chất thực vật có lợi như avenanthramides, phenolic.</p><p>Như vậy, hạt óc chó là một nguồn cung cấp dưỡng chất tuyệt vời, đặc biệt các axit béo không bão hòa, protein thực vật, chất xơ và vitamin E.</p><p>&nbsp;</p><p><br>&nbsp;</p>', 0, 3, 4, '2025-05-12 21:00:13', '2025-05-12 21:00:13'),
(17, 'Xoài Muối Ớt Mẹ Tép', 'products/tTLikQhuNYAUjqxldfhBCinBseBnujMqyOJ1TVq9.jpg', 'products/bPQcrA12NIcIDjmnTbjKJmPqoWjZiLF3v7SKahX5.jpg', 125000, 9, 1, '<p>Được lựa chọn kỹ lưỡng từ 100% Xoài chín tươi kết hợp với phương pháp sấy dẻo hiện đại, đảm bảo an toàn &amp; vệ sinh thực phẩm. Sản phẩm không chỉ là món ăn vặt thơm ngon, an toàn cho sức khoẻ mà còn chứa ít calories, nhiều chất xơ, thích hợp cho mọi lứa tuổi.</p>', 4, 3, 4, '2025-05-12 21:02:58', '2025-05-13 20:21:38'),
(18, 'Bánh Tráng Safoco size 22cm', 'products/o9hWQ3c3U512j6iJ6aFylQbBmtTZtUtmW5CvZ6cZ.jpg', 'products/gqa5qsAYHsZsmsokecliJ3ukeNF20HmYpyAUm2Vo.jpg', 25000, 10, 0, '<p>Bánh tráng với độ dài 22cm phù hợp cho nhiều món ăn như bánh cuốn, bánh mỏng giúp khi ăn không bị ngán, cuốn dễ, tạo độ trong suốt hấp dẫn, bắt mắt Thành phần: Tinh bột khoai mì, gạo, muối</p><p>Khối lượng: 300g Kích thước: 22cm Sử dụng để cuốn chả giò, gỏi cuốn,... Bảo quản trong bao kín, nơi khô ráo, thoáng mát Thương hiệu: Safoco (Việt Nam) Nơi sản xuất: Việt Nam</p>', 0, 3, 4, '2025-05-12 21:04:30', '2025-05-12 21:04:30'),
(19, 'Mì Trứng sợi nhỏ Safoco', 'products/mKMOFpjzY2SW7ZfudIELoV5MFj1GJrhuUelSnDla.jpg', 'products/k09hxdz7l9Bd4QCeDjmzr0VjnfqKocXDgbYDsOHL.jpg', 32000, 10, 0, '<p>Sợi mì nhỏ, dai ngon hoàn hảo, kích thích vị giác cùng thị giác với màu vàng bắt mắt từ trứng. Mì trứng sợi nhỏ Safoco gói 500g có thể chế biến thành nhiều món từ xào cho đến nấu chung với nước lèo. Mì Safoco chất lượng, dinh dưỡng là sự lựa chọn của nhiều khách hàng.</p><p><strong>Thông tin sản phẩm</strong>Loại sản phẩm Mì trứng Trọng lượng 500g Số vắt Khoảng 20 vắt Loại sợi Sợi tròn, nhỏ</p><p>Thương hiệu Safoco (Việt Nam) Sản xuất tại Việt Nam</p><p><strong>Thành phần</strong></p><p>Bột mì (97,5%), trứng (1,5% đã qua kiểm dịch), muối ăn, chất ổn định (Pentasodium Triphosphate (E451i), màu thực phẩm tổng hợp (Tartrazine (E102), Sunset yellow FCF (E110))</p><p><br>&nbsp;</p><p><strong>Cách dùng</strong></p><p>Cho các vắt mì vào nước đang sôi, nấu khoảng 1-3 phút, thỉnh thoảng đánh tơi vắt mì cho chín mềm đều, đừng nấu chín quá, vớt mì ra, bỏ vào nước lạnh, đánh tơi sợi mì rồi vớt ra để cho ráo nước.</p><p>Cho một muỗng dầu thực vật rồi trộn đều để các sợi mì không dính vào nhau. Sau đó dùng làm các món ăn tuỳ thích.</p><p>MÌ NƯỚC - Sắp mì vào tô để thịt, tôm, cua, gia vị rồi đổ nước lèo đang sôi vào. MÌ XÀO - Xào với các loại thịt, tôm, cua, nấm rơm và gia vị tuỳ theo khẩu vị. Bảo quản: Để nơi khô ráo, thoáng mát</p>', 0, 3, 4, '2025-05-13 00:59:21', '2025-05-13 00:59:21'),
(20, 'Nui ống lớn Safoco', 'products/LJ00eZMcbTstxnIxc2KpIlMwSZZ7y7qWdmhaAg4c.jpg', 'products/uyVONspakrO1kf1VoXRZBuj7Hjk5xXwtadVzduYs.jpg', 29000, 10, 0, '<p>Loại sản phẩm: Nui ống Trọng lượng: 400g</p><p>Thương hiệu: Safoco (Việt Nam) Sản xuất tại: Việt Nam<br>&nbsp;</p><p><strong>Thành phần</strong>Bột gạo 64%, bột mì 17%, tinh bột khoai mì 17%, trứng (1%, đã qua kiểm dịch), muối ăn, chất ổn định (Pentasodium Triphosphate (E451i)), màu thực phẩm tổng hợp (Tartrazine (E102), Sunset Yellow FCF (E110)).<br>&nbsp;</p><p><strong>Cách dùng</strong></p><p>Đun sôi khoảng 1-3 lít nước (tuỳ theo khối lượng gói nui), cho nui vào nước đang sôi, nấu khoảng 7-12 phút, thỉnh thoảng khuấy đều và thử xem nui đã chín đều chưa. Đừng nấu chín quá, khi nui đã vừa chín thì vớt ra đem xả nước lạnh rồi để ráo nước, xong trộn nui với 1 muỗng dầu thực vật để nui không dính cục vào nhau. Sau đó chế biến thành các món ăn tuỳ theo ý thích. Nui nấu, nui xào với các loại rau củ, thịt, thuỷ hải sản, gia vị,...<br>&nbsp;</p><p><strong>Bảo quản</strong>Để nơi khô ráo, thoáng mát</p>', 0, 3, 4, '2025-05-13 01:18:41', '2025-05-13 01:18:41'),
(21, 'Trà trái mãng cầu xiêm túi lọc (Hộp 48g)', 'products/hWvsPCgpmb4iW0uJussiKd4uThBnG0IH21aqjjou.jpg', 'products/48lJuQd5RVZgelpo40cQQAa21CWT7cY4YLDDJY7u.jpg', 100000, 19, 1, '<p>TRÀ MÃNG CẦU</p><p>&nbsp;</p><p>Trà mãng cầu được xem là ‘thần dược’. Nhờ vào hàng loạt lợi ích cho sức khỏ của loại trà này. Chẳng hạn như ngừa sự phát triển của một số loại bệnh ung thư. Giảm huyết áp, tăng cường sức đề kháng và khả năng tiêu hoá. Loại trà này còn giúp làm đẹp như giảm cân, đẹp da và kháng viêm.</p><p>&nbsp;</p><p>Trà mãng cầu là loại trà được làm từ lá hay trái mãng cầu xiêm (Annona muricata). Ở Việt Nam thì trà mãng cầu hay được làm từ trái của cây mãng cầu xiêm. Thế nhưng ở các nước thì lá mới là phần được làm thành trà. Và gần đây thì người tiêu dùng nước ta mới bắt đầu làm quen với việc uống lá mãng cầu. Quả mãng cầu rất được chú ý thời gian gần đây. Vì một số nghiên cứu cho thấy loại trái cây này có nhiều lợi ích cho sức khoẻ.</p>', 0, 3, 1, '2025-05-13 01:20:10', '2025-05-14 02:58:27'),
(22, 'Yến chưng đường phèn (Hủ)', 'products/iQLClyJKNl6R5T3fwlfiuiu9Iehz6ydN5OFO2Xji.jpg', 'products/FQ8cFg2XFCg3Pwd2lLnYwmENWLfX0tMSDNne2U7v.jpg', 80000, 8, 0, '<p>Tổ yến chưng đường phèn có vị ngọt thanh tao nên được nhiều người yêu thích. Tổ yến chưng mang nguồn dinh dưỡng dồi dào, rất tốt cho trẻ em, bà bầu và người lớn tuổi.</p>', 0, 3, 1, '2025-05-13 01:22:03', '2025-05-13 01:22:03'),
(23, 'Trà trái mãng cầu xiêm', 'products/XPCozoRnecCpaTsPeJNquuV0N2opex2sEzyA9BG3.jpg', 'products/OvZP2zyGcg1glTfNexMO3MCDZG47bKULS49VLQFP.jpg', 120000, 10, 0, '<p>TRÀ MÃNG CẦU</p><p>&nbsp;Trà mãng cầu được xem là ‘thần dược’. Nhờ vào hàng loạt lợi ích cho sức khỏ của loại trà này. Chẳng hạn như ngừa sự phát triển của một số loại bệnh ung thư. Giảm huyết áp, tăng cường sức đề kháng và khả năng tiêu hoá. Loại trà này còn giúp làm đẹp như giảm cân, đẹp da và kháng viêm.</p><p>&nbsp;Trà mãng cầu là loại trà được làm từ lá hay trái mãng cầu xiêm (Annona muricata). Ở Việt Nam thì trà mãng cầu hay được làm từ trái của cây mãng cầu xiêm. Thế nhưng ở các nước thì lá mới là phần được làm thành trà. Và gần đây thì người tiêu dùng nước ta mới bắt đầu làm quen với việc uống lá mãng cầu. Quả mãng cầu rất được chú ý thời gian gần đây. Vì một số nghiên cứu cho thấy loại trái cây này có nhiều lợi ích cho sức khoẻ.</p>', 0, 3, 3, '2025-05-13 01:24:18', '2025-05-13 01:24:18'),
(24, 'Rong Sụn Mẹ Tép', 'products/kDxg4b7YeS4I2IvhZLy84fqmqjhDLCkru6ufPbTP.jpg', 'products/mFU0u37PVPnkjNcIDHlYkFa4tun8ZGSUhwXxwdqb.jpg', 145000, 10, 0, '<p>Rong sụn (rong sụn gai) thuộc ngành tảo đỏ, phát triển theo nhánh, chùm. Rong sụn khi nuôi có màu xanh lá đậm đặc trưng, tùy vào độ mặn thì rong còn có màu vàng hoặc nâu. Rong sụn được trồng tại các vùng biển, vịnh nông. Nhiệt độ nước ấm từ 25 – 30 độ C, điều kiện độ mặn cao, rong sẽ sinh trưởng và phát triển tốt. Hiện nay rong sụn biển đã và đang được nuôi trồng thành công tại một số vùng biển Việt Nam</p><p>Giá trị dinh dưỡng từ rong sụn biển rất cao. Thành phần dinh dưỡng có trong rong sụn chủ yếu là chất khoáng, vitamin A, B2, C, Canxi, Iot… Chính vì thế rong sụn rất tốt cho sức khỏe con người, có thể chữa một số bệnh như: huyết áp cao, táo bón, bướu cổ… Chính vì thế nhiều&nbsp;<strong>món ăn từ rong sụn</strong>&nbsp;được chế biến sáng tạo, vừa ngon vừa bổ dưỡng. Rong sụn biển tươi sau khi được sơ chế, sấy khô có thể được bảo quản lâu tới 06 tháng. Rong sụn khô được chế biến sử dụng thành nhiều món ăn ngon như: gỏi rong sụn, canh rong sụn, chè rong sụn, mứt rong sụn, thạch rong sụn,…</p>', 0, 3, 4, '2025-05-13 01:26:16', '2025-05-13 01:26:16'),
(25, 'Trà Bồ Khai Trà Bồ Khai Vị Quế Vị Nguyên Bản', 'products/kGRVkMnlceEmuF6T4gT9oqlMUd4x1oodv3PN0NBJ.jpg', 'products/m2fiitk8JgEBtaMKQL7G62TcI0vQZrepYxrFmFKJ.jpg', 99000, 10, 0, '<p>Tra bo khai</p>', 0, 3, 3, '2025-05-13 01:28:23', '2025-05-13 01:28:23'),
(26, 'Kẹo chuối gân hộp', 'products/LNs88vWso4PNI9OduiLvricXTHgrzfoiXdc6J21w.jpg', 'products/qksDxNMLWk6pN7JSAVAKrcpLTtetun6vcPloYWuC.jpg', 51000, 9, 0, '<p>???? Khác biệt hoàn toàn với những loại kẹo chuối bạn từng ăn! Kẹo chuối gân sầu riêng Vicosap không chỉ đem lại hương vị đặc trưng của chuối mà còn kết hợp với mùi sầu riêng thơm ngon, tạo nên một trải nghiệm ẩm thực độc đáo.</p><p><br>&nbsp;</p><p>???? Với sự mềm mịn, dẻo dai hơn và ít dính răng hơn, từng viên kẹo mang đến cảm giác thưởng thức hoàn hảo mà không gây cảm giác ngán.</p><p><br>&nbsp;</p><p>???? Giữ được vị chuối tươi ngon và thoảng mùi sầu riêng đặc trưng, mỗi viên kẹo là một hành trình khám phá vị giác mới lạ.</p><p><br>&nbsp;</p><p>Đừng bỏ lỡ cơ hội thưởng thức hương vị độc đáo này! ????</p>', 0, 4, 3, '2025-05-13 01:34:10', '2025-05-13 01:34:10'),
(27, 'Gạo Thơm Mỹ Bửu Trang', 'products/zoqmK5hIIqG2m55JWQO8MVe9efiFakG3CbEGnDzS.jpg', 'products/4zldFWT3GDGosn2qJV5SKHd4qqZrBTM4aw4l96LU.jpg', 170000, 10, 0, '<p>Gạo thơm Bửu Trang</p>', 0, 4, 3, '2025-05-13 01:41:47', '2025-05-13 01:41:47'),
(28, 'GIĂM BÔNG NGUYỄN DŨNG', 'products/d8Ku8rwN6VanL7sdFzTV8ZtRX4TryK7o4iJ2hOUU.jpg', 'products/eWdCPQGtaNEBVBg72eSCTNvYA90Jbc19SVvFry1C.jpg', 130000, 10, 0, '<figure class=\"image\"><img src=\"https://dyh48pub5c8mm.cloudfront.net/home/store/goods/7203/20250211/s3_7203_2025021114095773328.jpg\" alt=\"Chất lượng tuyệt hảo: Được làm từ thịt heo tươi sạch, kết hợp cùng giăm bông hảo hạng, tạo nên hương vị thơm ngon đặc trưng. Vị ngon khó cưỡng: Thịt dai giòn, béo nhẹ, không hề ngấy. Khi cắn vào, bạn sẽ cảm nhận được sự hòa quyện hoàn hảo giữa độ ngọt tự nhiên của thịt và vị mặn nhẹ từ giăm bông. Đa dạng cách thưởng thức: Có thể ăn ngay, làm nhân bánh mì, ăn kèm xôi, cuốn bánh tráng hoặc dùng trong các bữa tiệc. An toàn &amp; tiện lợi: Được chế biến theo quy trình đảm bảo vệ sinh an toàn thực phẩm, không chất bảo quản độc hại.\"></figure>', 0, 4, 1, '2025-05-13 01:43:25', '2025-05-13 01:43:25'),
(29, 'BÔNG ĐU ĐỦ ĐỰC NGÂM MẬT ONG', 'products/ZLvIVkVMwkaj3pW48q0KLRcxRNPt2hXr1kXYlc9v.jpg', 'products/TOyOzz0YEqR9x3wyaQjDffiYX89sYWIihrApT4ev.jpg', 350000, 10, 0, '<p>Ngon bổ rẻ</p>', 0, 4, 4, '2025-05-13 01:46:06', '2025-05-13 01:46:30'),
(30, 'MÍT SẤY GIÒN VIETBORN CỰC NGON - HỘP 200GR', 'products/ft3DpvCx4njiAlaQ8S27jmXLsNXl21aSu9qhCTKc.jpg', 'products/O9nVrI0RQWps20ZIFJJivP2YXXWkvTdjUMps1aB4.jpg', 81000, 10, 0, '<p>Mít sấy VietBorn cánh mít dày, màu vàng sáng đẹp dùng phương pháp chiên chân không kết hợp quay ly tâm tách dầu nên mít thơm và không bị hôi dầu.</p><p>&nbsp;</p><p>&nbsp;Hàng mới 100% – Nói không với hàng tồn kho</p><p>&nbsp;</p><p>&nbsp;Chất lượng ổn định, không thay đổi</p><p>&nbsp;</p><p>&nbsp;Đầy đủ chứng nhận VSATTP – Đảm bảo an toàn, sẵn sàng phân phối</p><p>&nbsp;</p><p>&nbsp;Nhận gia công đóng gói, in tem theo yêu cầu – Linh hoạt theo thương hiệu riêng</p><p>&nbsp;</p><p>&nbsp;Giá tốt nhất từ trước đến nay</p>', 0, 4, 3, '2025-05-13 01:49:09', '2025-05-13 01:49:41'),
(31, 'NGÔ CAY GIÒN VIETBORN CỰC ĐÃ - HỘP 200GR', 'products/BB5IofQPSRV4XkgG0Jus4CFI1LyTOHFZBuk2aU3P.jpg', 'products/gsAhhl69ikz8k2uRAAQ7TsmUl3pxFeQitbbHUZ6J.jpg', 59400, 10, 0, '<p>VietBorn mang đến cho bạn trải nghiệm hoàn toàn mới với ngô sấy đặc biệt:</p><p>Ngô nếp tươi Mộc Châu: Được tuyển chọn kỹ càng từ những bắp ngô tươi ngon nhất, đảm bảo độ ngọt tự nhiên và chất lượng tuyệt hảo.</p><p>Sấy cùng mật ong và ớt: Sự kết hợp hoàn hảo giữa vị ngọt thanh của mật ong, vị bùi béo của ngô và chút cay nồng của ớt tạo nên hương vị độc đáo, khó cưỡng.</p><p>Giòn tan từng hạt: Ngô sấy VietBorn được sấy khô bằng công nghệ hiện đại, giữ nguyên độ giòn tan và hương thơm đặc trưng</p>', 0, 4, 3, '2025-05-13 01:51:26', '2025-05-13 01:51:26'),
(32, 'Mật ong lên men tươi chai', 'products/DMG1aiIOKIPNsa67DhIyekOf4JIvjUvCRQGmOPS7.png', 'products/QH9tEqFQKBqCDgQ1pOdN7se7jiMNuK9VYwDSH9gx.png', 675000, 10, 0, '<p>Mật ong lên men tươi có nhiều tác dụng với sức khỏe:&nbsp;</p><p>- bổ sung hàng tỉ lợi khuẩn&nbsp;</p><p>- hỗ trợ&nbsp; tốt cho người đau dạ dày&nbsp;</p><p>- Hỗ trợ người mắc bệnh viêm thanh quản , hô hấp...</p>', 0, 4, 4, '2025-05-13 01:52:40', '2025-05-13 01:52:40'),
(33, 'Sữa chua uống dừa sáp lên men 120ml', 'products/0PEmbjigUtJeNgRbKY3XrTuPj675YbDYGKPIcf3O.jpg', 'products/jdkd8n7xwVLD2UoNdaa3zVllqrGEyHQNkNRGvWdR.jpg', 30000, 10, 0, '<p>Khám phá Sữa Chua Uống Dừa Sáp – sản phẩm tuyệt vời giúp bạn bổ sung năng lượng và dinh dưỡng mỗi ngày! Với công thức độc đáo, sữa chua này không chỉ thơm ngon mà còn mang lại nhiều lợi ích cho sức khỏe</p>', 0, 4, 1, '2025-05-13 01:53:39', '2025-05-13 01:53:39'),
(34, 'MẮM LÓC CHIÊN THỐ QUỐC TRUNG - HỦ 450G MẮM CHIÊN THỐ', 'products/7KoZzXnyko9dEjcLQ4i0tzPJuY7thzMpq801DUpK.png', 'products/jubqQgejI54VIYjYH56GUiaeLymkRQYYZgCtCmJ4.jpg', 300000, 10, 0, '<p>Mắm chiên</p>', 0, 4, 1, '2025-05-13 01:54:53', '2025-05-13 01:54:53'),
(35, 'Măng muối chua thanh hòa hộp 500g', 'products/nr3D6b0BjyVx62vmMmZS1NaOwRZa4WEEXvl3l7Wo.jpg', 'products/Q6TvxMeyyQy0b0PgvNy3rRkitY0EIvbLwky5dzRc.jpg', 40000, 10, 0, '<p>Măng chua Ngon</p>', 0, 4, 3, '2025-05-13 01:57:15', '2025-05-13 01:57:15'),
(36, 'TÔM THẺ CHÂN TRẮNG - 30 Con/kg', 'products/6OaJQZn7EneAImQE1PHMDkO2HjPzOHAPv5NPJAZa.png', 'products/AfmaVwUs80ADGrTeX2VIappOnhNx6twaejK8kvQ7.jpg', 300000, 10, 0, '<p>- Tôm thẻ chân trắng là một loại tôm có giá trị kinh tế cao và được đánh giá cao trong ngành công nghiệp thủy sản vì hương vị thơm ngon và chất lượng dinh dưỡng.</p><p>- Tôm thẻ lớn, với kích thước trung bình từ 30-35 con/kg, là sản phẩm biển tươi ngon và giàu dinh dưỡng. Thành phần chính của tôm thẻ bao gồm thịt tôm tươi ngon và chất bổ sung từ môi trường biển. Chúng có thể được chế biến thành nhiều món ngon như hấp, nướng, xào, hay làm nước lẩu, đem lại hương vị thơm ngon và dinh dưỡng cao cho các bữa ăn gia đình và tiệc tùng.</p><p>- Cách sử dụng: Rửa sạch và dùng dể chế biến các món ăn</p>', 0, 6, 1, '2025-05-13 01:59:53', '2025-05-13 01:59:53'),
(37, 'Cá Thu Một Nắng Côn Đảo', 'products/XemwxvIwTogpKFFHJlWWDyeRsKreVDqeT7nNdjYB.jpg', 'products/udeIww3xWFPtp1e1qRhY8CJXQr5moD5WFmIWS7yb.jpg', 350000, 10, 0, '<p>Cá thu một nắng Côn Đảo được lựa chọn từ những con cá Thu tươi, ngon đánh bắt ở Vùng ven biển Côn Đảo. Cá thu được lượt bỏ phần xương, xử lý thịt cá qua nước, muôi đúng tiêu chuân, sản phẩm được phơi nắng (khu phơi đảm bảo vệ sinh, màng che). Sản phẩm đạt kiểm định chất lượng (theo kết quả kiểm định chất lượng sản phẩm).</p><p>Cá thu một nắng có thể được chế biến thành nhiều món ăn ngon, từ nướng, chiên, xào, đến hấp, mỗi cách chế biến lại mang đến một hương vị riêng biệt. Khi nướng, cá thu một nắng thơm lừng, giòn rụm bên ngoài nhưng vẫn giữ được độ mềm, ngọt bên trong.</p>', 0, 6, 1, '2025-05-13 02:02:06', '2025-05-13 02:02:06'),
(38, 'OCOP - Chả cá Song Biển - 500gram', 'products/v3QRzx7BVPZGOBl3jB5a0ir3D6a42XFV5vjYXE3Z.jpg', 'products/pOygx0AwHCt7dTuNAmRCnqlHb7f34OzTplZegvbS.jpg', 90000, 10, 0, '<p>Tiền Hải là một huyện miền biển của tỉnh Thái Bình với nhiều bãi biển đẹp hoang sơ và rất giàu tài nguyên tôm cá. Bởi được thiên nhiên ưu ái nên sản lượng hải sản đánh bắt được ở nơi đây luôn vượt trội. Với nghề chài lưới truyền thống lâu đời, người dân Tiền Hải ngày ngày ra khơi đánh bắt về rất nhiều loại hải sản biển tươi ngon phục vụ đời sống nhân dân địa phương và phát triển thành nhiều sản phẩm chất lượng. Công ty TNHH Hải sản Ngọc Minh là đơn vị đi đầu trong sản xuất và chế biến hải sản tại địa phương đã lựa chọn cá song biển tươi ngon để tạo nên sản phẩm Đặc Sản Chả Cá Song Biển có chất lượng cao.</p><p>Những chiếc thuyền ra khơi trở về mang trong khoang thuyền rất nhiều loại cá biển cùng với loài tôm biển đặc biệt tươi ngon. Cá Song hay còn được biết với cái tên thân thuộc là Cá Mú. Đây là một loại cá biển xuất hiện nhiều ở khu vực Bắc Trung Bộ. Cá Song biển có thịt chắc, thơm ngon và béo nên rất được ưa chuộng. Mong muốn đưa sản phẩm tươi ngon nhất đến tay người dùng và bữa ăn thêm phần hấp dẫn, công ty TNHH Hải sản Ngọc Minh đã lựa chọn những con Cá Song biển tươi ngon nhất, cùng công thức riêng biệt tạo nên Đặc Sản Chả Cá Song Biển vô cùng thơm ngon. Từ khâu lựa chọn nguyên liệu đến quy trình sơ chế và chế biến đều được công ty TNHH Hải sản Ngọc Minh kiểm soát rất nghiêm ngặt, đảm bảo vệ sinh an toàn thực phẩm. Cá Song biển tươi được sơ chế làm sạch, lọc lấy phần thịt cá rồi xay nhuyễn cùng mắm cốt, tỏi, tiêu, rau thơm rồi chiên sơ tạp nên miếng chả cá dẻo dai, giòn ngọt và thơm lừng mê hoặc. Đặc Sản Chả Cá Song Biển được chia thành những miếng nhỏ, đóng khay đảm bảo vệ sinh và rất tiện dụng. Miếng chả cá của công ty TNHH Hải sản Ngọc Minh có điểm đặc biệt là hoàn toàn từ Cá Song biển tươi tự nhiên nên có vị ngọt đậm, thơm lừng và đặc biệt không chứa bột hay phụ gia nên giữ vẹn nguyên được hương vị tươi ngon của biển cả. Đặc Sản Chả Cá Song Biển là món ăn hấp dẫn mọi lứa tuổi và cung cấp nguồn dinh dưỡng dồi dào. Sản phẩm có thể chế biến thành các món ăn như chả cá chiên, chả cá rim, bánh mỳ chả cá phù hợp cho mọi bữa cơm gia đình hay các bữa tiệc.</p><p>Các sản phẩm hải sản mang thương hiệu Ngọc Minh với vị ngọt đậm đà và hương thơm đặc trưng của biển cả đã hấp dẫn rất nhiều thực khách. Sản phẩm Đặc Sản Chả Cá Song Biển đã được bán tại hệ thống cửa hàng của công ty TNHH Hải sản Ngọc Minh tại thôn Quang Thịnh, xã Nam Thịnh, huyện Tiền Hải, tỉnh Thái Bình, và một số tỉnh lân cận như Hà Nội, Hải Dương, Hà Nam, Thái Nguyên. Đây không chỉ là một loại thực phẩm tươi ngon cho gia đình mà còn là món quà chân tình và giàu dinh dưỡng mà người dân Tiền Hải muốn dành tặng cho bạn bè bốn phương. Hãy để các sản phẩm hải sản mang thương hiệu Ngọc Minh tăng thêm hương vị và dinh dưỡng cho bữa ăn gia đình bạn./.</p>', 0, 6, 1, '2025-05-13 02:03:51', '2025-05-13 02:03:51'),
(39, 'OCOP - TÔM NÕN TIỀN CHÂU - 1 HỘP 500gram', 'products/AVM1tX6qwQignNGVDjexDOXGF5uW6QNneIYElFvF.jpg', 'products/VL4EConNzikDFVby0rpKvU11NKFJKVAoSKtHwg60.jpg#products/t84WZKjii8CIgDdnFfJgt1wsLelahRgIFFemqH9T.jpg', 120000, 10, 0, '<p>Tiền Hải là một huyện miền biển của tỉnh Thái Bình với nhiều bãi biển đẹp hoang sơ và rất giàu tài nguyên tôm cá. Bởi được thiên nhiên ưu ái nên sản lượng hải sản đánh bắt được ở nơi đây luôn vượt trội. Với nghề chài lưới truyền thống lâu đời, người dân Tiền Hải ngày ngày ra khơi đánh bắt về rất nhiều loại hải sản biển tươi ngon phục vụ đời sống nhân dân địa phương và phát triển thành nhiều sản phẩm chất lượng. Đặc biệt trong đó có loài tôm biển thơm ngon được Công ty TNHH sản xuất và chế biển thủy hải sản số 6, chế biến thành sản phẩm Tôm nõn Tiền Châu có chất lượng và giá trị cao.</p>', 0, 6, 4, '2025-05-13 19:14:47', '2025-05-13 19:14:47'),
(40, 'OCOP - Chả tôm Biển - 500gram', 'products/b2dgk3bG3f9VKothtiREoop466hbqeqjH6oRf4rP.jpg', 'products/4N7OkDXJFhIN1p8czEgyTBMft58NS4oU0JygUvak.jpg#products/op0SoHjsJt2EjxIwJIOT6YFvrTVzaE5ZrCNlubY4.jpg', 110000, 10, 0, '<p>Tiền Hải là một huyện miền biển của tỉnh Thái Bình với nhiều bãi biển đẹp hoang sơ và rất giàu tài nguyên tôm cá. Bởi được thiên nhiên ưu ái nên sản lượng hải sản đánh bắt được ở nơi đây luôn vượt trội. Với nghề chài lưới truyền thống lâu đời, người dân Tiền Hải ngày ngày ra khơi đánh bắt về rất nhiều loại hải sản biển tươi ngon phục vụ đời sống nhân dân địa phương và phát triển thành nhiều sản phẩm chất lượng. Công ty TNHH Hải sản Ngọc Minh là đơn vị đi đầu trong sản xuất và chế biến hải sản tại địa phương đã lựa chọn tôm biển tươi ngon để tạo nên sản phẩm Đặc Sản Chả Tôm Biển có chất lượng và giá trị cao.</p><p>Những chiếc thuyền ra khơi trở về mang trong khoang thuyền rất nhiều loại cá biển cùng với loài tôm biển đặc biệt tươi ngon. Tôm tự nhiên được đánh bắt ở vùng biển Thái Bình, đặc biệt là ở huyện Tiền Hải có điểm đặc biệt là thịt tôm săn chắc, vỏ mỏng và hương vị đậm đà. Mong muốn đưa sản phẩm tươi ngon nhất đến tay người dùng và bữa ăn thêm phần hấp dẫn, công ty TNHH Hải sản Ngọc Minh đã lựa chọn những con tôm biển tươi ngon nhất, cùng công thức riêng biệt tạo nên Đặc Sản Chả Tôm Biển vô cùng hấp dẫn. Từ khâu lựa chọn nguyên liệu đến quy trình sơ chế và chế biến đều được công ty TNHH Hải sản Ngọc Minh kiểm soát rất nghiêm ngặt, đảm bảo vệ sinh an toàn thực phẩm. Tôm biển tươi tự nhiên được làm sạch, xay nhuyễn cùng thịt lợn tươi và các loại gia vị rồi chiên sơ tạo nên miếng chả tôm vàng óng hấp dẫn. Đặc Sản Chả Tôm Biển được chia thành những miếng nhỏ, đóng khay đảm bảo vệ sinh và rất tiện dụng. Miếng chả tôm của công ty TNHH Hải sản Ngọc Minh có điểm đặc biệt là hoàn toàn từ tôm biển tươi tự nhiên nên có vị ngọt đậm, thơm lừng và đặc biệt không chứa bột hay phụ gia nên giữ vẹn nguyên được hương vị tươi ngon của biển cả. Đặc Sản Chả Tôm Biển là món ăn hấp dẫn mọi lứa tuổi và cung cấp nguồn dinh dưỡng dồi dào. Sản phẩm có thể chế biến thành các món ăn như chả tôm chiên, chả tôm rim cà chua phù hợp cho mọi bữa cơm gia đình hay các bữa tiệc.</p><p>Các sản phẩm hải sản mang thương hiệu Ngọc Minh với vị ngọt đậm đà và hương thơm đặc trưng của biển cả đã hấp dẫn rất nhiều thực khách. Sản phẩm Đặc Sản Chả Tôm Biển đã được bán tại hệ thống cửa hàng của công ty TNHH Hải sản Ngọc Minh tại thôn Quang Thịnh, xã Nam Thịnh, huyện Tiền Hải, tỉnh Thái Bình, và một số tỉnh lân cận như Hà Nội, Hải Dương, Hà Nam, Thái Nguyên. Đây không chỉ là một loại thực phẩm tươi ngon cho gia đình mà còn là món quà chân tình và giàu dinh dưỡng mà người dân Tiền Hải muốn dành tặng cho bạn bè bốn phương. Hãy để các sản phẩm hải sản mang thương hiệu Ngọc Minh tăng thêm hương vị và dinh dưỡng cho bữa ăn gia đình bạn./..</p>', 0, 6, 3, '2025-05-13 19:16:13', '2025-05-13 19:16:13'),
(41, 'Cá Cơm Mờm Rim (70g/hủ)', 'products/p59Y9D9Yotyg5CahdWWFuLjMfY8KluEwhUrfyFGl.jpg', 'products/dCBjZObSex8KTwEpduUWRWv3ThcAk2PsC9VuKrl5.jpg#products/gW0YepLzuPZp2Q3r7dMMhz0PPAXnJMtgxj7P037b.jpg', 40000, 10, 0, '<p>Cá cơm mờm được mọi người biết đến là loài cá có nhiều chất dinh dưỡng nhất trong dòng cá cơm , Loại cá này chứa rất nhiều loại vitamin và khoáng chất rất tốt, đặc biệt là Vitamin E, Omega 3..... trong chế độ ăn bình thường thiếu đi những vitamin tốt cho móng và tóc như: vitamin H (hay còn gọi là<a href=\"https://hellobacsi.com/thuoc/biotin/\"> biotin</a>), vitamin B complex, vitamin E, A…&nbsp; cá cơm là nguồn cung dồi dào chất đạm, vitamin và khoáng chất thiết yếu nhằm duy trì sức khỏe tổng thể. Một vài thành phần nổi bật có thể kể đến như: các vitamin nhóm B (<a href=\"https://hellobacsi.com/thuoc/thiamin/\">thiamin</a>,<a href=\"https://hellobacsi.com/thuoc/vitamin-b2-riboflavin/\"> riboflavin</a>,<a href=\"https://hellobacsi.com/thuoc/niacin-lovastatin/\"> niacin</a>, folate…), canxi, sắt, magie, phospho, kẽm… Đặc biệt hơn loại cá này còn rất giàu<a href=\"https://hellobacsi.com/thuoc/axit-beo-omega-3/\"> axit béo omega-3</a>, cùng những loại cholesterol tốt cho cơ thể. Cá cơm là một thực phẩm sở hữu hàm lượng cao chất béo không bão hòa.</p>', 0, 6, 3, '2025-05-13 19:17:59', '2025-05-13 19:17:59'),
(42, 'OCOP - Cá nhệch kho tộ - 500gram', 'products/nSI5IMlQBwqg49DmHLvudtVcuvYY0m0PUsWfAcWu.jpg', 'products/QbPIVmEb6oGUb5A0liIfyHEBIbh0Jq1fkQvMaXM0.jpg', 150000, 10, 0, '<p>Cá kho là món ăn truyền thống từ rất lâu đời của người Việt Nam. Món ăn này thường xuyên xuất hiện trong những bữa cơm gia đình hằng ngày, đặc biệt là vào tiết trời mùa đông se lạnh. Nếu ai đã một lần thưởng thức món cá nhệch kho tộ thì chắc chắn không thể quên được hương vị của món ăn làm say đắm lòng người này.</p><p>Người Việt Nam có truyền thống ăn cá kho từ rất lâu đời. Trong bữa cơm gia đình, chúng ta đã khá quen thuộc với các món cá kho tộ như cá bống, cá chép, cá basa hay cá rô… nhưng Cá nhệch kho tộ thì bạn đã được thưởng thức chưa? Cá nhệch kho tộ trong các nhà hàng được chế biến như thế nào mà khiến cho thực khách khó tính nhất cũng phải gật gù khen ngon?</p><p>Món kho tộ xuất phát từ gian bếp của người dân nam bộ, tuy nhiên món ăn này được sử dụng phổ biến ở cả 3 miền Bắc Trung Nam, trở thành món ăn vô cùng gần gũi và dung dị. Tộ ở đây là cái tôt đất hoặc nồi đất dùng để kho cá. Cá được kho trong tộ đất mới ngon, chắc thịt và mang hương vị rất riêng của món cá kho.</p><p>Cá nhệch có thể chế biến được nhiều món ngon như: gỏi nhệch, nhệch om chuối đậu,…Nhưng cứ mỗi khi đến mùa đông thì món nhệch kho khô niêu đất được yêu thích nhất. Đây cũng là mùa mà nhệch cho năng suất đánh bắt cá, nhệch vào mùa, thơm ngon và béo hơn so với thời gian còn lại trong năm.</p><p>Để có niêu cá nhệch kho khô đạt tiêu chuẩn, thì khâu chuẩn bị nguyên liệu cũng cần được chú ý hơn. Cá nhệch kho thường là những con to bằng 2 ngón tay, có cân nặng tầm 600 – 700gr/ con và còn sống. Theo kinh nghiệm của ông cha ta để lại, nhệch lúc này đủ lớn để cho nhiều thịt, thịt nhệch cũng giai và chắc hơn so với loại cá còn nhỏ. Nếu chọn loại to quá thì thịt cá sẽ không được ngọt và thơm.</p><p>Các nguyên liệu dùng để kho chung với nhệch cũng có phần khác biệt so với các món cá kho tộ truyền thống. Nguyên liệu đi kèm gồm: riềng, sả, hành tím, ớt, rau răm, mùi tàu. Gia vị gồm: muối, tiêu, đường, nước mắt cốt, … Phải đầy đủ nguyên liệu thì hương vị cá kho mới được trọn vẹn.</p>', 0, 6, 4, '2025-05-13 19:19:17', '2025-05-13 19:19:17'),
(43, 'OCOP - Tôm nõn Mai Hường - Túi 1kg', 'products/7HSqTyNnqzLewZA9MnvGoVLAY5LYUq2K1yIvurHQ.jpg', 'products/tL2uqynmA8GaNzXD81Z0P4yBcyfBZrL4zEu00iJf.jpg', 600000, 10, 0, '<p>Tên sản phẩm: Tôm nõn Mai Hường</p><p>- Tên cơ sở sản xuất: Hộ kinh doanh Triệu Tuyết Mai</p><p>- Địa chỉ sản xuất: xã Ngư Lộc, huyện Hậu Lộc.</p><p>- Chủ cơ sở: Triệu Tuyết Mai</p><p>- Mô tả sản phẩm: là sản phẩm OCOP.</p><p>- Giá: 600.000 đồng - 1.500.000 đồng/tùy size.</p>', 0, 6, 3, '2025-05-13 19:24:59', '2025-05-13 19:24:59'),
(44, 'OCOP - Cá thu nướng Quân Thủy - Túi 1kg', 'products/htrmi3D0RuSM7bOYEY3yXo9MVCjcc3J5JSMdINl4.jpg', 'products/2aIocqPLSBea1nrTnz4PUyKVlSZsMTHNvYFBODm4.jpg', 320000, 10, 0, '<p>- Mô tả sản phẩm: Cá thu là một trong những loại cá biển có thịt thơm ngon, nhiều giá trị dinh dưỡng như chất béo, chất đạm. Hàm lượng dinh dưỡng trong thịt cá thu cao,&nbsp; chứa những&nbsp;vitamin&nbsp;và khoáng chất hàng đầu mà cơ thể cần thiết như acid béo omega-3 và lượng protein cao, cùng các loại khoáng chất như vitamin A, D,&nbsp;magie, kẽm, phốt pho, canxi,... giàu&nbsp;dinh dưỡng và năng lượng. Sử dụng thịt cá thu có tác dụng ngăn ngừa bệnh tim mạch, phát triển não bộ, tăng cường hệ miễn dịch, ngăn ngừa ung thư, tiểu đường, làm giảm tình trạng lão hóa, cải thiện các vấn đề về da... Tiêu thụ các sản phẩm từ cá sẽ mang đến một cơ thể khỏe mạnh, dẻo dai hơn, kéo dài tuổi thọ. Cá thu tươi được nướng thủ công trên bếp bằng than hoa nên vẫn giữ nguyên được hương vị thơm ngon, đảm bảo chất dinh dưỡng của cá. Miếng cá đạt tiêu chuẩn là miếng có màu hơi vàng, không cháy, không bị chảy mỡ và đặc biệt phải có mùi thơm đặc trưng của món cá nướng. Sản phẩm không sử dụng hóa chất, chất bảo quản nên rất an toàn cho người sử dụng. Dùng để chế biên các món hấp, nướng, sốt hoặc chế biến các món ăn theo nhu cầu. Bảo quản ở ngăn mát hạn sử dụng là 15 ngày, bảo quản ở ngăn đá hạn sử dụng là 90 ngày kể từ ngày kể từ ngày đóng gói. Là sản phẩm OCOP.</p>', 0, 6, 3, '2025-05-13 19:26:42', '2025-05-13 19:26:42'),
(45, 'Cá Mòi Kho Làng Chài - Xách 3 Lon (600g)', 'products/tJpSrUrQVt0Dh8EUiK22zsXfbkkWXwOBOoxx3Yn7.jpg', 'products/090Cc4xmjVKcMQ2t9IXHM8PgDTcS7jLUh6hMetLJ.jpg', 150000, 10, 0, '<p>Mô tả sản phẩm: Cá mòi đánh bắt cửa sông, mang kho thủ công cùng các loại gia vị hoàn toàn tự nhiên sau đó đóng vào hộp thanh trùng, cá hoàn toàn nhừ xương nhưng thịt cá vẫn săn chắc, cá và gia vị hòa quyện, thơm ngon, béo ngậy và giàu dinh dưỡng. Sản phẩm được bình chọn vào Top 100 đặc sản làm quà Việt Nam.</p><p>Thành phần chính: Cá mòi, riềng, chuối xanh, gừng, chay, mía, hạt tiêu…và các gia vị nêm.</p>', 0, 6, 3, '2025-05-13 19:33:04', '2025-05-13 19:33:04'),
(46, 'Đĩa khu đền tháp Mỹ Sơn', 'products/LNhODyG3PjWsLZT1gEsAej9DwMgfuNg7RTXD0aza.jpg', 'products/h1EKZwMj4vW9j1TZ3A9IVNKdHRQEB2KDeUdVUy1E.jpg#products/VPpvA6pd3kCJnJbHBX24TCwYd4jibzmXn64IiR0u.jpg', 500000, 5, 0, '<p>\" Đĩa khu đền tháp Mỹ Sơn\" là sản phẩm dùng trong việc trang trí phòng khách, để bàn làm việc, sản phẩm nhỏ gọn có bao gói, mà còn rất tiện lợi cho khách du lịch tham quan mua sắm làm quà tặng cho người thân, quảng bá về di sản văn hóa thế giới tại địa phương Duy Xuyên, Quảng Nam.</p>', 0, 7, 4, '2025-05-13 19:38:20', '2025-05-13 19:38:20'),
(47, 'Đá cảnh nghệ Thuật - đá thạch anh vàng', 'products/LxG9axWr5c05FVDh2Hh40h9YCNigfJk095Stmh6V.jpg', 'products/Jokqgtgl2PgrJ4ZPGoTDoEmOhMz0BVCZX7TnBfYD.jpg', 800000, 10, 0, '<p><i>là một loại đá quý không chỉ sở hữu vẻ đẹp lấp lánh say lòng người.&nbsp;Mà còn là loại đá&nbsp;ẩn chứa trong mình một nguồn năng lượng kỳ diệu mang đến nhiều tác dụng trong đời sống.</i>&nbsp;Chính bởi vậy mà đá thạch anh vàng rất được giới kinh doanh ưa chuộng sử dụng.&nbsp;Trong quá trình làm việc, bạn cũng có thể đặt một viên đá thạch anh vàng lên bàn làm việc. Năng lượng từ đá tỏa ra sẽ giúp tăng cường sự tập trung, khả năng sáng tạo để hoàn thành tốt công việc.</p>', 0, 7, 1, '2025-05-13 19:41:03', '2025-05-13 19:41:03'),
(48, 'NÓN LÁ ĐƯỜNG KÍNH 40CM', 'products/5CDZXVySDMs0HD3ANUnc8MUS3okTTqhjvLGsjXIJ.jpg', 'products/3DDsAeyUbQMxkz2ki1WdiEPZqzY7gDdby5rKKv1M.jpg', 45000, 10, 0, '<p>Nón lá là một đặc trưng văn hóa, có ý nghĩa rất sâu sắc và đặc biệt đối với người Việt Nam, là biểu tượng gắn với nông nghiệp, nông thôn và nghề làm ruộng, chiếc nón lá che mưa che nắng, phản ánh cuộc sống, hình ảnh lao động một nắng hai sương, chịu thương chịu khó của người dân Việt Nam.</p>', 0, 7, 4, '2025-05-13 19:46:32', '2025-05-13 19:46:32'),
(49, 'RỔ MÂY TRE', 'products/Z2E4RIUrFShHnyWKKeKfLNqT9njnHUj98PmgixWZ.jpg', 'products/SgB2BPjUBqHCpYyGn5lHqJ1OT8GVR69R09YSblp2.jpg', 200000, 10, 0, '<p>rổ mây tre quảng nam</p>', 0, 7, 4, '2025-05-13 19:48:06', '2025-05-13 19:48:06'),
(50, 'Trầm Hương', 'products/oAS8yRYkFvHWgDzeSJAEaX5oIrwTkEHGmfhvgDbP.jpg', 'products/WpPKQNBXaAmABZ9JBVmEAU2KPOqVr9CHu4GRVv3Y.jpg', 500000, 10, 0, '<p>Được Làm Từ Trầm Cao Cấp, sản phẩm nhiều mẫu mã cho quý khach hàng lựa chọn</p>', 0, 7, 4, '2025-05-13 19:56:19', '2025-05-13 19:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `star` int(11) NOT NULL DEFAULT 5,
  `content` varchar(500) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `star`, `content`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 5, 'b', 1, 4, '2025-04-21 02:25:56', '2025-05-09 13:06:38'),
(2, 2, 'ok', 2, 4, '2025-05-07 21:53:47', '2025-05-07 21:53:47'),
(3, 4, 'chất lượng tốt', 17, 4, '2025-05-13 20:21:38', '2025-05-13 20:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `role` enum('admin','manager','customer') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `phone`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Quản Trị Viên', 'admin@gmail.com', 'admin', '0555666888', 'admin', '$2a$10$T9MIgFOA7qJYjsI7ndVjYOu1ypqM2zbAtgCJDAUJ4Bfqu5nylTG9q', '2025-04-20 12:48:47', '2025-04-20 12:48:47'),
(2, 'Lại Văn Nam', 'laivannam@gmail.com', 'laivannam', '0123456789', 'manager', '$2y$10$am1jWJXmDa9HjqKKbbha3.ev/ItK9m/QBCNFIg7sSNQOOrvp../XO', '2025-04-20 10:53:04', '2025-05-11 20:25:54'),
(3, 'Nguyễn Văn An', 'nguyenvana@gmail.com', 'nguyenvana', '0123456798', 'manager', '$2y$10$pxwr8Hcuy59X68r26q7ZQejzQlyCJTKycQ7RgE3i0K69EaxEO0r3O', '2025-04-20 10:57:39', '2025-05-11 20:26:10'),
(4, 'Nguyễn Thị Bình Long Bình', 'nguyenthiblbl@gmail.com', 'nguyenthiblbl', '0999699699', 'customer', '$2a$10$uq5EZYfBiZN5kxjLRtuNbuP8XZBaZ4PWQfvjtPiYA.GCz/6hGlVzu', '2025-04-20 18:06:31', '2025-04-20 18:06:31'),
(5, 'Nguyễn Tấn Phát', 'nguyentanphat@gmail.com', 'nguyentanphat', '0389532626', 'manager', '$2y$10$T6TvJwxNr0ajRXGsKg/EXOnCJ6cS0ULe6xHXNvcK/qt32mQHPB2YK', '2025-05-08 10:32:27', '2025-05-11 20:26:20'),
(6, 'Nguyễn Nhật Quang', 'nguyennhatquang@gmail.com', 'nguyennhatquang', '0123456879', 'customer', '$2y$10$iEhynus4M5wHSkj/ejySBO9Ksd0phAvCYiqmgNykKk0qs795OeR6K', '2025-05-16 18:00:40', '2025-05-16 18:00:40'),
(7, 'Ngô Gia Bảo', 'ngogiabao@gmail.com', 'ngogiabao', '0123456897', 'customer', '$2y$10$W8FAEYYElzD1DrG.xu5wxuYOKhZeRWHRveFv.62D6vNeGYermsc/a', '2025-05-16 18:03:42', '2025-05-16 18:03:42'),
(8, 'Thái Ngọc Quý', 'thaingocquy@gmail.com', 'thaingocquy', '0123456978', 'customer', '$2y$10$rjRxKnUrkmco.KjBBJqEteHx.tBrDR7kSFGKgaWdUNC6I5UeMxQXy', '2025-05-16 18:04:41', '2025-05-16 18:04:41'),
(9, 'Nguyễn Văn Thanh', 'nguyenvanthanh@gmail.com', 'nguyenvanthanh', '0123456987', 'customer', '$2y$10$ScFBR0XJGDqEzmWsIMHNm.lUo61QQQZBpfHICI3g2.7k.d.LRnMUy', '2025-05-16 18:07:29', '2025-05-16 18:07:29'),
(10, 'Nguyễn Văn Bảo', 'nguyenvanbao@gmail.com', 'nguyenvanbao', '0123457689', 'customer', '$2y$10$aKJ1xYvRr9kuUaMyhQIMZOqc3kV718pHAveptOnP38NVL4gorJt/O', '2025-05-16 18:11:12', '2025-05-16 18:11:12'),
(11, 'Lê Việt Hoàng', 'leviethoang@gmail.com', 'leviethoang', '0123457698', 'customer', '$2y$10$BHDV2hl7rVL/fus2xL3Qeuzv7pfZ3Fbe/sDrq19u2Hb5Z.miRBvyC', '2025-05-16 18:12:14', '2025-05-16 18:12:14'),
(12, 'Phạm Quốc Trường', 'phamquoctruong@gmail.com', 'phamquoctruong', '0123457869', 'customer', '$2y$10$C1zFUd7xpRQsUXxrLqm2uemRUenStLYtIiWhXp/fpwdQMP65BeQdi', '2025-05-16 18:14:24', '2025-05-16 18:14:24'),
(13, 'Võ Thị Như', 'vothinhu@gmail.com', 'vothinhu', '0123457896', 'customer', '$2y$10$RfkjO42Cd12DZpa2kLp9h.n/emBE371B7UliRDutR3blA1WNParZS', '2025-05-16 18:16:03', '2025-05-16 18:16:03'),
(14, 'Phan Nguyên Vũ', 'phannguyenvu@gmail.com', 'phannguyenvu', '0123457968', 'customer', '$2y$10$vHvdc0WgJU5SouEc1Z/9hO1BEZNx9CrQ8bfuRucAvelTMcPpsYpqC', '2025-05-16 18:18:17', '2025-05-16 18:18:17'),
(15, 'Nguyễn Thị Phượng', 'nguyenthiphuong@gmail.com', 'nguyenthiphuong', '0818083678', 'manager', '$2y$10$WtyPAcFR5qQ6AwOm7duND.z8fSsnZAn0puIr/cN8ZZ4tlRhj99WlK', '2025-05-16 18:30:42', '2025-05-16 18:30:42'),
(16, 'Trịnh Hoàng Anh', 'trinhhoanganh@gmail.com', 'trinhhoanganh', '0123456788', 'manager', '$2y$10$Z.U6R5MnxhTEz2KSU.GkTO7gjkBDX39fmm8R/qeDUIynjNMprhFlq', '2025-05-16 18:33:51', '2025-05-16 18:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `view_histories`
--

CREATE TABLE `view_histories` (
  `id` int(11) NOT NULL,
  `user` varchar(500) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `view_histories`
--

INSERT INTO `view_histories` (`id`, `user`, `product_id`, `created_at`, `updated_at`) VALUES
(3, '13', 71, '2025-05-17 01:55:04', '2025-05-17 01:55:04'),
(4, '13', 60, '2025-05-17 01:55:52', '2025-05-17 01:55:52'),
(5, '7', 7, '2025-05-17 23:29:07', '2025-05-17 23:29:07'),
(6, '7', 4, '2025-05-17 23:29:20', '2025-05-17 23:29:20'),
(7, '7', 6, '2025-05-17 23:29:26', '2025-05-17 23:29:26'),
(8, '6', 14, '2025-05-17 23:32:25', '2025-05-17 23:32:25'),
(9, '6', 1, '2025-05-17 23:33:00', '2025-05-17 23:33:00'),
(10, '6', 71, '2025-05-17 23:33:15', '2025-05-17 23:33:15'),
(11, '14', 46, '2025-05-17 23:35:06', '2025-05-17 23:35:06'),
(12, '14', 47, '2025-05-17 23:35:13', '2025-05-17 23:35:13'),
(13, '14', 70, '2025-05-17 23:35:19', '2025-05-17 23:35:19'),
(14, '14', 50, '2025-05-17 23:35:23', '2025-05-17 23:35:23'),
(15, '12', 56, '2025-05-17 23:36:38', '2025-05-17 23:36:38'),
(16, '12', 58, '2025-05-17 23:36:40', '2025-05-17 23:36:40'),
(17, '12', 59, '2025-05-17 23:36:42', '2025-05-17 23:36:42'),
(18, '12', 57, '2025-05-17 23:36:45', '2025-05-17 23:36:45'),
(19, '11', 36, '2025-05-17 23:39:04', '2025-05-17 23:39:04'),
(20, '11', 39, '2025-05-17 23:39:08', '2025-05-17 23:39:08'),
(21, '11', 72, '2025-05-17 23:39:15', '2025-05-17 23:39:15'),
(22, '11', 43, '2025-05-17 23:39:21', '2025-05-17 23:39:21'),
(23, '10', 27, '2025-05-17 23:40:19', '2025-05-17 23:40:19'),
(24, '10', 28, '2025-05-17 23:40:26', '2025-05-17 23:40:26'),
(25, '9', 16, '2025-05-17 23:44:28', '2025-05-17 23:44:28'),
(26, '9', 17, '2025-05-17 23:44:31', '2025-05-17 23:44:31'),
(27, '9', 24, '2025-05-17 23:44:33', '2025-05-17 23:44:33'),
(28, '9', 19, '2025-05-17 23:44:39', '2025-05-17 23:44:39'),
(29, '8', 66, '2025-05-17 23:45:31', '2025-05-17 23:45:31'),
(30, '8', 26, '2025-05-17 23:45:35', '2025-05-17 23:45:35'),
(31, '8', 64, '2025-05-17 23:45:41', '2025-05-17 23:45:41'),
(32, '7', 3, '2025-05-20 07:21:41', '2025-05-20 07:21:41'),
(33, '7', 3, '2025-05-20 07:22:35', '2025-05-20 07:22:35'),
(34, '7', 3, '2025-05-20 07:23:02', '2025-05-20 07:23:02'),
(35, '7', 3, '2025-05-20 07:36:06', '2025-05-20 07:36:06'),
(36, '7', 3, '2025-05-20 07:37:07', '2025-05-20 07:37:07'),
(37, '7', 3, '2025-05-20 07:38:06', '2025-05-20 07:38:06'),
(38, '7', 33, '2025-05-21 04:25:49', '2025-05-21 04:25:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`,`brand_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`discount_id`,`branch_id`),
  ADD KEY `discount_id` (`discount_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `view_histories`
--
ALTER TABLE `view_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_orders`
--
ALTER TABLE `item_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `view_histories`
--
ALTER TABLE `view_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `inventories_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD CONSTRAINT `item_orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_orders_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `view_histories`
--
ALTER TABLE `view_histories`
  ADD CONSTRAINT `view_histories_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
