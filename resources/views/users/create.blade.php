<h1>Create Form</h1>
<form action="/store" method="POST">
    @csrf
    Name : <input type="text" id="name" name="name" placeholder="Enter Your name"> <br><br>
    Phone : <input type="phone" id="phone" name="phone" placeholder="Enter Your Phone"> <br><br>
    <button type="submit">Save</button>
</form>

{{-- <h1>Update Form</h1>
<form action="/update/{{$user['id']}}" method="POST">
    @csrf
    Name : <input type="text" id="name" name="name" value = "{{$user['name']}}"> <br>
    Email : <input type="email" id="email" name="email" value = "{{$user['email']}}"> <br>
    <button type="submit">Update</button>
</form> --}}