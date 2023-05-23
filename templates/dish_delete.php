<h2 class="content__main-heading">Удаление занятия</h2>

<form class="form" action="" method="post">
  <p>Удалить "<?= $dish['name'] ?>"?</p><br>
  <p>
    <input type="submit" value="Удалить" class="btn btn-danger">
    <a href="dishes.php?category_id=<?= $category_id ?>" class="btn btn-default">Отмена</a>
  </p>
</form>
