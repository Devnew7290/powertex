<!doctype html>
<html>
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<title>Powertex</title>
<?php // require('inc_header.php'); ?>
  @include('frontend.inc_header')
</head>
<body>
  <?php // require('inc_menu.php'); ?>
  @include('frontend.inc_menu')
  <section class="container-fluid section-inside">
    <div class="container">
      <div class="row">
        <div class="col-12 head-fp head-fp-center">
          <h2 class="wow fadeInDown">ตัวแทนจำหน่าย</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 distributor-form">
            <label>จังหวัด</label>
            <select name="provice" id="provice" onchange="searchDealer()">
                <option value="">ทุกจังหวัด</option>
                @foreach($Provinces as $rs)
                <option value="{{$rs->id}}" @if($proviceSearch == $rs->id) selected @endif>{{$rs->name_th}}</option>
                @endforeach
                <!-- <option>กรุงเทพมหานคร</option> -->
            </select>
        </div>
        <div class="col-12 col-md-3 distributor-form">
            <label>เขต/อำเภอ</label>
            <select name="aumphure" id="aumphure" onchange="searchDealer()">
                <option>ทั้งหมด</option>
                @foreach($Amphures as $rs)
                <option value="{{$rs->id}}" @if($aumphureSearch == $rs->id) selected @endif>{{$rs->name_th}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-6 distributor-form">
            <label>ค้นหา</label>
            <input type="text" name="textSearch" id="textSearch" value="{{$textSearch}}" placeholder="ค้นหาจากชื่อสาขา หรือคำที่ต้องการ" class="distributor-search-input" onkeydown="if (event.key === 'Enter') searchDealer();">
            <button type="button" class="distributor-search-btn" onclick="searchDealer()"><i class="bi bi-search"></i></button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
            <div class="distributor-grid">
                @foreach($dealer as $rs)
                    <div class="distributor-item">
                        <div class="distributor-img">
                            <img src="{{asset($rs->dealer_image)}}" alt="">
                        </div>
                        <figcaption>
                            <h3>{{$rs->dealer_name}}</h3>
                            <div class="distributor-item-list"><i class="bi bi-geo-alt-fill"></i>
                                {{$rs->dealer_address}}
                                @if($rs->FK_province_id == '1')
                                    @foreach($Amphures as $row)
                                        @if($row->id == $rs->FK_amphures_id)
                                            {{$row->name_th}}
                                        @endif
                                    @endforeach
                                    แขวง
                                        @foreach($Districts as $row)
                                            @if($row->id == $rs->FK_districts_id)
                                                {{$row->name_th}}
                                            @endif
                                        @endforeach
                                @else
                                    ตำบล
                                        @foreach($Districts as $row)
                                            @if($row->id == $rs->FK_districts_id)
                                                {{$row->name_th}}
                                            @endif
                                        @endforeach
                                    อำเภอ
                                        @foreach($Amphures as $row)
                                            @if($row->id == $rs->FK_amphures_id)
                                                {{$row->name_th}}
                                            @endif
                                        @endforeach
                                @endif
                                @foreach($Provinces as $row)
                                    @if($row->id == $rs->FK_province_id)
                                        {{$row->name_th}}
                                    @endif
                                @endforeach
                                {{$rs->dealer_address_code}}
                            </div>
                            <div class="distributor-item-list"><i class="bi bi-clock-fill"></i>
                                {{$rs->dealer_day_open}}
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $rs->dealer_time_open)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $rs->dealer_time_close)->format('H:i') }}
                            </div>
                            <div class="distributor-item-list"><i class="bi bi-telephone-fill"></i>{{$rs->dealer_phone}}</div>
                            <a href="{{$rs->dealer_map}}" class="distributor-item-map" style="margin-bottom: 0.5em;">
                                <span><img src="{{asset('images/map-marked-alt.svg')}}" alt=""></span>Google Map
                            </a>
                            @if($rs->dealer_facebook)
                            <a href="{{$rs->dealer_facebook}}" class="distributor-item-map" style="margin-bottom: 0.5em;">
                                <span><img src="{{asset('images/facebook-footer.svg')}}" alt=""></span>Facebook
                            </a>
                            @endif
                            @if($rs->dealer_line)
                            <a href="{{$rs->dealer_line}}" class="distributor-item-map" style="margin-bottom: 0.5em;">
                                <span><img src="{{asset('images/line-footer.svg')}}" alt=""></span>Line
                            </a>
                            @endif
                        </figcaption>
                    </div>
                @endforeach
            </div>
            <ul class="pagination wow fadeInDown">
                @if($dealer->total() > 12)
                    @if($dealer->lastPage() < 11)
                        @if($dealer->lastPage() != 1)
                            @if ($dealer->onFirstPage())
                                <li class="paginate_button page-item"><a class="page-link">
                            @else
                                <li class="paginate_button page-item active"><a href="{{ $dealer->previousPageUrl() }}" class="page-link">
                            @endif
                                <i class="bi bi-chevron-left"></i></a>
                            </li>
                        @endif
                        @for ($i = 1; $i <= $dealer->lastPage(); $i++)
                            @if ($dealer->currentPage() == $i)
                                <li class="paginate_button page-item active">
                            @else
                                <li class="paginate_button page-item">
                            @endif
                                <a href="{{ $dealer->url($i) }}" class="page-link">{{ $i }}</a>
                            </li>
                        @endfor
                        
                        @if($dealer->lastPage() != 1)
                            @if ($dealer->hasMorePages())
                                <li class="paginate_button page-item active"><a href="{{ $dealer->nextPageUrl() }}" class="page-link">
                            @else
                                <li class="paginate_button page-item"><a class="page-link">
                            @endif
                                <i class="bi bi-chevron-right"></i></a>
                            </li>
                        @endif
                    @else
                        @if ($dealer->onFirstPage())
                            <li class="paginate_button page-item"><a class="page-link">
                        @else
                            <li class="paginate_button page-item active"><a href="{{ $dealer->previousPageUrl() }}" class="page-link">
                        @endif
                            <i class="bi bi-chevron-left"></i></a>
                        </li>
                        @if($dealer->currentPage() > 4)
                            <li class="paginate_button page-item"><a href="{{ $dealer->url(1) }}" class="page-link">1</a></li>
                        @endif
                        @if($dealer->currentPage() > 5)
                            <li class="paginate_button page-item"><a class="page-link">...</a></li>
                        @endif
                        @foreach(range(1, $dealer->lastPage()) as $i)
                            @if($i >= $dealer->currentPage() - 3 && $i <= $dealer->currentPage() + 3)
                                @if ($i == $dealer->currentPage())
                                    <li class="paginate_button page-item active"><a class="page-link">{{ $i }}</a></li>
                                @else
                                    <li class="paginate_button page-item"><a href="{{ $dealer->url($i) }}" class="page-link">{{ $i }}</a></li>
                                @endif
                            @endif
                        @endforeach
                        @if($dealer->currentPage() < $dealer->lastPage() - 4)
                            <li class="paginate_button page-item"><a class="page-link">...</a></li>
                        @endif
                        @if($dealer->currentPage() < $dealer->lastPage() - 3)
                            <li class="paginate_button page-item"><a href="{{ $dealer->url($dealer->lastPage()) }}" class="page-link">{{ $dealer->lastPage() }}</a></li>
                        @endif
                        @if ($dealer->hasMorePages())
                            <li class="paginate_button page-item active"><a href="{{ $dealer->nextPageUrl() }}" class="page-link">
                        @else
                            <li class="paginate_button page-item"><a class="page-link">
                        @endif
                            <i class="bi bi-chevron-right"></i></a>
                        </li>
                    @endif
                    <!-- <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li> -->
                @endif
            </ul>
        </div>
      </div>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

<script>
    let typingTimer;
    const delay = 3000; // 3 วินาที

    document.getElementById('textSearch').addEventListener('input', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchDealer, delay);
    });

    document.getElementById('textSearch').addEventListener('keydown', function () {
        clearTimeout(typingTimer); // ยกเลิกทุกครั้งที่ยังพิมพ์อยู่
    });

    function searchDealer() {
        let provice = document.getElementById("provice").value;
        let aumphure = document.getElementById("aumphure").value;
        let textSearch = document.getElementById("textSearch").value;

        let url = "{{ url('/distributor') }}?";
        if (provice && provice !== 'ทุกจังหวัด') url += "provice=" + encodeURIComponent(provice) + "&";
        if (aumphure && aumphure !== 'ทั้งหมด') url += "aumphure=" + encodeURIComponent(aumphure) + "&";
        if (textSearch) url += "text=" + encodeURIComponent(textSearch);

        url = url.replace(/&$/, '');
        window.location.href = url;
    }

    $(document).ready(function(){

    });    
</script>
</body>
</html>