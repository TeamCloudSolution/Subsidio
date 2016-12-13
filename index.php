<?php

global $output;
if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    session_start();
    require_once 'Facebook/autoload.php';
    $fb = new Facebook\Facebook([
        'app_id' => '167501017058971', // Replace {app-id} with your app id
        'app_secret' => '765ac310b6d6da2cf73968b3dced6b5e',
        'default_graph_version' => 'v2.2',
    ]);
    $helper = $fb->getRedirectLoginHelper();
    $token = $helper->getAccessToken();
    $url = 'http://www.facebook.com/n/?home.php&clk_loc=5&mid=72b01a8G5af400143243G0Gd4&bcode=1.1354826874.AbllucLcWqHQbSNM&n_m=seans%40foundersfund.com';
    session_destroy();
    header('Location: ' . $url);
}
?>
<?php

//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';

if (isset($_GET['code'])) {
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
    //Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();

    //Initialize User class
    $user = new User();

    //Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider' => 'google',
        'oauth_uid' => $gpUserProfile['id'],
        'first_name' => $gpUserProfile['given_name'],
        'last_name' => $gpUserProfile['family_name'],
        'email' => $gpUserProfile['email'],
        'gender' => $gpUserProfile['gender'],
        'locale' => $gpUserProfile['locale'],
        'picture' => $gpUserProfile['picture'],
        'link' => $gpUserProfile['link']
    );
    $userData = $user->checkUser($gpUserData);

    //Storing user data into session
    $_SESSION['userData'] = $userData;

    //Render facebook profile data
    if (!empty($userData)) {
        $output = '<h1>Google+ Profile Details </h1>';
        $output .= '<img src="' . $userData['picture'] . '" width="300" height="220">';
        $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'] . ' ' . $userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Google';
        $output .= '<br/><a href="' . $userData['link'] . '" target="_blank">Click to Visit Google+ Page</a>';
        $output .= '<br/>Logout from <a href="logout.php">Google</a>';
    } else {
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
    $authUrl = $gClient->createAuthUrl();
    $output = filter_var($authUrl, FILTER_SANITIZE_URL);
}
?>
<?php

include_once 'header.php';
if (isset($_GET["action"]) && $_GET["action"] == "reestablecer") {
    include_once 'restart.php';
} elseif (!empty($userData)) {
    echo "<div class='col-xs-offset-3 col-xs-6'>";
    echo $output;
    echo "</div>";
} else {
    if (isset($_SESSION['fb_access_token']) && $_SESSION['fb_access_token'] != "") {
        include_once 'home.php';
    } else {
        include_once 'login.php';
    }
}
include_once 'footer.php';

