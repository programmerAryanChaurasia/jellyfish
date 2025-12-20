@extends('admin.layouts.app')

@section('title', 'Add New Section')
@section('page-title', 'Add New Home Page Section')
@section('page-subtitle', 'Create a new section for your landing page')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    Section Details
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.home-page.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="section_name" class="form-label">Section Type *</label>
                            <select class="form-control @error('section_name') is-invalid @enderror" 
                                    id="section_name" name="section_name" required>
                                <option value="">Select Section Type</option>
                                @foreach($sectionTypes as $key => $label)
                                    <option value="{{ $key }}" {{ old('section_name') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('section_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="sort_order" class="form-label">Display Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" 
                                   min="0" max="100">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Lower numbers display first</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Section Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}"
                               placeholder="Enter section title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="5"
                                  placeholder="Enter section content">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">You can use HTML tags for formatting</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="button_text" class="form-label">Button Text</label>
                            <input type="text" class="form-control @error('button_text') is-invalid @enderror" 
                                   id="button_text" name="button_text" value="{{ old('button_text') }}"
                                   placeholder="e.g., Learn More, Get Started">
                            @error('button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="button_link" class="form-label">Button Link</label>
                            <input type="text" class="form-control @error('button_link') is-invalid @enderror" 
                                   id="button_link" name="button_link" value="{{ old('button_link') }}"
                                   placeholder="e.g., /about, https://example.com">
                            @error('button_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Image Upload</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2" id="imagePreview" style="display: none;">
                            <img id="previewImage" src="" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (Show this section on the home page)
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Save Section
                        </button>
                        <a href="{{ route('admin.home-page') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Section Types Guide
                </h5>
            </div>
            <div class="card-body">
                <div class="accordion" id="sectionGuide">
                    @foreach($sectionTypes as $key => $label)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" 
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}">
                                {{ $label }}
                            </button>
                        </h2>
                        <div id="collapse{{ $key }}" class="accordion-collapse collapse" 
                             data-bs-parent="#sectionGuide">
                            <div class="accordion-body">
                                @php
                                    $descriptions = [
                                        'hero' => 'Main banner section with large image and call-to-action.',
                                        'welcome' => 'Welcome message section introducing your website.',
                                        'services' => 'List of services or features with icons.',
                                        'team' => 'Team members section with photos and descriptions.',
                                        'about' => 'About us or philosophy section.',
                                        'contact' => 'Contact information and social media links.',
                                        'footer' => 'Footer content with copyright and links.',
                                        'testimonial' => 'Customer testimonials and reviews.',
                                        'cta' => 'Call to action section to encourage conversions.',
                                        'custom' => 'Custom section for unique content.'
                                    ];
                                @endphp
                                {{ $descriptions[$key] ?? 'Custom content section.' }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .accordion-button:not(.collapsed) {
        background-color: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
    }
    
    #imagePreview {
        border: 2px dashed #dee2e6;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
    }
</style>

<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewImage');
        const previewContainer = document.getElementById('imagePreview');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
@endsection