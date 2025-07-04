<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="{{ asset('frontend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/libs/alertifyjs/build/alertify.min.js') }}"></script>
<script src="{{ asset('backend/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('frontend/libs/wow/dist/wow.min.js') }}"></script>

<script>
    const Config = {
        baseUrl: "{{ url('/') }}",
    };
</script>

<script src="{{ asset('frontend/js/banner-slides.js') }}"></script>
<script src="{{ asset('frontend/js/pages/home.js') }}"></script>
<script src="{{ asset('frontend/js/library.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('backend/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>

@php
    $customScripts = $config['js'] ?? [];
@endphp

@foreach ($customScripts as $script)
    <script src="{{ asset($script) }}"></script>
@endforeach

<!-- Preload and load index.js -->
<link rel="preload" as="script" href="{{ asset('frontend/js/index.js') }}" />
<script src="{{ asset('frontend/js/index.js') }}" type="text/javascript"></script>

<!-- Preload and load main.js -->
<link rel="preload" as="script" href="{{ asset('frontend/js/main.js') }}" />
<script src="{{ asset('frontend/js/main.js') }}" type="text/javascript"></script>

<!-- Preload and load ega-gateway-min.js -->
<link rel="preload" as="script" href="{{ asset('frontend/js/ega-gateway-min.js') }}" />
<script src="{{ asset('frontend/js/ega-gateway-min.js') }}" type="text/javascript"></script>

<script>
      var Bizweb = Bizweb || {};
      Bizweb.store = "my-pham-cho-spa.mysapo.net";
      Bizweb.id = 494811;
      Bizweb.theme = {
      id: 921992,
      name: "EGA Cosmetic",
      role: "main"
      };
      Bizweb.template = "index";
      if (!Bizweb.fbEventId) Bizweb.fbEventId = "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, (function(c) {
      var r = Math.random() * 16 | 0, v = c == "x" ? r : r & 3 | 8;
      return v.toString(16);
      }));
</script>
<script>
      (function() {
      function asyncLoad() {
      var urls = [ "//newproductreviews.sapoapps.vn/assets/js/productreviews.min.js?store=my-pham-cho-spa.mysapo.net" ];
      for (var i = 0; i < urls.length; i++) {
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.async = true;
            s.src = urls[i];
            var x = document.getElementsByTagName("script")[0];
            x.parentNode.insertBefore(s, x);
      }
      }
      window.attachEvent ? window.attachEvent("onload", asyncLoad) : window.addEventListener("load", asyncLoad, false);
      })();
</script>
<script>
      window.BizwebAnalytics = window.BizwebAnalytics || {};
      window.BizwebAnalytics.meta = window.BizwebAnalytics.meta || {};
      window.BizwebAnalytics.meta.currency = "VND";
      window.BizwebAnalytics.tracking_url = "/s";
      var meta = {};
      for (var attr in meta) {
      window.BizwebAnalytics.meta[attr] = meta[attr];
      }
</script>
