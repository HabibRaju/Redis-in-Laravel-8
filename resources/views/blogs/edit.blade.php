<h1>Update Form</h1>
<form action="/update/{{$blog->id}}" method="POST">
    @csrf
    Title       : <input type="text" id="title" name="title" value = "{{$blog->title}}"> <br><br>
    Sub Header  : <input type="text" id="sub_header" name="sub_header" value = "{{$blog->sub_header}}"> <br><br>
    Content     : <input type="text" id="content" name="content" value = "{{$blog->content}}"> <br><br>
    <button type="submit">Update</button>
</form>