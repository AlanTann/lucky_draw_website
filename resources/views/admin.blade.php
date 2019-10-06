<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>Admin Page</title>
</head>
<body>
<div style="padding-top:50px; padding-left:50px">
    <p style="font-weight:bold; font-size:20px">Lucky Draw</p>

    <form method="post" action="/draw" style="padding-top:20px">

    <p style="font-weight:bold">Prize Types:</p>
    <select class="mdb-select md-form colorful-select dropdown-success" name="prize_type">
        <option value="grand_winner">first_prize</option>
        <option value="second_first_winner">second prize - 1st winner</option>
        <option value="second_second_winner">second prize - 2nd winner</option>
        <option value="third_first_winner">third prize - 1st winner</option>
        <option value="third_second_winner">third prize - 2nd winner</option>
        <option value="third_third_winner">third prize - 3rd winner</option>
    </select>
    <p></p>
    <p style="font-weight:bold; margin-top: 20px">Generate Randomly:</p>
    <select class="mdb-select md-form colorful-select dropdown-success"  name="random">
        <option value="yes">yes</option>
        <option value="no">no</option>
    </select>
    <p></p>
    <p style="font-weight:bold; margin-top: 20px">Winning Number:</p>
    <input type="text" name="lucky_number"><br>

    <button class="btn btn-primary" style="margin-top: 30px">DRAW</button>

    </form>

    <div style="margin-top: 30px">Result:
        @if(isset($result))
            {{$result}}
        @endif
    </div>
</div>
</body>
</html>