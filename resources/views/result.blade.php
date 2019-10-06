<!doctype html>
<html>
<head>
    <title>Result Page</title>
</head>
<body>

    <p>Result Page</p>

    <p>Grand Winner = 
        @if(isset($winningResult['grand_winner']))
            {{$winningResult['grand_winner']}}
        @endif
    </p>

    <p>Second First Winner = 
        @if(isset($winningResult['second_first_winner']))
            {{$winningResult['second_first_winner']}}
        @endif
    </p>

    <p>Second SecondWinner = 
        @if(isset($winningResult['second_second_winner']))
            {{$winningResult['second_second_winner']}}
        @endif
    </p>

    <p>Third First Winner = 
        @if(isset($winningResult['third_first_winner']))
            {{$winningResult['third_first_winner']}}
        @endif
    </p>

    <p>Third Second Winner = 
        @if(isset($winningResult['third_second_winner']))
            {{$winningResult['third_second_winner']}}
        @endif
    </p>

    <p>Third Third Winner = 
        @if(isset($winningResult['third_third_winner']))
            {{$winningResult['third_third_winner']}}
        @endif
    </p>
</body>
</html>