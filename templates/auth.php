<h2 class="content__main-heading">Вход на сайт</h2>

<form class="form" action="" method="post">
  <div class="form__column">
    <div class="form__row">
      <?php $classname = isset($errors['username']) ? "form__input--error" : "";
      $value = isset($form['username']) ? $form['username'] : ""; ?>

      <label class="form__label" for="username">Username:</label>
      <input class="form__input <?=$classname;?>" type="text" name="username"
             id="username" value="<?=$value;?>">

      <?php if ($classname): ?>
        <div class="error-notice">
          <span class="error-notice__icon"></span>
          <span class="error-notice__tooltip"><?=$errors['username'];?></span>
        </div>
      <?php endif; ?>
    </div>

    <div class="form__row">
      <?php $classname = isset($errors['password']) ? "form__input--error" : "";
      $value = isset($form['password']) ? $form['password'] : ""; ?>

      <label class="form__label" for="password">Пароль:</label>
      <input class="form__input <?=$classname;?>" type="password"
             name="password" id="password">

      <?php if ($classname): ?>
        <div class="error-notice">
          <span class="error-notice__icon"></span>
          <span class="error-notice__tooltip"><?=$errors['password'];?></span>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="form__controls">
    <input class="button form__control" type="submit" name="" value="Войти">
  </div>
</form>

