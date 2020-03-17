<!DOCTYPE html>
<html>
<head>
    <title>{{$art->name}}</title>
</head>
<style>

    @page { margin: 20px; }

    body {
        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        margin: 20px;
    }

    .block {
        display: block;
    }

    .minifont12 {
        font-size: 12px;
    }

    .minifont10 {
        font-size: 10px;
    }

    .col-md-45 {
        width: 45%;
        display: inline-block;
    }

    .col-md-30 {
        width: 30%;
        display: inline-block;
    }

    .col-md-25 {
        width: 24%;
        display: inline-block;
    }

    .bluecolor {
        background-color: #C5C5EC;
    }

    .midtop {
        margin-top: 50px;
    }

    .center {
        text-align: center;
    }
</style>
<body>
<div class="header center " style="margin-bottom: 10px;">
    <h3><strong>ALJOE ALMAZAN</strong></h3>
</div>
<div class="header" style="position:relative; top:10; width:50%; margin: 0 auto ">
    <img src="{{ public_path("images/arts/".$art->image) }}" style="max-width: 100%">
</div>
<div class="content  midtop center">
    <h3>{{$art->name}}</h3>
    <p>{{$art->size1}} | {{$art->size2}}</p>
    <p style="font-size: 20px">{{$art->year}}</p>
    <br>
    <p style="margin: 0 auto; text-align: center;">{!! $art->description !!}</p>
</div>
<div class="content" style="position:absolute; bottom:10px;  margin: 0 auto; text-align: center">
    <p>aljoealmazan.com</p>
</div>
</body>
</html>