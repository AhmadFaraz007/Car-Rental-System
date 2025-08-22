<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog Management</title>
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
        .blog-card {
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <!-- Stats Section -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            <!-- Total Blogs Card -->
            <div class="bg-blue-100 p-6 rounded-lg shadow transition-all hover:shadow-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Total Blogs</h3>
                <div id="totalBlogsCounter" class="text-3xl font-bold text-blue-600">{{ $blogs->count() }}</div>
            </div>
            
            <!-- Dashboard Button Card -->
            <div class="bg-purple-100 p-6 rounded-lg shadow transition-all hover:shadow-lg flex items-center justify-center">
                <a href="/dashboard" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    Return to Dashboard
                </a>
            </div>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Blog Management</h2>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" 
                    data-bs-toggle="modal" data-bs-target="#blogModal"
                    onclick="prepareAddForm()">
                + Add New Blog
            </button>
        </div>
        
        <!-- Success/Error Messages -->
        <div id="successMessage" class="hidden mb-4 px-4 py-3 rounded bg-green-100 text-green-800 font-semibold"></div>
        <div id="errorMessage" class="hidden mb-4 px-4 py-3 rounded bg-red-100 text-red-800 font-semibold"></div>

        <!-- Blogs List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($blogs as $blog)
            <div class="blog-card bg-white border rounded-lg overflow-hidden">
                @if($blog->main_pic)
                <img src="{{ asset('storage/' . $blog->main_pic) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2">{{ $blog->title }}</h3>
                    <p class="text-gray-600 mb-3">{{ Str::limit($blog->content, 100) }}</p>
                    <div class="text-sm text-gray-500 mb-4">
                        <div>Written by: {{ $blog->written_by }}</div>
                        <div>Created: {{ $blog->created_at->format('M d, Y') }}</div>
                        <div>Updated: {{ $blog->updated_at->format('M d, Y') }}</div>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded" 
                                onclick="prepareEditForm({{ $blog->toJson() }})"
                                data-bs-toggle="modal" data-bs-target="#blogModal">
                            Edit
                        </button>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded" 
                                onclick="deleteBlog({{ $blog->id }})">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Blog Modal -->
    <div class="modal fade" id="blogModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add New Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="blogForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="formMethod"></div>
                    
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="blogTitle" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Written By</label>
                            <input type="text" name="written_by" id="writtenBy" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" id="blogContent" class="form-control" rows="6" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Main Image</label>
                            <input type="file" name="main_pic" id="mainPic" class="form-control">
                            <div id="currentImage" class="mt-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize modal
    const blogModal = new bootstrap.Modal(document.getElementById('blogModal'));
    let currentOperation = 'create'; // Track current operation
    
    function prepareAddForm() {
        currentOperation = 'create';
        document.getElementById('modalTitle').textContent = 'Add New Blog';
        document.getElementById('blogForm').action = "{{ route('blogs.store') }}";
        document.getElementById('formMethod').innerHTML = '';
        document.getElementById('blogTitle').value = '';
        document.getElementById('writtenBy').value = '';
        document.getElementById('blogContent').value = '';
        document.getElementById('mainPic').required = true;
        document.getElementById('currentImage').innerHTML = '';
    }
    
    function prepareEditForm(blog) {
        console.log('Editing blog:', blog);
        currentOperation = 'update';
        document.getElementById('modalTitle').textContent = 'Edit Blog';
        document.getElementById('blogForm').action = `/blogs/${blog.id}`;
        document.getElementById('formMethod').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('blogTitle').value = blog.title || '';
        document.getElementById('writtenBy').value = blog.written_by || '';
        document.getElementById('blogContent').value = blog.content || '';
        document.getElementById('mainPic').required = false;

        
        
        // Show current image if exists
        if (blog.main_pic) {
            document.getElementById('currentImage').innerHTML = `
                <p class="text-sm text-gray-500">Current Image:</p>
                <img src="/storage/${blog.main_pic}" class="h-20 mt-1">
                <input type="hidden" name="current_image" value="${blog.main_pic}">
            `;
        } else {
            document.getElementById('currentImage').innerHTML = '';
        }
    }
    
    function deleteBlog(id) {
        if (confirm("Are you sure you want to delete this blog?")) {
            const deleteBtn = document.querySelector(`[onclick="deleteBlog(${id})"]`);
            const originalText = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Deleting...';
            deleteBtn.disabled = true;
            
            fetch(`/blogs/${id}`, {
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(async response => {
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    throw new Error(`Expected JSON, got: ${text.substring(0, 100)}...`);
                }
                return response.json();
            })
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message || 'Delete failed');
                }
                
                // Remove the blog card from UI
                const blogCard = document.querySelector(`[onclick="prepareEditForm(${id})"]`)?.closest('.blog-card');
                if (blogCard) {
                    blogCard.remove();
                }
                
                // Update counter
                const totalCounter = document.getElementById('totalBlogsCounter');
                totalCounter.textContent = parseInt(totalCounter.textContent) - 1;
                
                showSuccessMessage(data.message || "Blog deleted successfully!");
            })
            .catch(error => {
                console.error("Error:", error);
                showErrorMessage(error.message || "Failed to delete blog");
            })
            .finally(() => {
                deleteBtn.innerHTML = originalText;
                deleteBtn.disabled = false;
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
    
    // Handle form submission via AJAX
    document.getElementById('blogForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        const url = form.action;
        const method = form.querySelector('input[name="_method"]')?.value || 'POST';
        const submitBtn = document.getElementById('submitBtn');
        const originalBtnText = submitBtn.innerHTML;
        
        // Set loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Processing...';
        
        try {
            const response = await fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                const text = await response.text();
                throw new Error(`Expected JSON, got: ${text.substring(0, 100)}...`);
            }

            const data = await response.json();
            
            if (!response.ok) {
                // Handle validation errors
                if (data.errors) {
                    const errorMessages = Object.entries(data.errors)
                        .map(([field, messages]) => `${messages.join(', ')}`)
                        .join('\n');
                    throw new Error(errorMessages);
                }
                throw new Error(data.message || 'Operation failed');
            }

            // Success handling
            showSuccessMessage(data.message || 
                (currentOperation === 'create' ? 'Blog created successfully!' : 'Blog updated successfully!'));
            
            // Close modal and refresh content
            blogModal.hide();
            
            // Refresh the page after a short delay
            setTimeout(() => window.location.reload(), 1500);
            
        } catch (error) {
            console.error("Error:", error);
            showErrorMessage(error.message || 
                (currentOperation === 'create' ? 'Failed to create blog' : 'Failed to update blog'));
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        }
    });

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
</body>
</html>