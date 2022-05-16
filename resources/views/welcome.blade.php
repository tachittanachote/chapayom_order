
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css" integrity="sha256-auSD6WsicI+oJhpUgntiZeIHFg0Vz0mYHrERIp079QU=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" integrity="sha256-PHcOkPmOshsMBC+vtJdVr5Mwb7r0LkSVJPlPrp/IMpU=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <title>CHAPAYOM ORDER</title>
  <style>
    .rslides {
      position: relative;
      list-style: none;
      overflow: hidden;
      width: 100%;
      padding: 0;
      margin: 0;
      }

    .rslides li {
      -webkit-backface-visibility: hidden;
      position: absolute;
      display: none;
      width: 100%;
      left: 0;
      top: 0;
      }

    .rslides li:first-child {
      position: relative;
      display: block;
      float: left;
      }

    .rslides img {
      display: block;
      height: auto;
      float: left;
      width: 100%;
      border: 0;
    }
  </style>
	<script data-ad-client="ca-pub-7279764822152910" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body>

  <div style="height: 100em; width: 100em; position: fixed; display:none;" id="checking"></div>
  <div style="height: 100em; width: 100em; position: fixed; display:none;" id="vertical"></div>
  <div class="container" id="app" style="display: none;">

      <section class="section">
          <nav class="navbar is-fixed-top">
              <div class="columns is-gapless is-mobile pt-2">
                  <div class="column animated fadeInLeft">
                      <figure class="image">
                          <img src="https://chapayom.com/wp-content/uploads/2017/09/ODODOD.jpg">
                      </figure>
                  </div>
                  <div class="column is-8" style="padding-right: 3vw !important; padding-top: 2vw !important;">
                      <p class="control is-pulled-right">
                      </p><figure class="image is-24x24 is-pulled-right animated fadeIn">
                          <img class="is-rounded" id="userImg" src="https://versions.bulma.io/0.7.0/images/placeholders/256x256.png">
                      </figure>
                      <p></p>
                      <p class="control is-pulled-right info-font">
                          <span style="display: none;" id="userName"><i class="fas fa-circle-notch fa-spin"></i></span>
                          สวัสดี คุณ<span id="nickname"><i class="fas fa-circle-notch fa-spin"></i></span>
                      </p>
                      <p class="control is-pulled-right info-font">
                          สาขา <span id="location"><i class="fas fa-circle-notch fa-spin"></i></span>
                          ( ติดต่อ <tel id="phone_number"><i class="fas fa-circle-notch fa-spin"></i></tel> )
                      </p>
                      <p class="control is-pulled-right info-font">
                          <span class="tag is-link" id="profile"><i class="far fa-edit iconx"></i> แก้ไขข้อมูล</span>
                          <!-- <span class="tag is-dark"><i class="fas fa-user-shield iconx"></i> แอดมิน</span> -->
                      </p>
                  </div>
              </div>
          </nav>
      </section>

    <section class="section" id="prod_list">
      <div class="container">

        <div class="column animated fadeInUp faster">
          <ul class="rslides">
            <li><img src="https://order.chapayom.com/images/sliderCPO.001.jpeg" alt=""></li>
            <li><img src="https://order.chapayom.com/images/sliderCPO.002.jpeg" alt=""></li>
            <li><img src="https://order.chapayom.com/images/sliderCPO.003.jpeg" alt=""></li>
            <li><img src="https://order.chapayom.com/images/sliderCPO.004.jpeg" alt=""></li>
          </ul>
        </div>

        <div class="column animated fadeInUp faster">
        <h5 class="title is-5">ระบบสั่งสินค้า</h5>
      </div>
          <!--<h5 class="title is-6" style="margin-top: 2px;"><span style="color:red;">**ประกาศ: ทดลองระบบสั่งซื้อสินค้าใหม่</span></h5>
          <h5 class="title is-6" style="margin-top: -15px;"><span style="color:red; font-size: 12px;">- คำสั่งซื้อสินค้ายังไม่มีผล</span></h5>-->


            <div class="column animated fadeInUp faster">
                <h5 class="title is-6">วัตถุดิบ</h5>
            </div>
            @foreach($products as $product)
            @if($product->product_type == "วัตถุดิบ")
            <div class="column animated fadeInUp faster">
                <div class="card">
                    <div class="card-content">
                        <div class="columns is-mobile">
                            <div class="column">
                                <h6 class="title is-6">{{$product->product_name}}</h6>
                            </div>
                            <div class="columns is-mobile is-gapless">
                                <div class="column">
                                    <button class="button is-success" id="dis-item-{{$product->item_id}}"><i class="fas fa-minus-circle"></i></button>
                                </div>
                                <div class="column fb-non">
                                    <div class="control">
                                        <input class="input item-input" type="text" pattern="\d*" maxlength="2" id="item-{{$product->item_id}}" placeholder="จำนวน" value="" data-name="{{$product->product_name}}">
                                    </div>
                                </div>
                                <div class="column">
                                    <button class="button is-success" id="add-item-{{$product->item_id}}"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer pt-2">
                      <div class="card-footer-item">
                        <p class="subtitle is-7 is-small">ราคา: <span id="price-item-{{$product->item_id}}">{{$product->product_price}}</span> บาท/{{$product->product_units}}</p>
                      </div>
                    </footer>
                </div>
            </div>
            @endif
            @endforeach

            <div class="column animated fadeInUp faster">
            <h5 class="title is-6">ภาชนะ</h5>
            </div>
            @foreach($products as $product)
              @if($product->product_type == "ภาชนะ")
              <div class="column animated fadeInUp faster">
                <div class="card">
                  <div class="card-content">
                    <div class="columns is-mobile">
                      <div class="column">
                        <h6 class="title is-6">{{$product->product_name}}</h6>
                      </div>
                      <div class="columns is-mobile is-gapless">
                        <div class="column">
                          <button class="button is-success" id="dis-item-{{$product->item_id}}"  @if($product->product_name == 'แก้วลายไต้หวัน/ลัง' || $product->product_name == 'แก้วลายไต้หวัน/แถว') disabled @endif><i class="fas fa-minus-circle"></i></button>
                        </div>
                        <div class="column fb-non">
                          <div class="control">
                            <input class="input item-input" type="text" pattern="\d*" maxlength="2" id="item-{{$product->item_id}}" placeholder="จำนวน" value="" data-name="{{$product->product_name}}"  @if($product->product_name == 'แก้วลายไต้หวัน/ลัง' || $product->product_name == 'แก้วลายไต้หวัน/แถว') readonly @endif>
                          </div>
                        </div>
                        <div class="column">
                          <button class="button is-success" id="add-item-{{$product->item_id}}" @if($product->product_name == 'แก้วลายไต้หวัน/ลัง' || $product->product_name == 'แก้วลายไต้หวัน/แถว') disabled @endif><i class="fas fa-plus-circle"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <footer class="card-footer pt-2">
                      @if($product->product_name == 'แก้วลายไต้หวัน/ลัง' || $product->product_name == 'แก้วลายไต้หวัน/แถว') 
                      <div class="card-footer-item">
                          <p class="subtitle is-7 is-small" style="color: red;">สินค้าหมดชั่วคราว</p>
                      </div>
                      @else
                      <div class="card-footer-item">
                          <p class="subtitle is-7 is-small">ราคา: <span id="price-item-{{$product->item_id}}">{{$product->product_price}}</span> บาท/{{$product->product_units}}</p>
                      </div>
                      @endif
                  </footer>
                </div>
              </div>
              @endif
            @endforeach

            <div class="column animated fadeInUp faster">
            <h5 class="title is-6">อุปกรณ์</h5>
            </div>
            @foreach($products as $product)
            @if($product->product_type == "อุปกรณ์")
            <div class="column animated fadeInUp faster">
                <div class="card">
                    <div class="card-content">
                        <div class="columns is-mobile">
                            <div class="column">
                                <h6 class="title is-6">{{$product->product_name}}</h6>
                            </div>
                            <div class="columns is-mobile is-gapless">
                                <div class="column">
                                    <button class="button is-success" id="dis-item-{{$product->item_id}}"><i class="fas fa-minus-circle"></i></button>
                                </div>
                                <div class="column fb-non">
                                    <div class="control">
                                        <input class="input item-input" type="text" pattern="\d*" maxlength="2" id="item-{{$product->item_id}}" placeholder="จำนวน" value="" data-name="{{$product->product_name}}">
                                    </div>
                                </div>
                                <div class="column">
                                    <button class="button is-success" id="add-item-{{$product->item_id}}"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer pt-2">
                      <div class="card-footer-item">
                        <p class="subtitle is-7 is-small">ราคา: <span id="price-item-{{$product->item_id}}">{{$product->product_price}}</span> บาท/{{$product->product_units}}</p>
                      </div>
                    </footer>
                </div>
            </div>
            @endif
            @endforeach

          <div class="column" style="margin-top: 15vw;"><div class="card-invisible"><div class="card-content"></div></div></div>
        </div>

      </div>
    </section>


    <section class="section mt-10vw" id="purchase_list" style="display: none;">
      <div class="container">
        <h5 class="title is-5">สรุปรายการที่สั่งซื้อ</h5>
        <h5 class="subtitle is-6" style="margin-top:5px;">- หมายเลขการสั่งซื้อ #<span id="order_id"></span> <span class="tag is-warning is-pulled-right" id="back"><i class="far fa-edit iconx"></i>แก้ไขรายการ</span></h5>
        <div class="columns">
          <div class="column">
            <table class = "table is-fullwidth" border="0" id="purchase_list_t">
               <thead>
                  <tr>
                     <th><center>จำนวน</center></th>
                     <th>รายการ</th>
                     <th>ราคา</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
          </div>
        </div>
    </div>

    <div class="container">
      <hr style="height: 4px;border-top: 2px solid #34b449;"><h5 class="title is-5">ช่องทางการชำระเงิน</h5>
        <div class="columns">
          <div class="column" style="padding-top: 10px;">
            <label for="promtpay" class="label">
              <article class="message">
                <input id="promtpay" type="radio" name="payoption" value="promtpay"> โอนผ่าน QR CODE <span class="margin-icon"><i class="fas fa-qrcode"></i></span>
              </article>
            </label>
            <label for="bank" class="label">
              <article class="message">
                <input id="bank" type="radio" name="payoption" value="bank"> โอนผ่านบัญชีธนาคาร <span class="margin-icon"><i class="fas fa-university"></i></span>
              </article>
            </label>
            <label for="destination" class="label">
              <article class="message">
                <input id="destination" type="radio" name="payoption" value="destination"> เก็บเงินปลายทาง <span class="margin-icon"><i class="fas fa-hand-holding-usd"></i></span>
              </article>
            </label>
          </div>
          <div class="column" style="padding-top: 10px;">
            <h5 class="title is-5">หมายเหตุ</h5>
            <div class="field">
              <div class="control">
                <textarea class="textarea is-success" id="comment" placeholder="ระบุข้อความ ..."></textarea>
              </div>
            </div>
          </div>
          <div class="column"><div class="card-invisible"><div class="card-content"></div></div></div>
          <div class="column"><div class="card-invisible"><div class="card-content"></div></div></div>
        </div>
    </div>
    </section>

    <section class="section hidden-d" id="summary-bar">
      <nav class="navbar is-fixed-bottom" id="sa-s">
        <div class="card">
          <div class="card-content">
            <div class="columns is-mobile">
              <div class="column has-text-centered"><span id="count">0</span> รายการ</div>
              <div class="column is-one-third has-text-centered">ยอดรวม</div>
              <div class="column has-text-centered"><span id="price">0</span> บาท</div>
            </div>
          </div>
          <div class="card-content footer-p">
            <div class="columns is-mobile">
            <div class="column"><button class="button is-success is-fullwidth is-rounded" id="cart"><i class="fas fa-shopping-cart"></i> <span class="margin-sum"> สรุปรายการสั่งซื้อ</span></button></div>
          </div>
            <div class="columns is-mobile has-text-centered" style="margin: 0px;padding: 0px;">
              <div class="column dev">Powered by NashX</div>
            </div>
          </div>
        </div>
      </nav>
    </section>

    <section class="section hidden-d" id="confirm-bar" style="display: none;">
      <nav class="navbar is-fixed-bottom" id="sa-c">
        <div class="card">
          <div class="card-content" style="padding: 5px;">
            <div class="columns is-mobile">
            </div>
          </div>
          <div class="card-content footer-p">
            <div class="columns is-mobile">
              <div class="spinner" id="loading">
                <p style="padding-bottom: 20px;">กำลังดำเนินการกรุณารอสักครู่</p>
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
              </div>
            </div>
            <div class="columns is-mobile" id="e_total_price">
              <div class="column has-text-centered ttsum"><article class="message"><h5 class="subtitle is-5 label">ยอดรวม <span id="total_price">0</span> บาท</h5></article></div>
            </div>
            <div class="columns is-mobile" id="e_confirm">
              <div class="column">
                   <div class="column btn-p10">
                       <button class="button is-success is-fullwidth is-rounded" id="confirm"><i class="fas fa-dollar-sign"></i> <span class="margin-sum"> ยืนยันการสั่งซื้อ</span></button>
                   </div>
              </div>
            </div>
            <div class="columns is-mobile has-text-centered" style="margin: 0px;padding: 0px;">
              <div class="column dev">Powered by NashX</div>
            </div>
          </div>
        </div>
      </nav>
    </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
  <script src="{{mix('/js/app.js')}}"></script>
  <script src="{{mix('/js/liff.js')}}"></script>
  <script src="{{mix('/js/resize.js')}}"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-TXR0674JYJ"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-TXR0674JYJ');
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ResponsiveSlides.js/1.55/responsiveslides.min.js" integrity="sha512-xLb7JAM9BNykuzMmlFtHHgQQAwFMiPVf9IhLV6g/IgQInWqxECLrlqBo64ytFPZH7qeZjahD1TOvl/wp8dL6LA==" crossorigin="anonymous"></script>
    <script>
      $(".rslides").responsiveSlides({
        auto: true,             // Boolean: Animate automatically, true or false
        speed: 500,            // Integer: Speed of the transition, in milliseconds
        timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
        pager: false,           // Boolean: Show pager, true or false
        nav: false,             // Boolean: Show navigation, true or false
        random: false,          // Boolean: Randomize the order of the slides, true or false
        pause: false,           // Boolean: Pause on hover, true or false
        pauseControls: true,    // Boolean: Pause when hovering controls, true or false
        prevText: "Previous",   // String: Text for the "previous" button
        nextText: "Next",       // String: Text for the "next" button
        maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
        navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
        manualControls: "",     // Selector: Declare custom pager navigation
        namespace: "rslides",   // String: Change the default namespace used
        before: function(){},   // Function: Before callback
        after: function(){}     // Function: After callback
      });
    </script>
</body>
</html>
