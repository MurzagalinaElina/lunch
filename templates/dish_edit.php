<h2 class="content__main-heading">Редактирование блюда</h2>

<form class="form" action="" method="post" autocomplete="off">
  <div class="form__row">
    <label class="form__label" for="name">Название <sup>*</sup></label>
    <input class="form__input" type="text" name="name" id="name" value="<?= $dish['name'] ?>">
  </div>

  <div class="form__row form-check">
    <input class="form-check-input" type="checkbox" name="is_active" <?= $dish['is_active'] == 1 ? 'checked' : '' ?> id="is_active">
    <label class="form-check-label" for="is_active">Активен</label>
  </div>

  <div class="form__row form__row--controls">
    <input class="button" type="submit" name="" value="Сохранить">
  </div>
</form>
