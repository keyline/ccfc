@extends('layouts.admin')
@section('content')

<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>


<div class="card">
    <div class="card-header">
        <a href="{{ route("admin.event") }}" class="btn btn-primary float-end">Back</a>

    </div>
    <div class="col-lg-12">
    </div>

    @if (session('status'))

    <h6 class="alert alert-success">{{ session('status') }}</h6>

    @endif

    <div class="card-body">

        <form method="POST" action="{{ url('admin/create/update-event/'.$event->id)}}" enctype="multipart/form-data">
            @csrf

            @method('PUT')

            <div class="form-group">
                <label for="name_of_the_block">Publish of day</label>
                <input type="text" name="day" value="{{$event->day}}" class="form-control">

            </div>
            <div class="form-group">
                <label for="name_of_the_block">Publish of month</label>
                <input type="text" name="month" value="{{$event->month}}" class="form-control">

            </div>

            <div class="form-group">
                <label for="name_of_the_block">Event name</label>
                <input type="text" name="event_name" value="{{$event->event_name}}" class="form-control">

            </div>
            <div class="form-group">
                <label for="name_of_the_block">Event Details 1</label>
                <input type="text" name="event_details1" value="{{$event->details_1}}" class="form-control">

            </div>
            <div class="form-group">



                <label for="name_of_the_block">Event Details 2</label>


                <textarea class="form-control ckeditor {{ $errors->has('body') ? 'is-invalid' : '' }}"
                    name="event_details2" id="body">{!! old('body', $event->details_2) !!}</textarea>

            </div>



            <div class="form-group">
                <label for="name_of_the_block">Circular Image</label>
                <input type="file" name="eventimage" class="form-control"><br>
                <img src="{{ asset('uploads/enentimg/'.$event->event_image)}}" width="100px" height="100px" alt="">

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