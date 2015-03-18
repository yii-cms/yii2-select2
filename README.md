Select2 widget for Yii2 framework.
==================================

https://github.com/select2/select2

```php
    <?= $form->field($model, 'user_id')->widget(Select2::className(), [
        'items' => ArrayHelper::map(User::find()->all(), 'id', function($model) {
            return $model->username . " <{$model->email}>";
        }),
        'clientOptions' => [
            'placeholder' => 'User',
            'allowClear' => true,
        ],
        'clientEvents' => [
            'change'=>'function (e) {
                console.log("Select2 change.");
            }',
        ],
    ]) ?>
```

```php
    <?= Select2::widget([
        'name' => 'InputName',
        'items' => ArrayHelper::map(User::find()->all(), 'id', function($model) {
            return $model->fio . " <{$model->email}>";
        }),
        'clientOptions' => [
            'placeholder' => 'User',
            'allowClear' => true,
        ]
    ]) ?>
```
