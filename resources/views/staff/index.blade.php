@extends('layouts.app')

@section('title', 'Staff Management Dashboard')

@section('content')
<div class="page-header">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h1 class="mb-1">
                    <i class="bi bi-people-fill"></i> Staff Management
                </h1>
                <p class="mb-0">Manage your organization's workforce efficiently</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #0056b3 0%, #003366 100%);">
                        <i class="bi bi-people"></i>
                        <h3>{{ $staff->total() }}</h3>
                        <p class="mb-0">Total Staff</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                        <i class="bi bi-check-circle"></i>
                        <h3>{{ $staff->where('status', 'active')->count() }}</h3>
                        <p class="mb-0">Active Staff</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                        <i class="bi bi-pause-circle"></i>
                        <h3>{{ $staff->where('status', 'inactive')->count() }}</h3>
                        <p class="mb-0">Inactive Staff</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);">
                        <i class="bi bi-building"></i>
                        <h3>{{ $staff->pluck('department')->unique()->count() }}</h3>
                        <p class="mb-0">Departments</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('staff.create') }}" class="btn btn-accent">
                    <i class="bi bi-person-plus"></i> Add New Staff
                </a>
            </div>
            
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-list-ul me-2"></i> Staff Directory
                    </h5>
                    <div class="d-flex align-items-center">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" class="form-control" 
                                   placeholder="Search staff..." id="searchInput">
                            <button class="btn btn-outline-secondary" type="button" id="searchButton">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($staff->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover" id="staffTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($staff as $member)
                                    <tr>
                                        <td>{{ $member->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-3" style="width: 40px; height: 40px; background-color: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-person-fill" style="font-size: 1.2rem; color: #6c757d;"></i>
                                                </div>
                                                <div>
                                                    <strong>{{ $member->first_name }} {{ $member->last_name }}</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->position }}</td>
                                        <td>{{ $member->department }}</td>
                                        <td>
                                            <span class="badge bg-{{ $member->status == 'active' ? 'success' : 'warning' }}">
                                                {{ ucfirst($member->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('staff.show', $member) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('staff.edit', $member) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('staff.destroy', $member) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $staff->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4" style="font-size: 3rem; color: #dee2e6;">
                                <i class="bi bi-people"></i>
                            </div>
                            <h4 class="text-muted">No Staff Members Found</h4>
                            <p class="text-muted mb-4">Get started by adding your first staff member</p>
                            <a href="{{ route('staff.create') }}" class="btn btn-primary">
                                <i class="bi bi-person-plus"></i> Add Staff Member
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const rows = document.querySelectorAll('#staffTable tbody tr');
        
        function performSearch() {
            const input = searchInput.value.toLowerCase();
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? '' : 'none';
            });
        }        

        searchInput.addEventListener('keyup', performSearch);      

        searchButton.addEventListener('click', performSearch);       

        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });       
 
        searchInput.addEventListener('search', function() {
            if (this.value === '') {
                performSearch();
            }
        });
    });
</script>
@endsection