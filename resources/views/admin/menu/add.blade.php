@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    
    <form action="" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên Danh Mục</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên Danh Mục" name="name">
            </div>

            <div class="form-group">
                <label>Danh mục </label>
                <select name="parent_id" class="form-control">
                    <option value="0"> Danh mục cha</option>
                </select>
            </div>

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Mô Tả Chi Tiết</label>
                <textarea name="content" id="content" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="">Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" checked name="active">
                    <label for="active" class="custom-control-label">Kích Hoạt</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                    <label for="no_active" class="custom-control-label">Không kích hoạt</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tạo Danh Mục</button>
        </div>
    </form>

@section('footer')
<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace( 'content' );
</script>
@endsection
@endsection
