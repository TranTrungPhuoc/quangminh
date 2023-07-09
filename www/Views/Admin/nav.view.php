<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
                    <div class="user-details">
                        <div id="more-details"><?php echo $_SESSION["user"]['firstname']; ?> <i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="/admin/user/update?id=<?php echo $_SESSION["user"]["id"]; ?>" data-toggle="tooltip" title="View Profile"><i class="feather icon-user"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="/">
                                <i class="feather icon-mail" data-toggle="tooltip" title="Messages"></i>
                                <small class="badge badge-pill badge-primary">5</small>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="/logout" data-toggle="tooltip" title="Logout" class="text-danger">
                                <i class="feather icon-power"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <?php
                $nav = [
                    array("title"=>"Dashboard", "icon"=>"home", "link"=>"dashboard"),
                    array("title"=>"Category", "icon"=>"menu", "link"=>"category"),
                    array("title"=>"Post", "icon"=>"globe", "link"=>"post"),
                    array("title"=>"Menu", "icon"=>"navigation", "link"=>"menu"),
                    array("title"=>"Configs", "icon"=>"settings", "link"=>"configs"),
                    array("title"=>"User", "icon"=>"users", "link"=>"user")
                ];
            ?>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption"></li>
                <?php
                    $str='';
                    foreach ($nav as $key => $value) {
                        $str .= '<li class="nav-item pcoded-hasmenu">';
                            $str .= '<a href="'.$value['link'].'/index" class="nav-link ">';
                                $str .= '<span class="pcoded-micon"><i class="feather icon-'.$value['icon'].'"></i></span>';
                                $str .= '<span class="pcoded-mtext">'.$value['title'].'</span>';
                            $str .= '</a>';
                        $str .= '</li>';
                    }
                    echo $str;
                ?>
            </ul>
            
        </div>
    </div>
</nav>