<section class="bread-crumb mb-3">
	<span class="crumb-border"></span>
	<div class="container ">
		<div class="row">
            <div class="col-12 a-left">
                <ul class="breadcrumb m-0 px-0">
                    <li class="home">
                        <a  href="/" class='link' ><span>@lang('frontend.home')</span></a>						
                        <span class="mr_lr">&nbsp;/&nbsp;</span>
                    </li>

                    @if (!is_null($breadcrumb))
                        @foreach ($breadcrumb->sortBy('level') as $item)
                            @if ($item->canonical == $model->canonical)
                                @continue
                            @endif
                            @php
                                $name = $item->name;
                                $canonical = writeUrl($item->canonical, true, true);
                            @endphp
                            <li>
                                <a href="{{ $canonical }}" class="link">{{ $name }}</a>
                                <span class="mr_lr">&nbsp;/&nbsp;</span>
                            </li>
                        @endforeach
                    @endif

                    <li><strong ><span>{{ $model->name }}</span></strong></li>
                </ul>
            </div>
		</div>
	</div>
</section>