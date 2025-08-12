@extends('layouts.app')

@section('title', 'Staff Member: ' . $staff->first_name . ' ' . $staff->last_name)

@section('content')
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-1">
                    <i class="bi bi-person-badge"></i> {{ $staff->first_name }} {{ $staff->last_name }}
                </h1>
                <p class="mb-0">
                    <span class="badge bg-{{ $staff->status == 'active' ? 'success' : 'warning' }}">
                        {{ ucfirst($staff->status) }}
                    </span>
                    <span class="ms-2">{{ $staff->position }}</span>
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('staff.index') }}" class="btn btn-light">
                    <i class="bi bi-arrow-left"></i> Back to Staff List
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-person-lines-fill me-2"></i> Staff Profile
                        </h5>
                        <div class="btn-group">
                            <a href="{{ route('staff.edit', $staff) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="avatar mx-auto mb-3" style="width: 120px; height: 120px; background-color: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-person-fill" style="font-size: 3rem; color: #6c757d;"></i>
                            </div>
                            <h4>{{ $staff->first_name }} {{ $staff->last_name }}</h4>
                            <p class="text-muted mb-2">{{ $staff->position }}</p>
                            <p class="text-primary mb-0">{{ $staff->department }} Department</p>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <h5 class="section-title">
                                        <i class="bi bi-person me-2"></i> Personal Information
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <p class="mb-1 text-muted">First Name</p>
                                            <p class="fw-medium">{{ $staff->first_name }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p class="mb-1 text-muted">Last Name</p>
                                            <p class="fw-medium">{{ $staff->last_name }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <h5 class="section-title">
                                        <i class="bi bi-envelope me-2"></i> Contact Information
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <p class="mb-1 text-muted">Email</p>
                                            <p class="fw-medium">
                                                <a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a>
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p class="mb-1 text-muted">Phone</p>
                                            <p class="fw-medium">{{ $staff->phone }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <h5 class="section-title">
                                        <i class="bi bi-briefcase me-2"></i> Job Information
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <p class="mb-1 text-muted">Position</p>
                                            <p class="fw-medium">{{ $staff->position }}</p>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <p class="mb-1 text-muted">Department</p>
                                            <p class="fw-medium">{{ $staff->department }}</p>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <p class="mb-1 text-muted">Status</p>
                                            <p class="fw-medium">
                                                <span class="badge bg-{{ $staff->status == 'active' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($staff->status) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p class="mb-1 text-muted">Salary</p>
                                            <p class="fw-medium">RM{{ number_format($staff->salary, 2) }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p class="mb-1 text-muted">Hire Date</p>
                                            <p class="fw-medium">{{ $staff->hire_date->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back to List
                        </a>
                        <a href="{{ route('staff.edit', $staff) }}" class="btn btn-primary">
                            <i class="bi bi-pencil me-1"></i> Edit Profile
                        </a>
                        <form action="{{ route('staff.destroy', $staff) }}" method="POST" style="display: inline;" 
                              onsubmit="return confirm('Are you sure you want to delete this staff member?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection