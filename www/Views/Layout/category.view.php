<?php
use App\Models\Post;
$model = new Post();
?>

<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <?php
                foreach ($post as $key => $value) {

                    $user = $model->getDetail('esgi_User', $value['userid']);

            ?>


            <!-- Post preview-->
            <div class="post-preview">
                <a href="<?php echo strtolower(trim($value['slug']).'.html'); ?>">
                    <h2 class="post-title"><?php echo $value['title']; ?></h2>
                    <h3 class="post-subtitle"><?php echo $value['description']; ?></h3>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="<?php echo strtolower(trim($value['slug']).'.html'); ?>"><?php echo $user[0]['firstname'].' '.$user[0]['lastname']; ?></a>
                    <?php echo date("M jS, Y", strtotime($value['date_inserted'])); ?>
                </p>
            </div>

                <?php
                }
                ?>
        </div>
    </div>
</div>