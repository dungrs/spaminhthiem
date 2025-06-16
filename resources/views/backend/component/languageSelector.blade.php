<div class="btn-group dropstart me-2">
    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="d-flex justify-content-center align-items-center">
            <i class="mdi mdi-chevron-left me-1"></i>
            <img id="lang_image_select" src="{{ asset($currentLanguage->image ?? '') }}" class="me-2" alt="Header Language" height="16" width="25px"> 
            <div id="lang_name_select">
                {{ $currentLanguage->name }}
            </div>
        </div>
    </button>
    <div class="dropdown-menu">
        @if ($availableLanguages)
            @foreach ($availableLanguages as $language)
                <a 
                class="dropdown-item notify-item language-filter {{ $currentLanguage->canonical == $language->canonical ? 'active' : '' }}" 
                data-name="{{ $language->name }}" 
                data-image="{{ $language->image }}" 
                data-id="{{ $language->id }}"
                >
                    <img src="{{ asset($language->image ?? '') }}" alt="user-image" class="me-2" height="12" width="20"> <span class="align-middle">{{ $language->name }}</span>
                </a>
            @endforeach
        @endif
    </div>
</div>