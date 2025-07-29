@extends('layout')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Admin Dashboard</h1>


    <div class="row g-4">
        <!-- Users Card -->
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-sm ">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Total Users</h5>
                            <h2>{{ $totalUsers }}</h2>
                            <p class="card-text">Registered Users</p>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Total Products</h5>
                            <h2>{{ $totalProducts }}</h2>
                            <p class="card-text">Available Products</p>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-box-seam" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm ">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Total Orders</h5>
                            <h2>{{ $totalorder }}</h2>
                            <p class="card-text">Orders Placed</p>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-cart-check-fill" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Revenue</h5>
                            <h2>₹{{ number_format($totalrevenue, 2) }}</h2>
                            <p class="card-text">Total Revenue</p>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-currency-rupee" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mt-4">
        <div class="card text-light bg-info shadow-sm">
            <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Users Comment</h5>
                            <h2>{{ $totalcomment }}</h2>
                            <p class="card-text">Total Products</p>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-chat" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
{{-- <div class="row g-4 mt-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Orders by Status
            </div>
            <div class="card-body">
                <canvas id="ordersStatusChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                Revenue (Last 6 Months)
            </div>
            <div class="card-body">
                <canvas id="monthlyRevenueChart"></canvas>
            </div>
        </div>
    </div> --}}
</div>

@endsection

@section('scripts')
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

@endsection
<!-- Chart.js -->
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ordersStatusCtx = document.getElementById('ordersStatusChart').getContext('2d');
    const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');

// Data from backend
const ordersByStatus = @json($ordersByStatus);
const monthlyRevenue = @json($monthlyRevenue);

// Orders Status Pie
new Chart(ordersStatusCtx, {
    type: 'pie',
    data: {
        labels: Object.keys(ordersByStatus),
        datasets: [{
            data: Object.values(ordersByStatus),
            backgroundColor: ['#ffc107', '#28a745', '#dc3545'],
        }]
    },
    options: {
        responsive: true
    }
});

// Monthly Revenue Bar
new Chart(monthlyRevenueCtx, {
    type: 'bar',
    data: {
        labels: Object.keys(monthlyRevenue),
        datasets: [{
            label: 'Revenue (₹)',
            data: Object.values(monthlyRevenue),
            backgroundColor: '#17a2b8'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script> --}}

