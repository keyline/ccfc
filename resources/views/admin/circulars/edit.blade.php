@extends('layouts.admin')
@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<div class="card">
    <div class="card-header">
        <a href="{{ route("admin.circulars") }}" class="btn btn-primary float-end">Back</a>
    </div>
    <div class="col-lg-12">
    </div>
    @if (session('status'))
    <h6 class="alert alert-success">{{ session('status') }}</h6>
    @endif
    <div class="card-body">
        <form method="POST" action="{{ url('admin/create/update-circular/'.$circular->id)}}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name_of_the_block">Publish of day</label>
                <input type="text" name="day" value="{{$circular->day}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="name_of_the_block">Publish of month</label>
                <input type="text" name="month" value="{{$circular->month}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="name_of_the_block">Circular Details 1</label>
                <input type="text" name="circular_details1" value="{{$circular->details_1}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="name_of_the_block">Circular Details 2</label>
                <textarea class="form-control ckeditor {{ $errors->has('body') ? 'is-invalid' : '' }}"
                    name="circular_details2" id="body">{!! old('body', $circular->details_2) !!}</textarea>
            </div>
            <div class="form-group">
                <label for="name_of_the_block">Circular Image</label>
                <input type="file" name="circularimage" class="form-control"><br>
                <!-- <img src="{{ asset('uploads/circularimg/'.$circular->circular_image)}}" width="100px" height="100px"
                    alt=""> -->
                <?php
                $circular_image = $circular->circular_image;
                $fileURL = url('/').'/uploads/circularimg/'.$circular_image;
                if($circular_image != ''){
                    $fileExtn = $ext = pathinfo($circular_image, PATHINFO_EXTENSION);
                    if($fileExtn == 'pdf' || $fileExtn == 'PDF'){
                    ?>
                        <embed src="<?=$fileURL?>" width="300" height="200" type="application/pdf">
                    <?php
                    } else {
                    ?>
                        <img src="<?=$fileURL?>" width="300" height="200" class="img-thumbnail">
                    <?php
                    }
                }
                ?>
            </div><br><br>
            <div class="form-group">
                <label for="name_of_the_block">Notice Image </label>
                <input type="file" name="circular_image2" class="form-control"><br>
                <!-- <img src="{{ asset('uploads/circularimg/'.$circular->circular_image2)}}" width="100px" height="100px"
                    alt=""> -->
                <?php
                $circular_image2 = $circular->circular_image2;
                $fileURL = url('/').'/uploads/circularimg/'.$circular_image2;
                if($circular_image2 != ''){
                    $fileExtn = $ext = pathinfo($circular_image2, PATHINFO_EXTENSION);
                    if($fileExtn == 'pdf' || $fileExtn == 'PDF'){
                    ?>
                        <embed src="<?=$fileURL?>" width="300" height="200" type="application/pdf">
                    <?php
                    } else {
                    ?>
                        <img src="<?=$fileURL?>" width="300" height="200" class="img-thumbnail">
                    <?php
                    }
                }
                ?>
            </div><br><br>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
<script>
ClassicEditor
    .create(document.querySelector('#body'))
    .catch(error => {
        console.error(error);
    });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
@endsection