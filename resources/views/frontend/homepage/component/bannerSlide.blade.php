{{-- Slider --}}
@if (count($slides[$slideKeyword::MAIN]['item']))
    <div class="col-xl-60 col-md-9 col-12 mt-3 px-xl-0 pr-md-0">
        <div class="section_slider clearfix">
            <div class="panel-slide page-setup" data-setting="{{ json_encode($slides[$slideKeyword::MAIN]['setting']) }}">
                <div class="uk-container uk-container-center">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($slides[$slideKeyword::MAIN]['item'] as $key => $val)
                                <div class="swiper-slide">
                                    <div class="slide-item">
                                        {{-- <div class="slide-overlay">
                                            <div class="slide-title">{!! $val['name'] !!}</div>
                                            <div class="slide-description">{!! $val['description'] !!}</div>
                                        </div> --}}
                                        <span class="image"><img src="{{ $val['image'] }}" style="max-height: 400px;" alt="{{ $val['alt'] }}"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
    
{{-- Banner --}}
@if (count($slides[$slideKeyword::BANNER]['item']))
    <div class="col-xl-15 col-md-3 col-12 pt-3 sub_banner">
        @foreach ($slides[$slideKeyword::BANNER]['item'] as $key => $val)
            <a class="sub_banner__item banner" href="/collections/all" title="Promo 1">
                <picture>
                <source
                        media="(max-width: 480px)"
                        srcset="{{ $val['image'] }}">
                <img
                        class='img-fluid'
                        src="{{ $val['image'] }}"
                        alt="{{ $val['alt'] }}"
                        width="258"
                        height="auto"/>
                </picture>
            </a>
        @endforeach
    </div>
@endif
