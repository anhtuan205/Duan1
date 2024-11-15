<?php if (isset($error['dia_chi_nguoi_nhan'])) { ?>
                    <p class="text-danger"><?= $error['dia_chi_nguoi_nhan'] ?></p>

                  <?php } ?> 
                </div>



                <div class="form-group">
                  <label>Ghi chú</label>
                  <textarea name="ghi_chu" id="" class="form-control" placeholder="Nhập ghi chú"><?= $donHang['ghi_chu'] ?></textarea>
                </div>

                <hr>
                <div class="form-group">
                                <label for="inputStatus">Trạng thái đơn hàng</label>
                                <select id="inputStatus" name="trang_thai_id" class="form-control custom-select">
                                    <?php foreach ($listTrangThaiDonHang as $trangThai): ?>
                                        <option 
                                        <?php
                                       
                                        if ($donHang['trang_thai_id']> $trangThai['id'] 
                                        || $donHang['trang_thai_id']==9
                                        || $donHang['trang_thai_id']==10
                                        || $donHang['trang_thai_id']==11){
                                            echo 'disabled';
                                        }
                                         ?>
                                        value="<?=  $trangThai['id']; ?>" <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>>
                                            <?= $trangThai['ten_trang_thai']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- end footer -->
</body>

</html>