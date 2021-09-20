<form
    method="post"
    action="{{ route('text_search') }}"
    accept-charset="UTF-8"
>
    @csrf

    <div class="input-group mb-3">
        <input
            type="text"
            id="text_search"
            name="text_search"
            class="form-control"
            placeholder="Поиск"
            {{ $disabled }}
            value="{{ $search_text }}"
        >

        <button
            class="btn btn-primary"
            type="submit"
            id="btn_search"
            {{ $disabled }}
        >
            Найти
        </button>
    </div>
</form>
