<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach($employees as $employee)
    <div style=" flex">
        id:{{$employee->id}}
        name:{{$employee->name}}
        <br>
        salary:{{$employee->salary}}
       <a href="/edit/employee/{{$employee->id}}"> Edit </a>
    </div>
    @endforeach
</body>
</html>