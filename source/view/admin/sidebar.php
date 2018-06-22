<div class="sidebar-wrapper">
    <div class="logo">
        <a href="" class="simple-text">
            Manager Room
        </a>
    </div>

    <ul class="nav">
        <li class="">
            <a href="/?web=room">
                <i class="pe-7s-graph"></i>
                <p>Lab Room</p>
            </a>
        </li>
        <li>
            <a href="/?web=update_user&id=<?php echo $_SESSION['user_id'];?>">
                <i class="pe-7s-user"></i>
                <p>My Profile</p>
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
<p class="copyright pull-right" style="
    position:  absolute;
    z-index: 4;
    bottom: 2px;
    color: black;
    font-size: 12px;
    text-align: center;
    left: 10px;
">
    &copy; <script>document.write(new Date().getFullYear())</script> Made by Huy Hoàng , Tấn Nam.
</p>
