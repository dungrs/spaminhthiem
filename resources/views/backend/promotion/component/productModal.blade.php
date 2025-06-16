<div class="card-body">
    <div class="modal fade bs-example-modal-lg store-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="productModalLabel">Chọn sản phẩm</h5>
                        <small class="text-secondary">Chọn sản phẩm sẵn có hoặc tìm kiếm sản phẩm mà bạn mong muốn</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 filter-data">
                            <input type="text" name="keyword" class="form-control keyword" placeholder="Tìm kiếm sản phẩm...">
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light data-table-header">
                               
                            </thead>
                            <tbody class="data-table">

                            </tbody>
                        </table>
                    </div>
                    <ul class="pagination pagination-rounded justify-content-center justify-content-sm-end mb-sm-0">
                        
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary confirm-product-promotion" id="confirmProduct">Xác nhận</button>
                </div>
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- end card body -->