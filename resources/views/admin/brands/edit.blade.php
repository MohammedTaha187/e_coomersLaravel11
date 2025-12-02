@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Brand</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.brands') }}">
                            <div class="text-tiny">Brands</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit Brand</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form class="form-new-product form-style-1"
                      action="{{ route('admin.brands.update', $brand->id) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand name" name="name" tabindex="0"
                            value="{{ old('name', $brand->name) }}" aria-required="true" required="">
                    </fieldset>
                    @error('name')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Brand Slug <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand Slug" name="slug" tabindex="0"
                            value="{{ old('slug', $brand->slug) }}" aria-required="true" required="">
                    </fieldset>
                    @error('slug')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" @if($brand->image) style="display:block" @else style="display:none" @endif>
                                <img src="{{ $brand->image_url }}" class="effect8" alt="Preview">
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>
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

    const photoInp = $("#myFile");
    const imgPreview = $("#imgpreview");
    const imgTag = $("#imgpreview img");

    @if($brand->image)
        imgTag.attr("src", "{{ Storage::url($brand->image) }}");
        imgTag.attr("alt", "{{ $brand->name }}");
        imgPreview.show();
    @endif

    if(photoInp.length) {
        photoInp.on("change", function() {
            const [file] = this.files;
            if(file) {
                imgTag.attr("src", URL.createObjectURL(file));
                imgPreview.show();
            }
        });
    }
});
</script>
@endpush

