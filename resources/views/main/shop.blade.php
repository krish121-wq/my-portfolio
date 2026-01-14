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
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Apple<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Asus<span>(29)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Color</div>
                        <form action="#">
                            <ul>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Price</div>
                        <div class="price-range-area">
                            <div id="price-range"></div>
                            <div class="value-wrapper d-flex">
                                <div class="price">Price:</div>
                                <span>$</span><div id="lower-value"></div>
                                <div class="to">to</div>
                                <span>$</span><div id="upper-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                
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
                        {{-- Prev Arrow --}}
                        @if ($products->onFirstPage())
                            <a href="#" class="prev-arrow" style="pointer-events: none; opacity: 0.6;"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        @endif

                        {{-- Page Numbers (Looping through pages) --}}
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if ($page == $products->currentPage())
                                <a href="#" class="active">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Arrow --}}
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

    <a href="javascript:void(0);" class="social-info">
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
                    <div class="sorting mr-auto">
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
            </div>
        </div>
    </div>

    <section class="related-product-area section_gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Deals of the Week</h1>
                        <p>Check out our best deals for the week.</p>
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
                                    <div class="price"><h6>$189.00</h6><h6 class="l-through">$210.00</h6></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('assest/img/r2.jpg')}}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price"><h6>$189.00</h6><h6 class="l-through">$210.00</h6></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('assest/img/r3.jpg')}}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price"><h6>$189.00</h6><h6 class="l-through">$210.00</h6></div>
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


@endsection