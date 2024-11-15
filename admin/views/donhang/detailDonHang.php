<?php
// Assume necessary includes and initializations
require './views/layout/header.php';
include './views/layout/navbar.php';
include './views/layout/sidebar.php';

// Example data for the order (replace with actual data retrieval)
$donHang = [
    'trang_thai_id' => 1,
    'ten_trang_thai' => 'Đang xử lý',
    'ho_ten' => 'Nguyễn Văn A',
    'email' => 'nguyenvana@example.com',
    'so_dien_thoai' => '0123456789',
    'ten_nguoi_nhan' => 'Trần Thị B',
    'sdt_nguoi_nhan' => '0987654321',
    'dia_chi_nguoi_nhan' => '123 Đường ABC',
    'ma_don_hang' => 'DH123456',
    'tong_tien' => 0, // This will be calculated
    'ghi_chu' => 'Ghi chú đơn hàng',
    'ten_phuong_thuc' => 'Chuyển khoản',
    'ngay_dat' => '2024-11-15'
];

$sanPhamDonHang = [
    ['ten_san_pham' => 'Đồng hồ A', 'don_gia' => 500000, 'so_luong' => 2, 'thanh_tien' => 1000000],
    ['ten_san_pham' => 'Đồng hồ B', 'don_gia' => 300000, 'so_luong' => 1, 'thanh_tien' => 300000],
];

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản Lý Đơn Hàng</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <?php
                        if ($donHang['trang_thai_id'] == 1) {
                            $colorAlerts = 'primary';
                        } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                            $colorAlerts = 'warning';
                        } elseif ($donHang['trang_thai_id'] == 10) {
                            $colorAlerts = 'success';
                        } else {
                            $colorAlerts = 'danger';
                        }
                        ?>
                        <div class="alert alert-<?= $colorAlerts; ?>" role="alert">
                            Đơn hàng: <?= $donHang['ten_trang_thai'] ?>
                        </div>
                    </div>

                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-cat"></i> Shop đồng hồ
                                    <small class="float-right">Ngày đặt: <?= $donHang['ngay_dat']; ?></small>
                                </h4>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Thông tin người đặt
                                <address>
                                    <strong><?= $donHang['ho_ten']; ?></strong><br>
                                    Email: <?= $donHang['email']; ?><br>
                                    Số điện thoại: <?= $donHang['so_dien_thoai']; ?>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Người nhận
                                <address>
                                    <strong><?= $donHang['ten_nguoi_nhan']; ?></strong><br>
                                    Email người nhận: <?= $donHang['email']; ?><br>
                                    Số điện thoại người nhận: <?= $donHang['sdt_nguoi_nhan']; ?><br>
                                    Địa chỉ người nhận: <?= $donHang['dia_chi_nguoi_nhan']; ?><br>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Thông tin đơn hàng
                                <address>
                                    <strong>Mã đơn hàng: <?= $donHang['ma_don_hang']; ?></strong><br>
                                    Tổng tiền: <?= $donHang['tong_tien']; ?><br>
                                    Ghi chú: <?= $donHang['ghi_chu'] ?><br>
                                    Thanh toán: <?= $donHang['ten_phuong_thuc']; ?><br>
                                </address>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tong_tien = 0; ?>
                                        <?php foreach ($sanPhamDonHang as $key => $sanPham): ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $sanPham['ten_san_pham'] ?></td>
                                                <td><?= number_format($sanPham['don_gia'], 0, ',', '.') ?> VNĐ</td>
                                                <td><?= $sanPham['so_luong'] ?></td>
                                                <td><?= number_format($sanPham['thanh_tien'], 0, ',', '.') ?> VNĐ</td>
                                            </tr>
                                            <?php $tong_tien += $sanPham['thanh_tien']; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Ngày đặt hàng: <?= $donHang['ngay_dat'] ?></p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Thành tiền:</th>
                                            <td><?= number_format($tong_tien, 0, ',', '.') ?> VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>Vận chuyển:</th>
                                            <td>200.000 VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng tiền:</th>
                                            <td><?= number_format($tong_tien + 200000, 0, ',', '.') ?> VNĐ</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>