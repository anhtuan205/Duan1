<?php 

class HomeController
{
    public $modelSanPham;
    public function __construct(){
        $this->modelSanPham = new SanPham();
    }
    public function home(){
        echo "Anh Tuân";
    }
    public function danhsachSanPham(){
        $listProduct = $this->modelSanPham->getAllProduct();
        // var_dump($listProduct);die();
        require_once './views/listProduct.php';
    }

}