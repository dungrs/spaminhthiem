<!-- Order Items -->
<div class="card border-0 shadow-sm rounded-3 mt-4">
    <div class="card-header bg-white border-0">
        <h5 class="mb-0 fw-bold">Chi Tiết Đơn Hàng</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle" style="margin-bottom: 0px !important;">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px" class="text-center">STT</th>
                        <th style="width: 80px">Ảnh</th>
                        <th>Sản Phẩm</th>
                        <th style="width: 100px">Giá</th>
                        <th style="width: 120px">Số Lượng</th>
                        <th style="width: 120px">Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($carts) && !is_null($carts))
                        @foreach ($carts as $cart)
                            <tr>
                                <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $cart->image ?? '' }}" class="img-thumbnail">
                                </td>
                                <td class="align-middle">
                                    <h6 class="mb-1 fw-bold">{{ $cart->name }}</h6>
                                    <p class="text-muted small mb-2">
                                        @foreach ($cart->options['attributes'] as $attribute)
                                            <span class="d-block">{{ $attribute['attribute_catalogue_name'] }}: {{ $attribute['attribute_name'] }}</span>
                                        @endforeach
                                    </p>
                                </td>
                                <td class="align-middle">
                                    @if($cart->price != $cart->priceOriginal)
                                        <div class="fw-bold text-danger price-sale">
                                            {{ convert_price($cart->price) }}
                                        </div>
                                        <div class="text-decoration-line-through text-muted small price-old">
                                            {{ convert_price($cart->priceOriginal) }}
                                        </div>
                                    @else
                                        <div class="fw-bold text-danger price-sale">
                                            {{ convert_price($cart->price) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">{{ $cart->qty }}</td>
                                <td class="fw-bold align-middle">
                                    <div class="fw-bold text-danger price-sale">
                                        {{ convert_price($cart->price * $cart->qty) }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>