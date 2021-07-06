<?php
session_start();
include('header.php');?>
<body>
<?php
include('navbar_admin.php');?>

<section>
    <form method="post" action="upload.php" enctype="multipart/form-data">
        <div class="container">
            <div class="form-row form-row-edit">
                <div class="col col-md-4 col-12">
                    <h5 class="title-of-the-page">Modify Home</h5>
                </div>
            </div>
            <div class="form-row form-row-edit new-section">
                <div class="col col-md-4 col-12 section-margin">
                    <h6 class="title-section-padding">Hero section</h6>
                </div>
                <div class="col col-md-2 col-3"><label class="col-form-label modified-label">Title</label></div>
                <div class="col col-md-5"><input class="form-control form-2" type="text" name="textTitle" placeholder="Type title here"></div>
            </div>
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-4 col-3"><label class="col-form-label modified-label">Content</label></div>
                <div class="col col-md-5"><input class="form-control form-2" type="text" placeholder="Type content here" name="mainText"></div>
            </div>
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-4 col-3"><label class="col-form-label modified-label">Hero image</label></div>
                <div class="col d-md-flex align-items-md-center col-md-5"><input class="form-control-file" type="file" id="resetHero" name="resetHero"></div>
            </div>
            <div class="form-row form-row-edit new-section2">
                <div class="col col-md-4 col-12 section-margin">
                    <h6 class="title-section-padding">Burger of the day section</h6>
                </div>
                <div class="col col-md-2 col-3"><label class="col-form-label modified-label">Image</label></div>
                <div class="col d-md-flex align-items-md-center col-md-5"><input class="form-control-file resetDay .title-section-padding" type="file" name="resetDay"></div>
            </div>
            <div class="form-row">
                <div class="col text-center submit-col"><button class="btn btn-primary btn-custom3" type="submit" name="changeText">submit</button></div>
            </div>
        </div>
    </form>
</section>

<?php
include('footer.php');?>