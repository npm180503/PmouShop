@extends('frontend.layout')
@section('content')
<style>
    .hidden {
        opacity: 0;
        max-height: 0;
        overflow: hidden;
        transition: opacity 0.5s ease, max-height 0.5s ease;
    }

    .visible {
        margin-bottom: 50px;
        opacity: 1;
        max-height: 400px;
        /* Đảm bảo chiều cao tối đa lớn hơn chiều cao sản phẩm */
        transition: opacity 0.5s ease, max-height 0.5s ease;
    }

    .product-price {
        font-size: 18px;
        margin-top: 10px;
    }

    .original-price {
        text-decoration: line-through;
        color: gray;
        margin-right: 10px;
    }

    .sale-price {
        color: red;
        font-weight: bold;
    }

    .current-price {
        font-weight: bold;
    }
</style>
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140" style="margin-top:80px">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						Tất cả
					</button>

                    @foreach ($menus as $menu)
					    <button href="{{ route('fr.product', ['menu_id' => $menu->id]) }}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
						    {{ $menu->name }}
					    </button>                        
                    @endforeach
                    
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
                        Giảm giá
                    </button>  

				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 Filter
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col1 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Sort By
							</div>

							<ul>
								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Default
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Popularity
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Average rating
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04 filter-link-active">
										Newness
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Price: Low to High
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Price: High to Low
									</a>
								</li>
							</ul>
						</div>

						<div class="filter-col2 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Price
							</div>

							<ul>
								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04 filter-link-active">
										All
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										$0.00 - $50.00
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										$50.00 - $100.00
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										$100.00 - $150.00
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										$150.00 - $200.00
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										$200.00+
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
            <div class="row" id="product-list">
                @foreach ($products as $index => $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 product-item {{ $index < 8 ? 'initial' : 'hidden' }} menu-{{ $product->menu_id }}">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{{ asset($product->thumb) }}" alt="IMG-PRODUCT"
                                    style="width: 100%; height: 400px; object-fit: cover;">
                                <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-')}}"
									data-id="{{ $product->id }}"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Xem ngay
                                </a>
                            </div>
                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l">
									<a href="{{ route('fr.product.detail', ['productID' => $product->id]) }} "
										class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										{{ $product->name }}
									</a>
                                    @if ($product->price_sale)
                                        <span class="original-price"
                                            style="text-decoration: line-through;">{{ number_format($product->price, 0) }}
                                            VND</span>
                                        <span class="sale-price"
                                            style="color: red;">{{ number_format($product->price_sale, 0) }} VND</span>
                                    @else
                                        <span class="current-price">{{ number_format($product->price, 0) }} VND</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex-c-m flex-w w-full p-t-45">
                <a id="toggle-button" href="#"
                    class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    Xem Thêm
                </a>
            </div>
		</div>
	</div>
		

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>
	<script src={{ asset("template/js/product.js?v=".time()) }}></script>	
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggle-button');
            const hiddenItems = document.querySelectorAll('.product-item.hidden');
            const initialItems = document.querySelectorAll('.product-item.initial');
    
            let isExpanded = false;
    
            toggleButton.addEventListener('click', function(e) {
                e.preventDefault();
                if (isExpanded) {
                    // Thu gọn
                    hiddenItems.forEach(item => {
                        item.classList.remove('visible');
                        item.classList.add('hidden');
                    });
                    toggleButton.textContent = 'Xem Thêm';
                    isExpanded = false;
                } else {
                    // Hiển thị thêm
                    hiddenItems.forEach(item => {
                        item.classList.remove('hidden');
                        item.classList.add('visible');
                    });
                    toggleButton.textContent = 'Thu Gọn';
                    isExpanded = true;
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.filter-tope-group button');
        const products = document.querySelectorAll('.product-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                let filterValue = this.getAttribute('data-filter');

                // Loại bỏ lớp active khỏi tất cả các nút và thêm vào nút đang chọn
                filterButtons.forEach(btn => btn.classList.remove('how-active1'));
                this.classList.add('how-active1');

                // Hiển thị hoặc ẩn sản phẩm dựa trên filter
                products.forEach(product => {
                    if (filterValue === '*' || product.classList.contains(filterValue.substring(1))) {
                        product.style.display = 'block';
                    } else {
                        product.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>
@endsection
