  <style>
    .user-img {
        border-radius: 50%;
        height: 33px;
        width: 33px;
        object-fit: cover;
    }

    #links_box {
      display: flex;
      flex-direction: row;
      height: 35px;
    }

    #top_navbar {
      background-color: #fff;
    }

    #name_txt {
      color: #939597;
      margin-left: 13px;
    }

    #profile_img_and_name {
      display: flex;
      align-items: center;
    }

    #nav_item {
      color: #939597 !important;
      display: flex;
      align-items: center;
    }

    #nav_item_x {
      color: #939597 !important;
      display: flex;
      align-items: center;
    }

    #manage_account {
      color: #939597;
      display: flex;
      align-items: center;
    }

    #top_navbar {
      height: 60px;
    }

    #right_side_of_topbar {
      height: 45px;
      display: flex;
      align-items: baseline;
    }

    #icon_menu {
      width: 24px;
    }

    #profile_box {
      width: 70px;
    }

    @media only screen and (max-width: 567px){
      #profile_box {
        display: none;
      }

      #right_side_of_topbar {
        display: flex;
        align-items: center;
      }
    }

    @media only screen and (max-width: 390px){
      #nav_item_x {
        display: none;
      }
    }
  </style>
<!-- Navbar -->
  <nav id="top_navbar" class="main-header navbar navbar-expand navbar-primary navbar-dark ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <?php if(isset($_SESSION['login_id'])): ?>
      <li class="nav-item" id="hamburger_menu">
        <a class="nav-link" style="padding-left: 5px; padding-right: 5px;" id="nav_item" data-widget="pushmenu" href="" role="button">
          <img id="icon_menu" src="assets/uploads/menu_icon.png" alt="">
        </a>
      </li>
    <?php endif; ?>
      <li>
        <a class="nav-link text-white" id="nav_item"  href="./" role="button"> <large><b><?php echo $_SESSION['system']['name'] ?></b></large></a>
      </li>
    </ul>

    <ul id="right_side_of_topbar" class="navbar-nav ml-auto">
     
      <li class="nav-item" id="links_box">
        <a class="nav-link" data-tooltip="Fullscreen" data-position="bottom center" data-variation="tiny" id="nav_item_x" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
        <a class="nav-link" href="javascript:void(0)" data-tooltip="Manage account" data-position="bottom center" data-variation="tiny" id="manage_account">
          <i class="fa fa-cog"></i>
        </a>
        <a class="nav-link" id="nav_item" href="ajax.php?action=logout" data-tooltip="Logout" data-position="bottom center" data-variation="tiny">
          <i class="fa fa-power-off"></i>
        </a>
      </li>
     <li class="nav-item dropdown" id="profile_box">
        <a class="nav-link" aria-expanded="true" href="javascript:void(0)">
          <span>
            <div id="profile_img_and_name" class="d-felx badge-pill">
              <span class=""><img src="assets/uploads/<?php echo $_SESSION['login_avatar'] ?>" alt="" class="user-img border "></span>
            </div>
          </span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <script>
     $('#manage_account').click(function(){
        uni_modal('Manage Account','manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
     })
  </script>
