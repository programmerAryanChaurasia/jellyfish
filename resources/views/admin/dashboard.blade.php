{{--@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Welcome to Admin Panel</h5>
            </div>
            <div class="card-body">
                <p>You are logged in as <strong>{{ Auth::user()->role }}</strong>.</p>
                <p>Your permissions:</p>
                <ul>
                    @if(Auth::user()->role === 'admin')
                        <li>Full admin dashboard access</li>
                        <li>Role management</li>
                        <li>Home page management</li>
                    @elseif(Auth::user()->role === 'editor')
                        <li>Home page management only</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection --}}




@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Dashboard</h1>
        <p class="text-muted mb-0">Welcome back, {{ Auth::user()->name }}</p>
    </div>
    <div class="role-badge px-3 py-2 rounded bg-{{ Auth::user()->role === 'admin' ? 'danger' : 'warning' }}">
        <i class="fas fa-user-shield me-1"></i>
        {{ ucfirst(Auth::user()->role) }}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Admin Panel Overview
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <p class="mb-3">
                            You are logged in as <span class="badge bg-{{ Auth::user()->role === 'admin' ? 'danger' : 'warning' }} px-3 py-2">{{ Auth::user()->role }}</span>.
                        </p>
                        
                        <p class="fw-medium mb-2">Your permissions:</p>
                        <div class="permissions-list">
                            @if(Auth::user()->role === 'admin')
                            <div class="permission-item d-flex align-items-center mb-2 p-2 rounded bg-light">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span>Full admin dashboard access</span>
                            </div>
                            <div class="permission-item d-flex align-items-center mb-2 p-2 rounded bg-light">
                                <i class="fas fa-users-cog text-primary me-3"></i>
                                <span>Role management</span>
                            </div>
                            <div class="permission-item d-flex align-items-center mb-2 p-2 rounded bg-light">
                                <i class="fas fa-home text-info me-3"></i>
                                <span>Home page management</span>
                            </div>
                            @elseif(Auth::user()->role === 'editor')
                            <div class="permission-item d-flex align-items-center p-2 rounded bg-light">
                                <i class="fas fa-edit text-warning me-3"></i>
                                <span>Home page management only</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="role-icon p-4 rounded-circle bg-{{ Auth::user()->role === 'admin' ? 'danger' : 'warning' }} bg-opacity-10 d-inline-block">
                            @if(Auth::user()->role === 'admin')
                            <i class="fas fa-crown fa-3x text-danger"></i>
                            @else
                            <i class="fas fa-user-edit fa-3x text-warning"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 1.5rem;
        border-radius: 10px;
        margin-top: 1rem;
    }
    
    .role-badge {
        font-weight: 600;
        color: white;
    }
    
    .card {
        border-radius: 12px;
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .permission-item {
        transition: all 0.3s;
        border-left: 3px solid transparent;
    }
    
    .permission-item:hover {
        transform: translateX(5px);
        background: #f1f5f9 !important;
        border-left-color: #4f46e5;
    }
    
    .role-icon {
        transition: transform 0.3s;
    }
    
    .role-icon:hover {
        transform: scale(1.05);
    }
</style>
@endsection
