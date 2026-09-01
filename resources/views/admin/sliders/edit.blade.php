@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Slider</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($slider->image)
                        <img src="{{ asset('storage/app/public/' . $slider->image) }}" width="100" class="mt-2">
                    @endif
                </div>
                <div class="form-group">
                    <label>Title (English)</label>
                    <input type="text" name="title_en" class="form-control" value="{{ $slider->title_en }}">
                </div>
                <div class="form-group">
                    <label>Title (Arabic)</label>
                    <input type="text" name="title_ar" class="form-control" value="{{ $slider->title_ar }}" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Subtitle (English)</label>
                    <input type="text" name="subtitle_en" class="form-control" value="{{ $slider->subtitle_en }}">
                </div>
                <div class="form-group">
                    <label>Subtitle (Arabic)</label>
                    <input type="text" name="subtitle_ar" class="form-control" value="{{ $slider->subtitle_ar }}" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Offer Text (English)</label>
                    <input type="text" name="offer_text_en" class="form-control" value="{{ $slider->offer_text_en }}">
                </div>
                <div class="form-group">
                    <label>Offer Text (Arabic)</label>
                    <input type="text" name="offer_text_ar" class="form-control" value="{{ $slider->offer_text_ar }}" dir="rtl">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link</label>
                            <input type="text" name="link" class="form-control" value="{{ $slider->link }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Text Color</label>
                            <div class="d-flex align-items-center">
                                <input type="color" name="text_color" class="form-control mr-2" value="{{ $slider->text_color ?? '#ffffff' }}" style="width: 60px; padding: 2px; height: 38px;">
                                <input type="text" id="text_color_hex" class="form-control" placeholder="#ffffff" value="{{ $slider->text_color ?? '#ffffff' }}" oninput="this.previousElementSibling.value = this.value">
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const colorInput = document.querySelector('input[type="color"][name="text_color"]');
                                    const hexInput = document.getElementById('text_color_hex');
                                    if(colorInput && hexInput) {
                                        colorInput.addEventListener('input', function() {
                                            hexInput.value = this.value;
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $slider->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $slider->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
