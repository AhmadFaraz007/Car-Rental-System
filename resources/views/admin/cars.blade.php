<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cars List</title>
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
                /* Add this to your existing style block */
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
        <div class="grid grid-cols-3 gap-4 mb-8">
            <!-- Total Cars Card -->
            <div class="bg-blue-100 p-6 rounded-lg shadow transition-all hover:shadow-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Total Cars</h3>
                <div id="totalCarsCounter" class="text-3xl font-bold text-blue-600">0</div>
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
            <h2 class="text-3xl font-bold text-gray-800">Cars List</h2>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" data-bs-toggle="modal" data-bs-target="#addCarModal">+ Add New Car</button>
        </div>
        <div id="successMessage" class="hidden mb-4 px-4 py-3 rounded bg-green-100 text-green-800 font-semibold"></div>


        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Car Name</th>
                        <th class="py-3 px-6 text-left">Model</th>
                        <th class="py-3 px-6 text-left">Rent Price</th>
                        <th class="py-3 px-6 text-left">Description</th>
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-left">Owner Name</th>
                        <th class="py-3 px-6 text-left">Owner Contact</th>
                        <th class="py-3 px-6 text-left">Created at</th>
                        <th class="py-3 px-6 text-left">Updated at</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody id="carTableBody">
                    @foreach($cars as $car)
                    <tr id="carRow-{{ $car->id }}" class="border-b">
                        <td class="py-3 px-6">{{ $car->id }}</td>
                        <td class="py-3 px-6">{{ $car->name }}</td>
                        <td class="py-3 px-6">{{ $car->model }}</td>
                        <td class="py-3 px-6">{{ $car->rent_price }}</td>
                        <td class="py-3 px-6">{{ \Illuminate\Support\Str::words($car->description, 4, '...') }}</td>
                        <td class="py-3 px-6">
                        <img src="{{ asset($car->image_link) }}" alt="Car Image" class="w-20 h-20 object-cover rounded">
                        </td>
                        <td class="py-3 px-6">{{ $car->owner_name }}</td>
                        <td class="py-3 px-6">{{ $car->owner_contact }}</td>
                        <td class="py-3 px-6">{{ $car->created_at }}</td>
                        <td class="py-3 px-6">{{ $car->updated_at }}</td>
                        <td class="py-3 px-6">
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded" onclick="openEditModal({{ $car->id }}, '{{ $car->name }}', '{{ $car->model }}', {{ $car->rent_price }}, '{{ $car->description }}', '{{ $car->image_link }}','{{ $car->owner_name }}','{{ $car->owner_contact }}')">Edit</button>
                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded" onclick="deleteCar({{ $car->id }})">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Car Modal -->
    <div class="modal fade" id="addCarModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addCarForm" method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Car</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="text" name="name" class="form-control mb-2" required placeholder="Car Name">
                        <input type="text" name="model" class="form-control mb-2" required placeholder="Model">
                        <input type="number" name="rent_price" class="form-control mb-2" required placeholder="Rent Price">
                        <input type="textarea" name="description" class="form-control mb-2" required placeholder="Description">
                        <label for="image">Car Image</label>
                        <input type="file" name="image_link" accept="image/*">
                        <input type="text" name="owner_name" class="form-control mb-2" required placeholder="Owner Name">
                        <input type="text" name="owner_contact" class="form-control mb-2" required placeholder="Owner Contact">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Car</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Car Modal -->
    <div class="modal fade" id="editCarModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editCarForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Car</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="edit-id">
                        <input type="text" name="name" id="edit-name" class="form-control mb-2" required>
                        <input type="text" name="model" id="edit-model" class="form-control mb-2" required>
                        <input type="number" name="rent_price" id="edit-rent_price" class="form-control mb-2" required>
                        <input type="textarea" name="description" id="edit-description" class="form-control mb-2" required>
                        <label for="image">Car Image</label>
                        <img id="edit-preview" class="w-20 h-20 object-cover mb-2 rounded">
                        <input type="file" name="image_link" id="edit-image_link"  accept="image/*">
                        <input type="text" name="owner_name" id="edit-owner_name" class="form-control mb-2" required>
                        <input type="text" name="owner_contact" id="edit-owner_contact" class="form-control mb-2" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       document.getElementById("addCarForm").addEventListener("submit", function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        fetch("/cars", {
            method: "POST",
            headers: { 'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value },
            body: formData
        })
        .then(res => res.json())
        .then(car => {
            // 1. Close modal
            const modalElement = document.getElementById('addCarModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();


            // 2. Clear form
            form.reset();

            // 3. Add new row to table
            const tbody = document.getElementById("carTableBody");
            const row = document.createElement("tr");
            row.id = `carRow-${car.id}`;
            row.innerHTML = `
                <td class="py-3 px-6">${car.id}</td>
                <td class="py-3 px-6">${car.name}</td>
                <td class="py-3 px-6">${car.model}</td>
                <td class="py-3 px-6">${car.rent_price}</td>
                <td class="py-3 px-6">${car.description}</td>
                <td class="py-3 px-6"><img src="${car.image_link}" class="w-20 h-20 object-cover rounded" /></td>
                <td class="py-3 px-6">${car.owner_name}</td>
                <td class="py-3 px-6">${car.owner_contact}</td>
                <td class="py-3 px-6">${car.created_at ?? '-'}</td>
                <td class="py-3 px-6">${car.updated_at ?? '-'}</td>
                <td class="py-3 px-6">
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded" onclick="openEditModal(${car.id}, '${car.name}', '', '${car.model}', 2020, '')">Edit</button>
                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded" onclick="deleteCar(${car.id})">Delete</button>
                </td>
            `;
            tbody.appendChild(row);
            showSuccessMessage("Car added successfully!");
        })
        .catch(err => console.error("Error:", err));
    });

document.getElementById("editCarForm").addEventListener("submit", async function(e) {
    e.preventDefault();
    
    const form = this;
    const id = document.getElementById("edit-id").value;
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.textContent;
    
    try {
        // Disable button during submission
        submitBtn.disabled = true;
        submitBtn.textContent = "Updating...";
        
        const formData = new FormData(form);
        formData.append("_method", "PUT");
        
        // Log form data for debugging
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }
        
        const response = await fetch(`/cars/${id}`, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Update failed with status ' + response.status);
        }

        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('editCarModal'));
        modal.hide();

        // Update the table row
        updateCarRow(data);
        
        showSuccessMessage("Car updated successfully!");
    } catch (error) {
        console.error('Update error:', error);
        alert(`Error: ${error.message}`);
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = originalBtnText;
    }
});

function updateCarRow(car) {
    const row = document.getElementById(`carRow-${car.id}`);
    if (!row) return;

    // Helper function to escape quotes for HTML attributes
    const escapeHtml = (str) => String(str).replace(/"/g, '&quot;');
    
    row.innerHTML = `
        <td class="py-3 px-6">${car.id}</td>
        <td class="py-3 px-6">${car.name}</td>
        <td class="py-3 px-6">${car.model}</td>
        <td class="py-3 px-6">${car.rent_price}</td>
        <td class="py-3 px-6">${car.description}</td>
        <td class="py-3 px-6"><img src="${car.image_link}" class="w-20 h-20 object-cover rounded" /></td>
        <td class="py-3 px-6">${car.owner_name}</td>
        <td class="py-3 px-6">${car.owner_contact}</td>
        <td class="py-3 px-6">${car.created_at || '-'}</td>
        <td class="py-3 px-6">${car.updated_at || '-'}</td>
        <td class="py-3 px-6">
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded" 
                onclick="openEditModal(
                    ${car.id}, 
                    '${car.name.replace(/'/g, "\\'")}', 
                    '${car.model.replace(/'/g, "\\'")}', 
                    ${car.rent_price}, 
                    '${car.description.replace(/'/g, "\\'")}', 
                    '${car.image_link.replace(/'/g, "\\'")}',
                    '${car.owner_name.replace(/'/g, "\\'")}',
                    '${car.owner_contact.replace(/'/g, "\\'")}'
                )">Edit</button>
            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded" onclick="deleteCar(${car.id})">Delete</button>
        </td>
    `;
}



        function openEditModal(id, name, model, rent_price, description, image_link, owner_name, owner_contact) {
            document.getElementById("edit-id").value = id;
            document.getElementById("edit-name").value = name;
            document.getElementById("edit-model").value = model;
            document.getElementById("edit-rent_price").value = rent_price;
            document.getElementById("edit-description").value = description;
            document.getElementById("edit-preview").src = image_link;
            document.getElementById("edit-owner_name").value = owner_name;
            document.getElementById("edit-owner_contact").value = owner_contact;
            
            new bootstrap.Modal(document.getElementById("editCarModal")).show();
        }

        function deleteCar(id) {
            if (confirm("Are you sure you want to delete this car?")) {
                fetch(`/cars/${id}`, {
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Delete failed');
                    return res.json();
                })
                .then(() => {
                    document.getElementById(`carRow-${id}`).remove();
                    showSuccessMessage("Car deleted successfully!");
                })
                .catch(error => alert(error.message));
            }
        }

        function showSuccessMessage(message) {
            const msgDiv = document.getElementById("successMessage");
            msgDiv.textContent = message;
            msgDiv.classList.remove("hidden");
    
            // Hide after 6 seconds
            setTimeout(() => {
            msgDiv.classList.add("hidden");
            }, 6000);
}

    // Animation for counters
    document.addEventListener('DOMContentLoaded', function() {
        const totalCars = {{ count($cars) }};
        const totalRevenue = totalCars * 1500;
        
        // Animate total cars counter
        animateCounter('totalCarsCounter', totalCars);
        
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
