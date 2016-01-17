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
                                @if(isset($nearby))
                                    <img src="{{ asset($nearby->thumbnail) }}" alt="{{ $nearby->title }}">
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
                        {!! Form::label('title:th', 'ชื่อสถานที่ภาษาไทย') !!}
                        {!! Form::text('title:th', null , ['class' => 'form-control', 'placeholder' => 'ชื่อรูปภาษาไทย', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title:en', 'ชื่อสถานที่ภาษาอังกฤษ') !!}
                        {!! Form::text('title:en', null , ['class' => 'form-control', 'placeholder' => 'ชื่อรูปภาษาอังกฤษ']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('tel', 'เบอร์โทรติดต่อ') !!}
                        {!! Form::text('tel', null, ['class' => 'form-control', 'placeholder' => 'เบอร์โทรติดต่อ']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('latitude', 'ละติจูด') !!}
                        {!! Form::text('latitude', null, ['class' => 'form-control', 'placeholder' => 'ละติจูด']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('longitude', 'ลองจิจูด') !!}
                        {!! Form::text('longitude', null, ['class' => 'form-control', 'placeholder' => 'ลองจิจูด']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
    </div>
</div>