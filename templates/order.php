<h2 class="content__main-heading">Заказать</h2>

<form class="form" action="" method="post" autocomplete="off">
  <?php foreach ($categories as $category): ?>
    <div class="form-group">
      <label for="select<?= $category['id'] ?>">
        <?= htmlspecialchars($category['name']) ?>:
      </label>
      <select class="form-control" name="dishes[<?= $category['id'] ?>]" id="select<?= $category['id'] ?>">
        <option value="">Не выбрано</option>
        <?php foreach ($category['dishes'] as $dish): ?>
        <option <?= $dish['selected'] ? 'selected' : '' ?> value="<?= $dish['id'] ?>"><?= htmlspecialchars($dish['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <br>
  <?php endforeach; ?>

  <div class="form__row form__row--controls">
    <input class="button" type="submit" name="" value="Сохранить">
  </div>
</form>
