<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('add-vehicle')}}" method="post">
     @csrf
    <label for="make">make:</label>
    <input type="text" pleaceholder="enter ur make" name="make" id="make">
    <label for="salary">model:</label>
    <input type="text" pleaceholder="enter ur salary" name="model" id="model">
    <label for="make">year:</label>
    <input type="text" pleaceholder="enter ur make" name="year" id="year">
    <label for="salary">license_plate:</label>
    <input type="text" pleaceholder="enter ur license_plate" name="license_plate" id="license_plate">
    <button type="submit"> Add</button>
   <!-- @if(Session::has("message"))
    <div >{{Session::get("message")}}</div>
    @endif -->
    </form>

</body>
</html>