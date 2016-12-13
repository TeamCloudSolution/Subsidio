<?php global $output; ?>
<section class="">
    <form action="loginnormal.php" method="POST">
        <div class="col-xs-12 text-center">
            <h4>Sistema de reserva para tickets para subsidio</h4>
        </div>
        <div class="col-xs-5"></div>
        <div class="col-xs-7">
            <h2>Bienvenido</h2>
        </div>
        <div class="clear"></div>
        <div class="col-xs-5"></div>
        <div class="col-xs-7">
            <?php
            require_once 'Facebook/autoload.php';
            $fb = new Facebook\Facebook([
                'app_id' => '167501017058971', // Replace {app-id} with your app id
                'app_secret' => '765ac310b6d6da2cf73968b3dced6b5e',
                'default_graph_version' => 'v2.2',
            ]);

            $helper = $fb->getRedirectLoginHelper();

            $permissions = ['email']; // Optional permissions
            $loginUrl = $helper->getLoginUrl('http://pereyrateam.com/cloudsolution/fb-callback.php', $permissions);

            /*  echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>'; */
            ?>
            <a href="<?php echo htmlspecialchars($loginUrl); ?>"><img src="img/facebook.jpeg" alt="facebook" width="50px" height="50px"></a>
            <a href="<?php echo $output; ?>"><img src="img/google.jpeg" alt="Google+" width="50px" height="50px"></a>
        </div>
        <div class="clear"></div>
        <div class="col-xs-5 text-right"> Usuario</div>
        <div class="col-xs-7"><input type="text" name="user" size="30"></div>
        <div class="clear"></div>
        <div class="col-xs-5 text-right">Contraseña</div>
        <div class="col-xs-7"><input type="password" name="pass" size="30"></div>
        <div class="clear"></div>
        <div class="col-xs-5 text-right"></div>
        <div class="col-xs-7"><a href="index.php?action=reestablecer">¿Olvidaste tu contraseña?</a></div>
        <div class="clear"></div>
        <div class="col-xs-5 text-right"></div>
        <div class="col-xs-7"><input type="submit" size="50" value="Iniciar Sesion"></div>
    </form>
</section>