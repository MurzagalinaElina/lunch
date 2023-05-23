<h2 class="content__main-heading">Редактирование категории</h2>

<form class="form" action="" method="post" autocomplete="off">
  <div class="form__row">
    <label class="form__label" for="name">Название <sup>*</sup></label>
    <input class="form__input" type="text" name="name" id="name" value="<?= $category['name'] ?>" placeholder="Введите название категории">
  </div>

  <div class="form__row">
    <label class="form__label" for="position">Порядковый номер <sup>*</sup></label>
    <input class="form__input" type="number" name="position" id="position" value="<?= $category['position'] ?>">
  </div>

  <div class="form__row form__row--controls">
    <input class="button" type="submit" name="" value="Сохранить">
  </div>
</form>
