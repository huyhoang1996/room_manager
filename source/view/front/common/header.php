<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?web=dashboard">Go To Admin</a>
        </div>
        <div class="collapse navbar-collapse">
           <!--  <ul class="nav navbar-nav navbar-left">
                <li></li>
            </ul> -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php if(isset($_SESSION['user'])) { ?>
                        <a href="?web=logout">
                            <p>Log out</p>
                        </a>
                    <?php } else {?>
                        <a href="?web=login">
                            <p>Log in</p>
                        </a>
                    <?php } ?>
                </li>
				<li class="separator hidden-lg"></li>
            </ul>
        </div>
    </div>
</nav>