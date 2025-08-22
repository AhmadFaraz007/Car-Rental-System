<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Messages</title>
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
        .message-preview {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
            display: inline-block;
        }
        .whatsapp-btn {
            background-color: #25D366;
            color: white;
        }
        .whatsapp-btn:hover {
            background-color: #128C7E;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <!-- Stats Section -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            <!-- Total Messages Card -->
            <div class="bg-blue-100 p-6 rounded-lg shadow transition-all hover:shadow-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Total Messages</h3>
                <div id="totalMessagesCounter" class="text-3xl font-bold text-blue-600">0</div>
            </div>
            
            <!-- Dashboard Button Card -->
            <div class="bg-purple-100 p-6 rounded-lg shadow transition-all hover:shadow-lg flex items-center justify-center">
                <a href="/dashboard" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    Return to Dashboard
                </a>
            </div>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Messages</h2>
        </div>
        <div id="successMessage" class="hidden mb-4 px-4 py-3 rounded bg-green-100 text-green-800 font-semibold"></div>
        <div id="errorMessage" class="hidden mb-4 px-4 py-3 rounded bg-red-100 text-red-800 font-semibold"></div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Sender Name</th>
                        <th class="py-3 px-6 text-left">Contact</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Message</th>
                        <th class="py-3 px-6 text-left">Received At</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody id="messagesTableBody">
                    @foreach($messages as $message)
                    <tr id="messageRow-{{ $message->id }}" class="border-b">
                        <td class="py-3 px-6">{{ $message->id }}</td>
                        <td class="py-3 px-6 font-medium">{{ $message->sender_name }}</td>
                        <td class="py-3 px-6">{{ $message->sender_contact }}</td>
                        <td class="py-3 px-6">{{ $message->sender_gmail }}</td>
                        <td class="py-3 px-6">
                            <span class="message-preview" title="{{ $message->message }}">
                                {{ Str::limit($message->message, 12) }}
                            </span>
                        </td>
                        <td class="py-3 px-6">{{ $message->created_at->format('M d, Y H:i') }}</td>
                        <td class="py-3 px-6">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2" 
                                    onclick="showMessageModal('{{ $message->sender_name }}', '{{ $message->sender_contact }}', '{{ $message->sender_gmail }}', `{{ $message->message }}`, '{{ $message->created_at->format('M d, Y H:i') }}')">
                                View
                            </button>
                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded" 
                                    onclick="deleteMessage({{ $message->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Message View Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalTitle">Message Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <div class="mb-3">
                                <strong>From:</strong> <span id="modalSenderName"></span>
                            </div>
                            <div class="mb-3">
                                <strong>Contact:</strong> <span id="modalSenderContact"></span>
                            </div>
                            <div class="mb-3">
                                <strong>Email:</strong> <span id="modalSenderEmail"></span>
                            </div>
                            <div class="mb-3">
                                <strong>Received:</strong> <span id="modalReceivedAt"></span>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <div class="mb-3">
                                <strong>Original Message:</strong>
                                <p id="modalMessageContent" class="mt-2 p-3 bg-gray-100 rounded"></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h6 class="font-semibold mb-2">Reply via WhatsApp:</h6>
                        <div class="input-group mb-3">
                            <textarea id="whatsappReplyMessage" class="form-control" placeholder="Type your reply here..." rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn whatsapp-btn" onclick="sendWhatsAppReply()">
                        <i class="fab fa-whatsapp mr-2"></i> Send via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        // Initialize modal
        const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        let currentContact = '';
        
        // Animation for counters
        document.addEventListener('DOMContentLoaded', function() {
            const totalMessages = {{ $messages->count() }};
            
            // Animate total messages counter
            animateCounter('totalMessagesCounter', totalMessages);
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

        function showMessageModal(name, contact, email, message, receivedAt) {
            document.getElementById('modalSenderName').textContent = name;
            document.getElementById('modalSenderContact').textContent = contact;
            document.getElementById('modalSenderEmail').textContent = email;
            document.getElementById('modalMessageContent').textContent = message;
            document.getElementById('modalReceivedAt').textContent = receivedAt;
            document.getElementById('whatsappReplyMessage').value = '';
            currentContact = contact;
            messageModal.show();
        }

        function sendWhatsAppReply() {
            const replyMessage = document.getElementById('whatsappReplyMessage').value.trim();
            if (!replyMessage) {
                showErrorMessage("Please enter a reply message");
                return;
            }

            // Clean the phone number (remove non-numeric characters)
            const cleanedPhone = currentContact.replace(/\D/g, '');
            
            // Create WhatsApp link
            const whatsappUrl = `https://wa.me/${cleanedPhone}?text=${encodeURIComponent(replyMessage)}`;
            
            // Open in new tab
            window.open(whatsappUrl, '_blank');
            
            // Close modal
            messageModal.hide();
            
            showSuccessMessage("WhatsApp reply initiated!");
        }

        
        function deleteMessage(id) {
            if (confirm("Are you sure you want to delete this message?")) {
                fetch(`/messages/${id}`, {
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw new Error(err.message || 'Delete failed'); });
                    }
                    return response.json();
                })
                .then(data => {
                    const row = document.getElementById(`messageRow-${id}`);
                    if (row) {
                        row.remove();
                        
                        // Update counter
                        const totalCounter = document.getElementById('totalMessagesCounter');
                        totalCounter.textContent = parseInt(totalCounter.textContent) - 1;
                        
                        showSuccessMessage(data.message || "Message deleted successfully!");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    showErrorMessage(error.message || "Failed to delete message");
                });
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

        function showErrorMessage(message) {
            const msgDiv = document.getElementById("errorMessage");
            msgDiv.textContent = message;
            msgDiv.classList.remove("hidden");
    
            // Hide after 6 seconds
            setTimeout(() => {
                msgDiv.classList.add("hidden");
            }, 6000);
        }
    </script>
</body>
</html>