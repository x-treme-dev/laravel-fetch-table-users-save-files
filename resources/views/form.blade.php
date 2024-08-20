<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
</head>
<body>
    <form action="{{ route('form.store') }}" method='post' enctype='multipart/form-data'>
        @csrf
         <input type="text" name='path' id="path" required placeholder="Введите URL"  class="@error('path') is-invalid @else is-valid @enderror">
         @error('path')
         <b>{{ $message }}</b>
         @enderror
         <br><br>
         <input type="submit" value="Отправить">
       </form>
       <br>
       @if ($message = Session::get('success'))
       <div>
           <b>{{ $message }}</b>
       </div> 
       @endif
      
       @if ($data = Session::get('data'))
       <div>
          <!-- {{ print_r($data) }} -->
           <pre>
            <table>
                <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>email</th>
                <th>Birth date</th>
                <th>registered</th>
                <th>City</th>
                <th>Street</th>
                <th>Suite</th>
                <th>Phone</th>
                <th>Website</th>
                <th>Company</th>
                </tr>
               <tbody>
                @foreach( $data as $item)
                 <!--Если строка таблицы четная, то красить в серый цвет-->
                  @if (!$loop->even)
                     <tr @style([
                     'background-color:#cacfd2',
                     ])>
                     <td >{{$item['firstname']}}</td>
                     <td>{{$item['lastname']}}</td>
                     <td>{{$item['email']}}</td>
                     <td>{{$item['birthDate']}}</td>
                     <td>{{$item['login']['registered']}}</td>
                     <td>{{$item['address']['city']}}</td>
                     <td>{{$item['address']['street']}}</td>
                     <td>{{$item['address']['suite']}}</td>
                     <td>{{$item['phone']}}</td>
                     <td>{{$item['website']}}</td>
                     <td>{{$item['company']['name']}}</td>
                     </tr>
                      <!--Иначе выводим как есть-->  
                    @else
                    <tr>
                     <td >{{$item['firstname']}}</td>
                     <td>{{$item['lastname']}}</td>
                     <td>{{$item['email']}}</td>
                     <td>{{$item['birthDate']}}</td>
                     <td>{{$item['login']['registered']}}</td>
                     <td>{{$item['address']['city']}}</td>
                     <td>{{$item['address']['street']}}</td>
                     <td>{{$item['address']['suite']}}</td>
                     <td>{{$item['phone']}}</td>
                     <td>{{$item['website']}}</td>
                     <td>{{$item['company']['name']}}</td>
                     </tr>
                     @endif
                 @endforeach
                </tbody>
             </table>
           </pre>
       </div> 
       @endif
 
    
</body>
</html>