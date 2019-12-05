<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Bootstrap 3 scrollable dropdown</title>

  <!-- See Scrollable Menu with Bootstrap 3 http://stackoverflow.com/questions/19227496 -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>

  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.js"></script>
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.css">

  <style>
    .dropdown-menu {
      width: 100%;
    }

    .scrollable-menu {
      height: auto;
      max-height: 200px;
      overflow-x: hidden;
    }
  </style>
</head>

<body>
  
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            {{count(auth()->user()->unreadNotifications)}} <span class="caret"></span>
          </button>
          <ul class="dropdown-menu scrollable-menu" role="menu">
          @foreach(auth()->user()->unreadNotifications as $notifications)
          <li><a href="#" id="text_notif">{{$notifications->data['order']['orderCode']}} has been made"</a><br>
          </li>
          @endforeach
          </ul>
        </div>
        
</body>

</html>
