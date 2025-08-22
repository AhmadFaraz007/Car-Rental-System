@extends('layouts.master')

@section('modals')  <!-- Moved modals section outside main layout -->

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Book This Car</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="car-info-container">
                            <img id="modalCarImage" src="" class="img-fluid mb-3" alt="Car Image">
                            <h4 id="modalCarName"></h4>
                            <p id="modalCarModel"></p>
                            <p id="modalCarPrice"></p>
                            <p id="modalCarDescription"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}">
                            @csrf
                            <input type="hidden" id="car_id" name="car_id" value="">
                            
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="client_name" name="client_name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="cnic" class="form-label">CNIC</label>
                                <input type="text" class="form-control" id="cnic" name="cnic" placeholder="XXXXX-XXXXXXX-X" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age" min="18" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="days" class="form-label">Number of Days</label>
                                <input type="number" class="form-control" id="days" name="days" min="1" required>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="hidden" name="driving_license" value="0">
                                <input type="checkbox" class="form-check-input" id="driving_license" name="driving_license" value="1" required>
                                <label class="form-check-label" for="driving_license">I have a valid driving license</label>
                            </div>
                            
                            <div class="mb-3">
                                <label for="total_amount" class="form-label">Total Amount (Rs.)</label>
                                <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Proceed</button>
                            </div>
                            <input type="hidden" id="owner_name" value="">
                            <input type="hidden" id="owner_contact" value="">
                            <input type="hidden" id="car_name" value="">
                            <input type="hidden" id="car_model" value="">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('title', 'Available Cars')

@section('styles')
<style>
.cars-container {
    padding: 20px;
    width: 100%;
}

.cars-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 30px;
    justify-content: flex-start;
}

.car-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease;
    width: calc(33.333% - 14px); /* 3 cards per row with gap */
    min-height: 400px;
    box-sizing: border-box;
}

.car-image-container {
    height: 200px;
    overflow: hidden;
}

.car-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.car-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.car-card:hover .car-image {
    transform: scale(1.05);
}

.car-details {
    padding: 15px;
}

.car-name {
    font-size: 1.2rem;
    margin-bottom: 5px;
    color: #333;
}

.car-model {
    color: #666;
    margin-bottom: 10px;
}

.car-price {
    font-weight: bold;
    color: #e63946;
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.car-description {
    color: #555;
    margin-bottom: 15px;
}

.book-now-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.book-now-btn:hover {
    background-color: #0056b3;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .car-card {
        width: calc(50% - 10px); /* 2 cards per row on medium screens */
    }
}

@media (max-width: 768px) {
    .car-card {
        width: 100%; /* 1 card per row on small screens */
    }
    
    .modal-body .car-info-container {
        border-right: none;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
        padding-bottom: 20px;
    }
}

/* Modal styles remain the same */
.modal {
    z-index: 1060;
}

.modal-content {
    max-height: 90vh;
    overflow-y: auto;
}

#total_amount {
    font-weight: bold;
    font-size: 1.2rem;
}

.is-invalid {
    border-color: #dc3545;
}
</style>
@endsection

@section('content')
<div class="cars-container">
    <h2 class="page-title">Available Cars for Rent</h2>
    
    <div class="cars-list">
        @foreach($cars as $car)
        <div class="car-card">
            <div class="car-image-container">
                <img src="{{ $car->image_link }}" alt="{{ $car->name }}" class="car-image" onerror="this.src='https://via.placeholder.com/300x200?text=Car+Image'">
            </div>
            <div class="car-details">
                <h3 class="car-name">{{ $car->name }}</h3>
                <p class="car-model">{{ $car->model }}</p>
                <p class="car-price">Rs {{ number_format($car->rent_price, 2) }}/day</p>
                <p class="car-description">{{ Str::limit($car->description, 100) }}</p>
                <button class="book-now-btn" 
                    data-bs-toggle="modal" 
                    data-bs-target="#bookingModal"
                    data-car-id="{{ $car->id }}"
                    data-car-name="{{ $car->name }}"
                    data-car-model="{{ $car->model }}"
                    data-owner-name="{{ $car->owner_name }}"
                    data-owner-contact="{{ $car->owner_contact }}">
                    Book Now
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
    // Initialize modal properly
    var bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
    
    // When book now button is clicked
    $('.book-now-btn').click(function() {
        var carId = $(this).data('car-id');
        var carCard = $(this).closest('.car-card');


        
        // Set car ID in the form
        $('#car_id').val(carId);
        
        // Populate car details in modal
        $('#modalCarName').text(carCard.find('.car-name').text());
        $('#modalCarModel').text(carCard.find('.car-model').text());
        $('#modalCarPrice').text(carCard.find('.car-price').text());
        $('#modalCarDescription').text(carCard.find('.car-description').text());
        $('#owner_name').val($(this).data('owner-name'));
        $('#owner_contact').val($(this).data('owner-contact'));
        $('#car_name').val($(this).data('car-name'));
        $('#car_model').val($(this).data('car-model'));
        
        // Set car image
        var carImage = carCard.find('.car-image').attr('src');
        $('#modalCarImage').attr('src', carImage);
        
        // Calculate initial total amount
        var priceText = carCard.find('.car-price').text();
        var pricePerDay = parseFloat(priceText.replace(/[^0-9.]/g, ''));
        $('#days').val(1); // Default to 1 day
        $('#total_amount').val(pricePerDay.toFixed(2));
        
        // Show modal
        bookingModal.show();
    })
    });
document.addEventListener('DOMContentLoaded', function() {
    // When modal is about to be shown
    var bookingModal = document.getElementById('bookingModal');
    bookingModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var carCard = button.closest('.car-card');
        
        // Extract car data
        var carId = button.getAttribute('data-car-id');
        var carName = carCard.querySelector('.car-name').textContent;
        var carModel = carCard.querySelector('.car-model').textContent;
        var carPrice = carCard.querySelector('.car-price').textContent;
        var carDescription = carCard.querySelector('.car-description').textContent;
        var carImage = carCard.querySelector('.car-image').src;
        
        // Update modal content
        document.getElementById('modalCarName').textContent = carName;
        document.getElementById('modalCarModel').textContent = carModel;
        document.getElementById('modalCarPrice').textContent = carPrice;
        document.getElementById('modalCarDescription').textContent = carDescription;
        document.getElementById('modalCarImage').src = carImage;
        document.getElementById('car_id').value = carId;
        
        // Calculate initial price
        var pricePerDay = parseFloat(carPrice.replace(/[^0-9.]/g, ''));
        document.getElementById('days').value = 1;
        document.getElementById('total_amount').value = pricePerDay.toFixed(2);
    });
    
    // Calculate total when days change
    document.getElementById('days').addEventListener('input', function() {
        var days = this.value;
        var priceText = document.getElementById('modalCarPrice').textContent;
        var pricePerDay = parseFloat(priceText.replace(/[^0-9.]/g, ''));
        var total = days * pricePerDay;
        document.getElementById('total_amount').value = total.toFixed(2);
    });
    
    // CNIC validation
    document.getElementById('cnic').addEventListener('input', function() {
        var cnic = this.value;
        var isValid = /^\d{5}-\d{7}-\d{1}$/.test(cnic);
        if (!isValid && cnic.length > 0) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });
});

$('#bookingForm').submit(function(event) {
    event.preventDefault(); // Prevent default form submission

    const form = $(this);
    const formData = form.serialize(); // Serialize all form data

    // Extract WhatsApp related fields
    const ownerName = $('#owner_name').val();
    const ownerContact = $('#owner_contact').val().replace(/[^0-9]/g, '');
    const carName = $('#car_name').val();
    const carModel = $('#car_model').val();

    // WhatsApp message
    const message = encodeURIComponent(`Hi ${ownerName}, I want to rent your car ${carName} (${carModel}). Can you tell me more details?`);
    const whatsappUrl = `https://wa.me/${ownerContact}?text=${message}`;

    // AJAX form submission
    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: formData,
        success: function(response) {
            // Open WhatsApp in new tab
            window.open(whatsappUrl, '_blank');

            // Redirect after short delay to let WhatsApp open
            setTimeout(() => {
                window.location.href = "{{ route('Rentalcars') }}"; // Replace with your actual route
            }, 1000);
        },
        error: function(xhr) {
            alert('Booking failed. Please try again.');
            console.error(xhr.responseText);
        }
    });
});


</script>
@endsection


@section('styles')
<style>
.cars-container {
    padding: 20px;
    width: 100%;
}

.cars-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 30px;
    justify-content: flex-start;
}

.car-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease;
    width: calc(33.333% - 14px); /* 3 cards per row with gap */
    min-height: 400px;
    box-sizing: border-box;
}

.car-image-container {
    height: 200px;
    overflow: hidden;
}

.car-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.car-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.car-card:hover .car-image {
    transform: scale(1.05);
}

.car-details {
    padding: 15px;
}

.car-name {
    font-size: 1.2rem;
    margin-bottom: 5px;
    color: #333;
}

.car-model {
    color: #666;
    margin-bottom: 10px;
}

.car-price {
    font-weight: bold;
    color: #e63946;
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.car-description {
    color: #555;
    margin-bottom: 15px;
}

.book-now-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.book-now-btn:hover {
    background-color: #0056b3;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .car-card {
        width: calc(50% - 10px); /* 2 cards per row on medium screens */
    }
}

@media (max-width: 768px) {
    .car-card {
        width: 100%; /* 1 card per row on small screens */
    }
    
    .modal-body .car-info-container {
        border-right: none;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
        padding-bottom: 20px;
    }
}

/* Modal styles remain the same */
.modal {
    z-index: 1060;
}

.modal-content {
    max-height: 90vh;
    overflow-y: auto;
}

#total_amount {
    font-weight: bold;
    font-size: 1.2rem;
}

.is-invalid {
    border-color: #dc3545;
}

.cars-list {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 20px;
}

.car-card {
    width: 100%; /* Full width on mobile by default */
    min-height: 380px; /* Slightly reduced for mobile */
    margin-bottom: 15px;
}

/* Small devices (landscape phones, 576px and up) */
@media (min-width: 576px) {
    .car-card {
        width: calc(50% - 8px); /* 2 cards per row */
    }
}

/* Medium devices (tablets, 768px and up) */
@media (min-width: 768px) {
    .car-card {
        width: calc(33.33% - 10px); /* 3 cards per row */
    }
}

/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .car-card {
        width: calc(25% - 12px); /* 4 cards per row */
    }
}

@media (max-width: 576px) {
    .mobile-carousel {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }
    .car-card {
        flex: 0 0 80%; /* Show most of one card at a time */
        scroll-snap-align: start;
        margin-right: 15px;
    }
}
</style>
@endsection
