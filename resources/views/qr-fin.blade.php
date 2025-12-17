<form action="{{ route('qr.check') }}" method="POST">
    @csrf
    <label>FIN daxil edin:</label>
    <input type="text" name="fin" required maxlength="7">
    <button type="submit">Təsdiqlə</button>
</form>
