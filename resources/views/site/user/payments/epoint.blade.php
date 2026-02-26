<form action="{{ config('services.epoint.url') }}" method="POST">
    @foreach($data as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    <button type="submit">
        Ödənişə keç
    </button>
</form>

<script>
    document.forms[0].submit();
</script>
