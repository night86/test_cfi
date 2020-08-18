<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to CodeIgniter 4!</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-12">
            <div class="alert alert-secondary" role="alert">Test application</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Text</label>
                <textarea class="form-control" id="words" rows="3"></textarea>
            </div>
        </div>
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-12">
            <button id="sendWords" type="button" class="btn btn-primary btn-block">Submit</button>
        </div>
    </div>

    <div class="row results" style="display: none;">
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Word</th>
                    <th scope="col">Count</th>
                    <th scope="col">Stars</th>
                </tr>
                </thead>
                <tbody id="results">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function(){
        $('#sendWords').on('click', function(){

            var words = $('#words').val();
            $('#results').empty();

            if(words.length !== 0 && words.trim().length !== 0){

                $.ajax({
                    method: "post",
                    url: "/home/ajax",
                    data: { ip: "<?=$_SERVER['REMOTE_ADDR']?>", words: words }
                }).done(function(data){
                    $('#results').append(data);
                    $('.results').show();
                });
            }
            else {
                alert("Please fill in the empty fields.");
            }
        });
    });
</script>
</body>
</html>
