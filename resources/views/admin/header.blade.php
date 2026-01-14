<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="{{ asset('admin_assest/https://cdn.jsdelivr.net/npm/chart.js')}}"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; overflow-x: hidden; }
        .sidebar { min-height: 100vh; background: #ffffff; box-shadow: 2px 0 10px rgba(0,0,0,0.03); width: 250px; position: fixed; z-index: 1000; transition: all 0.3s; }
        .sidebar .nav-link { color: #64748b; font-weight: 500; padding: 12px 20px; border-radius: 8px; margin-bottom: 5px; transition: all 0.2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background-color: #f1f5f9; color: #2563eb; }
        .sidebar .nav-link i { width: 24px; }
        .main-content { margin-left: 230px; padding: 20px; transition: all 0.3s; }
        .navbar { background: #ffffff; box-shadow: 0 2px 10px rgba(0,0,0,0.03); padding: 15px 20px; border-radius: 10px; margin-bottom: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); background: #ffffff; transition: transform 0.2s; margin-bottom: 20px; }
        .card:hover { transform: translateY(-3px); }
        .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .bg-light-primary { background: #eff6ff; color: #2563eb; }
        .bg-light-success { background: #f0fdf4; color: #16a34a; }
        .bg-light-warning { background: #fefce8; color: #ca8a04; }
        .bg-light-danger { background: #fef2f2; color: #dc2626; }
        .table thead th { border-bottom: 2px solid #f1f5f9; color: #64748b; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; }
        .table td { vertical-align: middle; color: #334155; font-size: 0.95rem; padding: 15px; }
        .badge-soft-success { background-color: #dcfce7; color: #166534; padding: 5px 10px; border-radius: 6px; }
        .badge-soft-warning { background-color: #fef9c3; color: #854d0e; padding: 5px 10px; border-radius: 6px; }
        @media (max-width: 768px) { .sidebar { margin-left: -250px; } .main-content { margin-left: 0; } .sidebar.active { margin-left: 0; } }
    </style>
</head>
<body>

<div class="d-flex">
   <nav class="sidebar p-3" id="sidebar">
    <div class="d-flex align-items-center mb-4 px-2">
        <i class="fa-solid fa-layer-group text-primary fs-3 me-2"></i>
        <h4 class="m-0 fw-bold text-dark">Celestial<span class="text-primary">UI</span></h4>
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                <i class="fa-solid fa-folder-tree"></i> Category
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('product.index') }}" class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
                <i class="fa-solid fa-folder-tree"></i> Product
            </a>
        </li>
        
        <li class="nav-item mt-4"><span class="text-uppercase text-muted fs-7 px-3 fw-bold">Settings</span></li>
        
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-gear"></i> Preferences
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
            
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
