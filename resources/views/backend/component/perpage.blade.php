<div class="mb-3">
    <select class="form-control rounded choice-single" name="perpage">
        @for ($i = 20; $i <= 200; $i+=20 )
            <option value="{{ $i }}">{{ $i }} {{ __('messages.perpage') }}</option>
        @endfor
    </select>
</div>