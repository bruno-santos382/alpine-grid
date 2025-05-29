<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        li.active {
            color: red;
        }
    </style>
</head>
<body x-data>

<?php

$colunas = new class {
  public function textoEditavel(array $params): string {
    $options = (object) array_replace([
      'size' => 30,
      'maxlength' => 99,
    ], $params);
    
    return <<<HTML
    <input
        type="text"
        class="form-control input-small"
        @keyup.tab="\$dispatch('focusout')"
        @focusout.debounce.500ms="atualizarDados(row, \$el.value, '{$options->campo}')"
        :disabled="row.check_tratativa != null"
        :value="row.{$options->campo}"
        size="{$options->size}"
        maxlength="{$options->maxlength}"
        autocomplete="off"
    />
    <div style="margin-top: 6px">
      <span x-text="row.{$options->usuario_alteracao}"></span>
      <span x-text="row.{$options->data_alteracao}"></span>
    </div>
HTML;
  }
};

?>

<table x-grid="{url: 'https://jsonplaceholder.typicode.com/posts'}" @focusout.debounce.500ms="console.log($event.target)" border="1">
  <thead>
    <tr>
      <th x-grid:col="name" x-grid:hide>Coluna 1</th>
      <th x-grid:col="description">Coluna 2</th>
      <th x-grid:col="price">Coluna 3</th>
      <th x-grid:col="id">Coluna 4</th>
      <th x-grid:col="id" x-grid:no-sort>Coluna 5</th>
    </tr>
  </thead>
  <tbody>
    <template x-grid:each="row">
      <tr>
        <td>
          <?= $colunas->textoEditavel([
            'usuario_alteracao' => 'usuario_alteracao',
            'data_alteracao' => 'data_alteracao',
            'campo' => 'info_adicional'
          ]); ?> 
        </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </template>
  </tbody>
</table>

<script type="module" defer>
  import Alpine from './js/alpine/alpine.js';
  import datagrid from './js/alpine/datagrid.js';

  Alpine.plugin(datagrid)
  Alpine.start()
</script>

</body>
</html>
