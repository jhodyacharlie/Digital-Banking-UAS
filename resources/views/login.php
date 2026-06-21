<?php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
    $accountError = $errors->first('no_card');
    $passwordError = $errors->first('password');
    $loginError = $errors->first('login');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
    <title>Login Digital Banking</title>
</head>

<body>
    <main class="login-page">
        <section class="login-panel" aria-labelledby="login-title">
            <div class="brand">
                <div class="brand-mark" aria-hidden="true">DB</div>
                <div>
                    <p class="brand-kicker">Digital Banking</p>
                    <h1 id="login-title">Masuk Akun</h1>
                </div>
            </div>

            <?php if (session('status')): ?>
                <div class="notice success"><?php echo e(session('status')); ?></div>
            <?php endif; ?>

            <?php if ($loginError): ?>
                <div class="notice error"><?php echo e($loginError); ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login.store')); ?>" class="login-form" novalidate>
                <?php echo csrf_field(); ?>

                <div class="field">
                    <label for="no_card">No Kartu / Email</label>
                    <input
                        type="text"
                        name="no_card"
                        id="no_card"
                        value="<?php echo e(old('no_card')); ?>"
                        placeholder="Masukkan no kartu atau email"
                        autocomplete="username"
                        required
                        autofocus
                    >
                    <?php if ($accountError): ?>
                        <p class="input-error"><?php echo e($accountError); ?></p>
                    <?php endif; ?>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                    <?php if ($passwordError): ?>
                        <p class="input-error"><?php echo e($passwordError); ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <label for="remember" class="remember">
                        <input type="checkbox" name="remember" id="remember" value="1" <?php echo old('remember') ? 'checked' : ''; ?>>
                        Ingat saya
                    </label>
                    <a href="<?php echo e(route('login')); ?>">Lupa password?</a>
                </div>

                <p class="msg" aria-live="polite"></p>

                <button type="submit" id="login-btn" class="login-button">
                    Masuk
                </button>
            </form>
        </section>
    </main>

    <script src="<?php echo e(asset('js/login.js')); ?>" defer></script>
</body>

</html>
