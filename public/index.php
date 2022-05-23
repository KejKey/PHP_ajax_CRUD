<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "../controls/logout.php";
}

?>

<link href="..\style\navbar-top-fixed.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
</head>

<body>
    <?php include_once "../views/header.php"; ?>
    <?php require_once "../controls/userNotLogged.php"; ?>
    <?php include_once "../views/navbar.php"; ?>

    <main class="container">
        <div class="bg-light p-5 rounded">
            <div class="d-flex flex-row-reverse mb-2">
                <button id="add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal" data-bs-whatever="">Dodaj</button>
            </div>
            <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="insertModalLabel">Nowy przepis</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="alert_message"></div>
                            <form id="formInsert">
                                <div class="mb-3">
                                    <label for="recipe-title" class="col-form-label">Tytuł:</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="mb-3">
                                    <label for="recipe-image" class="col-form-label">Obraz:</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="recipe-text" class="col-form-label">Przepis:</label>
                                    <textarea class="form-control" id="recipe" name="recipe"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="insertClose">Zamknij</button>
                            <button type="button" class="btn btn-primary" id="insertSubmit" type="submit">Zapisz</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Nowy przepis</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div id="alert_update"></div>
                            <form id="updateForm">
                                <div class="mb-3">
                                    <label for="recipe-title" class="col-form-label">Tytuł:</label>
                                    <input type="text" class="form-control" id="titleUpdate" name="title">
                                    <input type="hidden" value="1" id="idUpdate">
                                </div>
                                <div class="mb-3">
                                    <img id="img" src="" class="img-fluid  mx-auto  d-block" />
                                </div>
                                <div class="mb-3">
                                    <label for="recipe-image" class="col-form-label">Obraz:</label>
                                    <input type="file" class="form-control" id="imageUpdate" name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="recipe-text" class="col-form-label">Przepis:</label>
                                    <textarea class="form-control" id="recipeUpdate" name="recipe"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="UpdateClose">Zamknij</button>
                            <button type="button" class="btn btn-primary" id="updateSubmit" type="submit">Zapisz</button>
                        </div>
                    </div>
                </div>
            </div>

            <table id="table_recipe" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>zdjęcie</th>
                        <th>tytuł</th>
                        <th></th>
                    </tr>
                </thead>
            </table>

        </div>
    </main>


    <script  type="text/javascript" src="js/main.js"></script>


    <?php include_once "../views/footer.php"; ?>