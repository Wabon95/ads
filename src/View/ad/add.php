<h1>Publier une annonce</h1>


<form enctype="multipart/form-data" action="/annonce/ajouter" method="post">

    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3">
                <label for="inputTitle" class="mb-2">Titre de l'annonce</label>
                <input type="text" class="form-control" name="inputTitle" id="inputTitle" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3">
                <label for="textareaContent" class="form-label">Description de l'annonce</label>
                <textarea class="form-control" name="textareaContent" id="textareaContent" rows="5" required></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group mb-3">
                <label for="inputPrice" class="mb-2">Prix</label>
                <input type="number" class="form-control" name="inputPrice" id="inputPrice">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group mb-3">
                <label for="inputFiles" class="form-label">Photos</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <input class="form-control" type="file" name="inputFiles[]" id="inputFiles" multiple required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3">
                <label for="selectCategory" class="form-label">Catégorie</label>
                <select class="form-select" name="selectCategory" id="selectCategory">
                    <?php 
                        foreach ($categories as $category) {
                            echo '<option value="' . $category->getName() . '">' . $category->getName() . '</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-4">Ajouter mon annonce</button>
</form>