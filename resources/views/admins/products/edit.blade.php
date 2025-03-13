<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa Hàng Điện Tử - Pros Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-2xl">
    <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Sửa sản phẩm</h1>

    <form action="{{ route('admins.products.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Tên sản phẩm -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Tên sản phẩm</label>
            <input type="text" id="name" name="name" required value="{{ $product->name }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Giá sản phẩm -->
        <div>
            <label for="price" class="block text-sm font-semibold text-gray-700">Giá</label>
            <input type="number" id="price" name="price" required min="1" value="{{ $product->price }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Mô tả -->
        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700">Mô tả</label>
            <textarea id="description" name="description" required rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">{{ $product->description }}</textarea>
        </div>

        <!-- Số lượng bán ra -->
        <div>
            <label for="sell" class="block text-sm font-semibold text-gray-700">Số lượng bán ra</label>
            <input type="number" id="sell" name="sell" required min="0" value="{{ $product->sell }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Chọn danh mục -->
        <div>
            <label class="block text-sm font-semibold text-gray-700">Danh mục</label>
            <select name="category_id[]" multiple required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Ảnh sản phẩm hiện có -->
        <div>
            <label class="block text-sm font-semibold text-gray-700">Ảnh sản phẩm</label>
            <div id="image-container" class="grid grid-cols-3 gap-2 mt-2">
                @foreach ($images as $image)
                    <div class="relative image-item draggable-item cursor-pointer" data-id="{{ $image->id }}" draggable="true">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="w-24 h-24 object-cover rounded shadow">
                        <input type="hidden" name="old_images[]" value="{{ $image->image_path }}">
                        <button type="button" class="absolute top-0 right-0 bg-red-500 text-white p-1 rounded-full text-xs delete-btn" data-id="{{ $image->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                @endforeach
                <input type="hidden" name="image_order" id="image_order">
            </div>
        </div>

        <!-- Thêm ảnh mới -->
        <div>
            <label for="images" class="block text-sm font-semibold text-gray-700">Thêm ảnh mới</label>
            <input type="file" id="images" name="images[]" accept="image/*" multiple
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>


        <!-- Chọn nhà cung cấp -->
        <div>
            <label class="block text-sm font-semibold text-gray-700">Nhà cung cấp</label>
            <select name="provider_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
                @foreach ($providers as $provider)
                    <option value="{{ $provider->id }}"
                    {{ $product->provider_id == $provider->id ? 'selected' : '' }}>
                    {{ $provider->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Trạng thái hiển thị -->
        <div>
            <label class="block text-sm font-semibold text-gray-700">Trạng thái</label>
            <div class="flex items-center space-x-6 mt-1">
                <label class="flex items-center">
                    <input type="radio" name="status" value="Hiện" {{ $product->status == 'Hiện' ? 'checked' : '' }} class="mr-2" checked> Hiện
                </label>
                <label class="flex items-center">
                    <input type="radio" name="status" value="Ẩn" {{ $product->status == 'Ẩn' ? 'checked' : '' }} class="mr-2"> Ẩn
                </label>
            </div>
        </div>

        <!-- Nút submit -->
        <button type="submit"
            class="w-full bg-black hover:bg-blue-600 text-white py-2 rounded-lg text-lg font-semibold transition duration-200">
            Cập nhật sản phẩm
        </button>
    </form>
</div>

</body>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    let deletedImages = [];
    let imageContainer = document.getElementById("image-container");

    // Xử lý xóa ảnh
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            const imageItem = this.closest(".image-item");
            const imageId = this.getAttribute("data-id");

            if (imageId) {
                deletedImages.push(imageId);
                updateDeletedImagesField();
            }

            imageItem.remove();
            updateImageOrder();
        });
    });

    function updateDeletedImagesField() {
        let inputField = document.getElementById("deleted_images");
        if (!inputField) {
            inputField = document.createElement("input");
            inputField.type = "hidden";
            inputField.name = "deleted_images";
            inputField.id = "deleted_images";
            document.querySelector("form").appendChild(inputField);
        }
        inputField.value = deletedImages.join(",");
    }

    // Kéo thả ảnh để đổi vị trí
    function makeImagesDraggable() {
        let draggedItem = null;

        document.querySelectorAll(".draggable-item").forEach(item => {
            item.draggable = true;

            item.addEventListener("dragstart", function (event) {
                draggedItem = this;
                setTimeout(() => this.classList.add("opacity-50"), 0);
            });

            item.addEventListener("dragend", function () {
                setTimeout(() => this.classList.remove("opacity-50"), 0);
                draggedItem = null;
                updateImageOrder();
            });

            item.addEventListener("dragover", function (event) {
                event.preventDefault();
            });

            item.addEventListener("drop", function (event) {
                event.preventDefault();
                if (draggedItem && draggedItem !== this) {
                    let children = [...imageContainer.children];
                    let draggedIndex = children.indexOf(draggedItem);
                    let targetIndex = children.indexOf(this);

                    if (draggedIndex > targetIndex) {
                        imageContainer.insertBefore(draggedItem, this);
                    } else {
                        imageContainer.insertBefore(draggedItem, this.nextSibling);
                    }
                }
            });
        });
    }

    function updateImageOrder() {
        let orderedImages = [];
        document.querySelectorAll(".image-item").forEach(item => {
            orderedImages.push(item.getAttribute("data-id"));
        });

        let orderInput = document.getElementById("image_order");
        if (!orderInput) {
            orderInput = document.createElement("input");
            orderInput.type = "hidden";
            orderInput.name = "image_order";
            orderInput.id = "image_order";
            document.querySelector("form").appendChild(orderInput);
        }
        orderInput.value = orderedImages.join(",");
        console.log("Updated image order:", orderInput.value);
    }

    makeImagesDraggable();
});

    </script>

</html>

