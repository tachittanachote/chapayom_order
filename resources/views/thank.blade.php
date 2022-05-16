<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{url('/css/bulma.css')}}" rel="stylesheet">
  <link href="{{url('/css/main.css')}}" rel="stylesheet">
  <title>CHAPAYOM ORDER | คำสั่งซื้อเรียบร้อย</title>

  <script>
  document.ontouchmove = function(event){
    event.preventDefault();
  }
  </script>
	<script data-ad-client="ca-pub-7279764822152910" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body>
  <div style="height: 100em; width: 100em; position: fixed; display:none;" id="vertical"></div>
  <div class="container" id="app" style="margin-bottom: 40vw;">
    <div class="columns is-mobile" style="margin-top: 25vw;">
      <div class="column">
      </div>
      <div class="column">
        <figure class="image is-5by4"><img src="https://chapayom.com/wp-content/uploads/2018/03/chapayombkkkkkT.png"></figure>
      </div>
      <div class="column">
      </div>
    </div>
    <div class="columns is-mobile" style="margin-top: 7vw;">
      <div class="column">
      </div>
      <div class="column is-flex" style="justify-content: center;">
        <figure class="image is-64x64"><img src="https://chapayom.com/wp-content/uploads/2017/09/correct.png"></figure>
      </div>
      <div class="column">
      </div>
    </div>
    <div class="columns is-mobile" style="margin-top: 2vw;">
      <div class="column is-1">
      </div>
      <div class="column has-text-centered">
        <h5 class="title is-5">ส่งคำสั่งซื้อเรียบร้อย</h5>
        <h6 class="subtitle is-6" style="margin-top: 5px; margin-bottom: 20px;">หมายเลขคำสั่งซื้อ</h6>
        <h3 class="title is-3" style="color: #36b449;">#{{$order_id}}</h3>
        <h6 class="subtitle is-6">สั่งซื้อเมื่อวันที่ {{$order_date}} เวลา {{$order_time}} น.</h6>
      </div>
      <div class="column is-1">
      </div>
    </div>
    <!---<div class="columns is-mobile">
      <div class="column">
      </div>
      <div class="column is-flex" style="justify-content: center;">
          <div><button id="close" class="button is-success is-rounded btn-custom">กลับไปยัง LINE</button></div>
      </div>
      <div class="column">
      </div>
    </div>!-->
    <div class="columns is-mobile" style="margin-top: -3vw;">
      <div class="column">
      </div>

      @if($pay_option == "promtpay")
      <div class="column is-flex" style="justify-content: center;">
        <button class="button is-link is-rounded modal-button" data-target="#ppay" aria-haspopup="true"><i class="fas fa-qrcode"></i> <span class="margin-sum">แสดง QR CODE ชำระเงิน</span></button>
      </div>
      @endif

      @if($pay_option == "bank")
      <div class="column is-flex" style="justify-content: center;">
        <button class="button is-link is-rounded modal-button" data-target="#bpay" aria-haspopup="true"><i class="fas fa-university"></i> <span class="margin-sum">แสดงเลขบัญชีธนาคาร</span></button>
      </div>
      @endif

      <div class="column">
      </div>
    </div>
    <div class="column is-flex" style="justify-content: center; margin-bottom: 0vw; margin-top: 0vw;">
        <img class="image is-24x24" id="close" src="https://chapayom.com/wp-content/uploads/2017/09/LINE_APP.png">
      </div>
      <div class="column is-flex" style="justify-content: center; margin-bottom: 0vw; margin-top: 0vw;">
          <button id="close" class="button is-success is-rounded btn-custom">กลับไปยัง LINE</button>
      </div>
      </div>
  </div>

  <div class="modal" id="bpay">
    <div class="modal-background"></div>
    <div class="modal-content is-rounded" style="width: 75%;">
      <div class="box">
        <img src="https://order.chapayom.com/upload/kbank.jpeg">
		<div class="column is-flex" style="justify-content: center;">
            <h3 class="title is-4">
                <button class="button is-primary" data-clipboard-text="0531496469" id="copy">
                    คัดลอกเลขบัญชี
                </button>
            </h3>
        </div>
        <div class="column is-flex" style="justify-content: center;">
            <h3 class="title is-4">ยอดรวม {{$cost}}.00 บาท</h3>
        </div>
          <!---div class="column is-flex" style="justify-content: center; margin-bottom: 0px;">
              <img class="image is-24x24" id="close" src="https://chapayom.com/wp-content/uploads/2017/09/LINE_APP.png">
          </div>
        <div class="column is-flex" style="justify-content: center; margin-top: -15px;">
          <button id="close_k" class="button is-success is-rounded is-fullwidth btn-custom">กลับไปยัง LINE</button>
        </div>!--->
      </div>
    </div>
    <button class="modal-close is-large" aria-label="close"></button>
  </div>

  <div class="modal" id="ppay">
    <div class="modal-background"></div>
    <div class="modal-content is-rounded" style="width: 75%;">
      <div class="box">
            <img src="https://chapayom.com/wp-content/uploads/2017/09/THIQR.png">
            <center><img width="50%" height="50%" src="https://promptpay.io/3800500092467/{{$cost}}"></center>
        <div class="column is-flex" style="justify-content: center;">
          <h3 class="title is-4">ยอดรวม {{$cost}}.00 บาท</h3>
        </div>
        <img width="100%" height="10vw" src="https://chapayom.com/wp-content/uploads/2017/09/bQRank.png">
        <img src="https://chapayom.com/wp-content/uploads/2017/09/htqr2.png">
          <!---<div class="column is-flex" style="justify-content: center; margin-bottom: 0px;">
              <img class="image is-24x24" id="close" src="https://chapayom.com/wp-content/uploads/2017/09/LINE_APP.png">
          </div>
          <div class="column is-flex" style="justify-content: center; margin-top: -15px;">
              <button id="close_k" class="button is-success is-rounded is-fullwidth btn-custom">กลับไปยัง LINE</button>
          </div>!--->
      </div>
    </div>
    <button class="modal-close is-large" aria-label="close"></button>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/js/all.min.js" integrity="sha256-0vuk8LXoyrmCjp1f0O300qo1M75ZQyhH9X3J6d+scmk=" crossorigin="anonymous"></script>
  <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
  <script src="{{mix('/js/line.js')}}"></script>
  <script src="{{mix('/js/resize.js')}}"></script>
  <script src="https://unpkg.com/popper.js@1"></script>
  <script src="https://unpkg.com/tippy.js@5"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
  <script>
  var clipboard = new ClipboardJS('.button');
    clipboard.on('success', function(e) {
      tippy('#copy', {
        content: "คัดลอกเรียบร้อยแล้ว"
      });
    e.clearSelection();
  });
  </script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TXR0674JYJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-TXR0674JYJ');
</script>
</body>
</html>
