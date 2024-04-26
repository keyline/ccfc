@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.gallery.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.galleries.update', [$gallery->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="gallery_name">{{ trans('cruds.gallery.fields.gallery_name') }}</label>
                <input class="form-control {{ $errors->has('gallery_name') ? 'is-invalid' : '' }}" type="text"
                    name="gallery_name" id="gallery_name" value="{{ old('gallery_name', $gallery->gallery_name) }}"
                    required>
                @if($errors->has('gallery_name'))
                <span class="text-danger">{{ $errors->first('gallery_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gallery.fields.gallery_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.gallery.fields.gallery_type') }}</label>
                <select class="form-control {{ $errors->has('gallery_type') ? 'is-invalid' : '' }}" name="gallery_type"
                    id="gallery_type" required>
                    <option value disabled {{ old('gallery_type', null) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Gallery::GALLERY_TYPE_SELECT as $key => $label)
                    <option value="{{ $key }}"
                        {{ old('gallery_type', $gallery->gallery_type) === (string) $key ? 'selected' : '' }}>
                        {{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gallery_type'))
                <span class="text-danger">{{ $errors->first('gallery_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gallery.fields.gallery_type_helper') }}</span>
            </div>
            <button id="removeChecked">Delete Selected</button>
            <button id="allChecked">Select All</button>
            <div class="form-group">
                <label for="images">{{ trans('cruds.gallery.fields.images') }}</label>
                <div class="needsclick dropzone {{ $errors->has('images') ? 'is-invalid' : '' }}" id="images-dropzone">
                </div>
                @if($errors->has('images'))
                <span class="text-danger">{{ $errors->first('images') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gallery.fields.images_helper') }}</span>
            </div>
			
			<!--<div class="form-group">
                <label for="image">{{ trans('cruds.gallery.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gallery.fields.image_helper') }}</span>
            </div>-->
			
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>

var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{route('admin.galleries.storeMedia')}}',
    maxFilesize: 50000000, // 50 MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: false,
    previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-image"><img data-dz-thumbnail /></div><div class="dz-details"><div class="dz-size"><span data-dz-size></span></div><div class="dz-filename"><span data-dz-name></span></div></div><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div><div class="dz-error-message"><span data-dz-errormessage></span></div><div class="dz-success-mark"></div><div class="dz-error-mark"></div><input type="checkbox" class="dz-checkbox" /></div>',
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
        size: 2,
       // width: 4096,
       // height: 4096
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
        uploadedImagesMap[file.name] = response.name
    },
    removedfile: function(file) {
        console.log(file)
        
    },
    init: function() {
        var clicked= false;
        var _this=this;
        
        @if(isset($gallery) && $gallery->images)
        var files = {!! json_encode($gallery->images) !!}
        for (var i in files) {
            var file = files[i]
            
            _this.options.addedfile.call(_this, file)
            _this.options.thumbnail.call(_this, file, file.original_url)
            file.previewElement.classList.add('dz-success')
            file.previewElement.classList.add('dz-complete')
            _this.files.push(file)
            $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
            file.previewElement.querySelector('.dz-checkbox').value = file.uuid;
            
        }
        @endif

        
    
    
      // Function to remove all checked files
document.getElementById('removeChecked').addEventListener('click', function(e){
    debugger;
    e.preventDefault();
      //var toRemove = document.querySelectorAll('.to-remove');
      var checkedFiles = Array.from(document.querySelectorAll('.dz-preview input[type="checkbox"]:checked')).map(function(checkbox) {
        return checkbox.value;
      });
      
    if (checkedFiles.length === 0) {
        alert('Please select files to delete.');
        return;
    }
    if (confirm('Are you sure you want to delete the selected files?')) {
      checkedFiles.forEach(function(fileName, i) {
        
        const fileObjects = Object.fromEntries(
    Object.entries(files).filter(([key, value]) => value.uuid === fileName) )

    // Destructure the 'previewElement' property from the file object
// Initialize an array to store previewElement values
const previewElements = [];
const names=[];

// Iterate over each file entry in the fileData object
for (const key in fileObjects) {
    if (fileObjects.hasOwnProperty(key)) {
        const { previewElement, file_name } = fileObjects[key]; // Destructure previewElement from each file entry
        previewElements.push(previewElement); // Push previewElement into the array
        names.push(file_name);
    }
}
    

console.log({"fileData": name});
//console.log({"Matching Preview": previewElements[0]});
//console.log({"parentNode": previewElements[0]['parentNode']});
       

        
        if (fileObjects) {
            console.log({"deleting": fileObjects});
            
            // Get the preview element associated with the file
            //var previewElement = filteredByValue.previewElement;
            
            _this.removeFile(fileObjects);



            if (previewElements !== null && previewElements[0].parentNode !== null) {
                // Remove the preview element from the DOM
                previewElements[0].parentNode.removeChild(previewElements[0]);
                $('form').find('input[name="images[]"][value="' + names[0] + '"]').remove()
            }
            // Optionally, send a request to the server to delete the file
            // $.ajax({
            //   type: 'POST',
            //   url: 'delete-file.php',
            //   data: { file_name: fileName },
            //   dataType: 'html'
            // });
        }else{
            console.log("File not found");
        }

      }.bind(this));

    }
    
}.bind(this));

// Event listener for "Delete Selected" button click
//document.getElementById('removeChecked').addEventListener('click', removeCheckedFiles);
document.getElementById('allChecked').addEventListener('click', function(e){
    debugger;
            e.preventDefault();
            // Select all checkhour checkboxes
            var checkImages = document.querySelectorAll('.dz-checkbox');
            var isChecked = this.textContent === 'Select All';

            // Update the text content of the button based on isChecked
            this.textContent = isChecked ? 'Deselect All' : 'Select All';
            // Toggle the checked property for each checkhour checkbox
            checkImages.forEach(function(checkImage) {
                checkImage.checked = isChecked;
            });

            // Toggle the text content of the checkall label
            this.textContent = clicked ? 'Select All' : 'Deselect All';

            // Toggle the state of clicked variable
            clicked = !clicked;
});

document.querySelectorAll('.dz-checkbox').forEach(function(checkbox){
    checkbox.addEventListener('change', function (e) {
    // Select the checkall button
        var checkAllButton = document.getElementById('allChecked');

    var checkImageCheckboxes = document.querySelectorAll('.dz-checkbox');
    // Check if all checkhour checkboxes are checked
                var allChecked = Array.from(checkImageCheckboxes).every(function(checkbox) {
                    return checkbox.checked;
                });

                // Update the text content of the checkall button based on allChecked
                checkAllButton.innerHTML = allChecked ? 'Deselect All' : 'Select All';
}.bind(this));
}.bind(this));

    },
    error: function(file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
};
</script>
@endsection