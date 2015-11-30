@extends('layouts.master')

@section('banner')
    <slideshow 
        type="banner" 
        :options="{ prevNextButtons: false }"
    >
    </slideshow>
@stop

@section('content')
    @include('components/ceo')
    <h2 class="heading--fancy">เกี่ยวกับเรา</h2>
    <div class="about">
        <div class="about__logo">
            <img src="/images/logo-306x401.png" alt="สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก">
        </div>
        <div class="about__body">
            <p>
                แหล่งท่องเที่ยวในเขตทหารเป็นแหล่งท่องเที่ยวที่มีความน่าสนใจและแตกต่างจากแหล่งท่องเที่ยวอื่นทั่วไป เพราะมีความหลาก หลายทั้งในด้านของการอนุรักษ์สิ่งแวดล้อม ประวัติศาสตร์และวัฒนธรรม การผจญภัย และการประกอบกิจกรรมต่างๆ ที่สามารถนำ มารวมไว้ในแหล่งท่องเที่ยวแห่งเดียวกันได้อย่างสอดคล้อง ซึ่งการท่องเที่ยวในแต่ละค่ายทหารนั้นจะแตกต่างกันไปตามสภาพที่ตั้ง อีกทั้ง ยังมีความปลอดภัยสูง เนื่องจากมีเจ้าหน้าที่ที่มีความเชี่ยวชาญเฉพาะด้านคอยให้คำแนะนำและดูแลการประกอบกิจกรรม มี อุปกรณ์สำหรับการประกอบกิจกรรมแต่ละกิจกรรมที่ได้มาตรฐาน จึงถือได้ว่าแหล่งท่องเที่ยวในเขตทหาร เป็นแหล่งท่องเที่ยวอีก ประเภทหนึ่งที่สามควรได้รับการส่งเสริมและพัฒนาให้มีนักท่องเที่ยวเดินทางเข้าไปท่องเที่ยวมากขึ้น ปัจจุบันนี้กรมการท่องเที่ยว กระทรวงการท่องเที่ยวและกีฬาได้เข้ามามีส่วนสนับสนุนส่งเสริมการท่องเที่ยวของกองทัพบกมากขึ้น โดยทางกรมการท่องเที่ยว ได้เห็นความสำคัญของการท่องเที่ยวในแหล่งท่องเที่ยวในเขตทหาร โดยจัดสรรงบประมาณมาช่วยปรับปรุงพัฒนาแหล่งท่องเที่ยว ในเขตทหารให้เป็นมืออาชีพและสอดคล้องกับธุรกิจการท่องเที่ยวในประเทศ พร้อมช่วยกระตุ้นยอดการท่องเที่ยวทั้งทางตรงและ ทางอ้อม ให้รองรับยุทธศาสตร์การท่องเที่ยว ตามแผนพัฒนาแหล่งท่องเที่ยวแห่งชาติ พ.ศ.๒๕๕๕ – ๑๕๕๙ ของกระทรวงการ ท่องเที่ยวและกีฬา อีกทั้งในปี ๒๕๕๘ ประเทศไทยก็จะเข้าร่วมประชาคมเศรษฐกิจอาเซียน (Asean Economics Community : AEC) จึงต้องเตรียมความพร้อมที่จะดึงดูดนักท่องเที่ยวต่างชาติ และ นักท่องเที่ยวในประเทศ ให้มาท่องเที่ยวในเขตทหารให้มากขึ้น อันจะเป็นการช่วยให้เศรษฐกิจของประเทศเติบโตอย่างยั่งยืน
            </p>
            <p>
                การทัพบกได้จัดตั้งสำนักงานส่งเสริมการท่องเที่ยวกองทัพบกขึ้น เพื่อให้สอดคล้องตามนโยบายด้านการท่องเที่ยวของประเทศ ดำเนินการโดยคณะกรรมการบริหารการท่องเที่ยวกองทัพบก มีผู้บัญชาการทหารบกเป็นประธานกรรมการ และผู้อำนวยการสำนัก งานส่งเสริมการท่องเที่ยวกองทัพบกเป็นกรรมการและเลขานุการ ซึ่งผุ้บัญชาการทหารบกได้กรุณามอบนโยบายให้แหล่งท่องเที่ยว ในเขตทหาร กองทัพบก เป็นเครื่องมือที่ใช้สร้างความสัมพันธ์อันดีระหว่างประชาชน กับ กองทัพบก ทั้งในด้านการท่องเที่ยวเชิงการ เรียนรุ้และการจัดกิจกรรม จากอุปกรณ์เครื่องช่วยฝึกที่หน่วยทหารรับผิดชอบ อันมีแนวคิดให้ทหารในกองทัพบก ทุกระดับได้รับรู้ถึง ประโยชน์ของการดำเนินการท่องเที่ยวทีมีต่อกองทัพบก ทั้งในด้านการนำรายได้มาพัฒนาหน่วยและการสร้างภาพลักษณ์ที่ดีต่อ ประชาชนรวมทั้งผู้เข้ามาท่องเที่ยวในเขตทหารของกองทัพบก
            </p>
            <p>
                การกำหนดแนวทางในการบริหารและพัฒนการท่องเที่ยวและส่งเสริมการท่องเที่ยวในเขตทหาร กองทัพบก จะกำหนดจากแนวคิด และวิสัยทัศน์ เป็นเจนารมณ์และนโยบาย ของผู้บัญชาการทหารบกเป็นหลัก โดยถือว่าการพัฒนาบุคลากรงานด้านการท่องเที่ยว เป็นหัวใจสำคัญของหน่วยตามหลักการของการพัฒนาองค์กร เพื่อให้เกิดการบริหารงานด้านการท่องเที่ยวแบบมืออาชีพ รวมทั้ง การจัดสำนักงานส่งเสริมการท่องเที่ยวให้เกิดขึ้นในหน่วยขึ้นตรงกองทัพบก ตั้งแต่ระดับ กองทัพภาค จนถึงระดับกองพล หน่วย บัญชาการช่วยรบ, มณฑลทหารบก และจังหวัดทหารบก และค่ายทหารในพื้นที่ จึงจะก่อให้เกิดพลังอำนาจในการบริหารและพัฒนา และส่งเสริมการท่องเที่ยวได้อย่างมีประสิทธิภาพเกิดประสิทธิผลตามเป้าประสงค์ของงานด้านกิจการพลเรือนได้อย่างเป็นรูปธรรม
            </p>
            <address>
                สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก 279 อาคารสวัสดิการทหารบก ชั้น 3 ถนนศรีอยุธยา แขวงวชิระ เขตดุสิต กรุงเทพมหานคร 10300<br>
                <br>
                โทร. 02-2826835, 02-2975831, 083-1232647<br>
                โทรสาร. 02-2826835, 02-2820620<br>
                โทร.ทบ. 95831 โทรสาร.ทบ. 91635<br>
            </address>
        </div>
    </div>
@stop