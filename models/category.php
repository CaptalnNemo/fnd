<?php
  class Category {
    public $id;
    public $name;
    public $parent_id;

    public function __construct($id, $name, $parent_id) {
      $this->id = $id;
      $this->name = $name;
      $this->parent_id = $parent_id;
    }

    public static function all() {
      $list = [];
      $db = DB::getInstance();
      $req = $db->query('SELECT * FROM categories');

      foreach($req->fetchAll() as $item) {
        $list[] = new Category($item['id'], $item['name'], $item['parent_id']);
      }

      return $list;
    }

    public static function find($id) {
      $db = DB::getInstance();
      $req = $db->prepare('SELECT * FROM categories WHERE id = :id');
      $req->execute(array('id' => $id));
      $item = $req->fetch();
      if (isset($item['id'])) {
        return new Category($item['id'], $item['name'], $item['parent_id']);
      }
      return null;
    }
  }
?>
