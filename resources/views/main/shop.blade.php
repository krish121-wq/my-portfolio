@extends('../layouts.masterlayouts')

@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shop Category page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Shop</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    
    <div class="container">
        <div class="row">
            
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                        @foreach($categories as $mainCategoryName => $subCatCollection)
                            <li class="main-nav-list">
                                <a data-toggle="collapse" href="#category{{ $loop->index }}" aria-expanded="false" aria-controls="category{{ $loop->index }}">
                                    <span class="lnr lnr-arrow-right"></span>
                                    {{ $mainCategoryName }}
                                    <span class="number">({{ $subCatCollection->sum('products_count') }})</span>
                                </a>
                                <ul class="collapse" id="category{{ $loop->index }}" data-toggle="collapse" aria-expanded="false" aria-controls="category{{ $loop->index }}">
                                    @foreach($subCatCollection as $subCat)
                                        <li class="main-nav-list child">
                                            <a href="{{ url('product/category/'.$subCat->id) }}">
                                                {{ $subCat->subcategory }}
                                                <span class="number">({{ $subCat->products_count }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="sidebar-filter mt-50">
                    <div class="top-filter-head">Product Filters</div>
                    <div class="common-filter">
                        <div class="head">Brands</div>
                        <form action="#">
                            <ul>
                                @foreach($brands as $brand)
                                    @if($brand->products_count > 0)
                                        <li class="filter-list">
                                            <input class="pixel-radio pixel-radio-filter" type="radio" 
                                                   id="brand{{ $brand->id }}" 
                                                   name="brand" 
                                                   value="{{ $brand->slug }}"
                                                   {{ request()->brand == $brand->slug ? 'checked' : '' }}>
                                            <label for="brand{{ $brand->id }}">
                                                {{ $brand->name }}<span>({{ $brand->products_count }})</span>
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Color</div>
                        <form action="#">
                            <ul>
                                @foreach($colors as $color)
                                    @if($color->products_count > 0)
                                        <li class="filter-list">
                                            <input class="pixel-radio pixel-radio-filter" type="radio" 
                                                   id="color{{ $color->id }}" 
                                                   name="color" 
                                                   value="{{ $color->id }}"
                                                   {{ request()->color == $color->id ? 'checked' : '' }}>
                                            <label for="color{{ $color->id }}">
                                                {{ $color->name }}<span>({{ $color->products_count }})</span>
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Price</div>
                        <div class="price-range-area">
                            <div id="price-range"></div>
                            <div class="value-wrapper d-flex">
                                <div class="price">Price:</div>
                                <span>Rs</span><div id="lower-value"></div>
                                <div class="to">to</div>
                                <span>Rs</span><div id="upper-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 col-md-7" id="dynamic-product-area">
                
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting">
                        <select>
                            <option value="1">Default sorting</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto">
                        <select>
                            <option value="1">Show 12</option>
                        </select>
                    </div>
                    <div class="pagination">
                        @if ($products->onFirstPage())
                            <a href="#" class="prev-arrow" style="pointer-events: none; opacity: 0.6;"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        @endif

                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if ($page == $products->currentPage())
                                <a href="#" class="active">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        @else
                            <a href="#" class="next-arrow" style="pointer-events: none; opacity: 0.6;"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        @endif
                    </div>
                </div>

                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        @if($products->count() > 0)
                            @foreach($products as $item)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-product">
                                        <div style="height: 250px; width: 100%; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                            <img class="img-fluid" src="{{ asset('img/'.$item->image) }}" alt="" style="max-height: 100%; max-width: 100%;">
                                        </div>
                                        <div class="product-details">
                                            <h6>{{ $item->name }}</h6>
                                            <div class="price">
                                                <h6>Rs. {{ $item->price }}</h6>
                                                <h6 class="l-through">Rs. {{ $item->mrp }}</h6>
                                            </div>
                                            <div class="prd-bottom">
                                                <a href="javascript:void(0);" class="social-info add-to-cart-btn" 
                                                   data-product-id="{{ $item->id }}" 
                                                   data-price="{{ $item->price }}" 
                                                   data-category-id="{{ $item->category_id }}">
                                                    <span class="ti-bag"></span>
                                                    <p class="hover-text">add to bag</p>
                                                </a>
                                                <a href="javascript:void(0);" class="social-info wishlist-btn" 
                                                   data-product-id="{{ $item->id }}" 
                                                   data-category-id="{{ $item->category_id }}">
                                                    <span class="lnr lnr-heart"></span>
                                                    <p class="hover-text">Wishlist</p>
                                                </a>
                                                <a href="javascript:void(0);" class="social-info">
                                                    <span class="lnr lnr-sync"></span>
                                                    <p class="hover-text">compare</p>
                                                </a>
                                               <a href="{{ route('single_product', $item->id) }}" class="social-info">
    <span class="lnr lnr-move"></span>
    <p class="hover-text">view more</p>
</a>
                                            </div>
                                            <p class="success-message" id="message-{{ $item->id }}" style="display:none; color:green; margin-top:5px; font-weight:bold;"></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12 text-center" style="padding: 50px;">
                                <h3 style="color: #ffba00;">No Products Found</h3>
                            </div>
                        @endif
                    </div>
                </section>

                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto"></div>
                    <div class="pagination">
                        @if ($products->onFirstPage())
                            <a href="#" class="prev-arrow" style="pointer-events: none; opacity: 0.6;"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        @endif

                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if ($page == $products->currentPage())
                                <a href="#" class="active">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        @else
                            <a href="#" class="next-arrow" style="pointer-events: none; opacity: 0.6;"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    	<section class="related-product-area section_gap_bottom">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Deals of the Week</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							magna aliqua.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{ asset('assest/img/r1.jpg')}}" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{ asset('assest/img/r2.jpg')}}" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{ asset('assest/img/r3.jpg')}}" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{ asset('assets/img/r5.jpg')}}" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{asset('assest/img/r6.jpg')}}" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{asset('assest/img/r7.jpg')}}" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{asset('assest/img/r9.jpg')}}" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{asset('assest/img/r10.jpg')}}" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{asset('assest/img/r11.jpg')}}" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="ctg-right">
						<a href="#" target="_blank">
							<img class="img-fluid d-block mx-auto" src="{{ asset('assest/img/category/c5.jpg')}}" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function () {
        
        // --- Settings ---
        var min_price_limit = 0;
        var max_price_limit = 50000; // Yahan apne products ki max price set karein

        // --- URL Se Values Uthana ---
        var currentUrl = new URL(window.location.href);
        var startMin = currentUrl.searchParams.get("min_price") || min_price_limit;
        var startMax = currentUrl.searchParams.get("max_price") || max_price_limit;

        // --- Slider Initialize ---
        $("#price-range").slider({
            range: true,
            min: min_price_limit,
            max: max_price_limit,
            values: [startMin, startMax],
            
            // Slide karte waqt sirf text badle (Visual)
            slide: function (event, ui) {
                $("#lower-value").text(ui.values[0]);
                $("#upper-value").text(ui.values[1]);
            },
            
            // Jab user chod de (Mouse Up), tab Filter Trigger ho
            stop: function (event, ui) {
                $("#lower-value").text(ui.values[0]);
                $("#upper-value").text(ui.values[1]);
                triggerFilter(); 
            }
        });

        // Default Text Set
        $("#lower-value").text($("#price-range").slider("values", 0));
        $("#upper-value").text($("#price-range").slider("values", 1));


        // --- AJAX Load Logic ---
        function loadProducts(finalUrl) {
            $('#dynamic-product-area').css('opacity', '0.5'); // Loading effect
            $('#dynamic-product-area').load(finalUrl + ' #dynamic-product-area > *', function() {
                $('#dynamic-product-area').css('opacity', '1');
                window.history.pushState({path: finalUrl}, '', finalUrl);
            });
        }

        // --- Main Filter Function ---
        function triggerFilter() {
            let currentUrl = new URL(window.location.href);
            let searchParams = currentUrl.searchParams;

            // Brand
            let selectedBrand = $('input[name="brand"]:checked').val();
            if (selectedBrand) searchParams.set('brand', selectedBrand);

            // Color
            let selectedColor = $('input[name="color"]:checked').val();
            if (selectedColor) searchParams.set('color', selectedColor);

            // Price
            let minPrice = $("#price-range").slider("values", 0);
            let maxPrice = $("#price-range").slider("values", 1);
            
            searchParams.set('min_price', minPrice);
            searchParams.set('max_price', maxPrice);

            searchParams.delete('page'); // Filter change = Page 1

            let finalUrl = currentUrl.pathname + '?' + searchParams.toString();
            
            // Console me check karein ki URL sahi ban raha hai ya nahi
            console.log("Requesting URL:", finalUrl); 
            
            loadProducts(finalUrl);
        }

        // Brand/Color Change Handler
        $(document).on('change', '.pixel-radio-filter', function () {
            triggerFilter();
        });

        // Pagination Handler
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            if(url) loadProducts(url);
        });

    });
</script>

@endsection