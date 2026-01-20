@extends('admin.adminlayouts')

@section('content')

{{-- 1. CSS Links --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<div class="main-content w-100"> 
    <div class="container-fluid">
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold text-dark mb-1">Color Manager</h2>
                <p class="text-muted mb-0" style="font-size: 0.95rem;">Organize your product colors efficiently.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('colors.create') }}" class="btn btn-primary btn-lg shadow-sm rounded-pill px-4" style="background: linear-gradient(45deg, #4e73df, #224abe); border:none;">
                    <i class="fa-solid fa-plus-circle me-2"></i>Add New Color
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header border-0 p-0" style="height: 6px; background: linear-gradient(90deg, #4e73df, #36b9cc, #1cc88a);"></div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-hover align-middle custom-table" style="width:100%">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Color Name</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Visual (Code)</th>
                                        {{-- Fixed: Added Status Header --}}
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-end pe-4 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colors as $color)
                                    <tr class="transition-hover">
                                        <td class="ps-4">
                                            <span class="badge bg-light text-secondary border">#{{ $color->id }}</span>
                                        </td>
                                        
                                        {{-- Column 2: Name --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                    <i class="fa-solid fa-signature text-primary fs-5"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-dark">{{ $color->name }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Column 3: Visual & Hex Code --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{-- Color Circle --}}
                                                <span class="shadow-sm me-3" style="display:inline-block; width: 35px; height: 35px; border-radius: 50%; background-color: {{ $color->code }}; border: 2px solid #fff; box-shadow: 0 0 5px rgba(0,0,0,0.1);"></span>
                                                
                                                {{-- Hex Code --}}
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-dark" style="font-family: monospace;">{{ $color->code }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        {{-- Column 4: Status (Ab Header match karega) --}}
                                        <td>
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2">Active</span>
                                        </td>

                                        {{-- Column 5: Actions --}}
                                        <td class="text-end pe-4">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('colors.edit', $color->id) }}" class="btn btn-light btn-sm rounded-circle text-primary hover-primary" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('colors.destroy', $color->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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

{{-- 2. Custom Styles --}}
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
</style>

{{-- 3. Scripts --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "pageLength": 10,
            "language": { "search": "", "searchPlaceholder": "Search colors..." },
            "dom": '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>'
        });
    });
</script>

@endsection