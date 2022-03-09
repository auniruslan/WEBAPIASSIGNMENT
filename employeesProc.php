<?php

//get all employees
function getAllEmployees($db)
{
    $sql = 'Select EmpCode, EmpFName, EmpLName, Job as category from employee ';
    $stmt = $db->prepare ($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get employees by code
function getEmployees($db, $EmpCode)
{
    $sql = 'Select EmpCode, EmpFName, EmpLName, Job as category from employee ';
    $sql .= 'Where EmpCode = :EmpCode';
    $stmt = $db->prepare ($sql);
    $code = (int) $EmpCode;
    $stmt->bindParam(':EmpCode', $code, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add new employees
function createEmployees($db, $form_data) 
{
    $sql = 'Insert into employee (EmpCode, EmpFName, EmpLName,Job) ';
    $sql .= 'values (:EmpCode, :EmpFName, :EmpLName, :Job)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':EmpCode', floatval ($form_data['EmpCode']));
    $stmt->bindParam(':EmpFName', $form_data['EmpFName']);
    $stmt->bindParam(':EmpLName', $form_data['EmpLName']);
    $stmt->bindParam(':Job', $form_data['Job']);
    $stmt->execute();
    return $db->lastInsertCode(); //insert last number.. continue
}

//delete employees by code
function deleteEmployees($db,$EmpCode) 
{
    $sql = ' Delete from employee where EmpCode = :EmpCode';
    $stmt = $db->prepare($sql);
    $code = (int)$EmpCode;
    $stmt->bindParam(':EmpCode', $code, PDO::PARAM_INT);
    $stmt->execute();
}

//update employees by code
    function updateEmployees($db,$form_dat,$EmpCode,) 
{
    $sql = 'UPDATE employee SET EmpCode = :EmpCode , EmpFName = :EmpFName , EmpLName = :EmpLName , Job = :Job';
    $sql .=' WHERE EmpCode = :EmpCode';
    $stmt = $db->prepare ($sql);
    $code = (int)$EmpCode;
    $stmt->bindParam(':EmpCode', $code, PDO::PARAM_INT);
    $stmt->bindParam(':EmpFName', $form_dat['EmpFName']);
    $stmt->bindParam(':EmpLName', $form_dat['EmpLName']);
    $stmt->bindParam(':Job', $form_dat['Job']);
    $stmt->execute();
}