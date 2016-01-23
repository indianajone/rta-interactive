<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail">
                                @if(isset($video))
                                    <img src="{{ asset($video->thumbnail_path) }}" alt="{{ $video->title }}">
                                @else 
                                    <img src="{{ asset('images/default.jpg') }}" alt="">
                                @endif
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            <div class="text-center">
                                <span class="btn btn-default btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    {!! Form::file('image', ['class' => 'form-control']) !!}
                                </span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('path', 'ลิงค์วีดีโอ') !!}
                        {!! Form::text('path', null , ['class' => 'form-control', 'placeholder' => 'http://youtube.com/xxxx', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title:th', 'ชื่อวีดีโอภาษาไทย') !!}
                        {!! Form::text('title:th', null , ['class' => 'form-control', 'placeholder' => 'ชื่อวีดีโอภาษาไทย', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title:en', 'ชื่อวีดีโอภาษาอังกฤษ') !!}
                        {!! Form::text('title:en', null , ['class' => 'form-control', 'placeholder' => 'ชื่อวีดีโอภาษาอังกฤษ']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
    </div>
</div>