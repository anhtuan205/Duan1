<!-- header -->
<?php require './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1>Sửa Thông Tin Sản Phẩm: <?= $sanPham['ten_san_pham'] ?></h1>
                </div>
                <div class="col-sm-1">
                    <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông Tin Sản Phẩm</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <form action="<?= BASE_URL_ADMIN . '?act=sua-san-pham' ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                <label for="ten_san_pham">Tên sản phẩm</label>
                                <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control" value="<?= $sanPham['ten_san_pham'] ?>">
                                <?php if (isset($_SESSION['error']['ten_san_pham'])): ?>
                                    <p class="text-danger"><?= $_SESSION['error']['ten_san_pham'] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="gia_san_pham">Giá sản phẩm</label>
                                <input type="number" id="gia_san_pham" name="gia_san_pham" class="form-control" value="<?= $sanPham['gia_san_pham'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="gia_khuyen_mai">Giá Khuyến Mại</label>
                                <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai" class="form-control" value="<?= $sanPham['gia_khuyen_mai'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="hinh_anh">Hình Ảnh</label>
                                <input type="file" id="hinh_anh" name="hinh_anh" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="so_luong">Số Lượng</label>
                                <input type="number" id="so_luong" name="so_luong" class="form-control" value="<?= $sanPham['so_luong'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="ngay_nhap">Ngày Nhập</label>
                                <input type="date" id="ngay_nhap" name="ngay_nhap" class="form-control" value="<?= $sanPham['ngay_nhap'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Danh Mục sản phẩm</label>
                                <select id="inputStatus" name="danh_muc_id" class="form-control custom-select">
                                    <?php foreach ($listDanhMuc as $danhMuc): ?>
                                        <option value="<?= $danhMuc['id']; ?>" <?= $danhMuc['id'] == $sanPham['danh_muc_id'] ? 'selected' : '' ?>>
                                            <?= $danhMuc['ten_danh_muc']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="trang_thai">Trạng thái sản phẩm</label>
                                <select id="trang_thai" name="trang_thai" class="form-control custom-select">
                                    <option value="1" <?= $sanPham['trang_thai'] == 1 ? 'selected' : '' ?>>Còn bán</option>
                                    <option value="2" <?= $sanPham['trang_thai'] == 2 ? 'selected' : '' ?>>Dừng bán</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mo_ta">Mô tả sản phẩm</label>
                                <textarea id="mo_ta" name="mo_ta" class="form-control" rows="4"><?= $sanPham['mo_ta'] ?></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                        </div>
                    </form>
                    <!-- /.card -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Album Ảnh sản phẩm</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form action="<?= BASE_URL_ADMIN . '?act=sua-album-anh-san-pham' ?>" method="post" enctype="multipart/form-data">
                            <div class="table-responsive">
                                <table id="fags" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ảnh</th>
                                            <th>File</th>
                                            <th>
                                                <div class="text-center">
                                                    <button type="button" onclick="addfags();" class="badge badge-success"><i class="fa fa-plus"></i> Thêm</button>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                        <input type="hidden" id="img_delete" name="img_delete">
                                        <?php foreach ($listAnhSanPham as $key => $value): ?>
                                            <tr id="fags-row-<?= $key ?>">
                                                <input type="hidden" name="current_img_ids[]" value="<?= $value['id'] ?>">
                                                <td><img src="<?= BASE_URL . $value['link_hinh_anh'] ?>" style="width:50px; height:50px;" alt=""></td>
                                                <td><input type="file" name="img_array[]" class="form-control"></td>
                                                <td class="mt-10"><button type="button" class="badge badge-danger" onclick="removeRow(<?= $key ?>, <?= $value['id'] ?>)"><i class="fa fa-trash"></i> Delete</button></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- end footer -->
<script>
    var fags_row = <?= count($listAnhSanPham) ?>;
    function addfags() {
        var html = '<tr id="fags-row-' + fags_row + '">';
        html += '<td><img src="https://quagiare.com/uploads/products/800/1246-9205623894_1580167193.jpg" style="width:50px; height:50px;" alt=""></td>';
        html += '<td><input type="file" name="img_array[]" class="form-control"></td>';
        html += '<td class="mt-10"><button type="button" class="badge badge-danger" onclick="removeRow(' + fags_row + ', null);"><i class="fa fa-trash"></i> Delete</button></td>';
        html += '</tr>';
        $('#fags tbody').append(html);
        fags_row++;
    }

    function removeRow(rowId, imgId) {
        $('#fags-row-' + rowId).remove();
        if (imgId !== null) {
            var imgDeleteInput = document.getElementById('img_delete');
            imgDeleteInput.value = imgDeleteInput.value ? imgDeleteInput.value + ',' + imgId : imgId;
        }
    }
</script>
</body>
</html>