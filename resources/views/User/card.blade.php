<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badge | {{$users->name}}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300;900&display=swap');

body {
  background: #f2f2f2;
}

.container  {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  height: 400px;
  width: 600px;
  background: #f2f2f2;
  overflow: hidden;
  border-radius: 20px;
  cursor: pointer;
  box-shadow: 0 0 20px 8px #d0d0d0;
}

.content {
  position: absolute;
  top: 50%;
  transform: translatey(-50%);
  text-align: justify;
  color: black;
  padding: 40px;
  font-family: 'Merriweather', serif;
}

h1 {
  font-weight: 900;
  text-align: center;
}

h3 {
  font-weight: 300;
}
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="content" style="text-align: center">
          <h1>{{$users->name}}</h1>
          <p>
            <span class="label label-info">{{$users->type}}</span>
            <span class="label label-info">
                
                @if ($users->administration=="active")
                Administration &nbsp;-
                @endif
            </span>&nbsp;
            <span class="label label-info">
                     
                @if ($users->parametre=="active")
                Paramètre &nbsp;-
                @endif
            </span>&nbsp;
            <span class="label label-info">
                 
                @if ($users->stock=="active")
                Stock &nbsp;-
                @endif
            </span>&nbsp;
            <span class="label label-info">
                 
                @if ($users->tiers=="active")
                Tiers &nbsp;- 
                @endif    
            </span>&nbsp;
            <span class="label label-info">
                     
                @if ($users->caisse=="active")
                Caisse &nbsp;-
                @endif
            </span>&nbsp;
            <span class="label label-info">
                     
                @if ($users->vente=="active")
                Vente 
                @endif
            </span>
            <span class="label label-info">
                     
                @if ($users->responsable=="Y")
                &nbsp;-  Responsable &nbsp;-
                @endif
            </span>&nbsp;
          </p>
        </div>
        
        <img src="{{ asset('qrcodes') }}/User-{{$users->id}}.svg" style="width: 25%">
        <div class="flap"></div>
      </div>
</body>
</html>