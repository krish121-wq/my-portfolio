@extends('admin.adminlayouts')

@section('content')

<div class="main-content w-100">
    <div class="container-fluid">
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold text-dark mb-1">Add New Color</h2>
                <p class="text-muted mb-0" style="font-size: 0.95rem;">Create a new Color for your product catalog.</p>
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
                        <form action="{{ route('colors.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold text-secondary text-uppercase text-xs">Color Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                        <i class="fa-solid fa-signature text-primary"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control rounded-end-pill" placeholder="e.g. Royal Blue" required>
                                </div>
                                @error('name')
                                    <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="code" class="form-label fw-bold text-secondary text-uppercase text-xs">Color Code (Hex)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                        <i class="fa-solid fa-palette text-primary"></i>
                                    </span>
                                    
                                    <input type="color" class="form-control form-control-color" id="colorPicker" value="#563d7c" title="Choose your color" style="max-width: 60px; padding: 5px;" onchange="document.getElementById('hexCode').value = this.value">
                                    
                                    <input type="text" name="code" id="hexCode" class="form-control rounded-end-pill" value="#563d7c" placeholder="#563d7c" required>
                                </div>
                                @error('code')
                                    <span class="text-danger small ms-3 mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-5">
                                <button type="reset" class="btn btn-light btn-lg rounded-pill px-4 hover-danger text-muted">
                                    <i class="fa-solid fa-rotate-left me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg shadow rounded-pill px-5" style="background: linear-gradient(45deg, #4e73df, #224abe); border:none;">
                                    <i class="fa-solid fa-save me-2"></i>Save Color
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
    /* Fix for color input spacing */
    .form-control-color { border-right: 0; }
</style>

@endsection