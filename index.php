<?php

    $insert = false;
    $update = false;
    $delete = false;

    $serverName = "localhost";
    $username = "root";
    $password = "";
    $dbname = "toDoList";

    $conn = mysqli_connect($serverName, $username, $password, $dbname);
    if (!$conn) {
        die("Unable to build connection with the database" . mysqli_connect_error());
    }

    if (isset($_GET['delete'])) {

        $sno = $_GET['delete'];
        // echo $sno;

        $sql = "DELETE FROM `table no.1` WHERE `table no.1`.`sr no` = $sno";
        $reuslt = mysqli_query($conn, $sql);
        if ($reuslt) {
            $delete = true;
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['snoEdit'])) {
            $sno = $_POST['snoEdit'];
            $noteTitle = $_POST['noteTitleEdit'];
            $noteDescription = $_POST['noteDescriptionEdit'];

            $sql = "UPDATE `table no.1` SET `noteTitle` = '$noteTitle', `noteDescription` = '$noteDescription' WHERE `table no.1`.`sr no` = $sno";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $update = true;
            }
        } else {
            $noteTitle = $_POST['noteTitle'];
            $noteDescription = $_POST['noteDescription'];

            $sql = "INSERT INTO `table no.1` (`noteTitle`, `noteDescription`, `submissionDate`) VALUES ('$noteTitle', '$noteDescription', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $insert = true;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <title>PHP CRUD</title>
</head>

<body>

    <!-- Edit Modal -->
    <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../PHP CRUD PROJECT/index.php" method="post">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="noteTitle">Note Title</label>
                            <input type="text" class="form-control" name="noteTitleEdit" id="noteTitleEdit" aria-describedby="emailHelp" placeholder="Enter Note Title">
                        </div>
                        <div class="form-group">
                            <label for="Note Description">Note Description</label>
                            <textarea name="noteDescriptionEdit" class="form-control" id="noteDescriptionEdit" placeholder="Note Description" cols="20" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <img src="https://www.php.net/images/logos/php-logo.svg" width="50px" alt="">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php

        if ($insert) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Data Inserted Successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
        }

        if ($update) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Data Updated Successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
        }

        if ($delete) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Data Deleted Successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
    }

    ?>

    <div class="container my-4">
        <form action="../PHP CRUD PROJECT/index.php" method="post">
            <div class="form-group">
                <label for="noteTitle">Note Title</label>
                <input type="text" class="form-control" name="noteTitle" id="noteTitle" aria-describedby="emailHelp" placeholder="Enter Note Title">
            </div>
            <div class="form-group">
                <label for="Note Description">Note Description</label>
                <textarea name="noteDescription" class="form-control" id="noteDescription" placeholder="Note Description" cols="20" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    <div class="container my-4">

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM `table no.1`";
                $result = mysqli_query($conn, $sql);
                $sr_no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
    <th scope='row'>" . $sr_no . "</th>
    <td>" . $row['noteTitle'] . "</td>
    <td>" . $row['noteDescription'] . "</td>
    <td> <button class='edit btn btn-sm btn-primary' id=" . $row['sr no'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $row['sr no'] . ">Remove</button> </td>
  </tr>";

                    $sr_no = $sr_no + 1;
                }
                ?>

            </tbody>
        </table>

        </tbody>
        </table>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        let edit = document.getElementsByClassName("edit");
        Array.from(edit).forEach(element => {
            element.addEventListener("click", (e) => {
                // console.log("edit");
                let tr = e.target.parentNode.parentNode;
                let title = tr.getElementsByTagName("td")[0].innerText;
                let description = tr.getElementsByTagName("td")[1].innerText;
                noteTitleEdit.value = title;
                noteDescriptionEdit.value = description;

                console.log(title, description);
                $('#editModal').modal('toggle');

                snoEdit.value = e.target.id;
                console.log(e.target.id); 
            });
        });

        let deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach(element => {
            element.addEventListener("click", (e) => {

                sno = e.target.id.substr(1,);
                console.log(sno);

                if (confirm("Are you want to delete this record")) {
                    window.location = `../PHP CRUD PROJECT/index.php?delete=${sno}`;
                }
                else{
                    console.log("Deletion Process Aborted");
                }
            });
        });
    </script>
</body>

</html>