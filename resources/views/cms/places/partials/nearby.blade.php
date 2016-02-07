<div class="row">
    <div class="col-md-12">
        <div class="form-group pull-right">
            <a 
                href="#modal-addnearby" 
                class="btn btn-primary"
                data-toggle="modal" 
                data-target="#modal-addnearby"
            >
                เพิ่มสถานที่
            </a>
        </div>
    </div>
</div>
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th width="10%">รูป</th>
                <th>ชื่อสถานที่</th>
                <th>เบอร์โทรติดต่อ</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($place->nearby as $nearby)
                <tr>
                    <td><img class="img-responsive" src="{{ $nearby->thumbnail }}" alt=""></td>
                    <td>
                        <a 
                            href="#modal-nearby-{{ $nearby->id }}" 
                            data-toggle="modal" 
                            data-target="#modal-nearby-{{ $nearby->id }}"
                        > 
                            {{ $nearby->title }}
                        </a>
                    </td>
                    <td>{{ $nearby->tel }}</td>
                    <td>
                        {!! Form::open([
                            'route' => ['cms.places.nearby.destroy', $place->id, $nearby->id], 
                            'method' => 'DELETE'
                        ]) !!}
                            <button name="delete" class="btn btn-danger">ลบ</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>