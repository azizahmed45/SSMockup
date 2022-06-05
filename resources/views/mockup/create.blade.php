@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Mockup</h4>
                </div>
                <div class="card-body">
                    <div class="card-content">
                        <form action="{{ route('mockup.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Mockup Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Mockup Name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="company">Device Company</label>
                                <select class="form-control" id="company" name="company">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="device">Device Model</label>
                                <select class="form-control" id="device" name="device">

                                </select>
                            </div>

                            <input id="config-top" class="invisible" name="mockupConfig[top]" value="0">
                            <input id="config-bottom" class="invisible" name="mockupConfig[bottom]" value="0">
                            <input id="config-left" class="invisible" name="mockupConfig[left]" value="0">
                            <input id="config-right" class="invisible" name="mockupConfig[right]" value="0">

                            <img id="mockup-image-viewer">

                            <div class="form-group">
                                <label for="image">Mockup Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>


                            <button type="submit" class="btn btn-primary ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            //COMPANY SELECTION
            var company_id = $('#company').val();
            getDevices(company_id);

            $('#company').change(function () {
                console.log('company changed');
                company_id = $(this).val();
                getDevices(company_id);
            });

            function getDevices(company_id) {
                $.get('/api/company/' + company_id + '/devices', function (data) {
                    $('#device').empty();
                    $.each(data, function (index, device) {
                        $('#device').append('<option value="' + device.id + '">' + device.name + '</option>');
                    });
                });
            }


            //IMAGE SELECTION
            $('#image').change(function () {
                console.log('image changed');
                setImage(this);
            });

            function setImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#mockup-image-viewer').attr('src', e.target.result);
                        $('#mockup-image-viewer').css('max-width', '100%');

                        setCropper();
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            var cropper;

            function setCropper(){
                cropper = new Cropper(document.getElementById('mockup-image-viewer'), {
                    viewMode: 0,
                    guides: true,
                    zoomable: false,
                    rotatable: true,
                    center: true,
                    highlight: true,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    ready: function () {
                        croppable = true;
                    },
                });

                document.getElementById('mockup-image-viewer').addEventListener('crop', function (e){
                    $('#config-left').val(Math.floor(e.detail.x));
                    $('#config-top').val(Math.floor(e.detail.y));
                    $('#config-right').val(Math.floor(e.detail.x + e.detail.width));
                    $('#config-bottom').val(Math.floor(e.detail.y + e.detail.height));
                })
            }
        })
    </script>
@endpush
