<h1>Create Form</h1>
<form action="/store" method="POST">
    @csrf
    Title       : <input type="text" id="title" name="title" placeholder="Enter Title" required> <br><br>
    Sub Header  : <input type="text" id="sub_header" name="sub_header" placeholder="Enter Sub Header" required> <br><br>
    Content     : <input type="text" id="content" name="content" placeholder="Enter Your Content" required> <br><br>
    <button type="submit">Save</button>
</form>