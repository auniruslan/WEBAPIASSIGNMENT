<?php
use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include employeesProc.php file
    include __DIR__ . '/../function/employeesProc.php';

//read table employees
    $app->get('/employees', function (Request $request, Response $response, array
    $arg){
    return $this->response->withJson(array('data' => 'success'), 200);
    });

// read all data from table employees
    $app->get('/allemployees',function (Request $request, Response $response,
    array $arg)
    {
    $data = getAllemployees($this->db);
    if (is_null($data)) {
    return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404);
    }
    return $this->response->withJson(array('data' => $data), 200);
    });

//request table employees by condition (employees code)
    $app->get('/employees/[{id}]', function ($request, $response, $args){
    $EmpCode = $args['id'];
    if (!is_numeric($EmpCode)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);
    }
    $data = getEmployees($this->db,$EmpCode);
    if (empty($data)) {
    return $this->response->withJson(array('error' => 'no data'), 500);
    }
    return $this->response->withJson(array('data' => $data), 200);
    });

    $app->post('/insertEmployee', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = createEmployees($this->db, $form_data);
    if ($data <= 0) {
    return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200);
    }
    );


//delete row
    $app->delete('/employees/del/[{code}]', function ($request, $response, $args){
    $EmpCode = $args['EmpCode'];
    if (!is_numeric($EmpCode)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
    }
    $data = deleteEmployees($this->db,$EmpCode);
    if (empty($data)) {
    return $this->response->withJson(array($EmpCode=> 'is successfully deleted'), 202);};
    });
    
//put table products
    $app->put('/employees/put/[{code}]', function ($request, $response, $args){
    $EmpCode = $args['code'];
    $date = date("Y-m-j h:i:s");
    if (!is_numeric($EmpCode)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
    }
    $form_dat=$request->getParsedBody();
    $data=updateEmployees($this->db,$form_dat,$EmpCode,$date);
    if ($data <=0)
    return $this->response->withJson(array('data' => 'successfully updated'), 200);
});