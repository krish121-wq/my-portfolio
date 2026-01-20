@extends('admin.adminlayouts')

@section('content')

<div class="main-content w-100">
    <div class="container-fluid">
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold text-dark mb-1">Edit Product</h2>
                <p class="text-muted mb-0" style="font-size: 0.95rem;">Update details for: <span class="text-primary fw-bold">{{ $OurProduct->name }}</span></p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('product.index') }}" class="btn btn-secondary btn-lg shadow-sm rounded-pill px-4">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    
                    <div class="card-header border-0 p-0" style="height: 6px; background: linear-gradient(90deg, #f6c23e, #fd7e14);"></div>
                    
                    <div class="card-body p-5">

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4 rounded-3">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('product.update', $OurProduct->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary text-uppercase text-xs">Select Category <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                        <i class="fa-solid fa-layer-group text-primary"></i>
                                    </span>
                                    <select name="category_id" class="form-select form-select-lg border-start-0 rounded-end-pill bg-light @error('category_id') is-invalid @enderror">
                                        <option value="" disabled>Choose a Category...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $OurProduct->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id') <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary text-uppercase text-xs">Select Subcategory</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                        <i class="fa-solid fa-tags text-info"></i>
                                    </span>
                                    <select name="subcategory_id" class="form-select form-select-lg border-start-0 rounded-end-pill bg-light @error('subcategory_id') is-invalid @enderror">
                                        <option value="" selected>Choose a Subcategory (Optional)...</option>
                                        @foreach($subcategories as $subcat)
                                            @if($subcat->subcategory)
                                                <option value="{{ $subcat->id }}" {{ old('subcategory_id', $OurProduct->subcategory_id) == $subcat->id ? 'selected' : '' }}>
                                                    {{ $subcat->category }} > {{ $subcat->subcategory }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('subcategory_id') <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary text-uppercase text-xs">Product Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                        <i class="fa-solid fa-box-open text-info"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control form-control-lg border-start-0 rounded-end-pill bg-light @error('name') is-invalid @enderror" value="{{ old('name', $OurProduct->name) }}" required>
                                </div>
                                @error('name') <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase text-xs">Brand</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                            <i class="fa-solid fa-certificate text-warning"></i>
                                        </span>
                                        <select name="brand_id" class="form-select form-select-lg border-start-0 rounded-end-pill bg-light">
                                            <option value="">Choose Brand (Optional)...</option>
                                            @foreach($brands as $brand)
                                                {{-- Check kar raha hai ki purana brand kaunsa tha --}}
                                                <option value="{{ $brand->id }}" {{ old('brand_id', $OurProduct->brand_id) == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase text-xs">Color</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                            <i class="fa-solid fa-palette text-danger"></i>
                                        </span>
                                        <select name="color_id" class="form-select form-select-lg border-start-0 rounded-end-pill bg-light">
                                            <option value="">Choose Color (Optional)...</option>
                                            @foreach($colors as $color)
                                                {{-- Check kar raha hai ki purana color kaunsa tha --}}
                                                <option value="{{ $color->id }}" style="background-color: {{ $color->code }}; color: #fff; text-shadow: 1px 1px 2px #000;" {{ old('color_id', $OurProduct->color_id) == $color->id ? 'selected' : '' }}>
                                                    {{ $color->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase text-xs">Selling Price (₹) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                            <i class="fa-solid fa-indian-rupee-sign text-success"></i>
                                        </span>
                                        <input type="number" name="price" class="form-control form-control-lg border-start-0 rounded-end-pill bg-light @error('price') is-invalid @enderror" value="{{ old('price', $OurProduct->price) }}" required>
                                    </div>
                                    @error('price') <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase text-xs">MRP (₹) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                            <i class="fa-solid fa-tag text-warning"></i>
                                        </span>
                                        <input type="number" name="mrp" class="form-control form-control-lg border-start-0 rounded-end-pill bg-light @error('mrp') is-invalid @enderror" value="{{ old('mrp', $OurProduct->mrp) }}" required>
                                    </div>
                                    @error('mrp') <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary text-uppercase text-xs">Product Image</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                        <i class="fa-solid fa-image text-secondary"></i>
                                    </span>
                                    <input type="file" name="image" id="imageInput" class="form-control form-control-lg border-start-0 rounded-end-pill bg-light @error('image') is-invalid @enderror" accept="image/*">
                                </div>
                                <small class="text-muted ms-3">Leave empty to keep current image.</small>
                                @error('image') <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span> @enderror
                                
                                <div class="mt-3 d-flex gap-4 align-items-center ms-3">
                                    <div class="text-center">
                                        <p class="small text-muted mb-1">Current</p>
                                        @if($OurProduct->image)
                                            <img src="{{ asset('img/'.$OurProduct->image) }}" class="img-thumbnail rounded-3" style="height: 100px; width: 100px; object-fit: cover;">
                                        @else
                                            <div class="bg-light border rounded-3 d-flex align-items-center justify-content-center" style="height: 100px; width: 100px;">No Img</div>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <img id="imagePreview" src="#" alt="New" class="d-none img-thumbnail rounded-3" style="height: 100px; width: 100px; object-fit: cover;">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary text-uppercase text-xs">Description <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                        <i class="fa-solid fa-file-lines text-primary"></i>
                                    </span>
                                    <textarea name="description" rows="3" class="form-control form-control-lg border-start-0 rounded-end-pill bg-light @error('description') is-invalid @enderror">{{ old('description', $OurProduct->description) }}</textarea>
                                </div>
                                @error('description') <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span> @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-5">
                                <button type="reset" class="btn btn-light btn-lg rounded-pill px-4 hover-danger text-muted">
                                    <i class="fa-solid fa-rotate-left me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-warning btn-lg shadow rounded-pill px-5 text-white" style="border:none;">
                                    <i class="fa-solid fa-pen-to-square me-2"></i>Update Product
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
    /* Shared CSS */
    .form-control:focus, .form-select:focus { box-shadow: none; border-color: #f6c23e; background-color: #fff; } /* Edit page focus color orange */
    .input-group-text { border-color: #d1d3e2; }
    .form-control, .form-select { border-color: #d1d3e2; }
    .hover-danger:hover { background-color: #e74a3b !important; color: white !important; }
    .text-xs { font-size: 0.75rem; letter-spacing: 0.05em; }
</style>

<script>
    // Simple Image Preview
    document.getElementById('imageInput').onchange = function (evt) {
        const [file] = this.files
        if (file) {
            const preview = document.getElementById('imagePreview');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        }
    }
</script>

@endsection