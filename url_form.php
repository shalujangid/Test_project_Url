<?php include "db.php";
$get_data_query=mysqli_query($conn,"SELECT * FROM sj_url_data");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL form</title>
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap-grid.min.css" integrity="sha512-a+PObWRxNVh4HZR9wijCGj84JgJ/QhZ8dET09REfYz2clUBjKYhGbOmdy9KEHilYKgbMSIHNQEsonv/r75mHXw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
body {
    background: #eee
}
#urlForm {
    background-color: #ffffff;
    margin: 0px auto;
    font-family: Raleway;
    padding: 40px;
    border-radius: 10px
}
#url_form{
    color: #6A1B9A;
}
h1 {
    text-align: center;
}
input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
    border-radius: 10px;
    -webkit-appearance: none;
}
.t input:focus{
    border:1px solid #6a1b9a !important;
    outline: none;
}
input.invalid {
    border:1px solid #e03a0666;
}
.old {
    color: red;
}
.middleaged {
    color: blue;
}
.young {
    color: green;
}
</style>
</head>
<body >
    <div class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-8">
                <form action="javascript:void(0);" id="urlform">
                    <h1 id="url_form">Url Form</h1>
                
                    <div class="t">
                        <label for="url" style="font-size:21px;color:grey">Enter URL:</label><br><br>
                        <input type="url" name="url" id="url" placeholder="https://url.com" pattern="https://.*" size="30" onchange="get_url()" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <table id="example" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Sno.</th>
            <th>URL</th>
            <th>Website Title</th>
            <th>Thumbnail Image</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if(mysqli_num_rows($get_data_query)>0)
    {
      
            $i=1;
            while($fetch_data = mysqli_fetch_assoc($get_data_query)){
                ?>
            <tr>
                <td><?php echo $fetch_data['ID'];?></td>
                <td><?php echo $fetch_data['Url'];?></td>
                <td><?php echo $fetch_data['Webpage_Title'];?></td>
                <td><?php echo $fetch_data['Thumnail_Image'];?></td>
            </tr>
        <?php
        $i++;
            }  
    }
    ?>
    </tbody>
</table>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.min.js" integrity="sha512-5BqtYqlWfJemW5+v+TZUs22uigI8tXeVah5S/1Z6qBLVO7gakAOtkOzUtgq6dsIo5c0NJdmGPs0H9I+2OHUHVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script>
//code to disable right click on webpage
window.addEventListener('contextmenu', function (e) { 
  e.preventDefault(); 
}, false);
//code to display datatable
$(document).ready(function () {
    $('#example').DataTable();
});
//ajax call
function get_url()
{
    var url=$("#url").val();
    $.ajax({
    url:'ajax_url.php',
    type:'POST',
    data: {"action":"get_title_and_thumbnail",url:url},
    success: function(msg)
    {
        $('#example').append(msg);
    }
	});
}

</script>
</html>