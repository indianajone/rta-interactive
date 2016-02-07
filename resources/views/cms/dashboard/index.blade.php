@extends('layouts.cms')

@section('content')

<h1>หน้าหลัก</h1>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-compass fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $count }}</div>
                        <div>สถานที่ทั้งหมด</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('cms.places.index') }}">
                <div class="panel-footer">
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-eye fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $mostView->view }}</div>
                        <div>{{ $mostView->name }}</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('cms.places.edit', $mostView->id) }}">
                <div class="panel-footer">
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

@stop