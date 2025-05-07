@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <h1 class="text-3xl font-bold text-gray-800">Welcome Back, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-600 mt-2">Your Travel Memory Statistics</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="stat-card bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center">
                <div class="stat-icon bg-blue-100 p-3 rounded-lg mr-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800">127</div>
                    <div class="text-gray-600">Total Memories</div>
                </div>
            </div>
        </div>

        <div class="stat-card bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center">
                <div class="stat-icon bg-green-100 p-3 rounded-lg mr-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800">42</div>
                    <div class="text-gray-600">Countries Visited</div>
                </div>
            </div>
        </div>

        <div class="stat-card bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center">
                <div class="stat-icon bg-purple-100 p-3 rounded-lg mr-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800">892</div>
                    <div class="text-gray-600">Photos Uploaded</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions mt-8 bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('memories.create') }}" class="action-card bg-blue-50 p-4 rounded-lg hover:bg-blue-100 transition-colors">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span class="font-medium">Add New Memory</span>
                </div>
            </a>
            <a href="{{ route('memories.index') }}" class="action-card bg-green-50 p-4 rounded-lg hover:bg-green-100 transition-colors">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                    <span class="font-medium">View All Memories</span>
                </div>
            </a>
            <a href="{{ route('map') }}" class="action-card bg-purple-50 p-4 rounded-lg hover:bg-purple-100 transition-colors">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="font-medium">View Memory Map</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Memories Timeline -->
    <div class="recent-memories mt-8 bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Memories</h2>
        <div class="space-y-4">
            @for ($i = 0; $i < 3; $i++)
            <div class="memory-item bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-medium text-gray-800">Santorini Sunset Experience</h3>
                        <p class="text-sm text-gray-600">Added 2 days ago</p>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500 mr-2">Oia, Greece</span>
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-2 text-gray-600">Captured the beautiful sunset over the iconic blue-domed churches...</div>
            </div>
            @endfor
        </div>
    </div>

    <!-- Memory Statistics Chart -->
    <div class="chart-container mt-8 bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Memory Statistics</h2>
        <div class="w-full h-64">
            <canvas id="memoryChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sample chart data
        const ctx = document.getElementById('memoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Memories Created',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#3B82F6',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush

@endsection
