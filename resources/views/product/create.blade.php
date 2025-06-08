@extends('base')
@section('content')
<div class="main-form min-h-screen py-8 px-4 pb-5">
<div class="container mx-auto max-w-4xl">
<div class="text-center mb-8 pt-5">
<div class="header-icon">
<span class="plus-icon">+</span>
</div>
<h1 class="main-title">Add New Product</h1>
</div>

    <div class="form-container">
        <div class="form-content">
            <form action="{{ route('insert_product') }}" method="POST" enctype="multipart/form-data" class="form-grid">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-input @error('name') error @enderror"
                           id="name" name="name" value="{{ old('name') }}" placeholder="Enter product name" required>
                    @error('name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="form-input @error('description') error @enderror"
                              placeholder="Describe your product features, benefits, and specifications...">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-input @error('category_id') error @enderror">
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select a category</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->category_id }}" {{ old('category_id') == $cat->category_id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price" class="form-label">Price (Rp)</label>
                        <input type="number" name="price" id="price" class="form-input @error('price') error @enderror"
                               value="{{ old('price') }}" placeholder="0" required>
                        @error('price')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="stock" class="form-label">Stock Quantity</label>
                        <input type="number" name="stock" id="stock" class="form-input @error('stock') error @enderror"
                               value="{{ old('stock') }}" placeholder="0" required>
                        @error('stock')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image_url" class="form-label">Product Image</label>
                        <div class="file-upload-container">
                            <input type="file" name="image_url" id="image_url" class="file-input @error('image_url') error @enderror" accept="image/*" required>
                            <label for="image_url" class="file-label flex items-center justify-center">
                                <span class="file-label-text">Choose Image File</span>
                                <div class="image-preview-wrapper absolute top-0 left-0 w-full h-full overflow-hidden rounded-md">
                                    <img id="image_preview" src="#" alt="Image Preview" style="display: none; max-width: 200; max-height: 200px; object-fit: cover;">
                                </div>
                            </label>
                        </div>
                        @error('image_url')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="submit-section">
                    <button type="submit" class="btn-primary">
                        Add Product
                        <div class="btn-shine"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<style>
/* ... Semua CSS sebelumnya ... */
* {
box-sizing: border-box;
}
.main-form {
background: #f8f4ee;
position: relative;
font-family:  'Montserrat', Helvetica, sans-serif !important;
}
.container {
position: relative; z-index: 1;
max-width: 1200px; margin: 0 auto; padding: 0 20px;
}
/* Header Styles */
.text-center { text-align: center; }
.mb-8 { margin-bottom: 2rem; }
.header-icon {
display: inline-flex; align-items: center; justify-content: center;
width: 64px; height: 64px;
background: #f8f4ee; border-radius: 50%;
margin-bottom: 1rem; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}
.plus-icon { font-size: 24px; font-weight: bold; color: #92400e; }
.main-title {
font-size: 2.5rem; font-weight: 700;
background: linear-gradient(135deg, #92400e, #d97706);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text; margin: 0 0 0.5rem 0; font-family: playfair display;
}
/* Form Container */
.form-container {
background: white; border-radius: 24px;
box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
overflow: hidden; border: 1px solid #e5e7eb;
}
.form-content { padding: 2rem; }
.form-grid { display: flex; flex-direction: column; gap: 1.5rem; }
/* Form Groups */
.form-group { position: relative; animation: fadeInUp 0.6s ease forwards; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
.form-label {
display: flex; align-items: center;
font-weight: 600; color: #374151;
margin-bottom: 0.5rem; font-size: 0.875rem;
text-transform: uppercase; letter-spacing: 0.05em;
}
/* Form Inputs */
.form-input {
width: 100%; padding: 12px 16px;
border: 2px solid #e5e7eb; border-radius: 12px;
font-size: 1rem; transition: all 0.3s ease;
background-color: #ffffff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
font-family:  'Montserrat', Helvetica, sans-serif !important;
}
/* .form-input:focus {
outline: none; border-color: #f59e0b;
box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1);
transform: translateY(-1px);
}
.form-input.error {
border-color: #ef4444;
box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
} */
.form-input::placeholder { color: #9ca3af; }
textarea.form-input { resize: vertical; min-height: 120px; }
select.form-input {
cursor: pointer; appearance: none;
background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
background-position: right 12px center;
background-repeat: no-repeat; background-size: 16px;
padding-right: 40px;
}
/* File Upload */
.file-upload-container {
position: relative;
border: 2px dashed #d1d5db;
border-radius: 12px;
background-color: #f9fafb;
color: #6b7280;
font-weight: 500;
cursor: pointer;
transition: all 0.3s ease;
overflow: hidden; /* Ensures preview stays within the border-radius */
height: 200px; /* Atur lebar frame sesuai keinginan Anda */
}
.file-input {
position: absolute; opacity: 0;
width: 100%; height: 100%;
cursor: pointer; z-index: 2;
}
.file-label {
position: relative;
width: 100%;
min-height: 100px; /* Minimum height for the label */
}
.file-label-text {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
text-align: center;
}
.file-label:hover {
border-color: #f59e0b; background-color: #fffbeb;
color: #d97706;
}
.image-preview-wrapper {
display: none; /* Initially hidden */
}
.aspect-w-1 {
padding-bottom: 100%; /* 1:1 aspect ratio */
}
.aspect-h-1 {
height: 0; /* Required for aspect ratio to work */
}
/* Error Messages */
.error-message {
color: #ef4444; font-size: 0.875rem;
margin-top: 0.375rem; display: flex;
align-items: center;
}
.error-message::before { content: '⚠️'; margin-right: 0.375rem; }
/* Submit Section */
.submit-section {
padding-top: 1.5rem; border-top: 1px solid #e5e7eb;
margin-top: 1rem;
}
/* Primary Button */
.btn-primary {
position: relative; display: inline-flex;
align-items: center; justify-content: center;
width: 100%; padding: 16px 32px;
background:  #5c3c1d;
color: white; border: none; border-radius: 12px;
font-weight: 600; font-size: 1.1rem;
cursor: pointer; transition: all 0.3s ease;
box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
overflow: hidden; text-transform: uppercase;
letter-spacing: 0.05em; font-family: 'Montserrat', Helvetica, sans-serif !important;
}
.btn-primary:hover {
transform: translateY(-2px);
box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2), 0 4px 6px rgba(0, 0, 0, 0.1);
background:  rgb(169, 109, 48);
}
.btn-primary:hover .btn-shine { left: 100%; }
/* Responsive Design */
@media (max-width: 768px) {
.form-row { grid-template-columns: 1fr; gap: 1rem; }
}
/* Animation */
@keyframes fadeInUp {
from { opacity: 0; transform: translateY(30px); }
to { opacity: 1; transform: translateY(0); }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('image_url');
    const imagePreview = document.getElementById('image_preview');
    const previewWrapper = document.querySelector('.image-preview-wrapper');
    const fileLabelText = document.querySelector('.file-label-text');

    fileInput.addEventListener('change', function(event) {
        // Ambil file yang dipilih oleh user
        const file = event.target.files[0];

        if (file) {
            // Jika ada file, buat FileReader untuk membacanya
            const reader = new FileReader();

            // Saat file selesai dibaca, jalankan fungsi ini
            reader.onload = function(e) {
                // Tampilkan elemen gambar dan wrappernya
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                previewWrapper.style.display = 'block';

                // Sembunyikan teks "Choose Image File"
                if (fileLabelText) {
                    fileLabelText.style.display = 'none';
                }
            };

            // Baca file sebagai Data URL (format base64)
            reader.readAsDataURL(file);
        } else {
            // Jika tidak ada file yang dipilih (misal, user klik cancel)
            // Kembalikan ke keadaan semula
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
            previewWrapper.style.display = 'none';
            if (fileLabelText) {
                fileLabelText.style.display = 'block';
            }
        }
    });
});
</script>
@endsection