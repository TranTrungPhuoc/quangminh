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
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Date Inserted</th>
                                <th>Active</th>
                                <th>Function</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($table as $key => $value) { 
                                $checked = ($value['status']==1) ? 'checked' : '';
                            ?>
                            <tr id="tr_<?php echo $value['id']; ?>">
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['firstname']; ?></td>
                                <td><?php echo $value['lastname']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['role']; ?></td>
                                <td><?php $date = explode(' ', $value['date_inserted']); echo $date[0]; ?></td>
                                <td><input type="checkbox" class="status_<?php echo $value['id']; ?>" onclick="script_status('<?php echo $value['id']; ?>')" <?php echo $checked; ?>></td>
                                <td>
                                    <a href="/admin/<?php echo explode('/',$_SERVER['REQUEST_URI'])[2]; ?>/update?id=<?php echo $value['id']; ?>" class="btn btn-sm btn-outline-info has-ripple">
                                        <i class="feather icon-edit"></i>
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger has-ripple" 
                                        data-bs-toggle="modal" data-bs-target="#popup_delete" onclick="getName('<?php echo $value['id']; ?>','<?php echo $value['lastname'].' '.$value['firstname']; ?>')">
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