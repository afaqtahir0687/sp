@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit FAQ</h1>
        <a href="{{ route('admin.faqs.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Back to FAQs</a>
    </div>


    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Question (English)</label>
                    <input type="text" name="question_en" class="form-control" value="{{ old('question_en', $faq->question_en) }}" required>
                </div>
                <div class="form-group">
                    <label>Question (Arabic)</label>
                    <input type="text" name="question_ar" class="form-control" value="{{ old('question_ar', $faq->question_ar) }}" required dir="rtl">
                </div>
                <div class="form-group">
                    <label>Answer (English)</label>
                    <textarea name="answer_en" class="form-control" rows="5" required>{{ old('answer_en', $faq->answer_en) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Answer (Arabic)</label>
                    <textarea name="answer_ar" class="form-control" rows="5" required dir="rtl">{{ old('answer_ar', $faq->answer_ar) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $faq->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $faq->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update FAQ</button>
            </form>
        </div>
    </div>
</div>
@endsection

