@extends('layouts.master')

@section('banner')
    <div class="slick slick--black" v-slick>
        @foreach($slideshow as $item)
            <div class="slick-slide slick-slide--fixed-height">
                <img src="{{ asset($item->path) }}" alt="$item->title">
                @if($item->title)
                    <span>{{ $item->title }}</span>
                @endif
            </div>
        @endforeach
    </div>
@stop

@section('content')
    
    <h2 class="heading--fancy">{{ trans('common.heading.ar_code') }}</h2>
    
    <article>
        {{-- @if(app()->getLocale() === 'th') --}}
            <p>AR หรือ Augmented Reality คือ เทคโนโลยีใหม่ ที่ผสานเอาโลกแห่งความเป็นจริง (Real) เข้ากับโลกเสมือน (Virtual) ซึ่งจะทำให้ภาพที่เห็นในจอภาพกลายเป็นวัตถุ 3 มิติลอยอยู่เหนือพื้นผิวจริง โดนผ่านทางอุปกรณ์ต่างๆ อย่างกล้องมือถือ คอมพิวเตอร์ และ แว่น เราอาจเห็นภาพโมเดลของอาคารขนาดใหญ่ หรือเห็นสัญลักษณ์ของร้านค้าต่างๆ รูปสินค้าต่างๆ รวมไปถึงรูปคนเสมือนจริงปรากฏตัวและกำลังพูดผ่านหน้าจอคอมพิวเตอร์ นี่คือสิ่งที่ตื่นตาตื่นใจ ซึ่งแสดงผลเหมือนจริงแบบ 3D 360 องศากันเลย</p>
            <p>โดยปกติแล้ว AR  มักพบบนสมาร์ทโฟน มากกว่าพีซี และสมาร์ทโฟนมักอยู่ที่มือและมีกล้องติดมาด้วยเสมอ ซึ่งกล้องนี้เปรียบเสมือนดวงตาที่ทำให้เรามองเห็นโลกทั้งใบ เราไม่สามารถถ่ายทอดข้อมูลผ่านจอประสาทตาได้ แต่เราสามารถใช้จอของสมาร์ทโฟนได้</p>

            <div>
                <h5>หลักการของมันประกอบด้วย</h5>
                <ol>
                    <li>ตัว Marker ต่างๆ หรือ sensor โดยจะส่องหางจาก Marker นี้ประมาณ 50 เซนติเมตร</li>
                    <li>กล้อง, มือถือ, แว่น อุปกรณ์ที่สามารถตรวจจับ sensor ต่างๆ</li>
                    <li>จอแสดงผล จอมือถือ,จอภาพต่างๆ</li>
                    <li>ระบบประมวลผลเพื่อสร้าง วัตถุ 3D เช่น ตัวโปรแกรมในคอมพิวเตอร์</li>
                </ol>
            </div>
       {{--  @else
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        @endif --}}
    </article>

    <h2 class="heading--fancy">{{ trans('common.heading.recommended') }}</h2>
    
    <div class="cards cards--col-2">
        @forelse($places->chunk(2) as $set)
            <div class="row">
                @foreach($set as $place)
                    @include('components/card')
                @endforeach
            </div>
        @empty
            <div class="notfound">
                <h3 class="notfound__body">{{ trans('common.notfound') }}</h3>
            </div>
        @endforelse 
    </div>

@stop