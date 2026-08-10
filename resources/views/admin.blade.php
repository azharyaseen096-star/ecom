<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f7f5f0;
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 60px 20px;
            color: #1a1a1a;
        }

        .form-wrapper {
            width: 100%;
            max-width: 540px;
        }

        /* Header */
        .form-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 32px;
        }

        .form-header-icon {
            width: 46px;
            height: 46px;
            background: #ffffff;
            border: 1px solid #ebe7e1;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .form-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.2;
        }

        .form-header p {
            font-size: 13px;
            color: #9a9590;
            margin-top: 3px;
            line-height: 1.4;
        }

        /* Card */
        .form-card {
            background: #ffffff;
            border: 1px solid #ebe7e1;
            border-radius: 16px;
            padding: 32px;
            transition: box-shadow 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 12px 32px rgba(26, 26, 26, 0.06);
        }

        /* Field Groups */
        .field-group {
            margin-bottom: 22px;
        }

        .field-group:last-of-type {
            margin-bottom: 28px;
        }

        .field-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }

        .field-input {
            width: 100%;
            padding: 12px 16px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #1a1a1a;
            background: #fafaf8;
            border: 1px solid #ebe7e1;
            border-radius: 10px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .field-input::placeholder {
            color: #bfbab4;
        }

        .field-input:focus {
            border-color: #c8956c;
            box-shadow: 0 0 0 3px rgba(200, 149, 108, 0.12);
        }

        textarea.field-input {
            resize: vertical;
            min-height: 110px;
            line-height: 1.6;
        }

        /* File Upload */
        .file-upload-area {
            border: 2px dashed #ebe7e1;
            border-radius: 12px;
            padding: 32px 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s ease, background 0.2s ease;
            position: relative;
            background: #fafaf8;
        }

        .file-upload-area:hover {
            border-color: #c8956c;
            background: #fdf8f3;
        }

        .file-upload-area.has-file {
            border-color: #1a1a1a;
            border-style: solid;
            background: #ffffff;
        }

        .file-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .file-upload-icon {
            width: 44px;
            height: 44px;
            background: #f7f5f0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }

        .file-upload-text {
            font-size: 14px;
            color: #1a1a1a;
            font-weight: 500;
        }

        .file-upload-hint {
            font-size: 12px;
            color: #9a9590;
            margin-top: 6px;
        }

        .file-name-display {
            display: none;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #1a1a1a;
        }

        .file-upload-area.has-file .file-upload-default {
            display: none;
        }

        .file-upload-area.has-file .file-name-display {
            display: flex;
        }

        .file-remove {
            width: 24px;
            height: 24px;
            background: #f7f5f0;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
            flex-shrink: 0;
        }

        .file-remove:hover {
            background: #ebe7e1;
        }

        /* Image Preview */
        .image-preview-wrap {
            display: none;
            margin-top: 14px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #ebe7e1;
            background: #f2efea;
            max-height: 200px;
        }

        .image-preview-wrap img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            display: block;
        }

        .file-upload-area.has-file ~ .image-preview-wrap {
            display: block;
        }

        /* Divider */
        .form-divider {
            height: 1px;
            background: #ebe7e1;
            margin: 28px 0;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 12px;
        }

        .btn-submit {
            flex: 1;
            padding: 13px 28px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            color: #ffffff;
            background: #1a1a1a;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            letter-spacing: 0.3px;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #c8956c;
        }

        .btn-reset {
            padding: 13px 24px;
            font-size: 14px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            color: #9a9590;
            background: transparent;
            border: 1px solid #ebe7e1;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-reset:hover {
            border-color: #1a1a1a;
            color: #1a1a1a;
        }

        /* Row layout */
        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 500px) {
            .field-row {
                grid-template-columns: 1fr;
            }
            .form-card {
                padding: 24px;
            }
        }
    </style>
</head>

<body>

<div class="form-wrapper">

    <!-- Header -->
    <div class="form-header">
        <div class="form-header-icon">
            <svg width="22" height="22" fill="none" stroke="#1a1a1a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
        </div>
        <div>
            <h1>Add Product</h1>
            <p>Fill in the details to add a new product</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">

        <form method="POST" action="/save-product" enctype="multipart/form-data" id="productForm">

            @csrf

            <!-- Name & Price Row -->
            <div class="field-row">
                <div class="field-group">
                    <label class="field-label">Product Name</label>
                    <input
                        type="text"
                        name="name"
                        class="field-input"
                        placeholder="e.g. Wireless Headphones"
                        required
                    >
                </div>
                <div class="field-group">
                    <label class="field-label">Price (Rs)</label>
                    <input
                        type="number"
                        name="price"
                        class="field-input"
                        placeholder="e.g. 2500"
                        min="0"
                        required
                    >
                </div>
            </div>

            <!-- Image Upload -->
            <div class="field-group">
                <label class="field-label">Product Image</label>
                <div class="file-upload-area" id="uploadArea">
                    <input type="file" name="image" id="fileInput" accept="image/*">

                    <div class="file-upload-default">
                        <div class="file-upload-icon">
                            <svg width="20" height="20" fill="none" stroke="#9a9590" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                        </div>
                        <p class="file-upload-text">Click to upload image</p>
                        <p class="file-upload-hint">PNG, JPG or WebP — max 2MB</p>
                    </div>

                    <div class="file-name-display">
                        <svg width="16" height="16" fill="none" stroke="#1a1a1a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                        <span id="fileName">file.jpg</span>
                        <button type="button" class="file-remove" id="removeFile" onclick="removeFileHandler(event)">
                            <svg width="12" height="12" fill="none" stroke="#9a9590" stroke-width="2" stroke-linecap="round" viewBox="0 0 24 24">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="image-preview-wrap" id="imagePreview">
                    <img id="previewImg" src="" alt="Preview">
                </div>
            </div>

            <!-- Description -->
            <div class="field-group">
                <label class="field-label">Description</label>
                <textarea
                    name="description"
                    class="field-input"
                    placeholder="Write a brief description about the product..."
                ></textarea>
            </div>

            <div class="form-divider"></div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Save Product
                </button>
                <button type="reset" class="btn-reset" onclick="resetForm()">
                    Clear
                </button>
            </div>

        </form>

    </div>

</div>

<script>
    const fileInput = document.getElementById('fileInput');
    const uploadArea = document.getElementById('uploadArea');
    const fileName = document.getElementById('fileName');
    const previewImg = document.getElementById('previewImg');

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            fileName.textContent = this.files[0].name;
            uploadArea.classList.add('has-file');

            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    function removeFileHandler(e) {
        e.stopPropagation();
        fileInput.value = '';
        uploadArea.classList.remove('has-file');
        previewImg.src = '';
    }

    function resetForm() {
        fileInput.value = '';
        uploadArea.classList.remove('has-file');
        previewImg.src = '';
    }
</script>

</body>

</html>