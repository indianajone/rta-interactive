<div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="modalImageLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalImageLabel">รูป</h4>
            </div>
            <div class="modal-body"> 
                <div class="form-group">
                    <img class="img-responsive" src="" alt="">
                </div>
                {!! Form::open(['method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::label('title:th', 'ชื่อรูปภาษาไทย') !!}
                        {!! Form::text('title:th', null , ['class' => 'form-control', 'placeholder' => 'ชื่อรูปภาษาไทย']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title:en', 'ชื่อรูปภาษาอังกฤษ') !!}
                        {!! Form::text('title:en', null , ['class' => 'form-control', 'placeholder' => 'ชื่อรูปภาษาอังกฤษ']) !!}
                    </div>
                {!! Form::close() !!}                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">บัญทึก</button>
            </div>
        </div>
    </div>
</div>