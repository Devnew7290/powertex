<!doctype html>
<html>
<head>
<meta name="keywords" content="{{$contact->contacts_keyword}}" />
<meta name="description" content="{{$contact->contacts_description}}" />
<title>Powertex</title>
<?php // require('inc_header.php'); ?>
@include('frontend.inc_header')
</head>
<body>
  <?php // require('inc_menu.php'); ?>
  @include('frontend.inc_menu')
  <section class="container-fluid contact-iframe-relative">
    <iframe class="contact-iframe" src="{{$contact->contacts_map}}" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <!-- <iframe class="contact-iframe" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31004.061701052164!2d100.745166!3d13.748228!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d668e7d1bfc93%3A0xd58c12c2c1968565!2sPOWERTEX%20WORLDWIDE%20CO.%2C%20LTD.!5e0!3m2!1sen!2sus!4v1742191374180!5m2!1sen!2sus" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-6 contact-info">
                <div class="head-fp">
                    <h2>ติดต่อเรา</h2>
                </div>
                <h3>บริษัท พาวเวอร์เท็กซ์ เวิลด์ไวด์ จำกัด</h3>
                <div class="contact-list-box">
                    <address class="contact-list"><img src="{{asset('images/map-marker-alt.svg')}}" alt="">{{$contact->contacts_address}}</address>
                    <a href="tel:027376005" class="contact-list"><img src="{{asset('images/phone-alt.svg')}}" alt="">{{$contact->contacts_phone}}</a>
                    @if($contact->contacts_fax) <div class="contact-list"><img src="{{asset('images/fax.svg')}}" alt="">{{$contact->contacts_fax}}</div> @endif
                    <a href="mailto:{{$contact->contacts_email}}" class="contact-list"><img src="{{asset('images/envelope.svg')}}" alt="">{{$contact->contacts_email}}</a>
                </div>
                <h4>ช่องทางการติดตาม</h4>
                <div class="contact-social">
                    @if($contact->contacts_facebook) <a href="{{$contact->contacts_facebook}}" target="_blank"><img src="{{asset('images/facebook-footer.svg')}}" alt=""></a> @endif
                    @if($contact->contacts_line) <a href="{{$contact->contacts_line}}" target="_blank"><img src="{{asset('images/line-footer.svg')}}" alt=""></a> @endif
                    @if($contact->contacts_ig) <a href="{{$contact->contacts_ig}}" target="_blank"><img src="{{asset('images/instagram-footer.svg')}}" alt=""></a> @endif
                    @if($contact->contacts_yt) <a href="{{$contact->contacts_yt}}" target="_blank"><img src="{{asset('images/youtube-footer.svg')}}" alt=""></a> @endif
                    @if($contact->contacts_tiktok) <a href="{{$contact->contacts_tiktok}}" target="_blank"><img src="{{asset('images/tiktok-footer.svg')}}" alt=""></a> @endif
                </div>
            </div>
        </div>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

<script>
$(document).ready(function(){

});    
</script>
</body>
</html>