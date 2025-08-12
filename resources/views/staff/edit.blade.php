@extends('layouts.app')

@section('title', 'Edit Staff Member: ' . $staff->first_name . ' ' . $staff->last_name)

@section('content')
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-1">
                    <i class="bi bi-person-gear"></i> Edit {{ $staff->first_name }} {{ $staff->last_name }}
                </h1>
                <p class="mb-0">Update the details of this team member</p>
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
                    <h5 class="mb-0">
                        <i class="bi bi-person-lines-fill me-2"></i> Staff Information
                    </h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Please fix the following errors:</h6>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('staff.update', $staff) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <h5 class="section-title">
                                <i class="bi bi-person me-2"></i> Personal Information
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                           id="first_name" name="first_name" value="{{ old('first_name', $staff->first_name) }}" 
                                           placeholder="Enter first name" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                           id="last_name" name="last_name" value="{{ old('last_name', $staff->last_name) }}" 
                                           placeholder="Enter last name" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="section-title">
                                <i class="bi bi-envelope me-2"></i> Contact Information
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $staff->email) }}" 
                                           placeholder="Enter email address" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $staff->phone) }}" 
                                           placeholder="Enter phone number" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="section-title">
                                <i class="bi bi-briefcase me-2"></i> Job Information
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                           id="position" name="position" value="{{ old('position', $staff->position) }}" 
                                           placeholder="e.g., Software Developer, Manager" required>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                    <select class="form-select @error('department') is-invalid @enderror" 
                                            id="department" name="department" required>
                                        <option value="">Select Department</option>
                                        <option value="IT" {{ old('department', $staff->department) == 'IT' ? 'selected' : '' }}>IT</option>
                                        <option value="HR" {{ old('department', $staff->department) == 'HR' ? 'selected' : '' }}>HR</option>
                                        <option value="Finance" {{ old('department', $staff->department) == 'Finance' ? 'selected' : '' }}>Finance</option>
                                        <option value="Marketing" {{ old('department', $staff->department) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                        <option value="Sales" {{ old('department', $staff->department) == 'Sales' ? 'selected' : '' }}>Sales</option>
                                        <option value="Operations" {{ old('department', $staff->department) == 'Operations' ? 'selected' : '' }}>Operations</option>
                                        <option value="Customer Service" {{ old('department', $staff->department) == 'Customer Service' ? 'selected' : '' }}>Customer Service</option>
                                    </select>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="salary" class="form-label">Salary <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">RM</span>
                                        <input type="number" step="0.01" min="0" class="form-control @error('salary') is-invalid @enderror" 
                                               id="salary" name="salary" value="{{ old('salary', $staff->salary) }}" 
                                               placeholder="Enter annual salary" required>
                                        @error('salary')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="hire_date" class="form-label">Hire Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('hire_date') is-invalid @enderror" 
                                           id="hire_date" name="hire_date" value="{{ old('hire_date', $staff->hire_date->format('Y-m-d')) }}" 
                                           required>
                                    @error('hire_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="active" {{ old('status', $staff->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $staff->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('staff.show', $staff) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-eye me-1"></i> View Profile
                            </a>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Update Staff Member
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')       

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection