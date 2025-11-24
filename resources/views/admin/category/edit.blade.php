@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit category</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.categories') }}">

                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories') }}">
                            <div class="text-tiny">categorys</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit category</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.categories.update', $category->id) }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <fieldset class="name">
                        <div class="body-title">category Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="category name" name="name" tabindex="0"
                            value="{{ old('name', $category->name) }}" aria-required="true" required="">
                    </fieldset>
                    @error('name')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">category Slug <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="category Slug" name="slug" tabindex="0"
                            value="{{ old('slug', $category->slug) }}" aria-required="true" required="">
                    </fieldset>
                    @error('slug')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview"
                                @if ($category->image) style="display:block" @else style="display:none" @endif>
                                <img src="{{ $category->image_url }}" class="effect8" alt="Preview">
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                            browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('image')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit" name="submit" value="save">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // تحديث slug تلقائي
            $("input[name='name']").on("input", function() {
                const slug = $(this).val()
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, "-")
                    .replace(/[^\w\-]+/g, "")
                    .replace(/\-\-+/g, "-");
                $("input[name='slug']").val(slug);
            });

            // معاينة الصورة
            const photoInp = $("#myFile");
            const imgPreview = $("#imgpreview");
            const imgTag = $("#imgpreview img");

            // عرض الصورة القديمة أولاً
            @if ($category->image)
                imgTag.attr("src", "{{ Storage::url($category->image) }}");
                imgTag.attr("alt", "{{ $category->name }}");
                imgPreview.show();
            @endif

            // لو المستخدم رفع صورة جديدة
            if (photoInp.length) {
                photoInp.on("change", function() {
                    const [file] = this.files;
                    if (file) {
                        imgTag.attr("src", URL.createObjectURL(file));
                        imgPreview.show();
                    }
                });
            }
        });
    </script>
@endpush
