<h2>商品を出品する</h2>
<!-- fileフォームの送信方法をPOSTに設定 -->
<?= $this->Form->create($biditem, ['type' => 'file']) ?>
<fieldset>
    <legend>※商品名と終了日時を入力:</legend>
    <?php
    echo $this->Form->hidden('user_id', ['value' => $authuser['id']]);
    echo '<p><strong>USER: ' . $authuser['username'] . '</strong></p>';
    echo $this->Form->control('name');
    echo $this->Form->input('item_detail', [
        "type" => "textarea",
        "cols" => 10,
        "rows" => 5,
        "label" => "item_detail"
    ]);
    echo '出品画像登録';
    echo $this->Form->input('item_image', [
        "type" => "file",
        "label" => "item_image"
    ]);

    echo $this->Form->hidden('finished', ['value' => 0]);
    echo $this->Form->control('endtime');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
