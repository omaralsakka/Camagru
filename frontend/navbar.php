<?php
  session_start();
?>


  <!-- top navagation bar -->
  <div class="home-top-nav">
    <?php
    
    echo '
      <div class="home-top-nav-icon">
          <div class="home-top-nav-username">
            <h1 class="username-in-nav">'.$_SESSION['username'].'</h1>
          </div>
      </div>
    ';
    
    ?>
    <div class="home-top-nav-icon">
      <div class="home-top-nav-logo">
        <a href="home.php">
          <img
            src="../media/logos/Camagru-logos_sideBySide_black.png"
            alt="Camagru logo"
          />
        </a>
      </div>
    </div>

    <!-- top right side icons -->
    <div class="home-top-nav-icon">
      <div class="home-top-nav-icon-inside">
        <div class="home-top-nav-icons">
			<a class="outline" href="home.php"><img src="../media/icons/icons8-home-empty.svg" 
				onmouseover="this.src='../media/icons/icons8-home-filled.svg'" 
				onmouseout="this.src='../media/icons/icons8-home-empty.svg'" alt="home icon"></a>

        </div>

        <div class="home-top-nav-icons">
          <a class="outline" href="../srcs/profile-page.php"
            ><img
              src="../media/icons/icons8-cat-profile-outline.png"
              onmouseover="this.src='../media/icons/icons8-cat-profile-inline.png'"
              onmouseout="this.src='../media/icons/icons8-cat-profile-outline.png'"
              alt="profile image icon"
          /></a>
        </div>

        <div class="home-top-nav-icons">
          <a class="outline" href="editing-page.php"
            ><img
            id="editing"
            src="../media/icons/icons8-camera-100-outline.png"
            onmouseover="this.src='../media/icons/icons8-camera-100-inline.png'"
            onmouseout="this.src='../media/icons/icons8-camera-100-outline.png'"
            alt="camera image icon"
            />
          </a>
        </div>

        <div class="home-top-nav-icons">
          <a class="outline" href="settings.php"
            ><img
            id="settings"
            src="../media/icons/icons8-settings-outline.png"
            onmouseover="this.src='../media/icons/icons8-settings-inline.png'"
            onmouseout="this.src='../media/icons/icons8-settings-outline.png'"
            alt="camera image icon"
            />
          </a>
        </div>

        <div class="home-top-nav-icons">
          <a class="outline" href="signout.php"
            ><img
              id="logout"
              src="../media/icons/icons8-sign-out-outline.png"
              onmouseover="this.src='../media/icons/icons8-sign-out-inline.png'"
              onmouseout="this.src='../media/icons/icons8-sign-out-outline.png'"
              alt="log out image icon"
            />
          </a>
        </div>
      </div>
    </div>
  </div>