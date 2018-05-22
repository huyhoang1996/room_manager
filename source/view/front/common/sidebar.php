<div class="sidebar-wrapper">
    <div class="logo">
        <a href="" class="simple-text">
            WELLCOME USER
        </a>
    </div>

    <ul class="nav">
        <li class="">
            <a href="?web=room">
                <i class="pe-7s-graph"></i>
                <p>Lab Room</p>
            </a>
        </li>
        <li>
            <a href="/?web=update_user&id=<?php echo $_SESSION['user_id'];?>">
                <i class="pe-7s-user"></i>
                <p>User Profile</p>
            </a>
        </li>
        <?php
            if ($_SESSION['is_admin']){
                echo '<li>
                    <a href="/?web=list_data">
                        <i class="pe-7s-note2"></i>
                        <p>Room List</p>
                    </a>
                </li>
                <li>
                    <a href="/?web=list_user">
                        <i class="pe-7s-note2"></i>
                        <p>User List</p>
                    </a>
                </li>';
            }
        ?>
    </ul>
</div>

