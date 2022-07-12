@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редагувати товар</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group w-25">
                                <label>Назва товару</label>
                                <input type="text" class="form-control" name="title" placeholder="Назва товару"
                                       value="{{ $product->title }}">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="w-50">{{ $product->description }}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group w-25">
                                <label>Вкажіть ціну</label>
                                <input type="text" class="form-control" name="price" placeholder="Ціна"
                                       value="{{ $product->price }}">
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group w-25">
                                <label>Вкажіть кількість</label>
                                <input type="text" class="form-control" name="quantity" placeholder="Кількість"
                                       value="{{ $product->quantity }}">
                                @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group w-25">
                                <label>Оберіть категорію</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_id ? ' selected' : '' }}
                                        >{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group w-25">
                                <label>Розмістити на сайті:</label>
                                <select name="is_published" class="form-control">
                                    <option value="1">Розмістити</option>
                                    <option value="0">Приховати</option>
                                </select>
                            </div>
                            <div class="form-group w-25">
                                <label>Наявність товару:</label>
                                <select name="is_available" class="form-control">
                                    <option value="1">У наявності</option>
                                    <option value="0">Товар відсутній</option>
                                </select>
                            </div>
                            <div class="form-group w-50">
                                <label for="exampleInputFile">Додати зображення</label>
                                <div class="w-50 mb-3">
                                    <img src="{{ url('storage/' . $product->image) }}" alt="image" class="w-50">
                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image">
                                        <label class="custom-file-label">Оберіть файл</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Завантажити</span>
                                    </div>
                                </div>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Оновити">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

