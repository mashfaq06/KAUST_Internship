<?php


if(isset($_POST['search']))
{
    $valueToSearch = $_POST['NameToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `dataset` WHERE CONCAT(`title`, `abstract`, `keywords`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);

}
elseif(isset($_POST['submit']))
{
    $categories=$_POST['category'];
    $t=0;
    $count=0;
    $size=count($categories);
    while($t<=$size)
    {
        echo "Entered while loop ";
        if($categories[$t]!=null)
        {
            echo "'Entered If condition' ";
            $count=$count+1;
        }


        echo "Value of Count in while loop is ".$count ."\n";

    }
    for($i=0;$i<=$count;$i++)
    {
        if($categories[$i]!=null)
        {
            //$number=count($categories[$i]);
            echo "\nThe Value of Count in for loop is ".$count ." ";
            echo "\nThe values are ";
            echo $categories[$i];
            echo "\n Value of add is  ";
            $add=$i+1;
            echo $add;
            $connect = mysqli_connect("localhost", "ashfaq", "password", "test");
            $sql = "UPDATE dataset SET cat1='$categories[$i]' WHERE sno='$add';";
            $stmt=$connect->query($sql);
            $connect->close();

        }

    }

    $query = "SELECT * FROM `dataset`";
    $search_result = filterTable($query);}
else
{
    $query = "SELECT * FROM `dataset`";
    $search_result = filterTable($query);
}


// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "ashfaq", "password", "test");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Dataset</title>
    <style>
        .legend
        {
            border: 1px solid gray;
            border-collapse: collapse;
            width:0.1%;
            white-space: nowrap;

        }
        .legend td
        {
            border: 1px solid gray;

        }
        .legend th
        {
            border: 1px solid gray;
        }

        .dataset_table td,th
        {
            border:1px solid gray;
            border-collapse: collapse;
        }
        .table-fixed tbody {
            height: 200px;
            overflow-y: auto;
            width: 100%;
        }
        .table-fixed thead,
        .table-fixed tbody,
        .table-fixed tr,
        .table-fixed td,
        .table-fixed th {
            display: block;
        }
        .table-fixed tr:after {
            content: "";
            display: block;
            visibility: hidden;
            clear: both;
        }
        .table-fixed tbody td,
        .table-fixed thead > tr > th {
            float: left;
        }
        .table > thead > tr > th,
        .table > thead > tr > td {
            font-size: .9em;
            font-weight: 400;
            border-bottom: 0;
            letter-spacing: 1px;
            vertical-align: top;
            padding: 8px;
            background: #51596a;
            text-transform: uppercase;
            color: #ffffff;
        }
    </style>
</head>
<body>
<center>
    <h1>Data Set</h1>
</center>
<form action="Type2.php" method="post">
    <table class="legend">
        <tr>
            <th class="col-1">S.no</th>
            <th class="col-2">Category Name</th>
            <th class="col-3">S.no</th>
            <th class="col-4">Category Name</th>
        </tr>
        <tr>
            <td width="30">1</td> <td> Information Retrival</td> <td width="30">11</td> <td> Feature selection & Extraction </td>
        </tr>
        <tr>
            <td width="30">2</td> <td> Natural language processing </td> <td width="30">12</td> <td> Rule Learning </td>
        </tr>
        <tr>
            <td width="30">3</td> <td> Clustering </td> <td width="30">13</td> <td> Semi-supervised & Active learning</td>
        </tr>
        <tr>
            <td width="30">4</td> <td> Optimizing Methods </td> <td width="30">14</td> <td> Agent System </td>
        </tr>
        <tr>
            <td width="30">5</td> <td> Gene and cancer </td> <td width="30">15</td> <td> Recommendation </td>
        </tr>
        <tr>
            <td width="30">6</td> <td> Tracking </td> <td width="30">16</td> <td> Unsupervised learning </td>
        </tr>
        <tr>
            <td width="30">7</td> <td> Security and privacy </td> <td width="30">17</td> <td> Dimensionality reduction </td>
        </tr>
        <tr>
            <td width="30">8</td> <td> Time Series </td> <td width="30">18</td> <td> Neural Networks </td>
        </tr>
        <tr>
            <td width="30">9</td> <td> Graph Mning & Social Network </td> <td width="30">19</td> <td> Online Learning </td>
        </tr>
        <tr>
            <td width="30">10</td> <td> Supervised Learning </td> <td width="30">20</td> <td> Multi-label Classification </td>
        </tr>

    </table><br>

    Name: <input type="text" size="30" placeholder="Enter the name" name="NameToSearch">
    <input type="submit" name="search" value="Search" style="alignment: right"> <br><br><br>
    <table class="table table-fixed">
        <thead>
        <tr>
            <th class="col-1">title</th>
            <th class="col-4">abstract</th>
            <th class="col-2">Keyword</th>
            <th class="col-2">Enter Category</th>
            <th class="col-3">Category</th>
        </tr>
        </thead>
        <tbody>
        <!-- populate table from mysql database -->
        <?php while($row = mysqli_fetch_array($search_result)):?>
            <tr>
                <td class="col-1"> <?php echo $row['title'];?> </td>
                <td class="col-4"><?php echo $row['abstract'];?></td>
                <td class="col-2"><?php echo $row['keywords'];?></td>
                <td class="col-2"><input  type="text" name="category[]" placeholder="category"><br></td>
                <td class="col-3"><?php echo $row['cat1'];?></td>
            </tr>
        <?php endwhile;?>
        </tbody>
        <input type="submit" name="submit" value="submit">
    </table><br>

</form>

</body>
</html>