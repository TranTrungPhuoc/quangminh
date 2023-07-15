<?php
use App\Models\Comment;
$model = new Comment();
?>
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <?php echo $content; ?>
                <hr>
                <h3>Comment</h3>
                <form id="script_comment">
                    <input type="hidden" class="form-control" id="postid" value="<?php echo $id; ?>">
                    <div class="mb-3 mt-3">
                        <label for="fullname" class="form-label">FullName:</label>
                        <input type="text" class="form-control" id="fullname" placeholder="Enter FullName" name="fullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Question:</label>
                        <textarea name="content" id="content" class="form-control" placeholder="Enter Content" cols="30" rows="10" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br>
                <div class="details">
                    <?php foreach ($conment as $key => $value) { 
                        $user = $model->getDetail('esgi_User', $value['userid']);   
                    ?>
                    <div class="card" style="margin-bottom:20px">
                        <div class="card-header">Name: <b><?php echo $value['title']; ?></b></div>
                        <div class="card-body">Question: <?php echo $value['content']; ?></div>
                        <?php if(count($user)>0){ ?>
                        <div class="card-header text-success">Name: <b><?php echo $user[0]['firstname'].' '.$user[0]['lastname']; ?></b></div>
                        <div class="card-body text-success">Reply: <?php echo $value['reply']; ?></div> 
                        <?php }?>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</article>

<?php
    if(isset($_SESSION['user'])){
?>

<style>
    .edit{
        position:fixed;
        bottom:10%;
        left:1%;
        border:1px solid black;
        border-radius:10px;
        padding:20px;
        background:black;
        color:white;
        font-size:16px;
        text-transform:uppercase;
    }
    .edit:hover{
        color: yellow;
    }
</style>

<a href="/admin/post/update?id=<?php echo $id; ?>" class="edit" target="_blank">
    Edit
</a>

<?php } ?>