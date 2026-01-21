<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email təsdiqi</title>
</head>
<body>
<h2>Salam {{ $name }}</h2>

<p>Zəhmət olmasa email ünvanınızı təsdiqləyin:</p>

<p>
    <a href="{{ $link }}" style="padding:10px 20px;background:#2563eb;color:white;text-decoration:none;border-radius:6px;">
        Emaili təsdiqlə
    </a>
</p>

<p>Əgər bu əməliyyatı siz etməmisinizsə, mesajı nəzərə almayın.</p>
</body>
</html>
