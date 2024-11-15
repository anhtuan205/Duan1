<?php
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucControllers.php';
require_once './controllers/AdminSanPhamControllers.php';
require_once './controllers/AdminDonHangControllers.php';

// Require toàn bộ file Models
require_once './models/AdminSanPham.php';
require_once './models/AdminDanhMuc.php';
require_once './models/AdminDonHang.php';


// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
  // Trang chủ
  'danh-muc' => (new AdminDanhMucControllers())->danhsachDanhMuc(),
  'form-them-danh-muc' => (new AdminDanhMucControllers())->formAddDanhMuc(),
  'them-danh-muc' => (new AdminDanhMucControllers())->postAddDanhMuc(),
  'form-sua-danh-muc' => (new AdminDanhMucControllers())->formEditDanhMuc(),
  'sua-danh-muc' => (new AdminDanhMucControllers())->postEditDanhMuc(),
  'xoa-danh-muc' => (new AdminDanhMucControllers())->deleteDanhMuc(),

  // sản phẩm
  'san-pham' => (new AdminSanPhamControllers())->danhsachSanPham(),
  'form-them-san-pham' => (new AdminSanPhamControllers())->formAddSanPham(),
  'them-san-pham' => (new AdminSanPhamControllers())->postAddSanPham(),
  'form-sua-san-pham' => (new AdminSanPhamControllers())->formEditSanPham(), // Thêm trường hợp này
  'sua-san-pham' => (new AdminSanPhamControllers())->postEditSanPham(),
  'sua-album-anh-san-pham' => (new AdminSanPhamControllers())->postEditAnhSanPham(),
  'xoa-san-pham' => (new AdminSanPhamControllers())->deleteSanPham(),
  'chi-tiet-san-pham' => (new AdminSanPhamControllers())->detailSanPham(),
  // dơn hang
  'don-hang' => (new AdminDonHangControllers())->danhsachDonHang(),
  'form-sua-don-hang' => (new AdminDonHangControllers())->formEditDonHang(), // Thêm trường hợp này
  'sua-don-hang' => (new AdminDonHangControllers())->postEditDonHang(),
  'chi-tiet-don-hang' => (new AdminDonHangControllers())->detailDonHang(),
};
