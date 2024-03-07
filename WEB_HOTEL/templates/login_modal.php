<?php if (!isLoggedin()) : ?>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Anmelden</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="?action=login" method="post">
                        <div id="login-form">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" required>

                            <label for="password">Passwort</label>
                            <input type="password" id="password" name="password" required>

                            <label id="rememberme">
                                <input type="checkbox" name="rememberme"> Angemeldet bleiben?
                            </label>

                            <p class="agreement-text">
                                Wenn du fortfährst, stimmst du unserer
                                <a href="?page=legal">Nutzungsvereinbarung</a>
                                zu und bestätigst, dass du die
                                <a href="?page=legal">Datenschutzerklärung</a>
                                verstehst.
                            </p>

                            <p>
                                <a class="forgot-password" href="#">Username oder Passwort vergessen?</a>
                            </p>

                            <input type="submit" value="Anmelden">

                            <p class="create-account">
                                Noch keinen Account? <a href="?page=register">Erstelle einen hier!</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>