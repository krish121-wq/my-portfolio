@extends('admin.adminlayouts')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<div class="main-content w-100"> 
    <div class="container-fluid py-4"> 
        <div class="row mb-4 align-items-center justify-content-center">
            <div class="col-xl-10 col-lg-11">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="fw-bold text-dark mb-1">Product Manager</h2>
                        <p class="text-muted mb-0" style="font-size: 0.95rem;">Manage your product inventory and prices.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('product.create') }}" class="btn btn-primary btn-lg shadow-sm rounded-pill px-4" style="background: linear-gradient(45deg, #4e73df, #224abe); border:none;">
                            <i class="fa-solid fa-plus-circle me-2"></i>Add New Product
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11"> 
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header border-0 p-0" style="height: 6px; background: linear-gradient(90deg, #4e73df, #36b9cc, #1cc88a);"></div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-sm table-hover align-middle custom-table" style="width:100%">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">ID</th>
                                        <th class="py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Product Info</th>
                                        <th class="py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Category</th>
                                        <th class="py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Brand</th>
                                        <th class="py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Color</th>
                                        <th class="py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Price</th> 
                                        <th class="py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">MRP</th>   
                                        <th class="py-3 text-end pe-4 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($OurProduct as $item)
                                    <tr class="transition-hover">
                                        <td class="ps-4">
                                            <span class="badge bg-light text-secondary border">#{{ $item->id }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center py-1">
                                                <div class="avatar-sm border rounded-circle overflow-hidden me-3" style="width: 45px; height: 45px;">
                                                    @if($item->image)
                                                        <img src="{{ asset('img/'.$item->image) }}" alt="img" class="w-100 h-100 object-fit-cover">
                                                    @else
                                                        <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center text-white small">No Img</div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-dark text-truncate" style="max-width: 180px;">{{ $item->name }}</h6>
                                                    <small class="text-muted text-truncate d-block" style="max-width: 150px;">{{ $item->description }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="badge bg-info bg-opacity-10 text-info border border-info rounded-pill px-3 mb-1" style="width: fit-content;">
                                                    {{ $item->category->category ?? 'Uncategorized' }}
                                                </span>
                                                @if($item->subcategory)
                                                    <span class="text-xs text-muted ms-1">
                                                        <i class="fa-solid fa-level-up-alt fa-rotate-90 me-1"></i>
                                                        {{ $item->subcategory->subcategory }} </span>
                                                @endif
                                            </div>
                                        </td>

                                        <td>
                                            @if($item->brand)
                                                <span class="badge bg-secondary bg-opacity-10 text-dark border border-secondary rounded-pill px-3">
                                                    {{ $item->brand->name }}
                                                </span>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($item->color)
                                                <div class="d-flex align-items-center" title="{{ $item->color->name }}">
                                                    <span class="border shadow-sm me-2" style="width: 20px; height: 20px; border-radius: 50%; background-color: {{ $item->color->code }};"></span>
                                                    <span class="text-dark small fw-bold">{{ $item->color->name }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <span class="fw-bold text-dark fs-6">₹{{ number_format($item->price, 2) }}</span>
                                        </td>

                                        <td>
                                            <span class="text-muted text-decoration-line-through small">₹{{ number_format($item->mrp, 2) }}</span>
                                        </td>

                                        <td class="text-end pe-4">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-light btn-sm rounded-circle text-primary hover-primary" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('product.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light btn-sm rounded-circle text-danger hover-danger" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-hover { transition: all 0.2s ease; }
    .transition-hover:hover { background-color: #f8f9fc; transform: translateY(-2px); }
    .hover-primary:hover { background-color: #4e73df !important; color: white !important; }
    .hover-danger:hover { background-color: #e74a3b !important; color: white !important; }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4e73df !important; color: white !important; border: 1px solid #4e73df !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d1d3e2; border-radius: 20px; padding: 5px 15px;
    }
    .table-sm > :not(caption) > * > * { padding: 0.5rem 0.5rem; }
</style>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "pageLength": 10,
            "language": { "search": "", "searchPlaceholder": "Search..." },
            "dom": '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>'
        });
    });
</script>

@endsection