<?php
require_once "Database.php";
$conn = (new Database())->getConnection();

$stmt = $conn->query("SELECT * FROM `parameter`;");
$setting = $stmt->fetch(PDO::FETCH_ASSOC);
$parameter = $setting["parameter_a"];
$y1Check = $setting["y1"];
$y2Check = $setting["y2"];
$y3Check = $setting["y3"];

?>
<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Richterova">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>SSE</title>
</head>

<body class="bg-light">

<div class="container">
    <div class="row pt-5 pb-3 justify-content-center">
        <div class="col-sm-7">
            <div class="card text-center" >
                <div class="card-body">
                    <h2 class="card-title">SSE</h2>
                    <div class="mb-3">
                        <label for="result" class="form-label">Output</label>
                        <textarea class="form-control text-center" id="result" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card ">
                <div class="card-body">
                    <h4 class="card-title text-center">Settings</h4>
                    <form action="updateSettings.php" method="post" >
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">a</span>
                            <input type="number" step="0.01" id="parameterInput" value="1" class="form-control" aria-label="Parameter" name="parameter" aria-describedby="basic-addon1">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="y1Check" value="1" id="check1">
                            <label class="form-check-label" for="check1">
                                y1 = sin<sup>2</sup>(ax)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="y2Check" value="1" id="check2">
                            <label class="form-check-label" for="check2">
                                y2 = cos<sup>2</sup>(ax)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="y3Check" value="1" id="check3">
                            <label class="form-check-label" for="check3">
                                y3 = sin(ax).cos(ax)
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="my-3 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy;2021 WEBTECH2 - Richterová </p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script>
    var y1 = <?php echo $y1Check; ?>;
    var y2 = <?php echo $y2Check; ?>;
    var y3 = <?php echo $y3Check ?>;
    var parameter = <?php echo $parameter ?>;
    document.getElementById("parameterInput").value = parameter;
    if(y1){
        $("#check1").prop('checked', true);
    }
    if(y2){
        $("#check2").prop('checked', true);
    }
    if(y3){
        $("#check3").prop('checked', true);
    }
</script>

<script>
    var source = new EventSource("sse.php");
    source.addEventListener('data', (e) =>{
        var data = JSON.parse(e.data);
        console.log(data);
        document.querySelector("#result").textContent = JSON.stringify(data);

    })
</script>
</body>



</html>