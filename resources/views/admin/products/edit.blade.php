@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Product</h3>
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
                        <a href="{{ route('admin.products') }}">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit product</div>
                    </li>
                </ul>
            </div>
            <!-- form-edit-product -->
            <form class="tf-section-2 form-edit-product" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.products.update', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0"
                            value="{{ old('name', $product->name) }}" aria-required="true" required="">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('name')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter product slug" name="slug" tabindex="0"
                            value="{{ old('slug', $product->slug) }}" aria-required="true" required="">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product slug.</div>
                    </fieldset>

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Category <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="category_id">
                                    <option value="">Choose category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="brand">
                            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option value="">Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>

                    <div class="gap22 cols">
                        <fieldset class="name">
                            <div class="body-title mb-10">Colors</div>
                            <div id="colors-container">
                                @foreach ($product->colors as $index => $color)
                                    <div class="flex gap-2 mb-2 items-center color-row">
                                        <input type="text" name="colors[{{ $index }}][name]"
                                            placeholder="Color Name" class="form-control" value="{{ $color->name }}"
                                            required>
                                        <div class="flex items-center gap-2">
                                            <input type="color" name="colors[{{ $index }}][code]"
                                                class="form-control form-control-color" value="{{ $color->code }}"
                                                title="Choose your color"
                                                style="width: 50px; padding: 0; border: none; cursor: pointer;">
                                            <input type="text" class="form-control color-hex-input" placeholder="#000000"
                                                value="{{ $color->code }}" style="width: 100px;">
                                        </div>
                                        <button type="button" class="tf-button-sm remove-color"
                                            style="background: red; color: white; border: none; padding: 5px 10px;">X</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="tf-button btn-sm" id="add-color">Add Color</button>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Sizes</div>
                            <div id="sizes-container">
                                @foreach ($product->sizes as $index => $size)
                                    <div class="flex gap-2 mb-2 items-center size-row">
                                        <select name="sizes[{{ $index }}][name]" class="form-control" required>
                                            <option value="S" {{ $size->name == 'S' ? 'selected' : '' }}>S</option>
                                            <option value="M" {{ $size->name == 'M' ? 'selected' : '' }}>M</option>
                                            <option value="L" {{ $size->name == 'L' ? 'selected' : '' }}>L</option>
                                            <option value="XL" {{ $size->name == 'XL' ? 'selected' : '' }}>XL</option>
                                            <option value="XXL" {{ $size->name == 'XXL' ? 'selected' : '' }}>XXL
                                            </option>
                                        </select>
                                        <button type="button" class="tf-button-sm remove-size"
                                            style="background: red; color: white; border: none; padding: 5px 10px;">X</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="tf-button btn-sm" id="add-size">Add Size</button>
                        </fieldset>
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Short Description <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="short_description" placeholder="Short Description" tabindex="0"
                            aria-required="true" required="">{{ old('short_description', $product->short_description) }}</textarea>
                        <div class="text-tiny">Provide a brief summary of the product.</div>
                    </fieldset>

                    <fieldset class="description">
                        <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true"
                            required="">{{ old('description', $product->description) }}</textarea>
                        <div class="text-tiny">Provide detailed information about the product.</div>
                    </fieldset>
                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if ($product->image)
                                <div class="item" id="imgpreview">
                                    <img src="{{ Storage::url($product->image) }}" class="effect8"
                                        alt="{{ $product->name }}">
                                </div>
                            @else
                                <div class="item" id="imgpreview" style="display:none">
                                    <img src="" class="effect8" alt="">
                                </div>
                            @endif
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="productImage">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
                                    <input type="file" id="productImage" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="wg-box mt-5">
                            <h3>Gallery Images</h3>
                            <form action="{{ route('admin.galleries.store', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="body-title mb-10">Upload Gallery Images</div>
                                    <div class="upload-image mb-16">
                                        <div id="galPreview" class="flex gap-2 flex-wrap"></div>
                                        <div id="galUpload" class="item up-load">
                                            <label class="uploadfile" for="galleryImages">
                                                <span class="icon">
                                                    <i class="icon-upload-cloud"></i>
                                                </span>
                                                <span class="text-tiny">
                                                    Drop your images here or select
                                                    <span class="tf-color">click to browse</span>
                                                    <br> (Max 10 images)
                                                </span>
                                                <input type="file" id="galleryImages" name="gallery_images[]"
                                                    accept="image/*" multiple>
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <button type="submit" class="tf-button w-full">Upload Gallery</button>
                            </form>

                            <div class="flex items-center flex-wrap gap10 mt-4">
                                @foreach ($product->galleries as $gallery)
                                    <div class="item position-relative"
                                        style="position: relative; inline-size: 100px; block-size: 100px;">
                                        <img src="{{ Storage::url($gallery->image) }}" alt="" class="effect8"
                                            style="inline-size: 100%; block-size: 100%; object-fit: cover;">
                                        <form action="{{ route('admin.galleries.destroy', $gallery->id) }}"
                                            method="POST" class="position-absolute top-0 end-0"
                                            style="position: absolute; inset-block-start: 0; inset-inline-end: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="tf-button-sm"
                                                style="background: red; color: white; border: none; padding: 2px 5px; cursor: pointer;"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </fieldset>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter regular price" name="regular_price"
                                tabindex="0" value="{{ old('regular_price', $product->price) }}" aria-required="true"
                                required="">
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Sale Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter sale price" name="sale_price"
                                tabindex="0" value="{{ old('sale_price', $product->sale_price) }}"
                                aria-required="true" required="">
                        </fieldset>
                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter SKU" name="sku" tabindex="0"
                                value="{{ old('sku', $product->sku) }}" aria-required="true" required="">
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter quantity" name="quantity"
                                tabindex="0" value="{{ old('quantity', $product->quantity) }}" aria-required="true"
                                required="">
                        </fieldset>
                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Stock</div>
                            <div class="select mb-10">
                                <select class="" name="stock_status">
                                    <option value="in_stock"
                                        {{ old('stock_status', $product->stock) == 'in_stock' ? 'selected' : '' }}>InStock
                                    </option>
                                    <option value="out_of_stock"
                                        {{ old('stock_status', $product->stock) == 'out_of_stock' ? 'selected' : '' }}>Out
                                        of Stock</option>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Featured</div>
                            <div class="select mb-10">
                                <select class="" name="featured">
                                    <option value="0"
                                        {{ old('featured', $product->featured) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1"
                                        {{ old('featured', $product->featured) == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Update product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("input[name='name']").on("input", function() {
                const slug = $(this).val()
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, "-")
                    .replace(/[^\w\-]+/g, "")
                    .replace(/\-\-+/g, "-");
                $("input[name='slug']").val(slug);
            });

            const photoInp = $("#productImage");
            if (photoInp.length) {
                photoInp.on("change", function() {
                    const [file] = this.files;
                    if (file) {
                        $("#imgpreview img").attr("src", URL.createObjectURL(file));
                        $("#imgpreview").show();
                    }
                });
            }
        });
        const galleryInput = document.getElementById('galleryImages');
        const galPreview = document.getElementById('galPreview');

        galleryInput.addEventListener('change', function() {
            galPreview.innerHTML = '';
            const files = this.files;
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid #ccc';
                    img.style.borderRadius = '5px';
                    img.style.marginRight = '5px';
                    img.style.marginBottom = '5px';
                    galPreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });

        let colorIndex = {{ $product->colors->count() }};

        $('#add-color').on('click', function() {
            const html = `
        <div class="flex gap-2 mb-2 items-center color-row">
            <input type="text" name="colors[${colorIndex}][name]" placeholder="Color Name" class="form-control" required>
            <div class="flex items-center gap-2">
                <input type="color" name="colors[${colorIndex}][code]" class="form-control form-control-color" value="#000000" title="Choose your color" style="width: 50px; padding: 0; border: none; cursor: pointer;">
                <input type="text" class="form-control color-hex-input" placeholder="#000000" value="#000000" style="width: 100px;">
            </div>
            <button type="button" class="tf-button-sm remove-color" style="background: red; color: white; border: none; padding: 5px 10px;">X</button>
        </div>
    `;
            $('#colors-container').append(html);
            colorIndex++;
        });

        $(document).on('click', '.remove-color', function() {
            $(this).closest('.color-row').remove();
        });

        $(document).on('input', '.form-control-color', function() {
            $(this).closest('.color-row').find('.color-hex-input').val($(this).val());
        });

        $(document).on('input', '.color-hex-input', function() {
            $(this).closest('.color-row').find('.form-control-color').val($(this).val());
        });


        let sizeIndex = {{ $product->sizes->count() }};

        $('#add-size').on('click', function() {
            const html = `
        <div class="flex gap-2 mb-2 items-center size-row">
            <select name="sizes[${sizeIndex}][name]" class="form-control" required>
                <option value="">Choose Size</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
            <button type="button" class="tf-button-sm remove-size" style="background: red; color: white;">X</button>
        </div>
    `;
            $('#sizes-container').append(html);
            sizeIndex++;
        });

        $(document).on('click', '.remove-size', function() {
            $(this).closest('.size-row').remove();
        });
    </script>
@endpush
