@extends('admin.adminlayouts')
@section('content')

    <div class="main-content w-100">
        <nav class="navbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-light d-md-none me-3" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text border-0 bg-light"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search data...">
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="position-relative">
                    <i class="fa-regular fa-bell fs-5 text-muted"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                </div>
                <div class="d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name=Kenneth+Osborne&background=0D8ABC&color=fff" class="rounded-circle me-2" width="35" height="35" alt="User">
                    <div class="d-none d-md-block">
                        <small class="d-block fw-bold text-dark">Kenneth Osborne</small>
                        <small class="d-block text-muted" style="font-size: 11px;">Admin</small>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid p-0">
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="fw-bold text-dark">Dashboard Overview</h3>
                    <p class="text-muted">Here's what's happening with your business today.</p>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 fs-6">Total Earnings</p>
                                <h3 class="fw-bold mb-0">$287,493</h3>
                            </div>
                            <div class="stat-icon bg-light-primary"><i class="fa-solid fa-dollar-sign"></i></div>
                        </div>
                        <small class="text-success fw-bold mt-2 d-block"><i class="fa-solid fa-arrow-up"></i> 1.4% Since last month</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 fs-6">Active Sessions</p>
                                <h3 class="fw-bold mb-0">23,342</h3>
                            </div>
                            <div class="stat-icon bg-light-success"><i class="fa-solid fa-globe"></i></div>
                        </div>
                        <small class="text-success fw-bold mt-2 d-block"><i class="fa-solid fa-arrow-up"></i> 5.2% Since last month</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 fs-6">Total Orders</p>
                                <h3 class="fw-bold mb-0">1,542</h3>
                            </div>
                            <div class="stat-icon bg-light-warning"><i class="fa-solid fa-bag-shopping"></i></div>
                        </div>
                        <small class="text-danger fw-bold mt-2 d-block"><i class="fa-solid fa-arrow-down"></i> 0.8% Since last month</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 fs-6">Pending Issues</p>
                                <h3 class="fw-bold mb-0">12</h3>
                            </div>
                            <div class="stat-icon bg-light-danger"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        </div>
                        <small class="text-muted mt-2 d-block">Requires attention</small>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-lg-8">
                    <div class="card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold m-0">Sales Analytics</h5>
                            <select class="form-select form-select-sm w-auto border-0 bg-light">
                                <option>This Year</option>
                                <option>Last Year</option>
                            </select>
                        </div>
                        <canvas id="salesChart" height="120"></canvas>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card p-4 h-100">
                        <h5 class="fw-bold mb-4">Traffic Source</h5>
                        <canvas id="trafficChart" height="200"></canvas>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted"><i class="fa-solid fa-circle text-primary fs-6 me-2"></i>Direct</span>
                                <span class="fw-bold">55%</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted"><i class="fa-solid fa-circle text-info fs-6 me-2"></i>Social</span>
                                <span class="fw-bold">30%</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted"><i class="fa-solid fa-circle text-secondary fs-6 me-2"></i>Referral</span>
                                <span class="fw-bold">15%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card p-4">
                        <h5 class="fw-bold mb-3">Project Status</h5>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Budget</th>
                                        <th>Status</th>
                                        <th>Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:35px; height:35px;">V</div>
                                                <div>
                                                    <span class="d-block fw-bold text-dark">Volkswagen</span>
                                                    <small class="text-muted">Automotive</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-bold">$2,322</td>
                                        <td><span class="badge-soft-success">Completed</span></td>
                                        <td>07 Nov 2025</td>
                                        <td><button class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fa-solid fa-ellipsis"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:35px; height:35px;">L</div>
                                                <div>
                                                    <span class="d-block fw-bold text-dark">Land Rover</span>
                                                    <small class="text-muted">Automotive</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-bold">$12,022</td>
                                        <td><span class="badge-soft-warning">In Progress</span></td>
                                        <td>08 Nov 2025</td>
                                        <td><button class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fa-solid fa-ellipsis"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:35px; height:35px;">B</div>
                                                <div>
                                                    <span class="d-block fw-bold text-dark">Bentley</span>
                                                    <small class="text-muted">Luxury</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-bold">$8,725</td>
                                        <td><span class="badge-soft-success">Completed</span></td>
                                        <td>11 Jun 2025</td>
                                        <td><button class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fa-solid fa-ellipsis"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
    });

    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Online Sales',
                data: [12000, 19000, 3000, 5000, 2000, 30000, 45000],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { borderDash: [2, 4] } }, x: { grid: { display: false } } } }
    });

    const trafficCtx = document.getElementById('trafficChart').getContext('2d');
    new Chart(trafficCtx, {
        type: 'doughnut',
        data: {
            labels: ['Direct', 'Social', 'Referral'],
            datasets: [{ data: [55, 30, 15], backgroundColor: ['#2563eb', '#06b6d4', '#64748b'], borderWidth: 0 }]
        },
        options: { responsive: true, cutout: '75%', plugins: { legend: { display: false } } }
    });
</script>
</body>
</html>
@endsection