$(document).ready(function() {
    fetch_data();

    function fetch_data() {
        var dataTable = $('#table_recipe').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "ajax/fetch.php",
                type: "POST"
            }
        });
    }

    setInterval(function() {
        $('#alert_message').html('');
        $('#alert_update').html('');
    }, 6000);


    $("#insertSubmit").click(function(event) {

        var form = $('#formInsert')[0];
        var data = new FormData(form);
        $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "ajax/insert.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function() {
                    $('#table_recipe').DataTable().destroy();
                    fetch_data();
                    $("#insertClose")[0].click();
                },
                error: function(data) {
                    $('#alert_message').html('<div class="alert alert-danger">' + "Wprowadź wszystkie wartości" + '</div>');
                }
            }

        );
    });

    $("#updateSubmit").click(function(event) {

        var form = $('#updateForm')[0];
        var data = new FormData(form);
        
        var id = $('#idUpdate').val();
        data.append('id', id);
        
        $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "ajax/update.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function(data) {
                    $('#table_recipe').DataTable().destroy();
                    fetch_data();
                    $("#UpdateClose")[0].click();
                },
                error: function(data) {
                    $('#alert_update').html('<div class="alert alert-danger">' + "Wprowadź wszystkie wartości" + '</div>');
                }
            }

        );
    });

    $(document).on('click', '.delete', function() {
        
        var data = new FormData();
        var id = $(this).attr("id");
        data.append('id', id);
        console.log(id);
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "ajax/delete.php",
            data: data,                       
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
            success: function(data) {
                console.log()
                $('#table_recipe').DataTable().destroy();
                fetch_data();                           
                },
            error: function(data) {
                    console.log("ups");
            }
        })
    });

});

var insertModal = document.getElementById('insertModal')
insertModal.addEventListener('show.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipeId = button.getAttribute('data-bs-whatever')
    var title = insertModal.querySelector('#title');
    var image = insertModal.querySelector('#image');
    var recipe = insertModal.querySelector('#recipe');

    title.value = null;
    image.value = "";
    recipe.value = "";

})

var updateModal = document.getElementById('updateModal')
updateModal.addEventListener('show.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipeId = button.getAttribute('data-bs-whatever')
    var modalTitle = updateModal.querySelector('#updateModalLabel')
    var title = updateModal.querySelector('#titleUpdate');
    var id = updateModal.querySelector('#idUpdate');
    var image = updateModal.querySelector('#img');
    var recipe = updateModal.querySelector('#recipeUpdate');
    var img = updateModal.querySelector('#imageUpdate');

    modalTitle.textContent = 'Edytujesz przepis: ' + recipeId;
    img.value="";
    var params = "id=" + recipeId;
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/getData.php", true);
    xhr.setRequestHeader('Content-type', "application/x-www-form-urlencoded");

    xhr.onload = function() {

        if (this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);

            title.value = data[0].title;
            id.value = data[0].id;
            image.src = "/" + data[0].image;
            recipe.value = data[0].recipe;
        }
    }

    xhr.send(params);


})