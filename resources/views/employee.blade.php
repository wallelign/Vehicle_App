<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('add-employee')}}" method="post">
     @csrf
    <label for="name">name:</label>
    <input type="text" pleaceholder="enter ur name" name="name" id="name">
    <label for="salary">salary:</label>
    <input type="text" pleaceholder="enter ur salary" name="salary" id="salary">
    <button type="submit"> Add</button>
   @if(Session::has("message"))
    <div >{{Session::get("message")}}</div>
    @endif
    </form>

</body>
</html>