<?php

include_once('../../config/database.php');
include_once('../model/Category.php');

$action = $_GET['action'];
$Category = new Category($conn);

if ($action == 'getTableData') 
{
    $result = $Category->getAll();

    $table_data = '';
    $counter = 1;
    foreach ($result as $category) {
        $table_data .= '<tr>';
        $table_data .= '<td>' . $counter . '</td>';
        $table_data .= '<td><span class="category">'  . $category['name'] . '</span></td>';
        $table_data .= '<td class="col-actions">';
        $table_data .= '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
        $table_data .= '<button type="button" onclick="Category.clickUpdate('. $category['id'] .')" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Update </button>';
        $table_data .= '<button type="button" onclick="Category.clickDelete('. $category['id'] .')" class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i> Delete</button>';
        $table_data .= '</div>';
        $table_data .= '</td>';
        $table_data .= '</tr>';

        $counter++;
    }

    echo json_encode($table_data);
}

else if ($action == 'getSelectData')
{
    $result = $Category->getAll();

    $options = '<option value="" selected="true" disabled>Select Category</option>';

    foreach ($result as $category) 
    {
        $options .= '<option value='. $category['id'] .'>' . $category['name'] . '</option>';
    }

    echo json_encode($options);
}

else if ($action == 'getById')
{
    $category_id = $_POST['category_id'];

    echo json_encode($Category->getById($category_id));
}

else if ($action == 'save')
{
    $category_name = $_POST['category_name'];

    $request = [
        'name' => $category_name
    ];

    $result = $Category->save($request);

    echo json_encode($result);
}

else if ($action == 'update')
{
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];

    $request = [
        'id' => $category_id,
        'name' => $category_name,
    ];

    $result = $Category->update($request);

    echo json_encode($result);
}

else if ($action == 'delete')
{
    $category_id = $_POST['category_id'];

    $result = $Category->delete($category_id);

    echo json_encode($result);
}
