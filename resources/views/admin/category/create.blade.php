@extends('admin.adminlayouts')

@section('content')

<div class="main-content w-100">
    <div class="container-fluid">
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold text-dark mb-1">Add New Category</h2>
                <p class="text-muted mb-0" style="font-size: 0.95rem;">Create a new category for your product catalog.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg shadow-sm rounded-pill px-4">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    
                    <div class="card-header border-0 p-0" style="height: 6px; background: linear-gradient(90deg, #4e73df, #36b9cc, #1cc88a);"></div>
                    
                    <div class="card-body p-5">
                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="category" class="form-label fw-bold text-secondary text-uppercase text-xs">Category Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                        <i class="fa-solid fa-layer-group text-primary"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        name="category" 
                                        class="form-control form-control-lg border-start-0 rounded-end-pill bg-light @error('category') is-invalid @enderror" 
                                        id="category" 
                                        placeholder="e.g. Men, Women"
                                        value="{{ old('category') }}"
                                    >
                                </div>
                                @error('category')
                                    <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="subcategory" class="form-label fw-bold text-secondary text-uppercase text-xs">Subcategory Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                        <i class="fa-solid fa-tags text-info"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        name="subcategory" 
                                        class="form-control form-control-lg border-start-0 rounded-end-pill bg-light @error('subcategory') is-invalid @enderror" 
                                        id="subcategory" 
                                        placeholder="e.g. Shoes, T-Shirts"
                                        value="{{ old('subcategory') }}"
                                    >
                                </div>
                                @error('subcategory')
                                    <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-5">
                                <button type="reset" class="btn btn-light btn-lg rounded-pill px-4 hover-danger text-muted">
                                    <i class="fa-solid fa-rotate-left me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg shadow rounded-pill px-5" style="background: linear-gradient(45deg, #4e73df, #224abe); border:none;">
                                    <i class="fa-solid fa-save me-2"></i>Save Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .form-control:focus { box-shadow: none; border-color: #4e73df; background-color: #fff; }
    .input-group-text { border-color: #d1d3e2; }
    .form-control { border-color: #d1d3e2; }
    .hover-danger:hover { background-color: #e74a3b !important; color: white !important; }
</style>

@endsection