<?php
    $errors = "";

    $db = mysqli_connect('localhost', 'root', '', 'todo');

    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if (empty($task)) {
            $errors = "You must fill in the task";
        } else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');
        }
    }

    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: index.php');
        }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");

?>

<!doctype html>
<html lang="en">

<head>
    <title>PHP_TodoList</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="wrapper">
        <nav class="navbar navbar-light bg-light justify-content-center">
            <span class="navbar-brand mb-0 h1">Todo list with PHP and MySQL</span>
        </nav>
        <div class="main">
            <div class="addTask">
                <div class="container">
                    <h1 class="display-4">Todo list</h1>

                    <form method="POST" action="index.php">
                    <?php if (isset($errors)) { ?>
                        <p><?php echo $errors; ?></p>
                    <?php } ?>
                        <div class="form-row align-items-center">
                            <div class="col-md-auto">
                                <label class="sr-only" for="inlineFormInput">Add Task</label>
                                <input type="text" class="form-control mb-2" id="inlineFormInput" name="task"
                                    placeholder=" do the dishes...">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2" name="submit">+</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="taskWrapper">
                <div class="jumbotron jumbotron-fluid taskList">
                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">done?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td class="task"><?php echo $row['task']; ?></td>
                                    <td class="delete"><a class="btn btn-danger btn-sm" href="index.php?del_task=<?php echo $row['id']; ?>" role="button"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg></i></a></td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>