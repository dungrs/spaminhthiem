<div class="product-sorting-bar">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <!-- Dropdown sắp xếp -->
        <div class="sorting-dropdown">
            <div class="dropdown">
                <button class="btn btn-sorting-dropdown dropdown-toggle" type="button" id="sortingDropdown" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-sort-amount-down-alt me-2"></i>
                    <span class="sorting-label">Sắp xếp theo</span>
                    <span class="current-sort">Mặc định</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortingDropdown">
                    <li><a class="dropdown-item" href="javascript:;"><i class="fas fa-check invisible me-2"></i> Mặc định</a></li>
                    <li><a class="dropdown-item" href="javascript:;"><i class="fas fa-check invisible me-2"></i> Tên A-Z</a></li>
                    <li><a class="dropdown-item" href="javascript:;"><i class="fas fa-check invisible me-2"></i> Tên Z-A</a></li>
                    <li><a class="dropdown-item" href="javascript:;"><i class="fas fa-check invisible me-2"></i> Giá thấp đến cao</a></li>
                    <li><a class="dropdown-item" href="javascript:;"><i class="fas fa-check invisible me-2"></i> Giá cao đến thấp</a></li>
                    <li><a class="dropdown-item" href="javascript:;"><i class="fas fa-check invisible me-2"></i> Hàng mới nhất</a></li>
                </ul>
            </div>
        </div>

        <!-- Kết quả (hiển thị trên desktop) -->
        <div class="result-count text-muted d-none d-xl-block">
            Hiển thị <span class="fw-bold">1-12</span> của <span class="fw-bold">12</span> sản phẩm
        </div>

        <!-- Nút lọc (chỉ hiển thị trên mobile) -->
        <button id="mobile-filter-btn" class="btn btn-filter-mobile d-xl-none">
            <i class="fas fa-sliders-h me-2"></i>
            <span>Bộ lọc</span>
        </button>
    </div>
</div>