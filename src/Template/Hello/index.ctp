<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <table>
        <?= $this->Html->tableHeaders(
            ["title", 'name', 'mail'],
            ['style' => ['background:#006;color:white']]
        ) ?>
        <?= $this->Html->tableCells(
            [
                ["this is sample", "taro", "taro@yamada"],
                ["test", "hanako", "hanako@kimura"],
            ],
            ['style' => ['background:#ccf']],
            ['style' => ['background:#dff']]
        ) ?>
    </table>
</body>

</html>