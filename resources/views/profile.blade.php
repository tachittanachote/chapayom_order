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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
  <title>CHAPAYOM ORDER | แก้ไข้ข้อมูล</title>

  <script>
  document.ontouchmove = function(event){
    event.preventDefault();
  }
  </script>
<script data-ad-client="ca-pub-7279764822152910" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body style="overflow: hidden;">

  <div style="height: 100em; width: 100em; position: fixed; display:none;" id="vertical"></div>
  <div class="container" id="app" style="margin-bottom: 40vw;">

    <div class="container">
    <section class="section">

      <div class="columns is-mobile">
        <div class="column"></div>
        <div class="column is-half">
            <center>
              <figure class="image is-96x96">
                  <img class="is-rounded" id="uimg" src="https://bulma.io/images/placeholders/96x96.png">
              </figure>
            </center>
        </div>
        <div class="column"></div>
      </div>

      <div class="columns is-mobile">
        <div class="column"></div>
        <div class="column is-four-fifths">
          <center><h4 class="title is-4">แก้ไขข้อมูลลูกค้า</h4></center>
        </div>
        <div class="column"></div>
      </div>

      <div class="columns is-mobile">
        <div class="column"></div>
        <div class="column is-four-fifths">
          <div class="control has-icons-left has-icons-right">
            <input id="name" class="input" type="text" placeholder="ชื่อลูกค้า" value="{{Auth::user()->name}}" maxlength="24" required>
            <span class="icon is-small is-left">
              <i class="fas fa-user-edit"></i>
            </span>
          </div>
        </div>
        <div class="column"></div>
      </div>

      <div class="columns is-mobile">
        <div class="column"></div>
        <div class="column is-four-fifths">
          <div class="control has-icons-left has-icons-right">
            <input id="branch" class="input" type="text" placeholder="สาขา" value="{{Auth::user()->branch}}" maxlength="128" required>
            <span class="icon is-small is-left">
              <i class="fas fa-address-card "></i>
            </span>
          </div>
        </div>
        <div class="column"></div>
      </div>
      <div class="columns is-mobile">
        <div class="column"></div>
        <div class="column is-four-fifths">
          <div class="control has-icons-left has-icons-right">
            <input id="phone" class="input" type="text" placeholder="เบอร์ติดต่อ" value="{{Auth::user()->phone_number}}" maxlength="10" required>
            <span class="icon is-small is-left">
              <i class="fas fa-phone"></i>
            </span>
          </div>
        </div>
        <div class="column"></div>
      </div>
        <div class="columns is-mobile">
            <div class="column"></div>
            <div class="column is-four-fifths">
                <div class="control has-icons-left has-icons-right">
                    @if(Auth::user()->status == "admin")<span class="tag is-success"><i class="fas fa-tag iconx"></i> แอดมิน</span>@endif
                    @if(Auth::user()->status == "customer")<span class="tag is-light"><i class="fas fa-tag iconx"></i> ลูกค้าแฟรนไชส์</span>@endif
                    @if(Auth::user()->status == "dev")<span class="tag is-warning"><i class="fas fa-tag iconx"></i> Dev</span>@endif
                </div>
            </div>
            <div class="column"></div>
        </div>


        <div class="columns is-mobile">
            <div class="column"></div>
            <div class="column is-one-third is-flex" style="justify-content: center;">
                <button class="button is-success is-rounded" id="save">
            <span class="icon is-small is-left">
              <i class="fas fa-check-square"></i>
            </span>
                    <span class="is-small">บันทึกข้อมูล</span>
                </button>
            </div>
            <div class="column"></div>
        </div>

        <div class="columns is-mobile">
            <div class="column"></div>
            <div class="column is-one-third is-flex" style="justify-content: center;">
                <button class="button is-rounded" id="back">
            <span class="icon is-small is-left">
              <i class="fas fa-arrow-left"></i>
            </span>
                    <span class="is-small">ย้อนกลับ</span>
                </button>
            </div>
            <div class="column"></div>
        </div>


    </div>


    </section>
  </div>

  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/js/all.min.js" integrity="sha256-0vuk8LXoyrmCjp1f0O300qo1M75ZQyhH9X3J6d+scmk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
  <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
  <script src="{{mix('/js/profile.js')}}"></script>
  <script src="{{mix('/js/resize.js')}}"></script>
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
