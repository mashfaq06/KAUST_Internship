<?php


if(isset($_POST['search']))
{
    $valueToSearch = $_POST['NameToSearch'];
    if($valueToSearch!=null)
    {
        $query = "SELECT * FROM `datatable` WHERE Student_id = '$valueToSearch';";
        if ($query==null)
        $search_result = filterTable($query);
    }
}
elseif(isset($_POST['submit']))
{
    $category=$_POST['Category'];
    $count=count($category);
    for($i=0;$i<$count;$i++)
    {
        if($category[$i]!=null)
        {
            $value=$i+1;
            $connect = mysqli_connect("localhost", "ashfaq", "password", "test");
            $sql = "UPDATE datatable SET Category='$category[$i]' WHERE sno='$value';";
            $stmt=$connect->query($sql);
            $connect->close();
        }

    }

    $query = "SELECT * FROM `datatable`";
    $search_result = filterTable($query);}

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
            font-size: smaller;
        }
        .legend td
        {
            border: 1px solid gray;
        }
        .legend th
        {
            border: 1px solid gray;
        }
        .table-fixed tbody {
            height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
            width: 100%;
            font-size: small;
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
        .table-fixed thead > tr > th
        {
            float: left;
        }
        .table > thead > tr > th,
        .table > thead > tr > td {
            font-size: small;
            font-weight: 400;
            border: 1px solid gray;
            border-bottom: 2px;
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
    <h1> Delve Data Set</h1>
</center>
<form action="Datatable_test.php" method="post">
    <center>
    <table class="legend">
        <tr>
            <th>No.</th>
            <th>Category Name</th>
            <th>No.</th>
            <th>Category Name</th>
            <th>No.</th>
            <th>Category Name</th>
            <th>No.</th>
            <th>Category Name</th>
            <th>No.</th>
            <th>Category Name</th>
            <th>No.</th>
            <th>Category Name</th>
            <th>No.</th>
            <th>Category Name</th>

        </tr>
        <tr>
            <td>1</td> <td> Information Retrival</td>
            <td>4</td> <td> Optimizing Methods </td>
            <td>7</td> <td> Security and privacy </td>
            <td>10</td> <td> Supervised Learning </td>
            <td>13</td> <td> Semi-supervised & Active learning</td>
            <td>16</td> <td> Unsupervised learning </td>
            <td>19</td> <td> Online Learning </td>

        </tr>
        <tr>
            <td>2</td> <td> Natural language processing </td>
            <td>5</td> <td> Gene and cancer </td>
            <td>8</td> <td> Time Series </td>
            <td>11</td> <td> Feature selection & Extraction </td>
            <td>14</td> <td> Agent System </td>
            <td>17</td> <td> Dimensionality reduction </td>
            <td>20</td> <td> Multi-label Classification </td>

        </tr>
        <tr>
            <td>3</td> <td> Clustering </td>
            <td>6</td> <td> Tracking </td>
            <td>9</td> <td> Graph Mning & Social Network </td>
            <td>12</td> <td> Rule Learning </td>
            <td>15</td> <td> Recommendation </td>
            <td>18</td> <td> Neural Networks </td>
            <td>21</td> <td>Deep Learning</td>

        </tr>

    </table>
    </center><br>

    Student ID: <input type="text" size="30" placeholder="Enter Student ID" name="NameToSearch">
    <input type="submit" name="search" value="Search" style="alignment: right">
    <br><p><?php
        $student_id= $_POST['NameToSearch'];
        if($student_id!=null)
        {
            echo "The Student ID is ".$student_id;
        }
        else
        {
            echo "<center><h3>Enter Student ID</h3></center>";
        }
        ?></p>
    <!-- <input type="text" placeholder="Paper_Id" name="Paper_id">
    <input type="text" placeholder="Categories" name="Categories"> -->
        <form>
        <br><table class="table table-fixed" width="100%" style="table-layout: fixed">
        <input type="submit" name="submit" value="submit"><br>

        <thead>
            <tr>
                <th width="10%">Title</th>
                <th width="15%">Indexkeys</th>
                <th width="10%">AuthorKeys</th>
                <th width="40%">Abstacts</th>
                <th width="10%">Categories</th>
                <th width="15%">Enter Category</th>

            </tr>
            </thead>
            <!-- populate table from mysql database -->
            <tbody>
            <?php
            if($search_result!=null)
            {
            while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td width="10%" ><?php echo $row['Title'];?></td>
                    <td width="15%" ><?php echo $row['Indexkeys'];?></td>
                    <td width="10%" ><?php echo $row['Autokeys'];?></td>
                    <td width="40%" ><?php echo $row['Abstract'];?> </td>
                    <td width="10%" ><?php echo $row['Category']; ?> </td>
                    <td width="15%"> <input type="text" name="Category[]" placeholder="Category"></td>
                </tr>
            <?php endwhile; }?>
            </tbody>
        </table>
        </form>
</form>
<script>

</script>

</body>
</html>