@extends('admin.layouts.app')
@section('title', 'Manage Home Page')

@section('content')

<div class="container-fluid p-5">
    <h4 class="mb-4">Home Page Management</h4>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('admin.home.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- ================= HERO SLIDER ================= -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5>Hero Slider</h5>
                <button type="button" class="btn btn-sm btn-primary" onclick="addSlider()">+ Add Slide</button>
            </div>
            <div class="card-body" id="sliderRepeater">
                @php
                    $heroSliders = $sections['hero_slider']->content['sliders'] ?? [['heading' => '', 'sub_heading' => '', 'image' => '']];
                @endphp
                
                @foreach($heroSliders as $index => $slider)
                <div class="slider-item border p-3 mb-3">
                    <input type="hidden" name="hero_slider[{{ $index }}][id]" value="{{ $slider['id'] ?? '' }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Heading</label>
                                <input type="text" name="hero_slider[{{ $index }}][heading]" 
                                       class="form-control" value="{{ $slider['heading'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Heading</label>
                                <input type="text" name="hero_slider[{{ $index }}][sub_heading]" 
                                       class="form-control" value="{{ $slider['sub_heading'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Background Image</label>
                                <input type="file" name="hero_slider_images[{{ $index }}]" class="form-control">
                                @if(!empty($slider['image']))
                                    <small class="text-muted">
                                        Current: <a href="{{ Storage::url($slider['image']) }}" target="_blank">View</a>
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">Remove</button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ================= JUMBOTRON ================= -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Jumbotron Section</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="jumbotron_description" class="form-control ck-editor" rows="4">
                        {{ $sections['jumbotron']->content['description'] ?? '' }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label>Button Text</label>
                    <input type="text" name="jumbotron_button_text" class="form-control" 
                           value="{{ $sections['jumbotron']->content['button_text'] ?? '' }}">
                </div>
            </div>
        </div>

        <!-- ================= BUILT WITH EASE ================= -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Built With Ease Section</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Section Heading</label>
                    <input type="text" name="built_with_ease_heading" class="form-control" 
                           value="{{ $sections['built_with_ease']->content['heading'] ?? 'Built with ease.' }}">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="built_with_ease_description" class="form-control ck-editor" rows="4">
                        {{ $sections['built_with_ease']->content['description'] ?? '' }}
                    </textarea>
                </div>
            </div>
        </div>

        <!-- ================= SERVICES ================= -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5>Services Section</h5>
                <button type="button" class="btn btn-sm btn-primary" onclick="addService()">+ Add Service</button>
            </div>
            <div class="card-body" id="serviceRepeater">
                @php
                    $services = $sections['services']->content['services'] ?? [['icon' => '', 'title' => '', 'description' => '']];
                @endphp
                
                @foreach($services as $index => $service)
                <div class="service-item border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Icon Class</label>
                                <input type="text" name="services[{{ $index }}][icon]" class="form-control" 
                                       placeholder="fas fa-code" value="{{ $service['icon'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="services[{{ $index }}][title]" class="form-control" 
                                       value="{{ $service['title'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="services[{{ $index }}][description]" 
                                          class="form-control ck-editor" rows="3">{{ $service['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">Remove</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ================= TEAM ================= -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5>Team Section</h5>
                <button type="button" class="btn btn-sm btn-primary" onclick="addTeam()">+ Add Member</button>
            </div>
            <div class="card-body" id="teamRepeater">
                @php
                    $teamMembers = $sections['team']->content['members'] ?? [['name' => '', 'description' => '', 'image' => '']];
                @endphp
                
                @foreach($teamMembers as $index => $member)
                <div class="team-item border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="team[{{ $index }}][name]" class="form-control" 
                                       value="{{ $member['name'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="team[{{ $index }}][description]" 
                                          class="form-control ck-editor" rows="3">{{ $member['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Profile Image</label>
                                <input type="file" name="team_images[{{ $index }}]" class="form-control">
                                @if(!empty($member['image']))
                                    <small class="text-muted">
                                        Current: <a href="{{ Storage::url($member['image']) }}" target="_blank">View</a>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">X</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ================= PHILOSOPHY ================= -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Philosophy Section</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="philosophy_description" class="form-control ck-editor" rows="5">
                        {{ $sections['philosophy']->content['description'] ?? '' }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="philosophy_image" class="form-control">
                    @if(!empty($sections['philosophy']->images['main_image']))
                        <small class="text-muted">
                            Current: <a href="{{ Storage::url($sections['philosophy']->images['main_image']) }}" target="_blank">View</a>
                        </small>
                    @endif
                </div>
            </div>
        </div>

        <!-- ================= SAVE ================= -->
        <div class="text-right">
            <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
    </form>
</div>

@endsection
@push('scripts')
<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

<script>
    // Map to store CKEditor instances
    const editorInstances = new Map();
    let sliderCount = {{ count($heroSliders ?? []) }};
    let serviceCount = {{ count($services ?? []) }};
    let teamCount = {{ count($teamMembers ?? []) }};

    /* Initialize CKEditor for specific textarea */
    function initCKEditor(textareaId) {
        const textarea = document.getElementById(textareaId);
        if (!textarea || editorInstances.has(textareaId)) {
            return;
        }
        
        ClassicEditor.create(textarea)
            .then(editor => {
                editorInstances.set(textareaId, editor);
            })
            .catch(error => console.error(error));
    }

    /* Initialize all existing CKEditors */
    function initExistingCKEditors() {
        document.querySelectorAll('.ck-editor').forEach((textarea, index) => {
            // Generate unique ID for each textarea if not exists
            if (!textarea.id) {
                textarea.id = 'ckeditor-' + Date.now() + '-' + index;
            }
            initCKEditor(textarea.id);
        });
    }

    /* Remove Repeater Item */
    function removeItem(btn) {
        btn.closest('.border').remove();
    }

    /* Add Slider */
    function addSlider() {
        const index = sliderCount++;
        const sliderContainer = document.getElementById('sliderRepeater');
        sliderContainer.insertAdjacentHTML('beforeend', `
        <div class="slider-item border p-3 mb-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Heading</label>
                        <input type="text" name="hero_slider[${index}][heading]" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sub Heading</label>
                        <input type="text" name="hero_slider[${index}][sub_heading]" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Background Image</label>
                        <input type="file" name="hero_slider_images[${index}]" class="form-control">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">Remove</button>
        </div>`);
    }

    /* Add Service */
    function addService() {
        const index = serviceCount++;
        const textareaId = 'service-desc-' + Date.now() + '-' + index;
        const serviceContainer = document.getElementById('serviceRepeater');
        
        serviceContainer.insertAdjacentHTML('beforeend', `
        <div class="service-item border p-3 mb-3">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Icon Class</label>
                        <input type="text" name="services[${index}][icon]" class="form-control" placeholder="fas fa-code">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="services[${index}][title]" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="${textareaId}" name="services[${index}][description]" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">Remove</button>
                </div>
            </div>
        </div>`);
        
        // Initialize CKEditor for the new textarea
        setTimeout(() => initCKEditor(textareaId), 100);
    }

    /* Add Team */
    function addTeam() {
        const index = teamCount++;
        const textareaId = 'team-desc-' + Date.now() + '-' + index;
        const teamContainer = document.getElementById('teamRepeater');
        
        teamContainer.insertAdjacentHTML('beforeend', `
        <div class="team-item border p-3 mb-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="team[${index}][name]" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="${textareaId}" name="team[${index}][description]" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Profile Image</label>
                        <input type="file" name="team_images[${index}]" class="form-control">
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">X</button>
                </div>
            </div>
        </div>`);
        
        // Initialize CKEditor for the new textarea
        setTimeout(() => initCKEditor(textareaId), 100);
    }

    /* Initialize on page load */
    document.addEventListener('DOMContentLoaded', function() {
        initExistingCKEditors();
    });
</script>

<style>
    .ck-editor__editable {
        min-height: 120px;
    }
</style>
@endpush