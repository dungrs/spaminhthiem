<div class="mb-3">
    <select class="form-control rounded choice-single" name="publish">
        @foreach (__('messages.publish') as $key => $val)
            <option value="{{ $key }}">{{ $val }}</option>
        @endforeach
    </select>
</div>