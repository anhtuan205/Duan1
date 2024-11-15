<?php
class AdminDonHangControllers
{
    public $modelDonHang;


    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }

    public function danhsachDonHang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once './views/donhang/listDonHang.php';
    }

    public function detailDonHang()
    {
        $don_hang_id = $_GET['id_don_hang'];

        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

        // lấy danh sách sản pgaamr đăth của đơn hàng
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);

        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        require_once './views/donhang/detailDonHang.php';
    }

    public function formEditDonHang() {
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
    }

    public function postEditDonHang() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $don_hang_id = $_POST['don_hang_id'] ?? '';
            
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $sđt_nguoi_nhan = $_POST['sđt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';
            
           

            $error = [];
            if (empty($ten_nguoi_nhan)) {
                $error['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
            }
            if (empty($sđt_nguoi_nhan)) {
                $error['sđt_nguoi_nhan'] = 'sđt người nhận không được để trống';
            }
            if (empty($email_nguoi_nhan)) {
                $error['email_nguoi_nhan'] = 'Email người nhận không được để trống';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $error['dia_chi_nguoi_nhan'] = 'địa chỉ không được để trống';
            }
            if (empty($trang_thai_id)) {
                $error['trang_thai'] = 'Trạng thái đơn hàng ';
            }

            $_SESSION['error'] = $error;

            // var_dump($don_hang_id);die;

            if (empty($error)) {
                $abc=$this->modelDonHang->updateDonHang( $don_hang_id,
                    $ten_nguoi_nhan,
                    $sđt_nguoi_nhan,
                    $email_nguoi_nhan,
                    $dia_chi_nguoi_nhan,
                    $ghi_chu,
                    $trang_thai_id
                   
                );// var_dump($abc);die;
                header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
    }

    // public function postEditAnhSanPham() {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $san_pham_id = $_POST['san_pham_id'] ?? '';
    //         $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);
    //         $img_array = $_FILES['img_array'];
    //         $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
    //         $current_img_ids = $_POST['current_img_ids'] ?? [];
    //         $upload_file = [];

    //         foreach ($img_array['name'] as $key => $value) {
    //             if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
    //                 $new_file = uploadFileAlbum($img_array, './upload/', $key);
    //                 if ($new_file) {
    //                     $upload_file[] = [
    //                         'id' => $current_img_ids[$key] ?? null,
    //                         'file' => $new_file  
    //                     ];
    //                 }
    //             }
    //         }

    //         foreach ($upload_file as $file_info) {
    //             if ($file_info['id']) {
    //                 $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];
    //                 $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);
    //                 deleteFile($old_file);
    //             } else {
    //                 $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
    //             }
    //         }

    //         foreach ($listAnhSanPhamCurrent as $anhSP) {
    //             $anh_id = $anhSP['id'];
    //             if (in_array($anh_id, $img_delete)) {
    //                 $this->modelSanPham->destroyAnhSanPham($anh_id);
    //                 deleteFile($anhSP['link_hinh_anh']);
    //             }
    //         }

    //         header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
    //         exit();
    //     }
    // }

    // public function deleteSanPham() {
    //     $id = $_GET['id_san_pham'];
    //     $sanPham = $this->modelSanPham->getDetailSanPham($id);
    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

    //     if ($sanPham) {
    //         deleteFile($sanPham['hinh_anh']);
    //         $this->modelSanPham->destroySanPham($id);
    //     }

    //     if ($listAnhSanPham) {
    //         foreach ($listAnhSanPham as $anhSP) {
    //             deleteFile($anhSP['link_hinh_anh']);
    //             $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
    //         }
    //     }//     header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
    //     exit();
    // }
    // // public function detailSanPham() {
    // //     $id = $_GET['id_san_pham'];

    // //     $sanPham = $this->modelSanPham->getDeltailSanPham($id);

    // //     $listAnhSanPham = $this->modelSanPham->getlistAnhSanPham($id);
    // //     if ($sanPham) {
    // //         require_once './views/sanpham/detailSanPham.php';

    // //     } else {
    // //         header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
    // //         exit();
    // //     }
    // // }
}