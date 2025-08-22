<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ece9e6, #ffffff);
        }
        .table-hover tbody tr:hover {
            background-color: #f3f4f6;
        }
        .modal-content {
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .transition-all {
            transition: all 0.3s ease;
        }
        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <!-- New Stats Section -->
        <div class="grid grid-cols-3 gap-4 mb-8">
            <!-- Total Bookings Card -->
            <div class="bg-blue-100 p-6 rounded-lg shadow transition-all hover:shadow-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Total Clients</h3>
                <div id="totalClientsCounter" class="text-3xl font-bold text-blue-600">0</div>
            </div>
            
            <!-- Total Revenue Card -->
            <div class="bg-green-100 p-6 rounded-lg shadow transition-all hover:shadow-lg">
                <h3 class="text-lg font-semibold text-green-800 mb-2">Total Revenue (PKR)</h3>
                <div id="totalRevenueCounter" class="text-3xl font-bold text-green-600">0</div>
            </div>
            
            <!-- Dashboard Button Card -->
            <div class="bg-purple-100 p-6 rounded-lg shadow transition-all hover:shadow-lg flex items-center justify-center">
                <a href="/dashboard" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    Return to Dashboard
                </a>
            </div>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">All Bookings</h2>
        </div>

        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 font-semibold">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">Car ID</th>
                        <th class="py-3 px-6 text-left">Client Name</th>
                        <th class="py-3 px-6 text-left">CNIC</th>
                        <th class="py-3 px-6 text-left">Gender</th>
                        <th class="py-3 px-6 text-left">Age</th>
                        <th class="py-3 px-6 text-left">Days</th>
                        <th class="py-3 px-6 text-left">License</th>
                        <th class="py-3 px-6 text-left">Total Amount</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-6">{{ $booking->car_id }}</td>
                            <td class="py-3 px-6">{{ $booking->client_name }}</td>
                            <td class="py-3 px-6">{{ $booking->cnic }}</td>
                            <td class="py-3 px-6">{{ ucfirst($booking->gender) }}</td>
                            <td class="py-3 px-6">{{ $booking->age }}</td>
                            <td class="py-3 px-6">{{ $booking->days }}</td>
                            <td class="py-3 px-6">{{ $booking->driving_license ? 'Yes' : 'No' }}</td>
                            <td class="py-3 px-6">Rs. {{ number_format($booking->total_amount) }}</td>
                            <td class="py-3 px-6">
                                <form action="{{ route('client.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this booking?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-4 px-6 text-center text-gray-500">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation for counters
        document.addEventListener('DOMContentLoaded', function() {
            const totalClients = {{ count($bookings) }};
            const totalRevenue = {{ $bookings->sum('total_amount') }};
            
            // Animate total clients counter
            animateCounter('totalClientsCounter', totalClients);
            
            // Animate total revenue counter
            animateCounter('totalRevenueCounter', totalRevenue);
        });
        
        function animateCounter(elementId, finalValue) {
            let current = 0;
            const increment = finalValue / 50;
            const element = document.getElementById(elementId);
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= finalValue) {
                    clearInterval(timer);
                    current = finalValue;
                }
                element.textContent = Math.floor(current).toLocaleString();
            }, 20);
        }
    </script>
</body>
</html>