<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <div class="container">
  @if(session('message'))
							<div class="alert alert-success">
									{{ session('message') }}
							</div>
		@endif
    <form action="{{route('postInputEmail')}}" method="post">
    @csrf
    <div class="form-group">

      <label for="">Email của bạn</label>
      <input type="text" name="txtEmail" id="" class="form-control" placeholder="Nhập Email của bạn" aria-describedby="helpId" value="{{isset($request->txtEmail)?$request->txtEmail:''}}">
      
      <button type="submit" class="btn btn-primary">Reset Password</button>
    </div>
    </form>
  </div>
</body>
</html>