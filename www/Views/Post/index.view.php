<?php
use App\Models\Post;
$model = new Post();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    <a href="/admin/<?php echo explode('/',$_SERVER['REQUEST_URI'])[2]; ?>/insert" class="btn btn-sm btn-outline-primary has-ripple">
                        <i class="feather icon-plus"></i>
                        Add New
                    </a>
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-success alert-dismissible fade show" style="display:none;" role="alert"></div>
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap text-center">
                        <thead>
                            <tr>
                                <th>title</th>
                                <th>category</th>
                                <th>user</th>
                                <th>Date Inserted</th>
                                <th>Active</th>
                                <th>Function</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($table as $key => $value) { 
                                $checked = ($value['status']==1) ? 'checked' : '';
                                $category = $model->getDetail('esgi_Category', $value['categoryid']);
                                $user = $model->getDetail('esgi_User', $value['userid']);
                            ?>
                            <tr id="tr_<?php echo $value['id']; ?>">
                                <td><?php echo $value['title']; ?></td>
                                <td><?php echo ($category) ? '<span class="badge bg-warning">'.$category[0]['title'].'</span>':''; ?></td>
                                <td><?php echo ($user) ? '<span class="badge bg-success">'.$user[0]['firstname'].' '.$user[0]['lastname'].'</span>':''; ?></td>
                                <td><?php $date = explode(' ', $value['date_inserted']); echo $date[0]; ?></td>
                                <td><input type="checkbox" class="status_<?php echo $value['id']; ?>" onclick="script_status('<?php echo $value['id']; ?>')" <?php echo $checked; ?>></td>
                                <td>
                                    <a href="<?php echo '/'.trim($value['slug'],' ').'.html'; ?>" target="_blank" class="btn btn-sm btn-outline-primary has-ripple">
                                        <i class="feather icon-eye"></i>
                                        View
                                    </a>
                                    <a href="/admin/<?php echo explode('/',$_SERVER['REQUEST_URI'])[2]; ?>/update?id=<?php echo $value['id']; ?>" class="btn btn-sm btn-outline-info has-ripple">
                                        <i class="feather icon-edit"></i>
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger has-ripple" 
                                        data-bs-toggle="modal" data-bs-target="#popup_delete" onclick="getName('<?php echo $value['id']; ?>','<?php echo $value['title']; ?>')">
                                        <i class="feather icon-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>